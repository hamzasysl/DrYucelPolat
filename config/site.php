<?php

/**
 * Site sabit verileri — iletisim bilgisi, sosyal medya, logo, header menu.
 * Tek kaynak: degisecek bilgi sadece buradan guncellenir.
 */

return [
    'name'        => 'Op. Dr. Yücel Polat',
    'logo'        => '/img/logo.svg',

    'phone'       => '+90 540 379 59 59',
    'phone_raw'   => '+905403795959',
    'email'       => 'dr.yucelpolat@hotmail.com',
    'address'     => 'Ballı Business Center, Alipaşa Mah. Sülün Cad. No: 6/1 Kat: 9 No: 906, Çorlu / Tekirdağ',
    'address_short' => 'Çorlu / Tekirdağ',

    'whatsapp'    => 'https://wa.me/905403795959',

    // Çalışma saatleri — footer + iletişim sayfası tek yerden okur.
    'hours' => [
        ['label' => 'Hafta içi', 'value' => '09:00 - 18:00'],
        ['label' => 'Cumartesi', 'value' => '10:00 - 14:00'],
        ['label' => 'Pazar',     'value' => 'Kapalı', 'closed' => true],
    ],

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
        ['title' => 'Yayınlar',  'route' => 'publications.index'],
        ['title' => 'Blog',      'route' => 'blog.index'],
        ['title' => 'İletişim',  'route' => 'contact'],
    ],
];
