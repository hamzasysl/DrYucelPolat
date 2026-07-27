<?php

/**
 * Site sabit verileri — iletisim bilgisi, sosyal medya, logo, header menu.
 * Tek kaynak: degisecek bilgi sadece buradan guncellenir.
 */

return [
    'name'        => 'Op. Dr. Yücel Polat',
    'logo'        => '/img/logo.svg',

    'phone'       => '+90 506 235 10 88',
    'phone_raw'   => '+905062351088',
    'email'       => 'dr.yucelpolat@hotmail.com',
    'address'     => 'Liv Hospital İstanbul, Ulus Mah. Bestekar Şevki Bey Sok. No: 1, Beşiktaş / İstanbul',

    'whatsapp'    => 'https://wa.me/905062351088',

    // Boş bırakılan sosyaller header'da gizlenir.
    'socials' => [
        'instagram' => 'https://instagram.com/dryucelpolat',
        'facebook'  => 'https://facebook.com/dryucelpolat',
        'youtube'   => 'https://youtube.com/@dryucelpolat',
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
