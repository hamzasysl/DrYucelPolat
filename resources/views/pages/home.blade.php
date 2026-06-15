@extends('layouts.app')

@section('title', 'Op. Dr. Yücel Polat — Kalp ve Damar Cerrahisi Uzmanı | Liv Hospital İstanbul')
@section('description', '20+ yıl deneyimle kalp damar cerrahisi, varis tedavisi, koroner bypass, endovasküler girişimler. Liv Hospital İstanbul. Ücretsiz konsültasyon randevusu — hızlı dönüş.')
@section('keywords', 'kalp damar cerrahisi İstanbul, varis tedavisi, koroner bypass, kalp kapak ameliyatı, Op. Dr. Yücel Polat, Liv Hospital, endovasküler cerrahi, kardiyovasküler cerrah, kılcal damar tedavisi, EVLA, köpük skleroterapi, damar tıkanıklığı tedavisi')
@section('og_title', 'Op. Dr. Yücel Polat — Kalp ve Damar Cerrahisi Uzmanı | Liv Hospital İstanbul')
@section('og_description', '20+ yıl deneyimle modern kalp ve damar tedavisi. Varis, bypass, kapak ve endovasküler girişimlerde uzman yaklaşım.')
@section('og_image', asset('img/doktor.webp'))
@section('og_type', 'website')

@section('structured_data')
@php
    $breadcrumbLd = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Anasayfa', 'item' => url('/')],
        ],
    ];
    $homePageLd = [
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        '@id' => url('/') . '#webpage-home',
        'url' => url('/'),
        'name' => 'Op. Dr. Yücel Polat — Kalp ve Damar Cerrahisi Uzmanı | Liv Hospital İstanbul',
        'description' => '20+ yıl deneyimle kalp damar cerrahisi, varis tedavisi, koroner bypass, endovasküler girişimler.',
        'isPartOf' => ['@id' => url('/') . '#website'],
        'about' => ['@id' => url('/') . '#person'],
        'primaryImageOfPage' => asset('img/doktor.webp'),
        'inLanguage' => 'tr-TR',
    ];
@endphp
<script type="application/ld+json">{!! json_encode($breadcrumbLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($homePageLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endsection

@section('content')

@php
    // Hero görseller: public/img/hero/ klasöründeki tüm jpg/png/webp dosyaları otomatik slide olur.
    // Slider arka plan olarak tüm hero'yu kaplar.
    $heroImages = collect(glob(public_path('img/hero/*.{jpg,jpeg,png,webp}'), GLOB_BRACE))
        ->map(fn ($p) => '/img/hero/' . basename($p))
        ->sort()
        ->values()
        ->all();
@endphp

{{-- HERO — Full-bleed background slider + ortalı içerik --}}
<section class="relative min-h-[540px] lg:min-h-[620px] overflow-hidden bg-deep-900"
         @if (count($heroImages) > 1)
             x-data="{
                count: {{ count($heroImages) }},
                current: 0,
                timer: null,
                init() { this.start(); },
                start() { this.timer = setInterval(() => this.next(), 6000); },
                stop() { clearInterval(this.timer); },
                next() { this.current = (this.current + 1) % this.count; },
                prev() { this.current = (this.current - 1 + this.count) % this.count; },
                go(i) { this.current = i; this.stop(); this.start(); }
             }"
             @mouseenter="stop" @mouseleave="start"
         @endif>

    {{-- Background images stack --}}
    @if (count($heroImages) > 0)
        <div class="absolute inset-0 z-0">
            @foreach ($heroImages as $i => $src)
                <img src="{{ $src }}"
                     alt=""
                     loading="{{ $i === 0 ? 'eager' : 'lazy' }}"
                     class="absolute inset-0 w-full h-full object-cover transition-opacity duration-[1200ms] ease-in-out"
                     @if (count($heroImages) > 1)
                         :class="current === {{ $i }} ? 'opacity-100' : 'opacity-0'"
                     @else
                         class="opacity-100"
                     @endif>
            @endforeach

            {{-- Uniform dark overlay — ortalı metin için her yer eşit okunabilir --}}
            <div class="absolute inset-0 bg-deep-900/65"></div>
            {{-- Üstten alta yumuşak vinyet (header + alt detayları dengeli) --}}
            <div class="absolute inset-0 bg-gradient-to-b from-deep-900/30 via-transparent to-deep-900/50"></div>
        </div>
    @else
        <div class="absolute inset-0 z-0 bg-gradient-to-br from-deep-700 via-deep-800 to-deep-900">
            <div class="absolute -top-32 -left-32 w-96 h-96 bg-brand-500/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-deep-500/30 rounded-full blur-3xl"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <p class="text-white/40 text-xs uppercase tracking-widest font-bold text-center">
                    public/img/hero/ klasörüne görsel ekle
                </p>
            </div>
        </div>
    @endif

    {{-- CENTERED CONTENT — full-width, text ortalı --}}
    <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-20 lg:py-24 min-h-[540px] lg:min-h-[620px] flex items-center justify-center">
        <div class="max-w-3xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur border border-white/15 px-4 py-2 rounded-full mb-6">
                <span class="w-2 h-2 rounded-full bg-leaf-500 animate-pulse"></span>
                <p class="text-white/90 font-semibold text-xs tracking-widest uppercase">
                    Op. Dr. Yücel Polat
                </p>
            </div>
            <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-[1.1] mb-6 drop-shadow-lg">
                Kalp ve Damar Sağlığınız <br class="hidden sm:inline">
                <span class="text-brand-400">Emin Ellerde</span>
            </h1>
            <p class="text-ink-100 text-lg leading-relaxed mb-10 max-w-2xl mx-auto drop-shadow">
                20 yılı aşkın deneyim, binlerce başarılı işlem ve hasta odaklı yaklaşımla
                varis, endovasküler tedavi ve klasik kalp-damar cerrahisinde modern standartlar.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center gap-2 bg-brand-500 hover:bg-white hover:text-deep-700 text-white px-7 py-4 text-sm font-extrabold uppercase tracking-wider rounded-lg shadow-[0_8px_24px_rgba(230,57,70,0.40)] transition-all">
                    <i class="fas fa-calendar-check"></i>
                    Randevu Al
                </a>
                <a href="#"
                   class="inline-flex items-center gap-2 border-2 border-white/40 text-white hover:bg-white hover:text-deep-700 px-7 py-4 text-sm font-extrabold uppercase tracking-wider rounded-lg backdrop-blur transition-all">
                    Hizmetlerimiz
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Slider kontroller --}}
    @if (count($heroImages) > 1)
        {{-- Prev/Next yan ortada --}}
        <button @click="prev"
                class="absolute left-4 lg:left-8 top-1/2 -translate-y-1/2 z-20
                       w-12 h-12 rounded-full bg-white/10 hover:bg-white border border-white/20 hover:border-white
                       text-white hover:text-deep-700 backdrop-blur transition-all
                       flex items-center justify-center"
                aria-label="Önceki">
            <i class="fas fa-chevron-left text-sm"></i>
        </button>
        <button @click="next"
                class="absolute right-4 lg:right-8 top-1/2 -translate-y-1/2 z-20
                       w-12 h-12 rounded-full bg-white/10 hover:bg-white border border-white/20 hover:border-white
                       text-white hover:text-deep-700 backdrop-blur transition-all
                       flex items-center justify-center"
                aria-label="Sonraki">
            <i class="fas fa-chevron-right text-sm"></i>
        </button>

        {{-- Dot indicators — alt orta --}}
        <div class="absolute bottom-7 left-1/2 -translate-x-1/2 flex items-center gap-2 z-20">
            @foreach ($heroImages as $i => $src)
                <button @click="go({{ $i }})"
                        :class="current === {{ $i }} ? 'w-10 bg-white' : 'w-2 bg-white/40 hover:bg-white/70'"
                        class="h-1.5 rounded-full transition-all duration-500"
                        aria-label="Slide {{ $i + 1 }}"></button>
            @endforeach
        </div>
    @endif
</section>

{{-- SERVICES — gerçek uzmanlık alanları (IG analizinden) --}}
<section class="bg-ink-50 py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center max-w-5xl mx-auto mb-14">
            {{-- Kicker — pembe yazı + yeşil çizgi (kısa) --}}
            <div class="inline-flex items-center gap-3 mb-5">
                <span class="h-px w-6 bg-gradient-to-r from-transparent to-leaf-500"></span>
                <p class="text-brand-500 font-semibold text-sm tracking-[0.22em] uppercase">Uzmanlık Alanları</p>
                <span class="h-px w-6 bg-gradient-to-l from-transparent to-leaf-500"></span>
            </div>

            {{-- Single-color title --}}
            <h2 class="font-display text-4xl lg:text-6xl font-bold text-deep-600 leading-[1.1] mb-6 tracking-tight">
                Kapsamlı Damar Tedavisi
            </h2>

            <p class="text-ink-400 text-base lg:text-lg leading-relaxed font-light">
                Varis ve endovasküler girişimlerden açık kalp cerrahisine, kanıta dayalı protokol.
            </p>
        </div>

        @php
            // Icon rengi rotasyonu — mavi / pembe / yeşil
            $iconStyles = [
                ['bg' => 'bg-deep-50',     'text' => 'text-deep-500'],
                ['bg' => 'bg-brand-50',    'text' => 'text-brand-500'],
                ['bg' => 'bg-leaf-500/15', 'text' => 'text-leaf-500'],
            ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach (config('treatments') as $i => $service)
                @php
                    $c = $iconStyles[$i % 3];
                    $hasPage = $service['has_page'] ?? false;
                @endphp
                <a href="{{ $hasPage ? route('services.show', $service['slug']) : '#' }}"
                   class="group bg-white rounded-2xl p-7 pb-5 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-ink-100 flex flex-col">
                    <div class="w-12 h-12 rounded-xl {{ $c['bg'] }} flex items-center justify-center {{ $c['text'] }} mb-5 shrink-0 transition-all duration-300 group-hover:scale-105">
                        <i class="fas {{ $service['icon'] }} text-xl"></i>
                    </div>
                    <h3 class="font-display text-lg font-bold text-deep-700 mb-3 leading-snug group-hover:text-brand-500 transition-colors">{{ $service['title'] }}</h3>
                    <p class="text-ink-500 text-sm leading-relaxed mb-5 flex-grow font-light">{{ $service['short'] }}</p>

                    {{-- CTA: ince çizgi + sol metin + yuvarlak pembe-hover ok butonu --}}
                    <div class="flex items-center justify-between pt-4 border-t border-ink-100 mt-auto">
                        <span class="inline-flex items-center text-deep-600 group-hover:text-brand-500 text-[11px] font-bold uppercase tracking-[0.16em] transition-colors">
                            Detayları Gör
                        </span>
                        <span class="w-9 h-9 rounded-lg bg-ink-50 text-deep-500 group-hover:bg-brand-500 group-hover:text-white inline-flex items-center justify-center transition-all duration-300 shadow-[0_2px_6px_rgba(15,61,90,0.06)] group-hover:shadow-[0_6px_14px_rgba(230,57,70,0.30)]">
                            <i class="fas fa-arrow-right text-[11px] transition-transform duration-300 group-hover:translate-x-0.5"></i>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- FELSEFE / YAKLAŞIM — Services'ten sonra "nasıl çalışıyoruz" --}}
<section class="bg-ink-50 py-20 lg:py-28 relative overflow-hidden">
    <div class="absolute -top-32 -right-32 w-96 h-96 bg-brand-100/40 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-deep-100/40 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-3xl mb-14">
            <div class="inline-flex items-center gap-3 mb-5">
                <span class="h-px w-6 bg-gradient-to-r from-transparent to-leaf-500"></span>
                <p class="text-brand-500 font-semibold text-sm tracking-[0.22em] uppercase">Çalışma Felsefem</p>
            </div>
            <h2 class="font-display text-3xl lg:text-4xl font-bold text-deep-600 leading-[1.15] tracking-tight mb-4">
                Modern tıp, bilimsel kanıt ve insan odaklı yaklaşım.
            </h2>
            <p class="text-ink-400 text-base lg:text-[17px] leading-relaxed font-light">
                Her hasta benzersizdir — tedavi planı kanıta dayalı, riski ölçülmüş ve hastaya özel olur.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ([
                ['n' => '01', 'icon' => 'fa-microscope',    'title' => 'Bilim Odaklı',     'body' => 'Tedavi seçenekleri güncel kılavuzlar ve uluslararası kanıt düzeyine göre değerlendirilir.'],
                ['n' => '02', 'icon' => 'fa-user-shield',   'title' => 'Hasta Güvenliği',  'body' => 'Her vakada risk-fayda analizi şeffaf paylaşılır; karar süreci ortak yürütülür.'],
                ['n' => '03', 'icon' => 'fa-people-arrows', 'title' => 'Multidisipliner',  'body' => 'Kardiyoloji, radyoloji ve dahili branşlarla koordineli planlama — gerektikçe konsey kararı.'],
            ] as $card)
                <div class="group relative bg-white rounded-2xl p-7 lg:p-8 border border-ink-100 hover:border-brand-200 hover:shadow-xl transition-all duration-300">
                    <span class="absolute left-0 top-7 lg:top-8 bottom-7 lg:bottom-8 w-1 rounded-r-full bg-gradient-to-b from-brand-500 to-deep-500 group-hover:from-brand-600 group-hover:to-deep-600 transition-colors"></span>

                    <div class="flex items-start gap-4 mb-5 pl-2">
                        <span class="w-11 h-11 rounded-xl bg-brand-50 text-brand-500 inline-flex items-center justify-center text-lg shrink-0
                                     group-hover:bg-brand-500 group-hover:text-white transition-colors">
                            <i class="fas {{ $card['icon'] }}"></i>
                        </span>
                        <p class="font-display text-3xl font-extrabold text-ink-100 group-hover:text-brand-100 transition-colors ml-auto leading-none mt-1">
                            {{ $card['n'] }}
                        </p>
                    </div>
                    <h3 class="font-display text-xl font-bold text-deep-700 mb-3 pl-2">{{ $card['title'] }}</h3>
                    <p class="text-ink-500 text-sm leading-relaxed pl-2 font-light">{{ $card['body'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ABOUT TEASER — net bilgiler --}}
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
                    <p class="text-brand-500 font-semibold text-sm tracking-[0.22em] uppercase">Hakkımda</p>
                </div>

                <h2 class="font-display text-3xl lg:text-5xl font-bold text-deep-600 leading-[1.1] mb-6 tracking-tight">
                    Op. Dr. Yücel Polat
                </h2>

                <p class="text-ink-500 text-lg leading-relaxed mb-5 font-light">
                    Kalp ve damar cerrahisi uzmanı. <span class="text-deep-700 font-semibold">Liv Hospital Istanbul</span>
                    bünyesinde varis, endovasküler girişimler ve klasik kalp-damar cerrahisi alanlarında hasta kabul etmektedir.
                </p>

                {{-- Bağlı olduğu kurumlar — top bar stilinde minimal yeşil badge'ler --}}
                <div class="space-y-3 mb-8">
                    <p class="text-[11px] uppercase tracking-[0.22em] font-semibold text-ink-400">Bağlı Olduğu Kurumlar</p>
                    <div class="flex flex-col gap-4">
                        <a href="https://www.livhospital.com.tr/" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2.5 text-ink-500 hover:text-deep-700 transition-colors w-fit">
                            <span class="w-7 h-7 rounded-md bg-leaf-500/15 text-leaf-500 inline-flex items-center justify-center shrink-0
                                         shadow-[0_1px_3px_rgba(132,204,22,0.20)]">
                                <i class="fas fa-hospital text-[10px]"></i>
                            </span>
                            <span class="font-light text-[15px]">Istinye Üniversitesi Liv Hospital</span>
                        </a>
                        <a href="https://www.livhospital.com.tr/" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2.5 text-ink-500 hover:text-deep-700 transition-colors w-fit">
                            <span class="w-7 h-7 rounded-md bg-leaf-500/15 text-leaf-500 inline-flex items-center justify-center shrink-0
                                         shadow-[0_1px_3px_rgba(132,204,22,0.20)]">
                                <i class="fas fa-hospital text-[10px]"></i>
                            </span>
                            <span class="font-light text-[15px]">Liv Hospital Bahçeşehir</span>
                        </a>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('about') }}"
                       class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white px-6 py-3.5 text-xs font-bold uppercase tracking-wider rounded-lg shadow-[0_6px_18px_rgba(230,57,70,0.20)] hover:shadow-[0_8px_22px_rgba(230,57,70,0.28)] transition-all">
                        Detaylı Özgeçmiş <i class="fas fa-arrow-right text-[10px]"></i>
                    </a>
                    <a href="https://wa.me/900000000000" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 bg-[#1FA950] hover:bg-[#168F47] text-white px-6 py-3.5 text-xs font-semibold uppercase tracking-wider rounded-lg shadow-[0_4px_12px_rgba(31,169,80,0.30)] hover:shadow-[0_6px_18px_rgba(22,143,71,0.35)] transition-all">
                        <i class="fab fa-whatsapp text-sm"></i> WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- INSTAGRAM SLIDER --}}
@include('partials.instagram-slider')

{{-- CONTACT FORM CTA — light theme --}}
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
                        <span class="w-11 h-11 rounded-xl bg-leaf-500/15 text-leaf-500 inline-flex items-center justify-center text-base shadow-[0_2px_6px_rgba(132,204,22,0.18)]"><i class="fas fa-phone"></i></span>
                        <div>
                            <p class="text-[11px] text-ink-400 uppercase tracking-[0.18em] font-semibold mb-0.5">Telefon</p>
                            <a href="tel:+900000000000" class="text-deep-700 font-semibold hover:text-brand-500 transition-colors">+90 (000) 000 00 00</a>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="w-11 h-11 rounded-xl bg-leaf-500/15 text-leaf-500 inline-flex items-center justify-center text-base shadow-[0_2px_6px_rgba(132,204,22,0.18)]"><i class="fas fa-envelope"></i></span>
                        <div>
                            <p class="text-[11px] text-ink-400 uppercase tracking-[0.18em] font-semibold mb-0.5">E-posta</p>
                            <a href="mailto:info@dryucelpolat.com" class="text-deep-700 font-semibold hover:text-brand-500 transition-colors">info@dryucelpolat.com</a>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="w-11 h-11 rounded-xl bg-leaf-500/15 text-leaf-500 inline-flex items-center justify-center text-base shadow-[0_2px_6px_rgba(132,204,22,0.18)]"><i class="fas fa-map-marker-alt"></i></span>
                        <div>
                            <p class="text-[11px] text-ink-400 uppercase tracking-[0.18em] font-semibold mb-0.5">Klinik</p>
                            <p class="text-deep-700 font-semibold">Klinik Adresi, Sarıyer / İstanbul</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white rounded-2xl p-8 shadow-xl border border-ink-100">
                    <livewire:ui.forms.simple-form page-title="home-cta" />
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
