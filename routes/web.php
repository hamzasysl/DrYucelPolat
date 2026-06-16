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

// ============================================================
// MEZ SEO — Sitemap Modülü
// HTML görseli + XML crawl feed'i tek SitemapBuilder'dan üretilir.
// ============================================================

// /sitemap — Kullanıcılar için şık HTML görsel sitemap (MEZ SEO paneli)
Route::get('/sitemap', function (\App\Seo\SitemapBuilder $builder) {
    return view('pages.sitemap', [
        'groups' => $builder->groups(),
        'stats'  => $builder->stats(),
    ]);
})->name('sitemap.html');

// /sitemap.xml — Arama motorları için XML feed + XSL stylesheet ile görsel sürüm
Route::get('/sitemap.xml', function (\App\Seo\SitemapBuilder $builder) {
    $now = now()->toAtomString();
    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<?xml-stylesheet type="text/xsl" href="' . asset('sitemap.xsl') . '"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($builder->flatUrls() as $u) {
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

// robots.txt — Klasik arama + AI/LLM crawler direktifleri ile birlikte.
Route::get('/robots.txt', function () {
    $body  = "# ============================================================\n";
    $body .= "# MEZ SEO — Crawler Directives\n";
    $body .= "# ============================================================\n\n";

    // Genel arama motorları
    $body .= "User-agent: *\n";
    $body .= "Allow: /\n";
    $body .= "Disallow: /thank-you\n";
    $body .= "Disallow: /_palette\n";
    $body .= "Disallow: /livewire/\n\n";

    // AI / LLM crawler'larına açık erişim — bilgilendirme amaçlı içerik
    // taranabilir ve tıbbi rehber yanıtlarında kaynak gösterilebilir.
    foreach ([
        'GPTBot',                   // OpenAI — ChatGPT crawler
        'OAI-SearchBot',            // OpenAI — search index
        'ChatGPT-User',             // OpenAI — kullanıcı tetikli fetch
        'ClaudeBot',                // Anthropic — Claude crawler
        'anthropic-ai',             // Anthropic — eski adı
        'Claude-Web',               // Anthropic — web fetch
        'Google-Extended',          // Google — Bard/Gemini training
        'PerplexityBot',            // Perplexity AI
        'Perplexity-User',          // Perplexity — kullanıcı tetikli
        'YouBot',                   // You.com AI
        'cohere-ai',                // Cohere
        'Bytespider',               // ByteDance (Doubao)
        'Amazonbot',                // Amazon (Alexa, Rufus)
        'Applebot-Extended',        // Apple Intelligence training
        'Meta-ExternalAgent',       // Meta AI
        'Meta-ExternalFetcher',     // Meta — kullanıcı tetikli
        'FacebookBot',              // Meta arama
        'CCBot',                    // Common Crawl (birçok LLM bunu kullanır)
        'Diffbot',
        'Omgili',
        'Timpibot',                 // Timpi AI
        'DuckAssistBot',            // DuckDuckGo AI
        'MistralAI-User',           // Mistral AI
        'PetalBot',                 // Huawei
    ] as $bot) {
        $body .= "User-agent: {$bot}\n";
        $body .= "Allow: /\n\n";
    }

    // Sitemap + LLM index dosyaları
    $body .= "# Sitemap & LLM index\n";
    $body .= "Sitemap: " . route('sitemap') . "\n";
    $body .= "# LLM-friendly content map: " . url('/llms.txt') . "\n";

    return response($body, 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
});

// llms.txt — LLM/AI crawler'lar için Markdown formatında yapılandırılmış içerik indeksi.
// Spec: https://llmstxt.org/
Route::get('/llms.txt', function (\App\Seo\LlmsTxtBuilder $builder) {
    return response($builder->render(), 200, ['Content-Type' => 'text/markdown; charset=UTF-8']);
})->name('llms');

// /api/geo — Server-side GeoIP. JS phone input bunu çağırır, ipapi.co rate-limit derdi yok.
Route::get('/api/geo', function () {
    $ip = \App\Services\ClientIp::get();
    $fallback = 'tr';
    try {
        $loc = \Torann\GeoIP\Facades\GeoIP::getLocation($ip)?->toArray() ?? [];
        $code = strtolower($loc['country_code2'] ?? $loc['iso_code'] ?? '');
        if (! $code || $code === 'xx') $code = $fallback;
        return response()->json([
            'country_code' => $code,
            'city'         => $loc['city']      ?? null,
            'region'       => $loc['state_prov']?? null,
            'ip'           => $ip,
        ])->header('Cache-Control', 'public, max-age=3600');
    } catch (\Throwable) {
        return response()->json(['country_code' => $fallback])->header('Cache-Control', 'public, max-age=300');
    }
})->name('api.geo');

// ai.txt — Spawning.ai standardı: AI eğitimi için içerik kullanımı izni.
Route::get('/ai.txt', function () {
    $body  = "# AI Training & Content Use Policy\n";
    $body .= "# Standard: https://site.spawning.ai/spawning-ai-txt\n\n";
    $body .= "User-Agent: *\n";
    $body .= "Allow: search-ai\n";
    $body .= "Allow: train-ai\n";
    $body .= "Allow: train-genai\n";
    $body .= "\n";
    $body .= "Contact: " . config('mail.from.address', 'info@dryucelpolat.com') . "\n";
    return response($body, 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
});
