<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Tüm view'lara settings + menüleri global olarak paylaş.
        // Helper veya facade yok — direkt Eloquent.
        View::composer('*', function ($view) {
            static $settings = null, $menus = null;
            if ($settings === null) {
                $settings = Setting::query()->pluck('value', 'key')->all();
            }
            if ($menus === null) {
                $menus = [
                    'header' => Menu::query()
                        ->where('location', 'header')
                        ->where('is_active', true)
                        ->whereNull('parent_id')
                        ->with(['children' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')])
                        ->orderBy('sort_order')
                        ->get(),
                    'footer' => Menu::query()
                        ->where('location', 'footer')
                        ->where('is_active', true)
                        ->whereNull('parent_id')
                        ->orderBy('sort_order')
                        ->get(),
                ];
            }
            $view->with([
                'siteSettings' => $settings,
                'siteMenus'    => $menus,
            ]);
        });
    }
}
