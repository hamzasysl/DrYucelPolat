<?php

namespace App\Traits;

trait RedirectsToThankYou
{
    protected function redirectToThankYou(array $data = []): mixed
    {
        // Yönlendirme kaldırıldı — form Livewire tarafında $success = true
        // ile aynı sayfada teşekkür mesajı gösterecek.
        return null;
    }
}
