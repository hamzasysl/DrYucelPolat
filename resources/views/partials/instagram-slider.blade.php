@php
    $igHandle  = config('instagram.handle');
    $igProfile = config('instagram.profile_url');
    // Yalnızca public/img/ig/ içinde dosyası bulunan post'ları göster.
    // Klasörden bir görseli silmek = slider'dan otomatik kaldırma.
    $igPosts = collect(config('instagram.posts', []))
        ->filter(fn ($p) => file_exists(public_path('img/ig/' . $p['slug'] . '.' . $p['ext'])))
        ->values()
        ->all();
@endphp

<section class="bg-white py-20 lg:py-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">
            <div class="min-w-0">
                {{-- Kicker — yeşil çizgi + pembe yazı (sayfa stiliyle uyumlu) --}}
                <div class="inline-flex items-center gap-3 mb-3">
                    <span class="h-px w-6 bg-gradient-to-r from-transparent to-leaf-500"></span>
                    <p class="text-brand-500 font-semibold text-sm tracking-[0.22em] uppercase">Fotoğraflar</p>
                </div>
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-deep-600 leading-[1.15] tracking-tight lg:whitespace-nowrap">
                    Klinikten Kareler ve Hastalarımız
                </h2>
                <p class="text-ink-400 text-sm lg:text-[15px] mt-3 leading-relaxed font-light lg:whitespace-nowrap">
                    Hastalarımızla yaşanan anlar, operasyon sonu kareler ve kliniğimizden paylaşımlar.
                </p>
            </div>
            <a href="{{ $igProfile }}" target="_blank" rel="noopener"
               class="self-start lg:self-auto shrink-0 inline-flex items-center gap-2 bg-ink-50 hover:bg-ink-100 text-ink-900 px-4 py-2.5 rounded-lg text-[11px] font-bold uppercase tracking-wider transition-colors">
                <i class="fab fa-instagram text-sm text-brand-500"></i>
                {{ '@' . $igHandle }}
                <i class="fas fa-arrow-up-right-from-square text-[9px] ml-1"></i>
            </a>
        </div>

        {{-- Slider --}}
        <div x-data="{
                pos: 0,
                max: 0,
                step: 0,
                init() {
                    this.computeStep();
                    window.addEventListener('resize', () => this.computeStep());
                    this.timer = setInterval(() => this.auto(), 4500);
                },
                computeStep() {
                    const t = this.$refs.track;
                    if (!t) return;
                    const card = t.querySelector('[data-slide]');
                    if (!card) return;
                    const gap = parseInt(getComputedStyle(t).gap) || 16;
                    this.step = card.offsetWidth + gap;
                    this.max  = Math.max(0, t.scrollWidth - t.clientWidth);
                    this.scrollTo();
                },
                scrollTo() {
                    this.$refs.track.scrollTo({ left: this.pos, behavior: 'smooth' });
                },
                prev() { this.pos = Math.max(0, this.pos - this.step); this.scrollTo(); },
                next() {
                    this.computeStep();
                    if (this.pos + this.step > this.max + 4) {
                        this.pos = 0;
                    } else {
                        this.pos += this.step;
                    }
                    this.scrollTo();
                },
                auto() { this.next(); },
                pause() { clearInterval(this.timer); },
                resume() { clearInterval(this.timer); this.timer = setInterval(() => this.auto(), 4500); }
             }"
             @mouseenter="pause" @mouseleave="resume"
             class="relative">

            {{-- Prev/Next butonları --}}
            <button @click="prev"
                    class="absolute -left-3 lg:-left-5 top-1/2 -translate-y-1/2 z-30
                           w-11 h-11 rounded-full bg-white text-deep-600
                           shadow-[0_4px_14px_color-mix(in_srgb,var(--color-deep-700)_20%,transparent)]
                           hover:bg-deep-600 hover:text-white
                           transition-all duration-200 flex items-center justify-center"
                    aria-label="Önceki">
                <i class="fas fa-chevron-left text-sm"></i>
            </button>
            <button @click="next"
                    class="absolute -right-3 lg:-right-5 top-1/2 -translate-y-1/2 z-30
                           w-11 h-11 rounded-full bg-white text-deep-600
                           shadow-[0_4px_14px_color-mix(in_srgb,var(--color-deep-700)_20%,transparent)]
                           hover:bg-deep-600 hover:text-white
                           transition-all duration-200 flex items-center justify-center"
                    aria-label="Sonraki">
                <i class="fas fa-chevron-right text-sm"></i>
            </button>

            {{-- Track --}}
            <div x-ref="track"
                 class="flex gap-4 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-2"
                 style="scrollbar-width:none; -ms-overflow-style:none;">
                <style>
                    [x-ref="track"]::-webkit-scrollbar { display: none; }
                </style>

                @foreach ($igPosts as $post)
                    @php
                        $src      = asset('img/ig/' . $post['slug'] . '.' . $post['ext']);
                        $href     = 'https://www.instagram.com/' . $igHandle . '/' . (($post['is_reel'] ?? false) ? 'reel' : 'p') . '/' . $post['slug'] . '/';
                        $isReel   = $post['is_reel'] ?? false;
                    @endphp
                    <a data-slide
                       href="{{ $href }}"
                       target="_blank" rel="noopener"
                       class="group relative flex-shrink-0 snap-start
                              w-[230px] sm:w-[260px] lg:w-[280px] aspect-[4/5]
                              rounded-2xl overflow-hidden bg-ink-100
                              shadow-sm hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ $src }}"
                             alt="{{ $post['alt'] }}"
                             loading="lazy"
                             class="absolute inset-0 w-full h-full object-cover
                                    group-hover:scale-105 transition-transform duration-500">

                        {{-- Reel rozet --}}
                        @if ($isReel)
                            <span class="absolute top-3 right-3 z-10 inline-flex items-center gap-1.5
                                         bg-white/90 backdrop-blur text-deep-700 px-2 py-1 rounded-md
                                         text-[10px] font-bold uppercase tracking-wider">
                                <i class="fas fa-play-circle text-brand-500"></i> Reels
                            </span>
                        @endif

                        {{-- Hover overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-deep-900/85 via-deep-900/30 to-transparent
                                    opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-xs font-semibold inline-flex items-center gap-1.5">
                                        <i class="fab fa-instagram"></i> Instagram'da gör
                                    </span>
                                    <i class="fas fa-arrow-up-right-from-square text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
