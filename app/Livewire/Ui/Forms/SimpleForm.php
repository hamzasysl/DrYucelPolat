<?php

namespace App\Livewire\Ui\Forms;

use App\Pipelines\LeadPipeline;
use App\Traits\RedirectsToThankYou;
use Illuminate\Validation\ValidationException;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;
use Livewire\Component;

class SimpleForm extends Component
{
    use RedirectsToThankYou;

    public bool $success = false;
    public bool $submitFailed = false;

    public string $pageTitle = 'acreon-global';

    public string $name = '';
    public string $treatment = '';
    public string $email = '';
    public string $phone = '';
    public string $message = '';

    /** Honeypot — bot doldurursa submit no-op olur */
    public string $website = '';

    public function mount(?string $pageTitle = null): void
    {
        if ($pageTitle) {
            $this->pageTitle = $pageTitle;
        }
    }

    protected function rules(): array
    {
        $treatmentSlugs = array_column(config('treatments', []), 'slug');
        $treatmentSlugs[] = 'diger';

        return [
            'name'      => ['required', 'string', 'min:2', 'max:80'],
            'treatment' => ['required', 'string', 'in:' . implode(',', $treatmentSlugs)],
            'phone' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $util = PhoneNumberUtil::getInstance();

                    try {
                        $proto = $util->parse($value, null);
                        if (!$util->isValidNumber($proto)) {
                            $fail(__('validation.custom.phone.valid_phone'));
                        }
                    } catch (NumberParseException $e) {
                        $fail(__('validation.custom.phone.valid_phone'));
                    }
                },
            ],
            'email'   => ['nullable', 'email', 'max:180'],
            'message' => ['nullable', 'string', 'max:1000'],
        ];
    }

    private function buildPayload(array $validated): array
    {
        $treatments = collect(config('treatments', []))->keyBy('slug');
        $treatmentSlug  = $validated['treatment'];
        $treatmentLabel = $treatmentSlug === 'diger'
            ? 'Diğer Tedaviler'
            : ($treatments[$treatmentSlug]['title'] ?? $treatmentSlug);

        return [
            'name'    => $validated['name'],
            'phone'   => $validated['phone'],
            'email'   => $validated['email'],
            'message' => $validated['message'] ?? null,
            'details' => [
                'treatment_slug'  => $treatmentSlug,
                'treatment_label' => $treatmentLabel,
            ],
            'ref'     => request()->headers->get('referer'),
        ];
    }

    public function submit(): mixed
    {
        if ($this->website !== '') return null; // honeypot tripwire

        $this->success = false;
        $this->submitFailed = false;
        $this->resetErrorBag('form');

        $this->phone = preg_replace('/(?!^\+)\D+/', '', $this->phone ?? '');

        try {
            $validated = $this->validate();

            $payload = $this->buildPayload($validated);
            LeadPipeline::handle('simple', $payload);

            $this->reset(['name', 'treatment', 'phone', 'email', 'message']);
            $this->resetValidation();
            $this->success = true;

            return $this->redirectToThankYou($payload);

        } catch (ValidationException $e) {
            $this->addError('form', __('validation.check_marked_fields'));
            throw $e;

        } catch (\Throwable $e) {
            report($e);
            $this->submitFailed = true;
            return null;
        }
    }

    public function render()
    {
        return view('livewire.ui.forms.simple-form');
    }
}
