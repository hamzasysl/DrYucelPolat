@php
    /** Global SEO defaults — sayfa-özel override edilebilir */
    $siteName    = 'Op. Dr. Yücel Polat';
    $defaultDesc = 'Op. Dr. Yücel Polat — 20+ yıl deneyimle kalp damar cerrahisi, varis tedavisi, koroner bypass ve endovasküler girişimler. Liv Hospital İstanbul. Ücretsiz konsültasyon randevusu.';
    $defaultTitle = $siteName . ' — Kalp ve Damar Cerrahisi Uzmanı | Liv Hospital İstanbul';
    $defaultOgImage = asset('img/doktor.webp');
    $canonical = url()->current();

    /** Global structured data — Physician + Hospital + WebSite, tek @graph node */
    $graphLd = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Physician',
                '@id' => url('/') . '#person',
                'name' => 'Op. Dr. Yücel Polat',
                'honorificPrefix' => 'Op. Dr.',
                'givenName' => 'Yücel',
                'familyName' => 'Polat',
                'jobTitle' => 'Kalp ve Damar Cerrahisi Uzmanı',
                'medicalSpecialty' => ['Cardiovascular Surgery', 'Vascular Surgery'],
                'image' => $defaultOgImage,
                'url' => url('/'),
                'sameAs' => [
                    'https://www.instagram.com/dryucelpolat/',
                ],
                'worksFor' => ['@id' => url('/') . '#clinic'],
                'areaServed' => ['@type' => 'Country', 'name' => 'Türkiye'],
                'knowsAbout' => [
                    'Varis Tedavisi', 'Koroner Bypass Cerrahisi', 'Kalp Kapak Cerrahisi',
                    'Aort Anevrizması', 'Karotis (Şah Damarı) Cerrahisi',
                    'Endovenöz Lazer (EVLA)', 'Radyofrekans Ablasyon', 'Köpük Skleroterapi',
                    'Periferik Arter Hastalığı', 'Shockwave IVL',
                    'Lenfödem ve Lipödem', 'Diyabetik Yara Tedavisi',
                    'Derin Ven Trombozu (DVT)', 'Pelvik Konjesyon Sendromu',
                ],
            ],
            [
                '@type' => ['MedicalBusiness', 'Hospital'],
                '@id' => url('/') . '#clinic',
                'name' => 'Op. Dr. Yücel Polat — Liv Hospital İstanbul',
                'url' => url('/'),
                'image' => $defaultOgImage,
                'telephone' => '+90-000-000-0000',
                'email' => 'info@dryucelpolat.com',
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => 'Liv Hospital',
                    'addressLocality' => 'Sarıyer',
                    'addressRegion' => 'İstanbul',
                    'postalCode' => '34000',
                    'addressCountry' => 'TR',
                ],
                'medicalSpecialty' => ['Cardiovascular Surgery', 'Vascular Surgery'],
                'priceRange' => '$$$',
                'openingHoursSpecification' => [
                    [
                        '@type' => 'OpeningHoursSpecification',
                        'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                        'opens' => '09:00', 'closes' => '18:00',
                    ],
                    [
                        '@type' => 'OpeningHoursSpecification',
                        'dayOfWeek' => 'Saturday',
                        'opens' => '10:00', 'closes' => '14:00',
                    ],
                ],
            ],
            [
                '@type' => 'WebSite',
                '@id' => url('/') . '#website',
                'url' => url('/'),
                'name' => $siteName,
                'publisher' => ['@id' => url('/') . '#person'],
                'inLanguage' => 'tr-TR',
            ],
        ],
    ];
@endphp
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ============================================================
         PRIMARY SEO
         ============================================================ --}}
    <title>@yield('title', $defaultTitle)</title>
    <meta name="description" content="@yield('description', $defaultDesc)">
    <meta name="keywords" content="@yield('keywords', 'kalp damar cerrahisi, varis tedavisi, koroner bypass, kalp kapak ameliyatı, endovasküler cerrahi, Op. Dr. Yücel Polat, Liv Hospital, kardiyovasküler cerrah İstanbul, damar tıkanıklığı, DVT tedavisi')">
    <meta name="author" content="Op. Dr. Yücel Polat">
    <meta name="robots" content="@yield('robots', 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1')">
    <meta name="googlebot" content="index, follow">
    <meta name="rating" content="general">
    <meta name="distribution" content="global">
    <meta name="geo.region" content="TR-34">
    <meta name="geo.placename" content="İstanbul">
    <meta name="ICBM" content="41.1532, 29.0537">
    <meta name="geo.position" content="41.1532;29.0537">
    <meta http-equiv="Content-Language" content="tr">

    {{-- Canonical --}}
    <link rel="canonical" href="@yield('canonical', $canonical)">

    {{-- ============================================================
         OPEN GRAPH (Facebook, LinkedIn, WhatsApp)
         ============================================================ --}}
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="@yield('og_title', $defaultTitle)">
    <meta property="og:description" content="@yield('og_description', $defaultDesc)">
    <meta property="og:image" content="@yield('og_image', $defaultOgImage)">
    <meta property="og:image:secure_url" content="@yield('og_image', $defaultOgImage)">
    <meta property="og:image:type" content="image/webp">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="@yield('og_image_alt', 'Op. Dr. Yücel Polat — Kalp ve Damar Cerrahisi Uzmanı')">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:locale" content="tr_TR">

    {{-- ============================================================
         TWITTER CARD
         ============================================================ --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', $defaultTitle)">
    <meta name="twitter:description" content="@yield('og_description', $defaultDesc)">
    <meta name="twitter:image" content="@yield('og_image', $defaultOgImage)">
    <meta name="twitter:image:alt" content="@yield('og_image_alt', 'Op. Dr. Yücel Polat')">

    {{-- ============================================================
         FAVICONS + PWA
         ============================================================ --}}
    <link rel="icon" type="image/png" sizes="32x32"  href="{{ asset('favicons/favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"  href="{{ asset('favicons/favicon-16.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/favicon-192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <meta name="theme-color" content="#0F3D5A">
    <meta name="msapplication-TileColor" content="#0F3D5A">
    <meta name="apple-mobile-web-app-title" content="Dr. Yücel Polat">
    <meta name="application-name" content="Dr. Yücel Polat">

    {{-- ============================================================
         GLOBAL STRUCTURED DATA — Physician + Hospital + WebSite
         ============================================================ --}}
    <script type="application/ld+json">{!! json_encode($graphLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>

    {{-- Page-specific structured data (BreadcrumbList, FAQPage, MedicalProcedure, vb.) --}}
    @yield('structured_data')

    {{-- ============================================================
         FONTS + EXTERNAL CSS
         ============================================================ --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">

    {{-- Font Awesome 6 free --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- intl-tel-input: bayraklı + ülke kodu + IP geolocation auto-detect --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.6/build/css/intlTelInput.css">
    <script defer src="https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.6/build/js/intlTelInput.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.6/build/js/utils.js"></script>

    <style>
        /* intl-tel-input integration — input ile entegre dropdown */
        .phone-iti { overflow: visible; }
        .phone-iti .iti { width: 100%; display: block; }
        .phone-iti .iti__flag-container { border-radius: 8px 0 0 8px; }
        .phone-iti input { padding-left: 66px !important; }
        .phone-iti .iti__selected-flag {
            background: transparent;
            border-right: 1px solid #E5E7EB;
            padding: 0 10px;
        }
        .phone-iti .iti__selected-flag:hover,
        .phone-iti .iti--allow-dropdown .iti__flag-container:hover .iti__selected-flag {
            background: rgba(15, 61, 90, 0.04);
        }
        .phone-iti .iti__country-list {
            border-radius: 12px;
            border: 1px solid #E5E7EB;
            box-shadow: 0 12px 32px rgba(15, 61, 90, 0.15);
            max-height: 280px;
            margin-top: 6px;
            padding: 4px;
            background: #FFFFFF;
        }
        .phone-iti .iti__country {
            font-size: 13px;
            padding: 8px 12px;
            border-radius: 6px;
            color: #1F2937;
        }
        .phone-iti .iti__country:hover { background: #F7F9FB; }
        .phone-iti .iti__country.iti__highlight,
        .phone-iti .iti__country.iti__active {
            background: rgba(30, 95, 158, 0.08);
            color: #0F3D5A;
        }
        .phone-iti .iti__dial-code { color: #6B7280; }
        .iti__search-input { display: none; }

        /* Mobile menu — staggered nav item entrance */
        @keyframes mobNavIn {
            from { opacity: 0; transform: translateX(-14px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        .mob-menu[data-mob-menu="open"] .mob-nav-item {
            animation: mobNavIn 0.42s cubic-bezier(0.22, 1, 0.36, 1) backwards;
            animation-delay: calc(var(--i, 0) * 70ms + 120ms);
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans bg-white text-ink-900 antialiased">

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @include('partials.whatsapp-fab')

    @livewireScripts
    @stack('scripts')
</body>
</html>
