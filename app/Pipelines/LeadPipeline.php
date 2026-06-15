<?php

namespace App\Pipelines;

use App\Mail\LeadSubmitted;
use App\Models\FormSubmission;
use App\Services\ClientIp;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Torann\GeoIP\Facades\GeoIP;

class LeadPipeline
{
    private const CORE_FIELDS = [
        'name',
        'company',
        'phone',
        'email',
        'message',
    ];

    public static function handle(string $formType, array $payload): FormSubmission
    {
        $ip  = ClientIp::get();
        $loc = self::resolveGeo($ip);

        $payload = self::flattenIncomingDetails($payload);

        $core = [];
        foreach (self::CORE_FIELDS as $field) {
            if (array_key_exists($field, $payload)) {
                $core[$field] = $payload[$field];
                unset($payload[$field]);
            }
        }

        $details = $payload;

        $submission = FormSubmission::create([
            'form_type'   => $formType,
            'source'      => session('lp_name', session('lp_title', 'acreon-global')),
            'locale'      => app()->getLocale(),

            'geo_country' => $loc['country'],
            'geo_region'  => $loc['region'],
            'geo_city'    => $loc['city'],

            'ip'          => $ip,
            'user_agent'  => request()->userAgent(),

            ...$core,
            'details'     => $details,
        ]);

        self::sendMail($submission->id);
        self::forwardToMezesoft($core, $details);

        return $submission;
    }

    private static function flattenIncomingDetails(array $payload): array
    {
        if (isset($payload['details']) && is_array($payload['details'])) {
            $payload = array_merge($payload['details'], $payload);
        }

        unset($payload['details']);

        return $payload;
    }

    private static function resolveGeo(string $ip): array
    {
        try {
            $loc = GeoIP::getLocation($ip)?->toArray() ?? [];
        } catch (\Throwable) {
            return ['country' => null, 'region' => null, 'city' => null];
        }

        return [
            'country' => $loc['country_code2'] ?? null,
            'region'  => $loc['state_prov'] ?? null,
            'city'    => $loc['city'] ?? null,
        ];
    }

    private static function sendMail(int $submissionId): void
    {
        app()->terminating(function () use ($submissionId) {
            app()->instance('lead_submission_id', $submissionId);

            Mail::to(config('mail.username') ?: config('mail.from.address'))
                ->cc(config('leads.mail_cc', []))
                ->bcc(config('leads.mail_bcc', []))
                ->send(new LeadSubmitted());
        });
    }

    private static function forwardToMezesoft(array $core, array $details): void
    {
        try {
            Http::acceptJson()->asJson()->post(config('services.mezesoft.endpoint'), [
                'landing_id' => config('services.mezesoft.landing_id'),
                'name'       => $core['name']  ?? null,
                'phone'      => $core['phone'] ?? null,
                'email'      => $core['email'] ?? null,

                'other_details' => collect($details)
                    ->except(['message', 'mesaj'])
                    ->merge([
                        'Company' => $core['company'] ?? null,
                        'Mesaj'   => $core['message'] ?? null,
                    ])
                    ->filter(fn ($v) => $v !== null && $v !== '')
                    ->mapWithKeys(fn ($v, $k) => [
                        ucwords(str_replace('_', ' ', (string) $k)) =>
                            (is_string($v)
                                ? ucwords(str_replace(['_', '-'], ' ', $v))
                                : $v),
                    ])
                    ->toArray(),
            ]);
        } catch (\Throwable $e) {
            report($e);
        }
    }
}
