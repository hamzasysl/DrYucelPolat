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
        'facebook'  => 'https://www.facebook.com/yucelpolat',
        'youtube'   => '',
        'linkedin'  => '',
        'x'         => '',
    ],

    // Görev yaptığı kurumlar — anasayfa + hakkımda tek yerden okur.
    // 'url' boş bırakılırsa kart link değil, düz metin olarak çıkar.
    'institutions' => [
        ['name' => 'Liv Hospital Bahçeşehir', 'url' => 'https://www.livhospital.com.tr/'],
        ['name' => 'Tekirdağ İsmail Fehmi Cumalıoğlu Şehir Hastanesi', 'url' => ''],
        ['name' => 'Mehmet Akif Ersoy Göğüs Kalp ve Damar Cerrahisi Eğitim ve Araştırma Hastanesi', 'url' => ''],
        ['name' => 'Şarköy Devlet Hastanesi', 'url' => ''],
    ],

    // Hizmet renk sistemi — logodaki üç odak alanı: atardamar (kırmızı), toplardamar (mavi), lenf (yeşil).
    // config/treatments.php içindeki 'system' alanı buradan renk alır; tüm sayfalarda aynı renk.
    'systems' => [
        'artery' => ['label' => 'Atardamar',    'bg' => 'bg-brand-50',    'text' => 'text-brand-500', 'fill' => 'group-hover:bg-brand-500', 'from' => '#E63946', 'to' => '#9F1F2A'],
        'vein'   => ['label' => 'Toplardamar',  'bg' => 'bg-deep-50',     'text' => 'text-deep-500',  'fill' => 'group-hover:bg-deep-500',  'from' => '#1E5F9E', 'to' => '#0F3D5A'],
        'lymph'  => ['label' => 'Lenf sistemi', 'bg' => 'bg-leaf-500/15', 'text' => 'text-leaf-500',  'fill' => 'group-hover:bg-leaf-500',  'from' => '#84CC16', 'to' => '#5A8E0F'],
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
