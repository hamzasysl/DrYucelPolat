@php
    /**
     * Seçili bilimsel yayınlar — Hakkımda sayfasında kullanılır.
     * Veri: config/publications.php · Sıralama routes/web.php (about) içinde yapılır.
     * Bilinçli olarak sayı / tür / istatistik gösterilmez; liste tüm yayınları kapsamaz.
     */
    $publications = $publications ?? collect();
@endphp

@if ($publications->isNotEmpty())
<section id="yayinlar" class="bg-ink-50 py-20 lg:py-28 border-t border-ink-100 scroll-mt-28">
    <div class="max-w-5xl mx-auto px-4 md:px-6 lg:px-8">

        {{-- Başlık --}}
        <div class="mb-10 lg:mb-12">
            <div class="inline-flex items-center gap-3 mb-4">
                <span class="h-px w-6 bg-gradient-to-r from-transparent to-leaf-500"></span>
                <p class="text-brand-500 font-semibold text-sm tracking-[0.22em] uppercase">Akademik Çalışmalar</p>
            </div>
            <h2 class="font-display tracking-tight">
                <span class="block text-ink-400 font-light text-[19px] lg:text-[23px] leading-snug mb-1.5">
                    Uluslararası hakemli dergilerden
                </span>
                <span class="block text-deep-600 font-extrabold text-[30px] lg:text-[42px] leading-[1.05] tracking-[-0.02em]">
                    Seçili bilimsel yayınlar
                </span>
            </h2>
        </div>

        {{-- Liste --}}
        <div class="space-y-4">
            @foreach ($publications as $p)
                <article class="group relative bg-white border border-ink-100 hover:border-deep-200 rounded-2xl overflow-hidden transition-colors duration-300">
                    <span class="absolute left-0 top-0 bottom-0 w-[3px] bg-gradient-to-b from-brand-500 via-brand-400/50 to-deep-400/40
                                 opacity-60 group-hover:opacity-100 transition-opacity"></span>

                    <div class="pl-6 pr-5 py-6 sm:pl-8 sm:pr-7 sm:py-7">
                        {{-- Yıl --}}
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 mb-3 rounded-md bg-deep-50 text-deep-600 text-[11px] font-bold uppercase tracking-wider">
                            <i class="far fa-calendar text-[10px]"></i>{{ $p['year'] }}
                        </span>

                        {{-- Başlık --}}
                        <h3 class="font-display text-[16px] sm:text-[17px] font-bold text-deep-700 leading-snug mb-3">
                            @if ($p['doi'])
                                <a href="https://doi.org/{{ $p['doi'] }}" target="_blank" rel="noopener"
                                   class="hover:text-brand-500 transition-colors">{{ $p['title'] }}</a>
                            @else
                                {{ $p['title'] }}
                            @endif
                        </h3>

                        {{-- Yazarlar — Y. Polat vurgulu --}}
                        <p class="text-[13.5px] text-ink-500 font-light leading-relaxed mb-2.5">
                            @foreach ($p['authors'] as $i => $author)
                                @if ($author === 'Y Polat')
                                    <span class="font-bold text-brand-500">Y. Polat</span>@else{{ $author }}@endif{{ $i < count($p['authors']) - 1 ? ', ' : '' }}@endforeach
                            @if ($p['et_al'] ?? false)
                                <span class="text-ink-400 italic"> ve ark.</span>
                            @endif
                        </p>

                        {{-- Dergi + bağlantı --}}
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-[13px]">
                            <span class="inline-flex items-center gap-2 text-deep-500 font-semibold">
                                <i class="fas fa-bookmark text-[10px] text-deep-300"></i>{{ $p['journal'] }}
                            </span>
                            @if (! empty($p['detail']))
                                <span class="text-ink-400 font-light">{{ $p['detail'] }}</span>
                            @endif
                            @if ($p['doi'])
                                <a href="https://doi.org/{{ $p['doi'] }}" target="_blank" rel="noopener"
                                   class="inline-flex items-center gap-1.5 text-brand-500 hover:text-deep-600 font-semibold transition-colors">
                                    <i class="fas fa-up-right-from-square text-[10px]"></i> Yayına git
                                </a>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif
