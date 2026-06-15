<?php

namespace App\Livewire\Ui\Forms;

use App\Pipelines\LeadPipeline;
use App\Traits\RedirectsToThankYou;
use Illuminate\Validation\ValidationException;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;
use Livewire\Component;

class ServiceQuickForm extends Component
{
    use RedirectsToThankYou;

    public bool $success = false;
    public bool $submitFailed = false;

    public string $pageTitle    = 'service-quick';
    public string $serviceSlug  = '';
    public string $serviceTitle = '';

    public string $name  = '';
    public string $phone = '';
    public string $email = '';

    /** Honeypot */
    public string $website = '';

    public function mount(?string $pageTitle = null, ?string $serviceSlug = null, ?string $serviceTitle = null): void
    {
        if ($pageTitle)    $this->pageTitle    = $pageTitle;
        if ($serviceSlug)  $this->serviceSlug  = $serviceSlug;
        if ($serviceTitle) $this->serviceTitle = $serviceTitle;
    }

    protected function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'min:2', 'max:80'],
            'email' => ['nullable', 'email', 'max:180'],
            'phone' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $util = PhoneNumberUtil::getInstance();
                    try {
                        $proto = $util->parse($value, null);
                        if (! $util->isValidNumber($proto)) {
                            $fail(__('validation.custom.phone.valid_phone'));
                        }
                    } catch (NumberParseException $e) {
                        $fail(__('validation.custom.phone.valid_phone'));
                    }
                },
            ],
        ];
    }

    public function submit(): mixed
    {
        if ($this->website !== '') return null; // honeypot tripwire

        $this->success      = false;
        $this->submitFailed = false;
        $this->resetErrorBag('form');

        $this->phone = preg_replace('/(?!^\+)\D+/', '', $this->phone ?? '');

        try {
            $validated = $this->validate();

            $payload = [
                'name'    => $validated['name'],
                'phone'   => $validated['phone'],
                'email'   => $validated['email'],
                'message' => null,
                'details' => [
                    'service_slug'  => $this->serviceSlug,
                    'service_title' => $this->serviceTitle,
                    'source_form'   => 'service-quick',
                ],
                'ref' => request()->headers->get('referer'),
            ];

            LeadPipeline::handle('service-quick', $payload);

            $this->reset(['name', 'phone', 'email']);
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
        return view('livewire.ui.forms.service-quick-form');
    }
}
