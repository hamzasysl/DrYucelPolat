<?php

namespace App\Traits;

trait RedirectsToThankYou
{
    protected function redirectToThankYou(array $data = []): mixed
    {
        session()->put('thank_you_allowed', true);
        session()->put('thank_you_data', $data);

        return redirect()->to('/thank-you');
    }
}
