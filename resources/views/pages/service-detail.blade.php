@extends('layouts.app')

@section('title', $service['title'] . ' — ' . config('app.name'))
@section('description', $service['seo_desc'] ?? $service['lead'])
@section('keywords', $service['seo_keywords'] ?? ($service['title'] . ', Op. Dr. Yücel Polat, Çorlu, Tekirdağ'))
@section('og_title', $service['title'] . ' — ' . config('app.name'))
@section('og_description', $service['seo_desc'] ?? $service['lead'])
@php
    $servicePhotoPathSeo = public_path('img/services/' . $service['slug'] . '.jpg');
    $hasServicePhotoSeo = file_exists($servicePhotoPathSeo);
@endphp
@section('og_image', $hasServicePhotoSeo ? asset('img/services/' . $service['slug'] . '.jpg') : asset('img/doktor.webp'))
@section('og_image_alt', $service['title'] . ' — Op. Dr. Yücel Polat')
@section('og_type', 'article')

@section('structured_data')
@php
    $breadcrumbLd = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Anasayfa', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Hizmetler', 'item' => route('services.index')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $service['title'], 'item' => url()->current()],
        ],
    ];
    $procedureLd = [
        '@context' => 'https://schema.org',
        '@type' => 'MedicalProcedure',
        '@id' => url()->current() . '#procedure',
        'name' => $service['title'],
        'description' => $service['seo_desc'] ?? $service['lead'],
        'url' => url()->current(),
        'image' => $hasServicePhotoSeo ? asset('img/services/' . $service['slug'] . '.jpg') : asset('img/doktor.webp'),
        'performer' => ['@id' => url('/') . '#person'],
        'procedureType' => 'https://schema.org/SurgicalProcedure',
        'bodyLocation' => 'Kalp ve damar sistemi',
        'preparation' => 'Muayene ve değerlendirme, gerekli tetkikler (Doppler USG, kan tahlilleri) ve hekim değerlendirmesi.',
        'followup' => 'Düzenli kontrol muayeneleri, gerektiğinde görüntüleme tetkikleri ve yaşam tarzı önerileri.',
    ];
    $webPageLd = [
        '@context' => 'https://schema.org',
        '@type' => 'MedicalWebPage',
        '@id' => url()->current() . '#webpage',
        'url' => url()->current(),
        'name' => $service['title'] . ' — Op. Dr. Yücel Polat',
        'description' => $service['seo_desc'] ?? $service['lead'],
        'isPartOf' => ['@id' => url('/') . '#website'],
        'mainEntity' => ['@id' => url()->current() . '#procedure'],
        'about' => ['@id' => url('/') . '#person'],
        'medicalAudience' => [
            '@type' => 'MedicalAudience',
            'audienceType' => 'Patient',
        ],
        'inLanguage' => 'tr-TR',
    ];
@endphp
<script type="application/ld+json">{!! json_encode($breadcrumbLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($webPageLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($procedureLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endsection

@section('content')

@include('partials.subheader', [
    'title'   => $service['title'],
    'current' => $service['title'],
    'parent'  => ['label' => 'Hizmetler', 'route' => 'services.index'],
])

{{-- 1. INTRO — Renkli profesyonel editorial, pembe CTA --}}
<section class="relative bg-white py-16 lg:py-24 overflow-hidden">
    {{-- Yumuşak dekoratif orb'lar — mavi atmosfer (pembe kaldırıldı) --}}
    <div class="absolute -top-32 -right-32 w-[480px] h-[480px] bg-deep-100/45 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/4 -left-32 w-80 h-80 bg-deep-50/60 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 left-1/3 w-72 h-72 bg-deep-200/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

            {{-- Sol: İçerik --}}
            <div class="lg:col-span-7 order-2 lg:order-1">

                {{-- SEO H2 — ana + alt başlık (H1 zaten subheader'da) --}}
                <h2 class="font-display mb-6">
                    <span class="block text-3xl lg:text-[40px] font-extrabold text-deep-700 leading-[1.05] tracking-[-0.01em]">
                        {{ $service['title'] }}
                    </span>
                </h2>

                {{-- Intro — docx "Nedir?" bölümü birebir --}}
                @if (! empty($service['intro']))
                    <div class="text-ink-500 text-[15px] lg:text-[16px] leading-[1.75] font-light max-w-xl mb-8 space-y-4">
                        @foreach ($service['intro'] as $para)
                            <p>{{ $para }}</p>
                        @endforeach
                    </div>
                @endif

                {{-- CTA — sadece WhatsApp; hizmete özel ön dolu mesaj --}}
                @php
                    $waMessage = 'Merhaba, web sitenizdeki "' . $service['title'] . '" sayfasından ulaşıyorum. Detaylı bilgi almak istiyorum, uygun bir randevu saati paylaşabilir misiniz? Teşekkürler.';
                    $waHref = config('site.whatsapp') . '?text=' . rawurlencode($waMessage);
                @endphp
                <div class="flex flex-wrap items-stretch gap-3 mb-12">
                    <a href="{{ $waHref }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 bg-[#1FA950] hover:bg-[#168F47] text-white px-7 py-4 text-sm font-semibold rounded-lg shadow-[0_8px_20px_rgba(31,169,80,0.32)] hover:shadow-[0_12px_28px_rgba(22,143,71,0.42)] hover:-translate-y-0.5 transition-all">
                        <i class="fab fa-whatsapp text-[17px]"></i>
                        WhatsApp ile İletişime Geç
                    </a>
                </div>
            </div>

            {{-- Sağ: Foto alanı (lg col-5) --}}
            <div class="lg:col-span-5 order-1 lg:order-2">
                <div class="relative">
                    {{-- Yumuşak gradient halo --}}
                    <div class="absolute -inset-4 bg-gradient-to-br from-brand-500/10 via-leaf-500/10 to-deep-500/10 rounded-3xl blur-2xl pointer-events-none"></div>

                    {{-- Foto / placeholder — kompakt portre --}}
                    <div class="relative aspect-[16/10] sm:aspect-[4/4] lg:aspect-[5/5.5] max-h-[60vh] sm:max-h-none rounded-2xl overflow-hidden shadow-2xl ring-1 ring-ink-100">
                        @php
                            $servicePhoto = public_path('img/services/' . $service['slug'] . '.jpg');
                            $servicePhotoExists = file_exists($servicePhoto);
                        @endphp

                        @if ($servicePhotoExists)
                            <img src="{{ asset('img/services/' . $service['slug'] . '.jpg') }}"
                                 alt="{{ $service['title'] }}"
                                 class="w-full h-full object-cover"
                                 loading="eager">
                        @else
                            {{-- Placeholder: dolu görsel beklenirken --}}
                            <div class="absolute inset-0 bg-gradient-to-br from-deep-100 via-white to-ink-100 flex items-center justify-center">
                                <div class="text-center p-6">
                                    <span class="w-20 h-20 rounded-2xl bg-white shadow-lg {{ config('site.systems.' . ($service['system'] ?? 'vein') . '.text') }} inline-flex items-center justify-center mb-3">
                                        <x-treatment-icon :slug="$service['slug']" :fallback="$service['icon']" class="w-11 h-11" />
                                    </span>
                                    <p class="text-[10px] uppercase tracking-[0.22em] font-bold text-ink-400">GÖRSEL YAKINDA</p>
                                    <p class="text-[10px] text-ink-300 mt-1 font-mono">img/services/{{ $service['slug'] }}.jpg</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 2. ANA MAKALE + STICKY SIDEBAR — beyaz arkaplan --}}
<section class="bg-white py-14 lg:py-20 border-t border-ink-100">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12">

        {{-- SOL: Makale — kutusuz, akan içerik --}}
        <article class="lg:col-span-8 prose-medical">

            @php $svcPartial = 'partials.services.' . $service['slug']; @endphp
            @if (view()->exists($svcPartial))
                @include($svcPartial, ['service' => $service])
            @else
                <p class="lead">{{ $service['lead'] }}</p>

                @if (! empty($service['points']))
                    <h2>Öne Çıkan Yaklaşımlar</h2>
                    <ul>
                        @foreach ($service['points'] as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                @endif

                <h2>Süreç</h2>
                <p>Muayene ve ayrıntılı değerlendirme ile başlayan süreç; tanı testleri, kişiselleştirilmiş tedavi planı, uygulama ve düzenli takip aşamalarıyla tamamlanır. Her hastanın klinik tablosu farklıdır ve bu fark planlamaya yansıtılır.</p>

                <h2>Ne Zaman Başvurmalısınız?</h2>
                <p>Damar sağlığınızı ayrıntılı değerlendirelim, size uygun tedavi seçeneklerini birlikte planlayalım. Erken değerlendirme tedavi seçeneklerini genişletir, sonuçları olumlu yönde etkiler.</p>
            @endif
        </article>

        {{-- SAĞ: Sticky sidebar — sadece form --}}
        <aside class="lg:col-span-4">
            <div class="lg:sticky lg:top-40">
                <div id="randevu-form" class="bg-white rounded-2xl p-6 shadow-xl border border-ink-100 scroll-mt-40">
                    <livewire:ui.forms.service-quick-form
                        :page-title="'service-' . $service['slug']"
                        :service-slug="$service['slug']"
                        :service-title="$service['title']" />
                </div>
            </div>
        </aside>
    </div>
</section>

@endsection
