@php
    /**
     * Subheader partial — tüm sayfalarda kullanılır.
     * Props:
     *   $title   — zorunlu, büyük başlık
     *   $current — opsiyonel, breadcrumb'taki mevcut sayfa adı (örn. "Hakkımda")
     *   $parent  — opsiyonel, ara breadcrumb [ 'label' => 'Hizmetler', 'route' => 'services.index' ]
     */
    $title   = $title   ?? '';
    $current = $current ?? null;
    $parent  = $parent  ?? null;
@endphp

<section class="relative overflow-hidden border-b border-ink-100">
    {{-- Arka plan görsel: blur + subtle opacity --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('img/hero/slider-3.jpg') }}"
             alt=""
             aria-hidden="true"
             loading="lazy"
             class="w-full h-full object-cover blur-md scale-110 opacity-[0.45]">
        <div class="absolute inset-0 bg-white/55"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-deep-50/30 via-transparent to-ink-50/40"></div>
    </div>

    {{-- İçerik — sol yaslı + sağda EKG nabız çizgisi --}}
    <div class="relative max-w-7xl mx-auto px-4 md:px-6 lg:px-8 pt-7 pb-10 lg:pt-8 lg:pb-12 flex items-center justify-between gap-8">
        <div class="min-w-0">
            @if ($current)
                <div class="inline-flex items-center gap-3 mb-3">
                    <span class="h-px w-6 bg-gradient-to-r from-transparent to-leaf-500"></span>
                    <nav class="flex items-center gap-1.5 text-[13px] font-light" aria-label="Breadcrumb">
                        <a href="{{ route('home') }}" class="text-brand-500 hover:text-brand-700 transition-colors">Anasayfa</a>
                        <span class="text-brand-200">›</span>
                        @if ($parent)
                            <a href="{{ route($parent['route']) }}" class="text-brand-500 hover:text-brand-700 transition-colors">{{ $parent['label'] }}</a>
                            <span class="text-brand-200">›</span>
                        @endif
                        <span class="text-brand-400">{{ $current }}</span>
                    </nav>
                </div>
            @endif

            <h1 class="font-display text-3xl lg:text-[38px] font-bold text-deep-600 tracking-tight leading-[1.1]">
                {{ $title }}
            </h1>
        </div>

        {{-- Sağ: EKG nabız çizgisi — tablet+ desktop, başlık genişlemesin diye shrink-0 --}}
        <div class="hidden md:block shrink-0 w-[180px] md:w-[200px] lg:w-[300px] xl:w-[380px] pointer-events-none lg:translate-x-4 xl:translate-x-6" aria-hidden="true">
            <svg viewBox="0 0 500 80" class="w-full h-8 md:h-9 lg:h-12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M 0 40 L 160 40 L 175 12 L 195 68 L 215 22 L 235 58 L 250 40 L 500 40"
                      stroke="url(#sub-pulse-grad)"
                      stroke-width="2.5"
                      stroke-linecap="round"
                      stroke-linejoin="round">
                    <animate attributeName="stroke-dasharray"
                             from="0 600" to="600 0" dur="2.5s"
                             repeatCount="indefinite"/>
                </path>
                <defs>
                    <linearGradient id="sub-pulse-grad" x1="0" y1="0" x2="1" y2="0">
                        <stop offset="0%"   stop-color="#84CC16" stop-opacity="0"/>
                        <stop offset="35%"  stop-color="#E63946"/>
                        <stop offset="65%"  stop-color="#E63946"/>
                        <stop offset="100%" stop-color="#1E5F9E" stop-opacity="0"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>
    </div>
</section>
