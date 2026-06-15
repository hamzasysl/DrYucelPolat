<?php

namespace App\Livewire\Ui;

use Livewire\Component;

class ThankYou extends Component
{
    public array $thankYouData = [];

    public function mount(): void
    {
        app()->setLocale(config('app.locale', 'en'));

        abort_unless(session()->get('thank_you_allowed'), 404);
        session()->forget('thank_you_allowed');

        $this->thankYouData = session()->pull('thank_you_data', []);
    }

    public function render()
    {
        return view('livewire.ui.thank-you', [
            'thankYouData' => $this->thankYouData,
        ])->layout('layouts.app', [
            'seo' => [
                'title'       => __('site.thankyou.title'),
                'description' => '',
                'canonical'   => url()->current(),
                'robots'      => 'noindex,nofollow',
            ],
        ]);
    }
}
