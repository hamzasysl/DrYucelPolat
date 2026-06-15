<?php

use Illuminate\Support\Facades\Route;

Route::view('/',          'pages.home')    ->name('home');
Route::view('/hakkimda',  'pages.about')   ->name('about');
Route::view('/hizmetler', 'pages.services')->name('services.index');

// Hizmet detay sayfası yalnızca config/treatments.php'de 'has_page' => true olanlar için açılır.
Route::get('/hizmetler/{slug}', function (string $slug) {
    $service = collect(config('treatments'))->firstWhere('slug', $slug);
    abort_unless($service && ($service['has_page'] ?? false), 404);
    return view('pages.service-detail', compact('service'));
})->name('services.show');

Route::view('/iletisim',   'pages.contact') ->name('contact');
Route::view('/blog',       'pages.blog')    ->name('blog.index');

Route::view('/_palette', 'pages._palette')->name('palette');

Route::get('/thank-you', \App\Livewire\Ui\ThankYou::class)->name('thank-you');

// SEO: Sitemap.xml — yayında olan tüm sayfaları + has_page hizmetleri içerir.
Route::get('/sitemap.xml', function () {
    $now = now()->toAtomString();
    $urls = [
        ['loc' => route('home'),            'priority' => '1.0', 'changefreq' => 'weekly'],
        ['loc' => route('about'),           'priority' => '0.8', 'changefreq' => 'monthly'],
        ['loc' => route('services.index'),  'priority' => '0.9', 'changefreq' => 'monthly'],
        ['loc' => route('contact'),         'priority' => '0.7', 'changefreq' => 'monthly'],
        ['loc' => route('blog.index'),      'priority' => '0.6', 'changefreq' => 'weekly'],
    ];
    foreach (config('treatments', []) as $t) {
        if ($t['has_page'] ?? false) {
            $urls[] = [
                'loc' => route('services.show', $t['slug']),
                'priority' => '0.8',
                'changefreq' => 'monthly',
            ];
        }
    }
    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($urls as $u) {
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . htmlspecialchars($u['loc'], ENT_XML1) . "</loc>\n";
        $xml .= "    <lastmod>{$now}</lastmod>\n";
        $xml .= "    <changefreq>{$u['changefreq']}</changefreq>\n";
        $xml .= "    <priority>{$u['priority']}</priority>\n";
        $xml .= "  </url>\n";
    }
    $xml .= '</urlset>';
    return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
})->name('sitemap');

// robots.txt — Valet/nginx kendi robots location bloğu ile çakışmasın diye Laravel route ile servis ediyoruz.
Route::get('/robots.txt', function () {
    $body  = "User-agent: *\n";
    $body .= "Allow: /\n";
    $body .= "Disallow: /thank-you\n";
    $body .= "Disallow: /_palette\n";
    $body .= "\n";
    $body .= "Sitemap: " . route('sitemap') . "\n";
    return response($body, 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
});
