@extends('layouts.app')

@section('title', 'Hakkımda — ' . config('app.name'))
@section('description', 'Op. Dr. Yücel Polat kimdir? Kalp ve Damar Cerrahisi Uzmanı, fleboloji ve estetik fleboloji. Eğitim, mesleki deneyim ve klinik yaklaşım. Çorlu / Tekirdağ.')
@section('keywords', 'Op. Dr. Yücel Polat kimdir, kardiyovasküler cerrah, fleboloji uzmanı, estetik fleboloji, kalp damar cerrahı Çorlu, vasküler cerrah Tekirdağ, Yücel Polat özgeçmiş, kalp damar cerrahisi uzmanı')
@section('og_title', 'Hakkımda — ' . config('app.name'))
@section('og_description', '20 yıllık hekimlik deneyimi, fleboloji ve estetik fleboloji odağı. Mesleki yolculuğum, uzmanlık alanlarım ve hasta odaklı yaklaşımım.')
@section('og_image', asset('img/doktor.webp'))
@section('og_image_alt', 'Op. Dr. Yücel Polat — Profil Fotoğrafı')
@section('og_type', 'profile')

@section('structured_data')
@php
    $breadcrumbLd = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Anasayfa', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Hakkımda', 'item' => route('about')],
        ],
    ];
    $aboutPageLd = [
        '@context' => 'https://schema.org',
        '@type' => 'AboutPage',
        '@id' => route('about') . '#webpage',
        'url' => route('about'),
        'name' => 'Hakkımda — Op. Dr. Yücel Polat',
        'description' => 'Op. Dr. Yücel Polat — Kalp ve Damar Cerrahisi Uzmanı, fleboloji / estetik fleboloji.',
        'isPartOf' => ['@id' => url('/') . '#website'],
        'mainEntity' => ['@id' => url('/') . '#person'],
        'inLanguage' => 'tr-TR',
    ];
@endphp
<script type="application/ld+json">{!! json_encode($breadcrumbLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($aboutPageLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endsection

@section('content')

@include('partials.subheader', [
    'title'   => 'Hakkımda',
    'current' => 'Hakkımda',
])

{{-- 1. ABOUT — Anasayfa'daki Hakkımda section'ının birebir aynısı --}}
<section class="bg-white py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

            {{-- Doktor fotosu --}}
            <div class="lg:col-span-5">
                <div class="relative">
                    <div class="absolute -inset-3 bg-gradient-to-br from-brand-500/10 to-deep-500/10 rounded-3xl blur-2xl"></div>
                    <div class="relative aspect-square rounded-3xl overflow-hidden shadow-2xl bg-gradient-to-br from-deep-100 to-ink-50">
                        <img src="{{ asset('img/doktor.webp') }}"
                             alt="Op. Dr. Yücel Polat"
                             class="w-full h-full object-cover"
                             loading="lazy">
                    </div>
                </div>
            </div>

            {{-- İçerik --}}
            <div class="lg:col-span-7">
                <div class="inline-flex items-center gap-3 mb-5">
                    <span class="h-px w-6 bg-gradient-to-r from-transparent to-leaf-500"></span>
                    <p class="text-brand-500 font-semibold text-sm tracking-[0.22em] uppercase">HAKKIMDA</p>
                </div>

                <h2 class="font-display text-3xl lg:text-5xl font-bold text-deep-600 leading-[1.1] mb-6 tracking-tight">
                    Op. Dr. Yücel Polat
                </h2>

                {{-- Unvan satırları --}}
                <div class="flex flex-wrap items-center gap-x-3 gap-y-2 mb-6">
                    <span class="inline-flex items-center gap-2 text-deep-600 text-[15px] font-semibold">
                        <i class="fas fa-heart-pulse text-brand-500 text-xs"></i>
                        Kalp ve Damar Cerrahisi Uzmanı
                    </span>
                    <span class="hidden sm:block w-px h-4 bg-ink-100"></span>
                    <span class="inline-flex items-center gap-2 text-deep-600 text-[15px] font-semibold">
                        <i class="fas fa-droplet text-leaf-500 text-xs"></i>
                        Fleboloji / Estetik Fleboloji
                    </span>
                </div>

                <p class="text-ink-500 text-lg leading-relaxed mb-5 font-light">
                    Trakya Üniversitesi Tıp Fakültesi'ndeki tıp eğitimimin ardından
                    <span class="text-deep-700 font-semibold">Gazi Üniversitesi Tıp Fakültesi Kalp ve Damar Cerrahisi
                    Anabilim Dalı'nda</span> uzmanlık eğitimimi tamamladım.
                </p>

                <p class="text-ink-500 text-[15px] leading-relaxed mb-6 font-light">
                    Çorlu'daki muayenehanemde hastalarımı tanı, tedavi ve takip süreçlerinde bütüncül bir
                    yaklaşımla değerlendiriyorum. Her hasta için bireysel bir tedavi planı oluşturmayı önemsiyorum.
                </p>

                {{-- Bağlı olduğu kurumlar --}}
                <div class="space-y-3 mb-8">
                    <p class="text-[11px] uppercase tracking-[0.22em] font-semibold text-ink-400">GÖREV YAPTIĞI KURUMLAR</p>
                    <div class="flex flex-col gap-4">
                        <a href="https://www.livhospital.com.tr/" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2.5 text-ink-500 hover:text-deep-700 transition-colors w-fit">
                            <span class="w-7 h-7 rounded-md bg-leaf-500/15 text-leaf-500 inline-flex items-center justify-center shrink-0
                                         shadow-[0_1px_3px_color-mix(in_srgb,var(--color-leaf-500)_20%,transparent)]">
                                <i class="fas fa-hospital text-[10px]"></i>
                            </span>
                            <span class="font-light text-[15px]">Istinye Üniversitesi Liv Hospital</span>
                        </a>
                        <a href="https://www.livhospital.com.tr/" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2.5 text-ink-500 hover:text-deep-700 transition-colors w-fit">
                            <span class="w-7 h-7 rounded-md bg-leaf-500/15 text-leaf-500 inline-flex items-center justify-center shrink-0
                                         shadow-[0_1px_3px_color-mix(in_srgb,var(--color-leaf-500)_20%,transparent)]">
                                <i class="fas fa-hospital text-[10px]"></i>
                            </span>
                            <span class="font-light text-[15px]">Liv Hospital Bahçeşehir</span>
                        </a>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white px-6 py-3.5 text-xs font-bold uppercase tracking-wider rounded-lg shadow-[0_6px_18px_color-mix(in_srgb,var(--color-brand-500)_20%,transparent)] hover:shadow-[0_8px_22px_color-mix(in_srgb,var(--color-brand-500)_28%,transparent)] transition-all">
                        Randevu Al <i class="fas fa-arrow-right text-[10px]"></i>
                    </a>
                    <a href="{{ config('site.whatsapp') }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 bg-[#1FA950] hover:bg-[#168F47] text-white px-6 py-3.5 text-xs font-semibold uppercase tracking-wider rounded-lg shadow-[0_4px_12px_rgba(31,169,80,0.30)] hover:shadow-[0_6px_18px_rgba(22,143,71,0.35)] transition-all">
                        <i class="fab fa-whatsapp text-sm"></i> WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 2. MESLEKİ YOLCULUK — hocanın kaleminden, dikey zaman çizgisi --}}
@php
    $journey = [
        [
            'icon'  => 'fa-graduation-cap',
            'title' => 'Eğitim',
            'text'  => 'Trakya Üniversitesi Tıp Fakültesi\'ndeki tıp eğitimimin ardından Gazi Üniversitesi Tıp Fakültesi
                        Kalp ve Damar Cerrahisi Anabilim Dalı\'nda uzmanlık eğitimimi tamamladım.',
        ],
        [
            'icon'  => 'fa-hospital',
            'title' => 'Kamu hastanelerinde 10 yılı aşkın uzmanlık',
            'text'  => 'Yaklaşık 20 yıllık hekimlik deneyimimin 10 yılı aşkın bölümünde Kalp ve Damar Cerrahisi Uzmanı
                        olarak farklı kamu hastanelerinde görev yaptım. Meslek hayatım boyunca Türkiye\'nin farklı
                        bölgelerinde sağlık hizmeti sundum; Şırnak ve Yüksekova\'da olağanüstü güvenlik koşullarının
                        yaşandığı dönemlerde hekimlik görevimi sürdürdüm. Bu süreçler, farklı ve zorlu klinik koşullarda
                        hasta değerlendirme, karar verme ve sağlık hizmetini sürdürme konusunda önemli mesleki deneyimler
                        kazanmamı sağladı.',
        ],
        [
            'icon'  => 'fa-droplet',
            'title' => 'Damar hastalıkları ve estetik flebolojiye yönelim',
            'text'  => 'Kalp ve damar cerrahisinin farklı alanlarında edindiğim klinik ve cerrahi deneyimin yanı sıra,
                        zaman içerisinde çalışmalarımı özellikle damar hastalıkları ve estetik fleboloji alanlarında
                        yoğunlaştırdım.',
        ],
        [
            'icon'  => 'fa-earth-europe',
            'title' => 'Avrupa\'daki fleboloji kliniklerinde gözlem',
            'text'  => 'Bu alandaki güncel yaklaşımları ve uygulamaları yerinde gözlemlemek amacıyla Avrupa\'nın farklı
                        ülkelerindeki fleboloji kliniklerini ziyaret ederek, venöz hastalıkların tanı ve tedavisinde
                        kullanılan farklı yöntem ve uygulamaları inceleme fırsatı buldum.',
        ],
        [
            'icon'  => 'fa-wand-magic-sparkles',
            'title' => 'Minimal invaziv (kesisiz) yaklaşım',
            'text'  => 'Cerrahi deneyimimi güncel minimal invaziv (kesisiz) yöntemler ile birleştirerek, hastalığın
                        özelliklerine ve kişinin ihtiyaçlarına uygun tedavi yaklaşımını belirlemeyi amaçlıyorum.',
        ],
        [
            'icon'  => 'fa-location-dot',
            'title' => 'Çorlu\'daki muayenehanem',
            'text'  => 'Hastalarımı tanı, tedavi ve takip süreçlerinde bütüncül bir yaklaşımla değerlendiriyorum.
                        Her hasta için bireysel bir tedavi planı oluşturmayı önemsiyorum.',
        ],
    ];
@endphp
<section class="bg-ink-50 py-20 lg:py-28 border-t border-ink-100">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">

            {{-- Sol: başlık (sticky) --}}
            <div class="lg:col-span-4 lg:sticky lg:top-32">
                <div class="inline-flex items-center gap-3 mb-5">
                    <span class="h-px w-6 bg-gradient-to-r from-transparent to-leaf-500"></span>
                    <p class="text-brand-500 font-semibold text-sm tracking-[0.22em] uppercase">ÖZGEÇMİŞ</p>
                </div>
                <h2 class="font-display tracking-tight mb-5">
                    <span class="block text-ink-400 font-light text-[19px] lg:text-[22px] leading-snug mb-1">Eğitimden kliniğe</span>
                    <span class="block text-deep-600 font-extrabold text-[30px] lg:text-[40px] leading-[1.08] tracking-[-0.02em]">
                        Mesleki yolculuğum
                    </span>
                </h2>
                <p class="text-ink-400 text-[15px] leading-relaxed font-light">
                    Yaklaşık 20 yıllık hekimlik deneyimi; kamu hastanelerinde uzmanlık, Türkiye'nin farklı
                    bölgelerinde saha tecrübesi ve damar sağlığında güncel minimal invaziv uygulamalar.
                </p>
            </div>

            {{-- Sağ: zaman çizgisi --}}
            <div class="lg:col-span-8">
                <ol class="relative">
                    {{-- Dikey çizgi --}}
                    <span class="absolute left-[19px] top-3 bottom-3 w-px bg-gradient-to-b from-brand-200 via-deep-200 to-transparent" aria-hidden="true"></span>

                    @foreach ($journey as $i => $step)
                        <li class="relative pl-14 pb-9 last:pb-0">
                            <span class="absolute left-0 top-0 w-10 h-10 rounded-xl bg-white border border-ink-100 text-deep-500
                                         inline-flex items-center justify-center shadow-[0_2px_10px_color-mix(in_srgb,var(--color-deep-700)_8%,transparent)]">
                                <i class="fas {{ $step['icon'] }} text-[13px] {{ $i === count($journey) - 1 ? 'text-brand-500' : '' }}"></i>
                            </span>
                            <h3 class="font-display text-[17px] lg:text-[19px] font-bold text-deep-700 leading-snug mb-2 pt-1.5">
                                {{ $step['title'] }}
                            </h3>
                            <p class="text-ink-500 text-[15px] leading-relaxed font-light">
                                {{ $step['text'] }}
                            </p>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</section>

{{-- 2. UZMANLIK ALANLARI — quote-style büyük metin + grid --}}
<section class="bg-white py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

            {{-- Sol: kicker + büyük başlık + kısa açıklama --}}
            <div class="lg:col-span-4 lg:sticky lg:top-32">
                <div class="inline-flex items-center gap-3 mb-5">
                    <span class="h-px w-6 bg-gradient-to-r from-transparent to-leaf-500"></span>
                    <p class="text-brand-500 font-semibold text-sm tracking-[0.22em] uppercase">UZMANLIK</p>
                </div>
                <h2 class="font-display text-3xl lg:text-[40px] font-bold text-deep-600 leading-[1.1] tracking-tight mb-5">
                    Çalıştığım alanlar
                </h2>
                <p class="text-ink-400 text-[15px] leading-relaxed font-light mb-6">
                    Varis ve kronik venöz hastalıkların tedavisinden ileri endovasküler girişimlere kadar
                    vasküler cerrahide hastaya özgü kapsamlı tedavi.
                </p>
                <a href="#"
                   class="inline-flex items-center gap-2 text-brand-500 hover:text-brand-700 text-xs font-bold uppercase tracking-wider transition-colors">
                    Tüm hizmetler <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            {{-- Sağ: 2 sütun list, her satır altında ince çizgi --}}
            <div class="lg:col-span-8">
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-1">
                    @foreach (config('treatments') as $i => $t)
                        <li class="group flex items-center gap-4 py-4 border-b border-ink-100 hover:border-brand-200 transition-colors">
                            <span class="w-9 h-9 rounded-lg bg-deep-50 text-deep-500 inline-flex items-center justify-center text-sm shrink-0
                                         group-hover:bg-deep-500 group-hover:text-white transition-all">
                                <i class="fas {{ $t['icon'] }}"></i>
                            </span>
                            <div class="flex-1 min-w-0">
                                <p class="text-deep-700 text-[15px] font-semibold leading-snug">{{ $t['title'] }}</p>
                            </div>
                            <span class="text-[11px] font-bold text-ink-300 group-hover:text-brand-400 tabular-nums transition-colors">
                                {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- CTA Banner — randevu (artık alıntıdan önce) --}}
<section class="bg-ink-50 py-16 lg:py-20">
    <div class="max-w-6xl mx-auto px-4 md:px-6 lg:px-8">
        <div class="relative bg-white rounded-3xl border border-ink-100 shadow-sm overflow-hidden p-8 lg:p-12">
            <div class="absolute -top-20 -right-20 w-72 h-72 bg-brand-100/50 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-deep-100/50 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                <div class="max-w-2xl">
                    <p class="text-brand-500 text-xs font-bold tracking-[0.22em] uppercase mb-3">RANDEVU</p>
                    <h2 class="font-display text-2xl lg:text-[32px] font-bold text-deep-600 leading-[1.2] tracking-tight mb-3">
                        Birlikte değerlendirelim.
                    </h2>
                    <p class="text-ink-400 text-[15px] lg:text-base font-light leading-relaxed">
                        Damar sağlığınızı ayrıntılı değerlendirelim, size uygun tedavi seçeneklerini birlikte planlayalım.
                    </p>
                </div>
                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white px-6 py-3.5 text-xs font-bold uppercase tracking-wider rounded-lg shadow-[0_6px_18px_color-mix(in_srgb,var(--color-brand-500)_20%,transparent)] hover:shadow-[0_8px_22px_color-mix(in_srgb,var(--color-brand-500)_28%,transparent)] transition-all">
                        <i class="fas fa-calendar-check text-xs"></i> Randevu Al
                    </a>
                    <a href="{{ config('site.whatsapp') }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 bg-[#1FA950] hover:bg-[#168F47] text-white px-6 py-3.5 text-xs font-semibold uppercase tracking-wider rounded-lg shadow-[0_4px_12px_rgba(31,169,80,0.30)] hover:shadow-[0_6px_18px_rgba(22,143,71,0.35)] transition-all">
                        <i class="fab fa-whatsapp text-sm"></i> WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ALINTI / DEĞER ÖZETİ — büyük italic vurgu (artık CTA banner'dan sonra) --}}
<section class="relative bg-gradient-to-br from-deep-600 to-deep-700 py-20 lg:py-28 overflow-hidden">
    <div class="absolute inset-0 opacity-20 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-brand-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-leaf-500/40 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-4xl mx-auto px-4 md:px-6 lg:px-8 text-center">
        <i class="fas fa-quote-left text-brand-400 text-4xl lg:text-5xl mb-6"></i>
        <p class="font-display text-2xl sm:text-3xl lg:text-[34px] font-light text-white leading-[1.35] tracking-tight italic mb-8">
            Bilimsel yaklaşım — Klinik deneyim — Kişiye özel değerlendirme.
        </p>
        <div class="inline-flex items-center gap-4">
            <span class="h-px w-12 bg-gradient-to-r from-transparent to-brand-400"></span>
            <p class="font-display text-sm font-semibold text-brand-200 uppercase tracking-[0.22em]">Op. Dr. Yücel Polat</p>
            <span class="h-px w-12 bg-gradient-to-l from-transparent to-brand-400"></span>
        </div>
    </div>
</section>

{{-- CONTACT FORM CTA — Anasayfa'dan birebir kopya --}}
<section class="relative bg-ink-50 py-20 lg:py-28 overflow-hidden border-t border-ink-100">
    <div class="absolute inset-0 opacity-30 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-brand-100 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-deep-100 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-start">
            <div>
                <div class="inline-flex items-center gap-3 mb-5">
                    <span class="h-px w-6 bg-gradient-to-r from-transparent to-leaf-500"></span>
                    <p class="text-brand-500 font-semibold text-sm tracking-[0.22em] uppercase">İLETİŞİM</p>
                </div>
                <h2 class="font-display text-3xl lg:text-[42px] font-bold text-deep-600 leading-[1.15] mb-5 tracking-tight whitespace-nowrap">
                    Randevu Talebi Oluşturun
                </h2>
                <p class="text-ink-400 text-base lg:text-[17px] leading-relaxed mb-10 max-w-lg font-light">
                    Muayene ve değerlendirme için randevu oluşturun; formu doldurun, en kısa sürede dönüş yapalım.
                </p>
                <div class="space-y-10 max-w-md">
                    <div class="flex items-center gap-4">
                        <span class="w-11 h-11 rounded-xl bg-leaf-500/15 text-leaf-500 inline-flex items-center justify-center text-base shadow-[0_2px_6px_color-mix(in_srgb,var(--color-leaf-500)_18%,transparent)]"><i class="fas fa-phone"></i></span>
                        <div>
                            <p class="text-[11px] text-ink-400 uppercase tracking-[0.18em] font-semibold mb-0.5">TELEFON</p>
                            <a href="tel:{{ config('site.phone_raw') }}" class="text-deep-700 font-semibold hover:text-brand-500 transition-colors">{{ config('site.phone') }}</a>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="w-11 h-11 rounded-xl bg-leaf-500/15 text-leaf-500 inline-flex items-center justify-center text-base shadow-[0_2px_6px_color-mix(in_srgb,var(--color-leaf-500)_18%,transparent)]"><i class="fas fa-envelope"></i></span>
                        <div>
                            <p class="text-[11px] text-ink-400 uppercase tracking-[0.18em] font-semibold mb-0.5">E-POSTA</p>
                            <a href="mailto:{{ config('site.email') }}" class="text-deep-700 font-semibold hover:text-brand-500 transition-colors">{{ config('site.email') }}</a>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="w-11 h-11 rounded-xl bg-leaf-500/15 text-leaf-500 inline-flex items-center justify-center text-base shadow-[0_2px_6px_color-mix(in_srgb,var(--color-leaf-500)_18%,transparent)]"><i class="fas fa-map-marker-alt"></i></span>
                        <div>
                            <p class="text-[11px] text-ink-400 uppercase tracking-[0.18em] font-semibold mb-0.5">MUAYENEHANE</p>
                            <p class="text-deep-700 font-semibold text-[15px] leading-snug">{{ config('site.address') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white rounded-2xl p-8 shadow-xl border border-ink-100">
                    <livewire:ui.forms.simple-form page-title="about-page" />
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
