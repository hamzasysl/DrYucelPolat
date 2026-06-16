<?php

/**
 * Site sabit verileri — iletisim bilgisi, sosyal medya, logo, header menu.
 * Tek kaynak: degisecek bilgi sadece buradan guncellenir.
 */

return [
    'name'        => 'Op. Dr. Yücel Polat',
    'logo'        => '/img/logo.png',

    'phone'       => '+90 (000) 000 00 00',
    'phone_raw'   => '+900000000000',
    'email'       => 'info@dryucelpolat.com',
    'address'     => 'Liv Hospital İstanbul, Ulus Mah. Bestekar Şevki Bey Sok. No: 1, Beşiktaş / İstanbul',

    'whatsapp'    => 'https://wa.me/900000000000',

    // Boş bırakılan sosyaller header'da gizlenir.
    'socials' => [
        'instagram' => 'https://instagram.com/dryucelpolat',
        'facebook'  => '',
        'youtube'   => '',
        'linkedin'  => '',
        'x'         => '',
    ],

    // Header navigasyon — Hizmetler dropdown'i config/treatments.php'den beslenir.
    'nav' => [
        ['title' => 'Anasayfa',  'route' => 'home'],
        ['title' => 'Hakkımda',  'route' => 'about'],
        ['title' => 'Hizmetler', 'dropdown' => true],
        ['title' => 'Blog',      'route' => 'blog.index'],
        ['title' => 'İletişim',  'route' => 'contact'],
    ],
];
