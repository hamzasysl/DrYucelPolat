@extends('layouts.app')

@section('title', 'Hizmetler — Tüm Tedaviler — ' . config('app.name'))
@section('description', 'Varis tedavisi, koroner bypass, kalp kapak, aort, endovasküler girişimler, DVT, lenfödem, diyabetik yara ve daha fazlası — Op. Dr. Yücel Polat tüm uzmanlık alanları.')
@section('keywords', 'kalp damar cerrahisi hizmetleri, varis tedavisi, koroner bypass, kalp kapak ameliyatı, endovasküler cerrahi, DVT tedavisi, lenfödem tedavisi, diyabetik yara, shockwave IVL, pelvik konjesyon, karotis cerrahisi')
@section('og_title', 'Tüm Hizmetler — ' . config('app.name'))
@section('og_description', 'Varis, bypass, kalp kapak, endovasküler girişimler — Op. Dr. Yücel Polat uzmanlık alanları.')
@section('og_image', asset('img/doktor.webp'))

@section('structured_data')
@php
    $breadcrumbLd = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Anasayfa', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Hizmetler', 'item' => route('services.index')],
        ],
    ];
    $serviceItems = [];
    foreach (config('treatments', []) as $i => $t) {
        $serviceItems[] = [
            '@type' => 'ListItem',
            'position' => $i + 1,
            'item' => [
                '@type' => 'MedicalProcedure',
                'name' => $t['title'],
                'description' => $t['short'],
                'url' => ($t['has_page'] ?? false) ? route('services.show', $t['slug']) : route('services.index'),
            ],
        ];
    }
    $servicesListLd = [
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        '@id' => route('services.index') . '#services-list',
        'name' => 'Op. Dr. Yücel Polat — Uzmanlık Alanları',
        'description' => 'Varis tedavisi, bypass, kalp kapak ve endovasküler girişimlerde uzmanlık alanları.',
        'itemListElement' => $serviceItems,
    ];
    $servicesPageLd = [
        '@context' => 'https://schema.org',
        '@type' => 'CollectionPage',
        '@id' => route('services.index') . '#webpage',
        'url' => route('services.index'),
        'name' => 'Hizmetler — Op. Dr. Yücel Polat',
        'description' => 'Op. Dr. Yücel Polat tüm uzmanlık alanları ve tedavi seçenekleri.',
        'isPartOf' => ['@id' => url('/') . '#website'],
        'mainEntity' => ['@id' => route('services.index') . '#services-list'],
        'inLanguage' => 'tr-TR',
    ];
@endphp
<script type="application/ld+json">{!! json_encode($breadcrumbLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($servicesPageLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($servicesListLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endsection

@section('content')

@include('partials.subheader', [
    'title'   => 'Hizmetler',
    'current' => 'Hizmetler',
])

{{-- SERVICES — Anasayfaya benzer ama foto'lu kartlar --}}
<section class="bg-ink-50 py-16 lg:py-24 relative overflow-hidden">
    {{-- Yumuşak arka plan orb'ları --}}
    <div class="absolute -top-32 -right-32 w-96 h-96 bg-deep-100/40 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-brand-100/30 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 md:px-6 lg:px-8">

        {{-- Section intro — ortalı --}}
        <div class="text-center max-w-3xl mx-auto mb-12 lg:mb-16">
            <div class="inline-flex items-center gap-3 mb-5">
                <span class="h-px w-6 bg-gradient-to-r from-transparent to-leaf-500"></span>
                <p class="text-brand-500 font-semibold text-sm tracking-[0.22em] uppercase">Uzmanlık Alanları</p>
                <span class="h-px w-6 bg-gradient-to-l from-transparent to-leaf-500"></span>
            </div>
            <h2 class="font-display text-3xl lg:text-5xl font-bold text-deep-600 leading-[1.1] mb-5 tracking-tight">
                Kapsamlı Damar &amp; Kalp Tedavisi
            </h2>
            <p class="text-ink-500 text-[15px] lg:text-base leading-relaxed font-light">
                Varis ve kılcal damar tedavisinden açık kalp cerrahisine kadar geniş bir uzmanlık alanı.
                Her tedavi planı vakaya özel; kanıta dayalı protokoller ve modern teknik altyapı.
            </p>
        </div>

        @php
            // Renk rotasyonu — foto fallback gradient'i için
            $accents = [
                ['from' => '#1E5F9E', 'to' => '#0F3D5A', 'badge' => 'bg-deep-500'],
                ['from' => '#E63946', 'to' => '#9F1F2A', 'badge' => 'bg-brand-500'],
                ['from' => '#84CC16', 'to' => '#5A8E0F', 'badge' => 'bg-leaf-500'],
                ['from' => '#F59E0B', 'to' => '#B97506', 'badge' => 'bg-sun-500'],
            ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-7">
            @foreach (config('treatments') as $i => $service)
                @php
                    $a = $accents[$i % 4];
                    $photoPath = public_path('img/services/' . $service['slug'] . '.jpg');
                    $hasPhoto = file_exists($photoPath);
                @endphp

                @php $hasPage = $service['has_page'] ?? false; @endphp
                <a href="{{ $hasPage ? route('services.show', $service['slug']) : '#' }}"
                   class="group relative bg-white rounded-2xl overflow-hidden shadow-[0_4px_16px_color-mix(in_srgb,var(--color-deep-700)_6%,transparent)] hover:shadow-[0_18px_40px_color-mix(in_srgb,var(--color-deep-700)_15%,transparent)] hover:-translate-y-1 transition-all duration-400 border border-ink-100 flex flex-col">

                    {{-- Foto alanı --}}
                    <div class="relative h-52 lg:h-56 overflow-hidden bg-gradient-to-br"
                         @if (!$hasPhoto) style="background-image: linear-gradient(135deg, {{ $a['from'] }}, {{ $a['to'] }});" @endif>

                        @if ($hasPhoto)
                            <img src="{{ asset('img/services/' . $service['slug'] . '.jpg') }}"
                                 alt="{{ $service['title'] }}"
                                 loading="lazy"
                                 class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.06]">
                            <div class="absolute inset-0 bg-gradient-to-t from-deep-900/55 via-deep-900/15 to-transparent"></div>
                        @else
                            {{-- Fallback: gradient + büyük ikon ortalı --}}
                            <div class="absolute inset-0 flex items-center justify-center text-white/85">
                                <i class="fas {{ $service['icon'] }} text-[68px] opacity-90 transition-transform duration-500 group-hover:scale-110"></i>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                        @endif

                        {{-- Üst sol köşede küçük ikon-rozet (her zaman görünür) --}}
                        <div class="absolute top-4 left-4 inline-flex items-center gap-2">
                            <span class="w-9 h-9 rounded-lg bg-white/95 backdrop-blur-sm text-deep-600 flex items-center justify-center shadow-[0_3px_10px_color-mix(in_srgb,var(--color-deep-700)_18%,transparent)]">
                                <i class="fas {{ $service['icon'] }} text-sm"></i>
                            </span>
                        </div>
                    </div>

                    {{-- İçerik --}}
                    <div class="p-6 lg:p-7 flex flex-col flex-grow">
                        <h3 class="font-display text-[19px] lg:text-[20px] font-bold text-deep-700 mb-2.5 leading-snug tracking-tight group-hover:text-brand-500 transition-colors">
                            {{ $service['title'] }}
                        </h3>
                        <p class="text-ink-500 text-[14px] leading-[1.65] mb-5 flex-grow font-light">
                            {{ $service['short'] }}
                        </p>

                        {{-- CTA satırı — sol "Detay" + sağ ok --}}
                        <div class="flex items-center justify-between pt-4 border-t border-ink-100 mt-auto">
                            <span class="inline-flex items-center gap-2 text-deep-600 group-hover:text-brand-500 text-[12px] font-bold uppercase tracking-[0.14em] transition-colors">
                                Detayları Gör
                            </span>
                            <span class="w-9 h-9 rounded-lg bg-ink-50 text-deep-500 group-hover:bg-brand-500 group-hover:text-white inline-flex items-center justify-center transition-all duration-300 shadow-[0_2px_6px_color-mix(in_srgb,var(--color-deep-700)_6%,transparent)] group-hover:shadow-[0_6px_14px_color-mix(in_srgb,var(--color-brand-500)_30%,transparent)]">
                                <i class="fas fa-arrow-right text-[11px] transition-transform duration-300 group-hover:translate-x-0.5"></i>
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Alt CTA bandı — açık tema --}}
        <div class="mt-16 lg:mt-20">
            <div class="relative bg-white rounded-2xl overflow-hidden p-8 lg:p-10 border border-ink-100 shadow-[0_8px_28px_-12px_color-mix(in_srgb,var(--color-deep-700)_12%,transparent)]">
                {{-- Hafif dekoratif renk yumuşatma — iki yan da mavi tonda --}}
                <div class="absolute -top-20 -right-20 w-72 h-72 bg-deep-100/40 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-deep-100/35 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative flex flex-col lg:flex-row items-start lg:items-center gap-6 lg:gap-10">
                    <div class="flex-1">
                        <p class="text-leaf-600 font-bold text-[10px] tracking-[0.24em] uppercase mb-2">İlk Adım</p>
                        <h3 class="font-display text-2xl lg:text-[28px] font-bold text-deep-700 leading-tight tracking-tight mb-2.5">
                            Hangi tedavinin uygun olduğunu birlikte değerlendirelim
                        </h3>
                        <p class="text-ink-500 text-[14px] lg:text-[15px] leading-relaxed font-light max-w-2xl">
                            Mevcut tetkikleriniz ve şikayetleriniz üzerinden ücretsiz konsültasyon.
                            Şeffaf değerlendirme, baskısız öneri.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-3 shrink-0">
                        <a href="{{ route('contact') }}"
                           class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white px-6 py-3 text-[13px] font-semibold rounded-lg shadow-[0_8px_20px_color-mix(in_srgb,var(--color-brand-500)_30%,transparent)] hover:shadow-[0_12px_28px_color-mix(in_srgb,var(--color-brand-500)_42%,transparent)] transition-all">
                            <i class="fas fa-calendar-check text-[12px]"></i>
                            Randevu Al
                        </a>
                        <a href="https://wa.me/900000000000" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 bg-[#1FA950] hover:bg-[#168F47] text-white px-6 py-3 text-[13px] font-semibold rounded-lg shadow-[0_8px_20px_rgba(31,169,80,0.28)] transition-all">
                            <i class="fab fa-whatsapp text-[15px]"></i>
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
