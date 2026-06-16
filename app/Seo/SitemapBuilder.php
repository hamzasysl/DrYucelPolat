<?php

namespace App\Seo;

use Illuminate\Support\Carbon;

/**
 * MEZ SEO — Sitemap Builder
 * ------------------------------------------------------------
 * Site sayfalarını grup grup toplar, XML ve HTML sitemap'i tek yerden besler.
 * Yayında olmayan hizmetler (has_page=false) sitemap'e dahil edilmez.
 */
class SitemapBuilder
{
    /** @return array<int, array<string, mixed>> */
    public function groups(): array
    {
        return [
            [
                'key'   => 'main',
                'title' => 'Ana Sayfalar',
                'icon'  => 'fa-house',
                'color' => 'deep',
                'pages' => [
                    [
                        'title'      => 'Anasayfa',
                        'url'        => route('home'),
                        'desc'       => 'Op. Dr. Yücel Polat — Kalp ve damar cerrahisi uzmanı, ana giriş sayfası.',
                        'priority'   => '1.0',
                        'changefreq' => 'weekly',
                    ],
                    [
                        'title'      => 'Hakkımda',
                        'url'        => route('about'),
                        'desc'       => 'Kim, deneyim, uzmanlık alanları ve klinik felsefe.',
                        'priority'   => '0.8',
                        'changefreq' => 'monthly',
                    ],
                    [
                        'title'      => 'İletişim',
                        'url'        => route('contact'),
                        'desc'       => 'Randevu, telefon, WhatsApp ve adres bilgileri.',
                        'priority'   => '0.7',
                        'changefreq' => 'monthly',
                    ],
                ],
            ],
            [
                'key'   => 'services',
                'title' => 'Hizmetler',
                'icon'  => 'fa-stethoscope',
                'color' => 'brand',
                'pages' => collect([
                    [
                        'title'      => 'Tüm Hizmetler',
                        'url'        => route('services.index'),
                        'desc'       => 'Uzmanlık alanları katalog sayfası — 8 ana tedavi başlığı.',
                        'priority'   => '0.9',
                        'changefreq' => 'monthly',
                        'is_index'   => true,
                    ],
                ])->merge(
                    collect(config('treatments', []))
                        ->filter(fn ($t) => $t['has_page'] ?? false)
                        ->map(fn ($t) => [
                            'title'      => $t['title'],
                            'url'        => route('services.show', $t['slug']),
                            'desc'       => $t['short'] ?? '',
                            'priority'   => '0.8',
                            'changefreq' => 'monthly',
                            'icon'       => $t['icon'] ?? null,
                        ])
                )->values()->all(),
            ],
            [
                'key'   => 'blog',
                'title' => 'Blog & Yayınlar',
                'icon'  => 'fa-newspaper',
                'color' => 'leaf',
                'pages' => [
                    [
                        'title'      => 'Blog',
                        'url'        => route('blog.index'),
                        'desc'       => 'Kalp ve damar sağlığı, tedavi yöntemleri ve hasta bilgilendirme yazıları.',
                        'priority'   => '0.6',
                        'changefreq' => 'weekly',
                    ],
                ],
            ],
        ];
    }

    /**
     * Düz URL listesi — XML sitemap için.
     * @return array<int, array<string, string>>
     */
    public function flatUrls(): array
    {
        $urls = [];
        foreach ($this->groups() as $group) {
            foreach ($group['pages'] as $page) {
                $urls[] = [
                    'loc'        => $page['url'],
                    'priority'   => $page['priority'] ?? '0.5',
                    'changefreq' => $page['changefreq'] ?? 'monthly',
                ];
            }
        }
        return $urls;
    }

    /** Toplam yayında URL sayısı */
    public function totalUrls(): int
    {
        return count($this->flatUrls());
    }

    /** İstatistik özet — HTML sitemap'in üstündeki dashboard için */
    public function stats(): array
    {
        $total  = $this->totalUrls();
        $groups = $this->groups();

        $services = collect(config('treatments', []));
        $published   = $services->filter(fn ($t) => $t['has_page'] ?? false)->count();
        $unpublished = $services->count() - $published;

        return [
            'total_urls'        => $total,
            'group_count'       => count($groups),
            'services_total'    => $services->count(),
            'services_live'     => $published,
            'services_draft'    => $unpublished,
            'last_modified'     => Carbon::now()->setTimezone('Europe/Istanbul')->format('d.m.Y H:i'),
            'sitemap_xml_url'   => url('/sitemap.xml'),
            'robots_url'        => url('/robots.txt'),
            'llms_url'          => url('/llms.txt'),
            'ai_url'            => url('/ai.txt'),
            'canonical_host'    => parse_url(url('/'), PHP_URL_HOST),
            'package_version'   => '1.1.0',
            'package_name'      => 'MEZ SEO',
            'package_author'    => 'Mez Bilişim',
            'package_url'       => 'https://mezbilisim.com',
        ];
    }
}
