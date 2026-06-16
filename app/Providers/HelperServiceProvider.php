<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * app/helpers.php fonksiyonlarını her Laravel boot'unda zorunlu yükler.
     * Composer autoload "files" yedek olarak duruyor; bu provider her ortamda garanti
     * (özellikle production sunucularında opcache/dump sorunlarına karşı).
     */
    public function register(): void
    {
        $helpers = base_path('app/helpers.php');
        if (file_exists($helpers)) {
            require_once $helpers;
        }
    }
}
