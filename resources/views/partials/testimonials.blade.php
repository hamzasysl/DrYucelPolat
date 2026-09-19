@php
    /**
     * Hasta yorumları slider'ı — config/testimonials.php'den beslenir.
     * Fotoğraf public/img/testimonials/ içinde varsa kartın üstünde gösterilir;
     * yoksa kart otomatik olarak alıntı başlıklı sade görünüme düşer.
     */
    $testimonials = collect(config('testimonials', []))
        ->map(function (array $t) {
            $t['photo_urls'] = collect($t['photos'] ?? [])
                ->filter(fn ($f) => file_exists(public_path('img/testimonials/' . $f)))
                ->map(fn ($f) => asset('img/testimonials/' . $f))
                ->values()
                ->all();
            return $t;
        })
        ->values();
@endphp

@if ($testimonials->isNotEmpty())
<section class="bg-ink-50 py-20 lg:py-28 overflow-hidden border-t border-ink-100">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">

        {{-- Başlık --}}
        <div class="mb-10 lg:mb-14">
            <div class="min-w-0 max-w-3xl">
                <div class="inline-flex items-center gap-3 mb-4">
                    <span class="h-px w-6 bg-gradient-to-r from-transparent to-leaf-500"></span>
                    <p class="text-brand-500 font-semibold text-sm tracking-[0.22em] uppercase">Hasta Yorumları</p>
                </div>
                <h2 class="font-display tracking-tight">
                    <span class="block text-ink-400 font-light text-[19px] lg:text-[23px] leading-snug mb-1.5">
                        Tedavi sürecini tamamlayan hastalarımızdan
                    </span>
                    <span class="block text-deep-600 font-extrabold text-[32px] lg:text-[46px] leading-[1.04] tracking-[-0.025em]">
                        İyileşme hikâyeleri
                    </span>
                </h2>
            </div>
        </div>

        {{-- Slider --}}
        <div x-data="{
                timer: null,
                atStart: true,
                atEnd: false,
                init() {
                    this.$nextTick(() => this.sync());
                    this.$refs.track.addEventListener('scroll', () => this.sync(), { passive: true });
                    window.addEventListener('resize', () => this.sync());
                    this.resume();
                },
                step() {
                    const t = this.$refs.track;
                    const card = t.querySelector('[data-slide]');
                    const gap = parseFloat(getComputedStyle(t).columnGap || getComputedStyle(t).gap) || 20;
                    return card ? card.offsetWidth + gap : t.clientWidth;
                },
                sync() {
                    const t = this.$refs.track;
                    this.atStart = t.scrollLeft <= 2;
                    this.atEnd   = t.scrollLeft >= t.scrollWidth - t.clientWidth - 2;
                },
                slide(left) {
                    this.$refs.track.scrollTo({ left, behavior: 'smooth' });
                    if (this.timer) this.resume();
                },
                prev() {
                    const t = this.$refs.track;
                    this.slide(this.atStart ? t.scrollWidth : t.scrollLeft - this.step());
                },
                next() {
                    const t = this.$refs.track;
                    this.slide(this.atEnd ? 0 : t.scrollLeft + this.step());
                },
                pause() { clearInterval(this.timer); this.timer = null; },
                resume() { clearInterval(this.timer); this.timer = setInterval(() => this.next(), 6500); }
             }"
             @mouseenter="pause()" @mouseleave="resume()"
             @focusin="pause()" @touchstart.passive="pause()"
             class="relative">

            {{-- Prev / Next --}}
            <button @click="prev" aria-label="Önceki yorum"
                    class="flex absolute left-0 sm:-left-3 lg:-left-5 top-1/2 -translate-y-1/2 z-30
                           w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white text-deep-600
                           shadow-[0_4px_14px_color-mix(in_srgb,var(--color-deep-700)_20%,transparent)]
                           hover:bg-deep-600 hover:text-white hover:scale-105 active:scale-95 transition-all duration-200 items-center justify-center">
                <i class="fas fa-chevron-left text-sm"></i>
            </button>
            <button @click="next" aria-label="Sonraki yorum"
                    class="flex absolute right-0 sm:-right-3 lg:-right-5 top-1/2 -translate-y-1/2 z-30
                           w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white text-deep-600
                           shadow-[0_4px_14px_color-mix(in_srgb,var(--color-deep-700)_20%,transparent)]
                           hover:bg-deep-600 hover:text-white hover:scale-105 active:scale-95 transition-all duration-200 items-center justify-center">
                <i class="fas fa-chevron-right text-sm"></i>
            </button>

            {{-- Track --}}
            <div x-ref="track"
                 class="rev-track flex gap-5 overflow-x-auto scroll-smooth snap-x snap-mandatory items-stretch pb-2 -mx-1 px-1"
                 style="scrollbar-width:none; -ms-overflow-style:none;">
                <style>
                    .rev-track::-webkit-scrollbar, .shot-track::-webkit-scrollbar { display: none; }
                </style>

                @foreach ($testimonials as $t)
                    @php $isLong = collect($t['text'])->sum(fn ($p) => mb_strlen($p)) > 420; @endphp
                    <article data-slide
                             x-data="{ open: false }"
                             class="group relative flex-shrink-0 snap-start flex flex-col
                                    w-[85vw] sm:w-[340px] lg:w-[360px]
                                    bg-white rounded-2xl border border-ink-100 hover:border-deep-200 overflow-hidden
                                    transition-colors duration-300">

                        {{-- Üst: fotoğraf(lar) veya alıntı bandı --}}
                        @php $shots = $t['photo_urls']; @endphp
                        @if (count($shots))
                            <div class="relative"
                                 x-data="{
                                    i: 0,
                                    n: {{ count($shots) }},
                                    sync() { const s = this.$refs.shots; this.i = Math.round(s.scrollLeft / s.clientWidth); },
                                    goto(k) { const s = this.$refs.shots; this.i = k; s.scrollTo({ left: k * s.clientWidth, behavior: 'smooth' }); },
                                    step(d) { this.goto((this.i + d + this.n) % this.n); }
                                 }">
                                <div x-ref="shots"
                                     @scroll.passive="sync()"
                                     class="shot-track flex overflow-x-auto snap-x snap-mandatory aspect-[4/5] bg-ink-100"
                                     style="scrollbar-width:none; -ms-overflow-style:none;">
                                    @foreach ($shots as $k => $shot)
                                        <img src="{{ $shot }}"
                                             alt="{{ ($t['name'] ?: 'Hastamız') . ' — Op. Dr. Yücel Polat' }}"
                                             loading="lazy"
                                             @click="$dispatch('lightbox-open', { shots: {{ Illuminate\Support\Js::from($shots) }}, i: {{ $k }} })"
                                             class="w-full h-full object-cover shrink-0 snap-start cursor-zoom-in"
                                             style="min-width:100%">
                                    @endforeach
                                </div>

                                {{-- Alt karartma --}}
                                <div class="pointer-events-none absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-deep-900/55 to-transparent"></div>

                                {{-- Tedavi rozeti --}}
                                @if (! empty($t['label']))
                                    <span class="absolute top-3 left-3 inline-flex items-center gap-1.5 bg-white/92 backdrop-blur
                                                 text-deep-700 px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider">
                                        <i class="fas fa-stethoscope text-brand-500 text-[9px]"></i>{{ $t['label'] }}
                                    </span>
                                @endif

                                @if (count($shots) > 1)
                                    {{-- Sayaç --}}
                                    <span class="absolute top-3 right-3 bg-deep-900/60 backdrop-blur text-white
                                                 px-2 py-0.5 rounded-md text-[10px] font-bold tabular-nums">
                                        <span x-text="i + 1"></span>/{{ count($shots) }}
                                    </span>

                                    {{-- Oklar --}}
                                    <button type="button" @click="step(-1)" aria-label="Önceki fotoğraf"
                                            class="absolute left-2 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white/85 hover:bg-white
                                                   text-deep-700 flex items-center justify-center
                                                   opacity-100 sm:opacity-0 sm:group-hover:opacity-100
                                                   transition-opacity duration-200">
                                        <i class="fas fa-chevron-left text-[11px]"></i>
                                    </button>
                                    <button type="button" @click="step(1)" aria-label="Sonraki fotoğraf"
                                            class="absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white/85 hover:bg-white
                                                   text-deep-700 flex items-center justify-center
                                                   opacity-100 sm:opacity-0 sm:group-hover:opacity-100
                                                   transition-opacity duration-200">
                                        <i class="fas fa-chevron-right text-[11px]"></i>
                                    </button>

                                    {{-- Noktalar --}}
                                    <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex items-center gap-1.5">
                                        @foreach ($shots as $k => $shot)
                                            <button type="button" @click="goto({{ $k }})" aria-label="{{ $k + 1 }}. fotoğraf"
                                                    class="h-1.5 rounded-full transition-all duration-300"
                                                    :class="i === {{ $k }} ? 'w-5 bg-white' : 'w-1.5 bg-white/55 hover:bg-white/80'"></button>
                                        @endforeach
                                    </div>
                                @endif

                                {{-- Büyütme ipucu --}}
                                <span class="pointer-events-none absolute bottom-3 left-3 inline-flex items-center gap-1.5
                                             bg-deep-900/55 backdrop-blur text-white px-2 py-1 rounded-md text-[10px] font-semibold
                                             opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity duration-200">
                                    <i class="fas fa-magnifying-glass-plus text-[9px]"></i> Büyüt
                                </span>

                                {{-- Alıntı rozeti --}}
                                <span class="absolute -bottom-5 right-5 z-10 w-10 h-10 rounded-xl bg-brand-500 text-white
                                             inline-flex items-center justify-center ring-4 ring-white">
                                    <i class="fas fa-quote-right text-[13px]"></i>
                                </span>
                            </div>
                        @else
                            <div class="relative px-6 pt-6 pb-1">
                                <div class="flex items-start justify-between gap-3">
                                    @if (! empty($t['label']))
                                        <span class="inline-flex items-center gap-1.5 bg-deep-50 text-deep-600 px-2.5 py-1 rounded-md
                                                     text-[10px] font-bold uppercase tracking-wider">
                                            <i class="fas fa-stethoscope text-brand-500 text-[9px]"></i>{{ $t['label'] }}
                                        </span>
                                    @endif
                                    <i class="fas fa-quote-right text-brand-100 text-3xl leading-none"></i>
                                </div>
                            </div>
                        @endif

                        {{-- Gövde --}}
                        <div class="flex-1 flex flex-col p-6 {{ count($shots) ? 'pt-7' : 'pt-4' }}">
                            {{-- Yıldızlar + sonuç rozeti --}}
                            <div class="flex items-center justify-between gap-3 mb-3">
                                <div class="flex items-center gap-1 text-[12px] text-sun-500" aria-label="5 üzerinden 5">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                                @if (! empty($t['result']))
                                    <span class="inline-flex items-center gap-1.5 bg-leaf-500/12 text-leaf-600 px-2.5 py-1 rounded-md
                                                 text-[10.5px] font-bold tracking-wide whitespace-nowrap">
                                        <i class="fas fa-arrow-trend-down text-[9px]"></i>{{ $t['result'] }}
                                    </span>
                                @endif
                            </div>

                            @if ($isLong)
                                {{-- Uzun yorum — yumuşak açılan gövde --}}
                                <div class="relative overflow-hidden transition-[max-height] duration-500 ease-[cubic-bezier(0.22,1,0.36,1)]"
                                     :style="open ? 'max-height:' + ($refs.body.scrollHeight + 8) + 'px' : 'max-height:13.5rem'">
                                    <div x-ref="body" class="text-ink-500 text-[14.5px] font-light leading-relaxed space-y-3">
                                        @foreach ($t['text'] as $paragraph)
                                            <p>{{ $paragraph }}</p>
                                        @endforeach
                                    </div>
                                    {{-- Kapalıyken alt kenarda yumuşak solma --}}
                                    <div class="pointer-events-none absolute inset-x-0 bottom-0 h-12 bg-gradient-to-t from-white to-transparent
                                                transition-opacity duration-300"
                                         :class="open ? 'opacity-0' : 'opacity-100'"></div>
                                </div>
                            @else
                                <div class="text-ink-500 text-[14.5px] font-light leading-relaxed space-y-3">
                                    @foreach ($t['text'] as $paragraph)
                                        <p>{{ $paragraph }}</p>
                                    @endforeach
                                </div>
                            @endif

                            @if ($isLong)
                                <button type="button" @click="open = !open"
                                        class="self-start mt-3 inline-flex items-center gap-1.5 text-brand-500 hover:text-deep-600
                                               text-[12px] font-bold uppercase tracking-wider transition-colors">
                                    <span x-text="open ? 'Kısalt' : 'Devamını oku'"></span>
                                    <i class="fas fa-chevron-down text-[9px] transition-transform" :class="open ? 'rotate-180' : ''"></i>
                                </button>
                            @endif

                            {{-- Yazar --}}
                            <div class="flex items-center gap-3 mt-6 pt-5 border-t border-ink-100">
                                <span class="w-9 h-9 rounded-full bg-deep-50 text-deep-500 inline-flex items-center justify-center shrink-0">
                                    <i class="fas fa-user text-[11px]"></i>
                                </span>
                                <div class="min-w-0">
                                    <p class="text-deep-700 text-[14.5px] font-bold leading-tight truncate">
                                        {{ $t['name'] ?: 'Hastamız' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        {{-- Fotoğraf büyütme (lightbox) --}}
        <div x-data="{
                open: false, shots: [], i: 0,
                show(s, k) { this.shots = s; this.i = k; this.open = true; document.body.style.overflow = 'hidden'; },
                hide() { this.open = false; document.body.style.overflow = ''; },
                next() { this.i = (this.i + 1) % this.shots.length; },
                prev() { this.i = (this.i - 1 + this.shots.length) % this.shots.length; }
             }"
             @lightbox-open.window="show($event.detail.shots, $event.detail.i)"
             @keydown.escape.window="open && hide()"
             @keydown.arrow-right.window="open && next()"
             @keydown.arrow-left.window="open && prev()">

            <div x-show="open" x-cloak style="display:none"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 @click.self="hide()"
                 class="fixed inset-0 z-[100] bg-deep-900/92 backdrop-blur-sm flex items-center justify-center p-4 sm:p-8">

                {{-- Kapat --}}
                <button type="button" @click="hide()" aria-label="Kapat"
                        class="absolute top-4 right-4 w-11 h-11 rounded-full bg-white/10 hover:bg-white text-white hover:text-deep-700
                               flex items-center justify-center transition-colors">
                    <i class="fas fa-xmark text-lg"></i>
                </button>

                {{-- Sayaç --}}
                <span x-show="shots.length > 1"
                      class="absolute top-6 left-1/2 -translate-x-1/2 text-white/80 text-[12px] font-semibold tabular-nums">
                    <span x-text="i + 1"></span> / <span x-text="shots.length"></span>
                </span>

                {{-- Oklar --}}
                <button type="button" x-show="shots.length > 1" @click.stop="prev()" aria-label="Önceki fotoğraf"
                        class="absolute left-3 sm:left-6 w-11 h-11 rounded-full bg-white/10 hover:bg-white text-white hover:text-deep-700
                               flex items-center justify-center transition-colors">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button type="button" x-show="shots.length > 1" @click.stop="next()" aria-label="Sonraki fotoğraf"
                        class="absolute right-3 sm:right-6 w-11 h-11 rounded-full bg-white/10 hover:bg-white text-white hover:text-deep-700
                               flex items-center justify-center transition-colors">
                    <i class="fas fa-chevron-right"></i>
                </button>

                {{-- Görsel --}}
                <img :src="shots[i]" alt="Hasta fotoğrafı — Op. Dr. Yücel Polat"
                     @click.stop
                     class="max-h-[86vh] max-w-full w-auto rounded-2xl shadow-2xl object-contain select-none">
            </div>
        </div>

        {{-- Alt not + CTA --}}
        <div class="mt-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">
            <p class="flex items-center gap-2.5 text-ink-400 text-[13px] font-light leading-relaxed max-w-xl m-0">
                <i class="fas fa-shield-heart text-leaf-500 text-[13px] shrink-0"></i>
                <span>Her hastanın klinik tablosu farklıdır; sonuçlar kişiden kişiye değişebilir.</span>
            </p>
            <a href="{{ route('contact') }}"
               class="shrink-0 inline-flex items-center justify-center gap-2 bg-brand-500 hover:bg-deep-600 text-white
                      px-6 py-3.5 leading-none text-[12px] font-bold uppercase tracking-[0.16em] rounded-xl
                      transition-colors
                      shadow-[0_10px_26px_-12px_color-mix(in_srgb,var(--color-brand-500)_70%,transparent)]">
                Randevu Al <i class="fas fa-arrow-right text-[11px]"></i>
            </a>
        </div>
    </div>
</section>
@endif
