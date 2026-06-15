<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $fillable = [
        'form_type',
        'source',
        'locale',
        'geo_country',
        'geo_region',
        'geo_city',

        'name',
        'company',
        'phone',
        'email',
        'message',

        'ip',
        'user_agent',
        'details',
    ];

    protected $casts = [
        'details' => 'array',
    ];

    public const MAIL_COLUMNS = [
        'id',
        'form_type',
        'source',
        'locale',
        'name',
        'company',
        'phone',
        'email',
        'message',
        'details',
        'geo_country',
        'geo_region',
        'geo_city',
        'ip',
    ];

    public function mailSubject(string $brand): string
    {
        $lp     = $this->source ?: $brand;
        $locale = strtoupper(str_replace('-', '_', $this->locale ?: app()->getLocale()));
        $type   = ucfirst($this->form_type ?: 'simple');

        return "LP - {$lp} | {$locale} - {$type} Form | {$brand}";
    }

    public function detailsList(): array
    {
        $details = $this->details;

        if (!is_array($details) || $details === []) {
            return [];
        }

        $out = [];

        foreach ($details as $k => $v) {
            if ($v === null || $v === '') continue;
            if (is_array($v) && $v === []) continue;

            $out[$this->labelKey((string) $k)] = $this->stringValue($v);
        }

        return $out;
    }

    private function labelKey(string $key): string
    {
        return ucwords(str_replace(['_', '-'], ' ', $key));
    }

    private function stringValue(mixed $value): string
    {
        if (is_bool($value)) return $value ? 'Yes' : 'No';
        if (is_array($value)) {
            return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        return (string) $value;
    }
}
