@extends('layouts.app')

@section('title', 'Bilimsel Yayınlar — ' . config('app.name'))
@section('description', 'Op. Dr. Yücel Polat\'ın uluslararası hakemli dergilerde yayımlanan bilimsel makaleleri ve kongre bildirileri — iskemi-reperfüzyon hasarı, diyabet, eritrosit deformabilitesi ve deneysel damar cerrahisi araştırmaları.')
@section('keywords', 'Yücel Polat yayınları, bilimsel makaleler, akademik çalışmalar, iskemi reperfüzyon, eritrosit deformabilitesi, fullerenol C60, irisin, picroside II, kalp damar cerrahisi araştırma, PubMed Yücel Polat')
@section('og_title', 'Bilimsel Yayınlar — ' . config('app.name'))
@section('og_description', 'Uluslararası hakemli dergilerde yayımlanan bilimsel makaleler ve kongre bildirileri.')
@section('og_image', asset('img/doktor.webp'))
@section('og_type', 'website')

@section('structured_data')
@php
    $breadcrumbLd = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Anasayfa', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Yayınlar', 'item' => route('publications.index')],
        ],
    ];

    $itemListLd = [
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        '@id' => route('publications.index') . '#publications',
        'name' => 'Op. Dr. Yücel Polat — Bilimsel Yayınlar',
        'numberOfItems' => $publications->count(),
        'itemListOrder' => 'https://schema.org/ItemListOrderAscending',
        'itemListElement' => $publications->map(fn ($p, $i) => [
            '@type' => 'ListItem',
            'position' => $i + 1,
            'item' => array_filter([
                '@type' => 'ScholarlyArticle',
                'name' => $p['title'],
                'headline' => $p['title'],
                'author' => collect($p['authors'])->map(fn ($a) => [
                    '@type' => 'Person',
                    'name' => $a === 'Y Polat' ? 'Yücel Polat' : $a,
                ])->all(),
                'datePublished' => (string) $p['year'],
                'isPartOf' => ['@type' => 'Periodical', 'name' => $p['journal']],
                'inLanguage' => 'en',
                'identifier' => $p['doi'] ? 'https://doi.org/' . $p['doi'] : null,
                'url' => $p['doi'] ? 'https://doi.org/' . $p['doi'] : null,
            ]),
        ])->all(),
    ];
@endphp
<script type="application/ld+json">{!! json_encode($breadcrumbLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($itemListLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endsection

@section('content')

@include('partials.subheader', [
    'title'   => 'Bilimsel Yayınlar',
    'current' => 'Yayınlar',
])

@php
    $articleCount  = $publications->where('type', 'article')->count();
    $abstractCount = $publications->where('type', 'abstract')->count();
    $yearFrom      = $publications->min('year');
    $yearTo        = $publications->max('year');
@endphp

{{-- 1. GİRİŞ + ÖZET İSTATİSTİK --}}
<section class="bg-white pt-16 lg:pt-20 pb-10 lg:pb-12">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">

            <div class="lg:col-span-7">
                <div class="inline-flex items-center gap-3 mb-4">
                    <span class="h-px w-8 bg-gradient-to-r from-transparent to-brand-500"></span>
                    <p class="text-brand-500 font-semibold text-sm tracking-[0.22em] uppercase">AKADEMİ</p>
                </div>
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-deep-600 leading-tight mb-5">
                    Hakemli dergilerde yayımlanan çalışmalar
                </h2>
                <p class="text-ink-500 text-[15px] lg:text-base leading-relaxed font-light">
                    Aşağıdaki çalışmalar; iskemi-reperfüzyon hasarı, diyabetik dokularda koruyucu tedaviler,
                    eritrosit deformabilitesi ve deneysel damar cerrahisi konularında yürütülmüş,
                    uluslararası hakemli dergilerde yayımlanmış araştırmalardır.
                </p>
            </div>

            {{-- Özet kartlar --}}
            <div class="lg:col-span-5">
                <div class="grid grid-cols-2 gap-3 sm:gap-4">
                    @php
                        $summary = [
                            ['icon' => 'fa-file-lines',  'value' => $publications->count(),   'label' => 'Toplam Yayın',     'color' => 'deep'],
                            ['icon' => 'fa-award',       'value' => $firstAuthor->count(),    'label' => 'Birinci İsim',     'color' => 'brand'],
                            ['icon' => 'fa-book-open',   'value' => $articleCount,            'label' => 'Hakemli Makale',   'color' => 'deep'],
                            ['icon' => 'fa-microphone',  'value' => $abstractCount,           'label' => 'Kongre Bildirisi', 'color' => 'brand'],
                        ];
                    @endphp
                    @foreach ($summary as $s)
                        <div class="relative bg-white border border-ink-100 rounded-2xl p-5 shadow-[0_2px_10px_color-mix(in_srgb,var(--color-deep-700)_6%,transparent)]">
                            <span class="w-10 h-10 rounded-xl inline-flex items-center justify-center mb-3
                                         {{ $s['color'] === 'brand' ? 'bg-brand-50 text-brand-500' : 'bg-deep-50 text-deep-500' }}">
                                <i class="fas {{ $s['icon'] }} text-sm"></i>
                            </span>
                            <p class="font-display text-3xl font-bold text-deep-700 leading-none tabular-nums">{{ $s['value'] }}</p>
                            <p class="text-[11px] uppercase tracking-[0.18em] font-semibold text-ink-400 mt-2">{{ $s['label'] }}</p>
                        </div>
                    @endforeach
                </div>
                <p class="text-[12.5px] text-ink-400 font-light mt-4 flex items-center gap-2">
                    <i class="far fa-calendar text-leaf-500 text-[11px]"></i>
                    Yayın aralığı: {{ $yearFrom }} – {{ $yearTo }}
                </p>
            </div>
        </div>
    </div>
</section>

{{-- 2. YAYIN LİSTESİ --}}
@php
    /** Tek bir yayın kartı — iki grupta da aynı görünüm kullanılır. */
    $groups = [
        [
            'key'   => 'first',
            'title' => 'Birinci İsim Yayınlar',
            'desc'  => 'Op. Dr. Yücel Polat\'ın ilk yazar olarak yürüttüğü çalışmalar.',
            'icon'  => 'fa-award',
            'items' => $firstAuthor,
        ],
        [
            'key'   => 'co',
            'title' => 'Ortak Yazar Olduğu Yayınlar',
            'desc'  => 'Yazar sırasına göre dizilmiştir.',
            'icon'  => 'fa-users',
            'items' => $coAuthor,
        ],
    ];
    $counter = 0;
@endphp

<section class="bg-ink-50 py-14 lg:py-20 border-t border-ink-100">
    <div class="max-w-5xl mx-auto px-4 md:px-6 lg:px-8 space-y-14">
        @foreach ($groups as $group)
            @continue($group['items']->isEmpty())
            <div>
                {{-- Grup başlığı --}}
                <div class="flex items-center gap-4 mb-7">
                    <span class="w-11 h-11 rounded-xl bg-white border border-ink-100 text-brand-500 inline-flex items-center justify-center shrink-0 shadow-[0_2px_10px_color-mix(in_srgb,var(--color-deep-700)_6%,transparent)]">
                        <i class="fas {{ $group['icon'] }} text-sm"></i>
                    </span>
                    <div class="min-w-0">
                        <h3 class="font-display text-xl lg:text-2xl font-bold text-deep-600 leading-tight">
                            {{ $group['title'] }}
                            <span class="text-ink-300 font-semibold text-base">({{ $group['items']->count() }})</span>
                        </h3>
                        <p class="text-ink-400 text-[13px] font-light mt-0.5">{{ $group['desc'] }}</p>
                    </div>
                </div>

                {{-- Kartlar --}}
                <div class="space-y-4">
                    @foreach ($group['items'] as $p)
                        @php $counter++; @endphp
                        <article class="group relative bg-white border border-ink-100 rounded-2xl overflow-hidden transition-all duration-300
                                        hover:border-deep-200 hover:shadow-[0_14px_36px_-14px_color-mix(in_srgb,var(--color-deep-700)_28%,transparent)]">
                            {{-- Sol aksan şeridi --}}
                            <span class="absolute left-0 top-0 bottom-0 w-[3px] bg-gradient-to-b from-brand-500 via-brand-400/50 to-deep-400/40
                                         opacity-60 group-hover:opacity-100 transition-opacity"></span>

                            <div class="pl-6 pr-5 py-6 sm:pl-8 sm:pr-7 sm:py-7">
                                <div class="flex items-start gap-4 sm:gap-5">
                                    {{-- Sıra numarası --}}
                                    <span class="hidden sm:flex w-10 h-10 rounded-xl bg-deep-50 text-deep-500 items-center justify-center shrink-0
                                                 font-display font-bold text-sm tabular-nums group-hover:bg-deep-500 group-hover:text-white transition-colors">
                                        {{ str_pad($counter, 2, '0', STR_PAD_LEFT) }}
                                    </span>

                                    <div class="min-w-0 flex-1">
                                        {{-- Rozetler --}}
                                        <div class="flex flex-wrap items-center gap-2 mb-3">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-deep-50 text-deep-600 text-[11px] font-bold uppercase tracking-wider">
                                                <i class="far fa-calendar text-[10px]"></i>{{ $p['year'] }}
                                            </span>
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider
                                                         {{ $p['type'] === 'article' ? 'bg-leaf-500/15 text-leaf-500' : 'bg-ink-100 text-ink-500' }}">
                                                <i class="fas {{ $p['type'] === 'article' ? 'fa-book-open' : 'fa-microphone' }} text-[10px]"></i>
                                                {{ $p['type'] === 'article' ? 'Makale' : 'Bildiri' }}
                                            </span>
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-brand-50 text-brand-500 text-[11px] font-bold uppercase tracking-wider">
                                                <i class="fas fa-user-pen text-[10px]"></i>
                                                {{ $p['position'] }}. yazar
                                            </span>
                                        </div>

                                        {{-- Başlık --}}
                                        <h4 class="font-display text-[16px] sm:text-[17px] font-bold text-deep-700 leading-snug mb-3">
                                            @if ($p['doi'])
                                                <a href="https://doi.org/{{ $p['doi'] }}" target="_blank" rel="noopener"
                                                   class="hover:text-brand-500 transition-colors">{{ $p['title'] }}</a>
                                            @else
                                                {{ $p['title'] }}
                                            @endif
                                        </h4>

                                        {{-- Yazarlar — Y Polat vurgulu --}}
                                        <p class="text-[13.5px] text-ink-500 font-light leading-relaxed mb-2.5">
                                            @foreach ($p['authors'] as $i => $author)
                                                @if ($author === 'Y Polat')
                                                    <span class="font-bold text-brand-500">Y. Polat</span>@else{{ $author }}@endif{{ $i < count($p['authors']) - 1 ? ', ' : '' }}@endforeach
                                            @if ($p['et_al'] ?? false)
                                                <span class="text-ink-400 italic"> ve ark.</span>
                                            @endif
                                        </p>

                                        {{-- Dergi + DOI --}}
                                        <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-[13px]">
                                            <span class="inline-flex items-center gap-2 text-deep-500 font-semibold">
                                                <i class="fas fa-bookmark text-[10px] text-deep-300"></i>
                                                {{ $p['journal'] }}
                                            </span>
                                            @if (! empty($p['detail']))
                                                <span class="text-ink-400 font-light">{{ $p['detail'] }}</span>
                                            @endif
                                            @if ($p['doi'])
                                                <a href="https://doi.org/{{ $p['doi'] }}" target="_blank" rel="noopener"
                                                   class="inline-flex items-center gap-1.5 text-brand-500 hover:text-deep-600 font-semibold transition-colors">
                                                    <i class="fas fa-up-right-from-square text-[10px]"></i>
                                                    Yayına git
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- 3. RANDEVU CTA — açık zeminli premium banner --}}
@php
    $ctaWhatsapp = config('site.whatsapp') . '?text=' . rawurlencode('Merhaba, web sitenizden ulaşıyorum. Randevu oluşturmak istiyorum. Teşekkürler.');
@endphp
<section class="bg-ink-50 pb-16 lg:pb-24">
    <div class="max-w-6xl mx-auto px-4 md:px-6 lg:px-8">
        <div class="relative bg-white rounded-[28px] border border-ink-100 overflow-hidden
                    px-8 py-10 lg:px-14 lg:py-14
                    shadow-[0_24px_60px_-28px_color-mix(in_srgb,var(--color-deep-700)_35%,transparent)]">

            {{-- Dekor: yumuşak ışık lekeleri + ince üst aksan --}}
            <div class="absolute -top-24 -right-24 w-80 h-80 bg-brand-100/45 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-28 -left-24 w-80 h-80 bg-deep-100/45 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute top-0 left-0 h-[3px] w-40 bg-gradient-to-r from-brand-500 to-transparent"></div>

            <div class="relative flex flex-col lg:flex-row items-start lg:items-center justify-between gap-10 lg:gap-14">

                {{-- Metin --}}
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-3 mb-5">
                        <span class="h-px w-7 bg-gradient-to-r from-transparent to-brand-500"></span>
                        <p class="text-brand-500 text-[11px] font-bold tracking-[0.3em] uppercase">Randevu</p>
                    </div>

                    <h3 class="font-display tracking-tight mb-4">
                        <span class="block text-ink-400 font-light text-[19px] lg:text-[23px] leading-snug mb-1">
                            Laboratuvardan kliniğe
                        </span>
                        <span class="block text-deep-600 font-extrabold text-[30px] lg:text-[42px] leading-[1.06] tracking-[-0.02em]">
                            Kanıta dayalı <span class="text-brand-500">tedavi planı</span>
                        </span>
                    </h3>

                    <p class="text-ink-400 text-[15px] lg:text-base font-light leading-relaxed max-w-xl">
                        Yıllardır yürüttüğüm bilimsel çalışmaların kazandırdığı bakış açısıyla,
                        her hastaya riski ölçülmüş ve kişiye özel bir tedavi planı hazırlıyorum.
                    </p>

                    {{-- Güven satırı — ince ayraçlı, sade --}}
                    <div class="flex flex-wrap items-center gap-y-2 mt-7">
                        @foreach ([
                            'Çorlu / Tekirdağ muayenehanesi',
                            '20+ yıl klinik deneyim',
                            'Bilimsel temelli yaklaşım',
                        ] as $i => $trust)
                            @if ($i > 0)
                                <span class="hidden sm:block w-px h-4 bg-ink-100 mx-4"></span>
                            @endif
                            <span class="inline-flex items-center gap-2 text-ink-500 text-[13px] font-light {{ $i > 0 ? 'mr-4 sm:mr-0' : 'mr-4 sm:mr-0' }}">
                                <i class="fas fa-check text-leaf-500 text-[10px]"></i>
                                {{ $trust }}
                            </span>
                        @endforeach
                    </div>
                </div>

                {{-- Aksiyonlar --}}
                <div class="w-full lg:w-auto flex flex-col sm:flex-row lg:flex-col gap-3 shrink-0 lg:min-w-[248px]">
                    <a href="{{ route('contact') }}"
                       class="group flex-1 inline-flex items-center justify-between gap-4 bg-brand-500 hover:bg-deep-600 text-white
                              px-6 py-4 rounded-xl text-[12px] font-bold uppercase tracking-[0.16em] transition-all duration-300
                              shadow-[0_10px_26px_-10px_color-mix(in_srgb,var(--color-brand-500)_70%,transparent)]
                              hover:shadow-[0_14px_32px_-10px_color-mix(in_srgb,var(--color-deep-600)_60%,transparent)]">
                        <span class="inline-flex items-center gap-2.5">
                            <i class="fas fa-calendar-check text-sm"></i> Randevu Al
                        </span>
                        <i class="fas fa-arrow-right text-[11px] transition-transform duration-300 group-hover:translate-x-1"></i>
                    </a>

                    <a href="{{ $ctaWhatsapp }}" target="_blank" rel="noopener"
                       class="group flex-1 inline-flex items-center justify-between gap-4 bg-white hover:bg-[#1FA950] text-deep-600 hover:text-white
                              border border-ink-100 hover:border-[#1FA950]
                              px-6 py-4 rounded-xl text-[12px] font-bold uppercase tracking-[0.16em] transition-all duration-300">
                        <span class="inline-flex items-center gap-2.5">
                            <i class="fab fa-whatsapp text-base text-[#1FA950] group-hover:text-white transition-colors"></i> WhatsApp
                        </span>
                        <i class="fas fa-arrow-right text-[11px] transition-transform duration-300 group-hover:translate-x-1"></i>
                    </a>

                    <a href="tel:{{ config('site.phone_raw') }}"
                       class="text-center lg:text-left text-ink-400 hover:text-brand-500 text-[13px] font-light transition-colors mt-1 inline-flex items-center justify-center lg:justify-start gap-2">
                        <i class="fas fa-phone text-[10px] text-leaf-500"></i>
                        <span class="tabular-nums">{{ config('site.phone') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
