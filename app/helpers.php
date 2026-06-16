<?php

use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (! function_exists('setting')) {
    /**
     * Site ayarını oku — Setting modelinden, cache'lenir.
     */
    function setting(string $key, mixed $default = null): mixed
    {
        return Setting::get($key, $default);
    }
}

if (! function_exists('page_title')) {
    /**
     * Sayfa başlığı üretir — sağ tarafı (site adı + slogan) admin ayarlarından gelir.
     * Boş prefix'te yalnız site adı + slogan döner (anasayfa).
     */
    function page_title(?string $prefix = null): string
    {
        $name    = setting('site_name', 'Op. Dr. Yücel Polat');
        $tagline = setting('site_tagline', 'Kalp ve Damar Cerrahisi Uzmanı');

        if (! $prefix || trim($prefix) === '') {
            return $name . ($tagline ? ' — ' . $tagline : '');
        }
        return $prefix . ' — ' . $name . ($tagline ? ' | ' . $tagline : '');
    }
}

if (! function_exists('menu_items')) {
    /**
     * Belirli lokasyon (header/footer/mobile) için aktif menü öğelerini döndürür.
     * Cache'lenir; admin menü değiştirdiğinde MenuController içinden temizlenmelidir.
     */
    function menu_items(string $location = 'header'): \Illuminate\Database\Eloquent\Collection
    {
        return Cache::rememberForever("menu:items:{$location}", function () use ($location) {
            return Menu::query()
                ->where('location', $location)
                ->where('is_active', true)
                ->whereNull('parent_id')
                ->with(['children' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')])
                ->orderBy('sort_order')
                ->get();
        });
    }
}
