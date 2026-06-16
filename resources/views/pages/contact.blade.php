@extends('layouts.app')

@section('title', 'İletişim & Randevu — ' . config('app.name'))
@section('description', 'Op. Dr. Yücel Polat ile iletişim — Liv Hospital İstanbul. Telefon, WhatsApp, e-posta ve online randevu formu. Ücretsiz konsültasyon için hızlı dönüş.')
@section('keywords', 'Op. Dr. Yücel Polat iletişim, randevu al, kalp damar cerrahı randevu, Liv Hospital iletişim, kardiyovasküler cerrah randevu, ücretsiz konsültasyon, WhatsApp randevu')
@section('og_title', 'İletişim & Randevu — ' . config('app.name'))
@section('og_description', 'Ücretsiz konsültasyon randevusu için iletişim formu, telefon ve WhatsApp. Liv Hospital İstanbul.')
@section('og_image', asset('img/doktor.webp'))

@section('structured_data')
@php
    $breadcrumbLd = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Anasayfa', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'İletişim', 'item' => route('contact')],
        ],
    ];
    $contactPageLd = [
        '@context' => 'https://schema.org',
        '@type' => 'ContactPage',
        '@id' => route('contact') . '#webpage',
        'url' => route('contact'),
        'name' => 'İletişim & Randevu — Op. Dr. Yücel Polat',
        'description' => 'Op. Dr. Yücel Polat ile iletişim ve randevu — Liv Hospital İstanbul.',
        'isPartOf' => ['@id' => url('/') . '#website'],
        'about' => ['@id' => url('/') . '#clinic'],
        'inLanguage' => 'tr-TR',
    ];
@endphp
<script type="application/ld+json">{!! json_encode($breadcrumbLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($contactPageLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endsection

@section('content')

@include('partials.subheader', [
    'title'   => 'İletişim',
    'current' => 'İletişim',
])

{{-- CONTACT FORM — Anasayfa ile aynı tasarım --}}
<section class="relative bg-ink-50 py-20 lg:py-28 overflow-hidden">
    <div class="absolute inset-0 opacity-30 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-brand-100 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-deep-100 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-start">
            <div>
                <div class="inline-flex items-center gap-3 mb-5">
                    <span class="h-px w-6 bg-gradient-to-r from-transparent to-leaf-500"></span>
                    <p class="text-brand-500 font-semibold text-sm tracking-[0.22em] uppercase">İletişim</p>
                </div>
                <h2 class="font-display text-3xl lg:text-[42px] font-bold text-deep-600 leading-[1.15] mb-5 tracking-tight whitespace-nowrap">
                    Randevu Talebi Oluşturun
                </h2>
                <p class="text-ink-400 text-base lg:text-[17px] leading-relaxed mb-10 max-w-lg font-light">
                    Konsültasyon ve detaylı muayene için formu doldurun, en kısa sürede dönüş yapalım.
                </p>
                <div class="space-y-10 max-w-md">
                    <div class="flex items-center gap-4">
                        <span class="w-11 h-11 rounded-xl bg-leaf-500/15 text-leaf-500 inline-flex items-center justify-center text-base shadow-[0_2px_6px_color-mix(in_srgb,var(--color-leaf-500)_18%,transparent)]"><i class="fas fa-phone"></i></span>
                        <div>
                            <p class="text-[11px] text-ink-400 uppercase tracking-[0.18em] font-semibold mb-0.5">Telefon</p>
                            <a href="tel:+900000000000" class="text-deep-700 font-semibold hover:text-brand-500 transition-colors">+90 (000) 000 00 00</a>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="w-11 h-11 rounded-xl bg-leaf-500/15 text-leaf-500 inline-flex items-center justify-center text-base shadow-[0_2px_6px_color-mix(in_srgb,var(--color-leaf-500)_18%,transparent)]"><i class="fas fa-envelope"></i></span>
                        <div>
                            <p class="text-[11px] text-ink-400 uppercase tracking-[0.18em] font-semibold mb-0.5">E-posta</p>
                            <a href="mailto:info@dryucelpolat.com" class="text-deep-700 font-semibold hover:text-brand-500 transition-colors">info@dryucelpolat.com</a>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="w-11 h-11 rounded-xl bg-leaf-500/15 text-leaf-500 inline-flex items-center justify-center text-base shadow-[0_2px_6px_color-mix(in_srgb,var(--color-leaf-500)_18%,transparent)]"><i class="fas fa-map-marker-alt"></i></span>
                        <div>
                            <p class="text-[11px] text-ink-400 uppercase tracking-[0.18em] font-semibold mb-0.5">Klinik</p>
                            <p class="text-deep-700 font-semibold">Klinik Adresi, Sarıyer / İstanbul</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white rounded-2xl p-8 shadow-xl border border-ink-100">
                    <livewire:ui.forms.simple-form page-title="contact-page" />
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Map section (geçici adres — gerçek adres gelince güncellenecek) --}}
<section class="bg-white py-16 lg:py-20 border-t border-ink-100">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <div class="inline-flex items-center gap-3 mb-4">
                <span class="h-px w-6 bg-gradient-to-r from-transparent to-leaf-500"></span>
                <p class="text-brand-500 font-semibold text-sm tracking-[0.22em] uppercase">Konum</p>
                <span class="h-px w-6 bg-gradient-to-l from-transparent to-leaf-500"></span>
            </div>
            <h2 class="font-display text-3xl lg:text-4xl font-bold text-deep-600 leading-tight tracking-tight">
                Bizi Haritada Bulun
            </h2>
        </div>

        <div class="relative rounded-2xl overflow-hidden shadow-xl border border-ink-100 ring-1 ring-deep-100/40">
            <div class="aspect-[16/8] lg:aspect-[21/8] bg-ink-100">
                <iframe
                    src="https://www.google.com/maps?q=DAP+Vadi+İstinye+Ofis+Merkez+Kağıthane+Cd.+No:3+D:68+34406+Kağıthane+İstanbul&output=embed"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Klinik konumu — Google Maps"
                    class="w-full h-full"></iframe>
            </div>

            {{-- Floating address card --}}
            <div class="absolute bottom-4 left-4 right-4 sm:right-auto sm:max-w-md
                        bg-white/95 backdrop-blur rounded-xl shadow-lg border border-ink-100 p-4
                        flex items-start gap-3">
                <span class="w-10 h-10 rounded-lg bg-leaf-500/15 text-leaf-500 inline-flex items-center justify-center shrink-0">
                    <i class="fas fa-location-dot"></i>
                </span>
                <div class="min-w-0">
                    <p class="text-[10px] text-ink-400 uppercase tracking-[0.22em] font-semibold mb-1">Adres</p>
                    <p class="text-deep-700 text-sm font-semibold leading-snug mb-2">
                        DAP Vadi İstinye Ofis, Merkez,<br>
                        Kağıthane Cd. No:3 D:68, 34406<br>
                        Kağıthane / İstanbul
                    </p>
                    <a href="https://www.google.com/maps/dir/?api=1&destination=DAP+Vadi+İstinye+Ofis+Merkez+Kağıthane+Cd.+No:3+D:68+34406+Kağıthane+İstanbul"
                       target="_blank" rel="noopener"
                       class="inline-flex items-center gap-1.5 text-brand-500 hover:text-brand-700 text-xs font-bold uppercase tracking-wider transition-colors">
                        Yol Tarifi Al <i class="fas fa-arrow-up-right-from-square text-[10px]"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
