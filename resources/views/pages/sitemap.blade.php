@extends('layouts.app')

@section('title', page_title('Site Haritası'))
@section('description', 'Op. Dr. Yücel Polat web sitesindeki tüm sayfalara hızlı erişim — site haritası ve SEO durumu.')
@section('og_title', page_title('Site Haritası'))
@section('og_description', 'Tüm sayfaların organize edilmiş listesi.')

@section('structured_data')
@php
    $breadcrumbLd = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Anasayfa', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Site Haritası', 'item' => route('sitemap.html')],
        ],
    ];
@endphp
<script type="application/ld+json">{!! json_encode($breadcrumbLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endsection

@section('content')

@include('partials.subheader', [
    'title'   => 'Site Haritası',
    'current' => 'Site Haritası',
])

<section class="bg-ink-50 py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">

        {{-- =====================================================
             MEZ SEO — Panel header
             ===================================================== --}}
        <div class="relative bg-white rounded-2xl border border-ink-100 overflow-hidden shadow-[0_8px_28px_-12px_color-mix(in_srgb,var(--color-deep-700)_12%,transparent)] mb-8">
            {{-- Üst aksan şeridi --}}
            <div class="h-1 bg-gradient-to-r from-brand-500 via-leaf-500 to-deep-500"></div>

            <div class="p-6 lg:p-8 flex flex-col lg:flex-row items-start lg:items-center gap-5 lg:gap-8">
                {{-- Brand panel kimliği — mezbilisim.com link --}}
                <a href="{{ $stats['package_url'] }}" target="_blank" rel="noopener"
                   class="group flex items-center gap-4 shrink-0">
                    <div class="relative w-14 h-14 rounded-xl bg-gradient-to-br from-deep-500 to-deep-700 flex items-center justify-center shadow-[0_8px_20px_color-mix(in_srgb,var(--color-deep-700)_30%,transparent)] group-hover:shadow-[0_12px_28px_color-mix(in_srgb,var(--color-deep-700)_40%,transparent)] transition-all duration-300">
                        <i class="fas fa-sitemap text-white text-xl"></i>
                        <span class="absolute -top-1 -right-1 w-3 h-3 rounded-full bg-leaf-500 ring-2 ring-white"></span>
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-2 mb-1">
                            <p class="text-brand-500 font-bold text-[10px] tracking-[0.24em] uppercase group-hover:text-brand-600 transition-colors">{{ $stats['package_name'] }}</p>
                            <span class="text-[9px] font-bold text-leaf-600 bg-leaf-500/10 px-1.5 py-0.5 rounded-full">v{{ $stats['package_version'] }}</span>
                        </div>
                        <h2 class="font-display text-[20px] lg:text-[22px] font-bold text-deep-700 leading-tight tracking-tight">
                            Site Haritası & SEO Durumu
                        </h2>
                        <p class="text-[10.5px] text-ink-400 mt-1 font-light">
                            by <span class="font-semibold text-deep-600 group-hover:text-brand-500 transition-colors">{{ $stats['package_author'] }}</span>
                        </p>
                    </div>
                </a>

                {{-- Hızlı linkler — XML + robots + AI/LLM --}}
                <div class="flex flex-wrap gap-2 lg:ml-auto">
                    <a href="{{ $stats['sitemap_xml_url'] }}" target="_blank"
                       class="inline-flex items-center gap-2 bg-ink-50 hover:bg-ink-100 text-deep-700 px-3.5 py-2 rounded-lg text-[12px] font-semibold border border-ink-100 transition-colors">
                        <i class="fas fa-file-code text-[11px] text-deep-500"></i>
                        sitemap.xml
                    </a>
                    <a href="{{ $stats['robots_url'] }}" target="_blank"
                       class="inline-flex items-center gap-2 bg-ink-50 hover:bg-ink-100 text-deep-700 px-3.5 py-2 rounded-lg text-[12px] font-semibold border border-ink-100 transition-colors">
                        <i class="fas fa-robot text-[11px] text-leaf-600"></i>
                        robots.txt
                    </a>
                    <a href="{{ $stats['llms_url'] }}" target="_blank"
                       class="inline-flex items-center gap-2 bg-gradient-to-br from-deep-700 to-deep-500 hover:from-deep-800 hover:to-deep-600 text-white px-3.5 py-2 rounded-lg text-[12px] font-semibold transition-all shadow-[0_4px_10px_color-mix(in_srgb,var(--color-deep-700)_25%,transparent)]">
                        <i class="fas fa-brain text-[11px]"></i>
                        llms.txt
                        <span class="text-[9px] font-bold bg-leaf-500 px-1.5 py-0.5 rounded">AI</span>
                    </a>
                    <a href="{{ $stats['ai_url'] }}" target="_blank"
                       class="inline-flex items-center gap-2 bg-ink-50 hover:bg-ink-100 text-deep-700 px-3.5 py-2 rounded-lg text-[12px] font-semibold border border-ink-100 transition-colors">
                        <i class="fas fa-microchip text-[11px] text-brand-500"></i>
                        ai.txt
                    </a>
                </div>
            </div>

            {{-- Stat grid --}}
            <div class="border-t border-ink-100 grid grid-cols-2 sm:grid-cols-4 divide-x divide-ink-100">
                @foreach ([
                    ['label' => 'Toplam URL',     'value' => $stats['total_urls'],     'icon' => 'fa-link',        'color' => 'deep'],
                    ['label' => 'Yayında Hizmet', 'value' => $stats['services_live'],  'icon' => 'fa-circle-check','color' => 'leaf'],
                    ['label' => 'Taslak',          'value' => $stats['services_draft'], 'icon' => 'fa-clock',       'color' => 'sun'],
                    ['label' => 'Son Güncelleme',  'value' => $stats['last_modified'],  'icon' => 'fa-rotate',      'color' => 'brand'],
                ] as $stat)
                    @php
                        $colorMap = [
                            'deep'  => ['bg' => 'bg-deep-500/10',  'text' => 'text-deep-500'],
                            'leaf'  => ['bg' => 'bg-leaf-500/15',  'text' => 'text-leaf-600'],
                            'sun'   => ['bg' => 'bg-sun-500/15',   'text' => 'text-sun-500'],
                            'brand' => ['bg' => 'bg-brand-500/10', 'text' => 'text-brand-500'],
                        ];
                        $c = $colorMap[$stat['color']];
                    @endphp
                    <div class="p-4 lg:p-5 flex items-center gap-3">
                        <span class="w-9 h-9 rounded-lg {{ $c['bg'] }} {{ $c['text'] }} inline-flex items-center justify-center text-[13px] shrink-0">
                            <i class="fas {{ $stat['icon'] }}"></i>
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="text-[10px] uppercase tracking-[0.18em] text-ink-400 font-bold leading-none mb-1">{{ $stat['label'] }}</p>
                            <p class="font-display text-[15px] lg:text-[16px] font-extrabold text-deep-700 leading-tight truncate">{{ $stat['value'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- =====================================================
             Sayfa grupları
             ===================================================== --}}
        <div class="space-y-6">
            @foreach ($groups as $group)
                @php
                    $colorMap = [
                        'deep'  => ['accent' => 'from-deep-500 to-deep-700',   'badge' => 'bg-deep-50 text-deep-600',    'dot' => 'bg-deep-500'],
                        'brand' => ['accent' => 'from-brand-500 to-brand-700', 'badge' => 'bg-brand-50 text-brand-600',  'dot' => 'bg-brand-500'],
                        'leaf'  => ['accent' => 'from-leaf-500 to-leaf-600',   'badge' => 'bg-leaf-500/15 text-leaf-600','dot' => 'bg-leaf-500'],
                    ];
                    $g = $colorMap[$group['color']] ?? $colorMap['deep'];
                @endphp

                <div class="bg-white rounded-2xl border border-ink-100 overflow-hidden shadow-[0_4px_16px_color-mix(in_srgb,var(--color-deep-700)_5%,transparent)]">

                    {{-- Grup header --}}
                    <div class="px-5 lg:px-7 py-4 lg:py-5 border-b border-ink-100 flex items-center gap-4">
                        <span class="w-10 h-10 rounded-xl bg-gradient-to-br {{ $g['accent'] }} text-white inline-flex items-center justify-center text-[14px] shrink-0 shadow-[0_4px_10px_color-mix(in_srgb,var(--color-deep-700)_15%,transparent)]">
                            <i class="fas {{ $group['icon'] }}"></i>
                        </span>
                        <div class="min-w-0 flex-1">
                            <h3 class="font-display text-[17px] lg:text-[19px] font-bold text-deep-700 leading-tight tracking-tight">
                                {{ $group['title'] }}
                            </h3>
                            <p class="text-[12px] text-ink-400 mt-0.5 font-light">{{ count($group['pages']) }} sayfa</p>
                        </div>
                        <span class="hidden sm:inline-flex items-center text-[10px] font-bold text-ink-400 bg-ink-50 px-2.5 py-1 rounded-md tracking-[0.16em] uppercase">
                            {{ strtoupper($group['key']) }}
                        </span>
                    </div>

                    {{-- Sayfa listesi --}}
                    <div class="divide-y divide-ink-100">
                        @foreach ($group['pages'] as $page)
                            <a href="{{ $page['url'] }}"
                               class="group flex items-start sm:items-center gap-4 px-5 lg:px-7 py-4 hover:bg-ink-50/60 transition-colors">

                                {{-- Bullet veya icon --}}
                                @if (!empty($page['icon']))
                                    <span class="w-8 h-8 rounded-lg bg-ink-50 text-deep-500 inline-flex items-center justify-center text-[11px] shrink-0 group-hover:bg-white group-hover:shadow-[0_2px_6px_color-mix(in_srgb,var(--color-deep-700)_10%,transparent)] transition-all">
                                        <i class="fas {{ $page['icon'] }}"></i>
                                    </span>
                                @else
                                    <span class="w-8 h-8 rounded-lg bg-ink-50 inline-flex items-center justify-center shrink-0 group-hover:bg-white group-hover:shadow-[0_2px_6px_color-mix(in_srgb,var(--color-deep-700)_10%,transparent)] transition-all">
                                        <span class="w-2 h-2 rounded-full {{ $g['dot'] }} opacity-80"></span>
                                    </span>
                                @endif

                                {{-- Content --}}
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center flex-wrap gap-x-2 gap-y-1">
                                        <h4 class="font-display text-[14.5px] lg:text-[15px] font-semibold text-deep-700 group-hover:text-brand-500 transition-colors leading-snug">
                                            {{ $page['title'] }}
                                        </h4>
                                        @if (!empty($page['is_index']))
                                            <span class="inline-flex items-center text-[8.5px] font-bold text-deep-600 bg-deep-50 px-1.5 py-0.5 rounded uppercase tracking-[0.14em]">Hub</span>
                                        @endif
                                        <span class="hidden sm:inline-flex items-center text-[9.5px] font-bold text-leaf-600 bg-leaf-500/10 px-1.5 py-0.5 rounded uppercase tracking-[0.14em]">
                                            <span class="w-1 h-1 rounded-full bg-leaf-500 mr-1"></span>
                                            Yayında
                                        </span>
                                    </div>
                                    <p class="text-[12.5px] text-ink-500 mt-0.5 leading-snug font-light line-clamp-1 sm:line-clamp-2">{{ $page['desc'] }}</p>
                                    <p class="text-[10.5px] text-ink-300 mt-1 font-mono truncate">{{ $page['url'] }}</p>
                                </div>

                                {{-- Meta + arrow --}}
                                <div class="hidden md:flex flex-col items-end gap-1.5 shrink-0">
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-[9.5px] font-bold text-ink-400 tracking-[0.14em] uppercase">Pri</span>
                                        <span class="font-display text-[12.5px] font-extrabold text-deep-600 tabular-nums">{{ $page['priority'] }}</span>
                                    </div>
                                    <span class="text-[10px] text-ink-400 font-light capitalize">{{ $page['changefreq'] }}</span>
                                </div>

                                <span class="w-8 h-8 rounded-lg bg-ink-50 text-deep-500 group-hover:bg-brand-500 group-hover:text-white inline-flex items-center justify-center shrink-0 transition-all duration-300">
                                    <i class="fas fa-arrow-right text-[10px] transition-transform duration-300 group-hover:translate-x-0.5"></i>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        {{-- =====================================================
             Footer — MEZ SEO imzası
             ===================================================== --}}
        <div class="mt-10 lg:mt-12 flex flex-col sm:flex-row items-center justify-between gap-4 px-2">
            <p class="text-[12px] text-ink-400 font-light text-center sm:text-left">
                <strong class="text-deep-600 font-semibold">{{ $stats['canonical_host'] }}</strong> ·
                Son güncelleme <strong class="text-deep-600 font-semibold">{{ $stats['last_modified'] }}</strong>
            </p>
            <div class="inline-flex items-center gap-2 text-[11px] text-ink-400">
                <span>Powered by</span>
                <a href="{{ $stats['package_url'] }}" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-1.5 text-deep-600 font-bold hover:text-brand-500 transition-colors">
                    <i class="fas fa-sitemap text-brand-500 text-[10px]"></i>
                    {{ $stats['package_name'] }}
                    <span class="text-[9px] font-bold text-leaf-600 bg-leaf-500/10 px-1 py-0.5 rounded">v{{ $stats['package_version'] }}</span>
                </a>
                <span class="text-ink-300">·</span>
                <a href="{{ $stats['package_url'] }}" target="_blank" rel="noopener" class="text-deep-500 hover:text-brand-500 font-semibold transition-colors">
                    {{ $stats['package_author'] }}
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
