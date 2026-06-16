<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            // General
            ['key' => 'site_name',         'value' => 'Op. Dr. Yücel Polat',  'group' => 'general',  'label' => 'Site Adı'],
            ['key' => 'site_tagline',      'value' => 'Kalp ve Damar Cerrahisi Uzmanı', 'group' => 'general', 'label' => 'Slogan'],
            ['key' => 'site_logo',         'value' => '/img/logo.png',         'group' => 'general',  'label' => 'Logo URL'],

            // Contact
            ['key' => 'contact_phone',     'value' => '+90 (000) 000 00 00',   'group' => 'contact',  'label' => 'Telefon'],
            ['key' => 'contact_phone_raw', 'value' => '+900000000000',         'group' => 'contact',  'label' => 'Telefon (E.164)'],
            ['key' => 'contact_email',     'value' => 'info@dryucelpolat.com', 'group' => 'contact',  'label' => 'E-posta'],
            ['key' => 'contact_address',   'value' => 'Liv Hospital, Sarıyer / İstanbul', 'group' => 'contact', 'label' => 'Adres'],
            ['key' => 'whatsapp_url',      'value' => 'https://wa.me/900000000000', 'group' => 'contact', 'label' => 'WhatsApp Link'],

            // Social
            ['key' => 'social_instagram',  'value' => 'https://instagram.com/dryucelpolat', 'group' => 'social', 'label' => 'Instagram'],
            ['key' => 'social_facebook',   'value' => '',                      'group' => 'social',   'label' => 'Facebook'],
            ['key' => 'social_youtube',    'value' => '',                      'group' => 'social',   'label' => 'YouTube'],
            ['key' => 'social_linkedin',   'value' => '',                      'group' => 'social',   'label' => 'LinkedIn'],
            ['key' => 'social_x',          'value' => '',                      'group' => 'social',   'label' => 'X (Twitter)'],

            // SEO Defaults
            ['key' => 'seo_default_title',       'value' => 'Op. Dr. Yücel Polat — Kalp ve Damar Cerrahisi Uzmanı', 'group' => 'seo', 'label' => 'Varsayılan Title'],
            ['key' => 'seo_default_description', 'value' => '20+ yıl deneyimle kalp damar cerrahisi, varis tedavisi, koroner bypass.', 'group' => 'seo', 'label' => 'Varsayılan Description'],
            ['key' => 'seo_og_image',            'value' => '/img/doktor.webp', 'group' => 'seo', 'label' => 'Varsayılan OG Image'],
            ['key' => 'seo_geo_region',          'value' => 'TR-34',            'group' => 'seo', 'label' => 'Geo Region'],
            ['key' => 'seo_geo_placename',       'value' => 'İstanbul',         'group' => 'seo', 'label' => 'Geo Placename'],

            // Branding
            ['key' => 'brand_color_primary',  'value' => '#E63946',  'group' => 'brand', 'label' => 'Birincil Renk'],
            ['key' => 'brand_color_deep',     'value' => '#1E5F9E',  'group' => 'brand', 'label' => 'İkincil Renk (Mavi)'],
            ['key' => 'brand_color_leaf',     'value' => '#84CC16',  'group' => 'brand', 'label' => 'Üçüncül Renk (Yeşil)'],
        ];

        foreach ($defaults as $row) {
            Setting::updateOrCreate(['key' => $row['key']], $row);
        }
    }
}
