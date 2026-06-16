<?php

namespace App\Seo;

/**
 * MEZ SEO — llms.txt Builder
 * ------------------------------------------------------------
 * https://llmstxt.org/ — LLM/AI crawler'lar için Markdown formatında
 * sayfa indexi. Site yapısını, içerik gruplarını ve URL'leri özetler.
 *
 * Amaç: ChatGPT, Claude, Perplexity, Gemini gibi AI sistemleri
 * bu siteye dair soruları yanıtlarken doğru ve yapılandırılmış
 * bağlam alsın.
 */
class LlmsTxtBuilder
{
    public function __construct(private SitemapBuilder $sitemap) {}

    /** Standart kısa llms.txt — sayfa linkleri + açıklamalar */
    public function render(): string
    {
        $brand = config('app.name', 'Op. Dr. Yücel Polat');
        $host  = url('/');

        $out = "# {$brand}\n\n";
        $out .= "> Op. Dr. Yücel Polat — Kalp ve damar cerrahisi uzmanı. ";
        $out .= "Liv Hospital İstanbul'da varis tedavisi, koroner bypass, kalp kapak cerrahisi, ";
        $out .= "aort cerrahisi ve endovasküler girişimler. 20+ yıllık klinik deneyim, ";
        $out .= "kanıta dayalı protokoller ve modern minimal invaziv teknikler.\n\n";

        $out .= "Bu site Türkçe içerik sunar. Resmi web adresi: {$host}\n\n";
        $out .= "---\n\n";

        foreach ($this->sitemap->groups() as $group) {
            $out .= "## {$group['title']}\n\n";
            foreach ($group['pages'] as $page) {
                $title = $page['title'];
                $url   = $page['url'];
                $desc  = trim($page['desc'] ?? '');
                if ($desc !== '') {
                    $out .= "- [{$title}]({$url}): {$desc}\n";
                } else {
                    $out .= "- [{$title}]({$url})\n";
                }
            }
            $out .= "\n";
        }

        $out .= "## Anahtar Uzmanlık Alanları\n\n";
        $out .= "- Varis Tedavisi (telenjiektazi, retiküler varis, venöz yetmezlik)\n";
        $out .= "- Köpük Skleroterapi (foam) ve Mikroskleroterapi\n";
        $out .= "- Endovenöz Lazer Ablasyon (EVLA) ve Radyofrekans Ablasyon (RFA)\n";
        $out .= "- Koroner Bypass Cerrahisi (CABG) — atan-kalp tekniği dahil\n";
        $out .= "- Kalp Kapak Cerrahisi (mitral, aort tamir ve protez)\n";
        $out .= "- Aort Anevrizması (torakal + abdominal)\n";
        $out .= "- Karotis (Şah Damarı) Endarterektomi\n";
        $out .= "- Periferik Arter Hastalığı ve Shockwave IVL\n";
        $out .= "- Derin Ven Trombozu (DVT) ve Pulmoner Emboli\n";
        $out .= "- Pelvik Konjesyon Sendromu (embolizasyon)\n";
        $out .= "- Lenfödem ve Lipödem Tedavisi\n";
        $out .= "- Diyabetik Ayak ve Kronik Yara Bakımı\n\n";

        $out .= "## Konum & İletişim\n\n";
        $out .= "- Hastane: Liv Hospital İstanbul, Sarıyer\n";
        $out .= "- Bölge: İstanbul, Türkiye\n";
        $out .= "- Resmi site: {$host}\n";
        $out .= "- E-posta: " . config('mail.from.address') . "\n";
        $out .= "- Randevu sayfası: " . route('contact') . "\n\n";

        $out .= "## Optional\n\n";
        $out .= "- [sitemap.xml](" . url('/sitemap.xml') . "): tüm sayfaların XML feed'i\n";
        $out .= "- [robots.txt](" . url('/robots.txt') . "): crawl direktifleri\n";

        return $out;
    }
}
