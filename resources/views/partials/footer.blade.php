<footer class="relative overflow-hidden bg-[#174E7C] text-ink-100">
    {{-- Üst aksan şeridi — brand → leaf gradient --}}
    <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-brand-500/60 to-transparent"></div>
    <div class="absolute top-px inset-x-0 h-px bg-gradient-to-r from-transparent via-leaf-500/30 to-transparent"></div>

    {{-- Çok hafif dekoratif orb (renk geçişi yapmasın diye azaltıldı) --}}
    <div class="absolute -top-40 -right-32 w-96 h-96 bg-white/[0.03] rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-10">

            {{-- Brand column --}}
            <div class="lg:col-span-4">
                <div class="inline-flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-white/95 backdrop-blur flex items-center justify-center shadow-[0_8px_28px_color-mix(in_srgb,var(--color-deep-700)_30%,transparent)]">
                        <img src="{{ asset('img/logo.png') }}" alt="" class="h-10 w-auto">
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-white text-lg leading-tight">Op. Dr. Yücel Polat</h3>
                        <p class="text-deep-100 text-[10px] font-semibold tracking-[0.22em] uppercase mt-0.5">Kardiyovasküler Cerrahi</p>
                    </div>
                </div>

                {{-- Açıklama: gradient aksanlı dikey çizgili kart --}}
                <div class="relative pl-5 mb-7">
                    {{-- Dikey gradient aksan çizgi (pembe → mavi) --}}
                    <span class="absolute left-0 top-0 bottom-0 w-[3px] rounded-full bg-gradient-to-b from-brand-500 via-brand-400/60 to-deep-400/40"></span>

                    <p class="text-ink-200/85 text-sm leading-relaxed font-light mb-3.5 max-w-md">
                        Liv Hospital Istanbul bünyesinde varis tedavisi,
                        endovasküler girişimler, lenfödem-lipödem, diyabetik yara, tromboz ve klasik
                        kalp-damar cerrahisi alanlarında hizmet veriyorum. Her hasta için bilimsel kanıta dayalı,
                        riski ölçülmüş ve kişiye özel tedavi planı.
                    </p>

                    {{-- Quote tarzı kısa imza --}}
                    <p class="text-ink-200/65 text-[12.5px] leading-relaxed font-light italic max-w-md flex items-start gap-2">
                        <i class="fas fa-quote-left text-brand-400/60 text-[10px] mt-1 shrink-0"></i>
                        Bilim, deneyim ve şefkat — birlikte daha güçlü.
                    </p>
                </div>

                {{-- Premium social row — yumuşak cam etkili --}}
                @php
                    $footerSocials = collect([
                        ['url' => config('site.socials.instagram'), 'icon' => 'fab fa-instagram',  'label' => 'Instagram'],
                        ['url' => config('site.socials.facebook'),  'icon' => 'fab fa-facebook-f', 'label' => 'Facebook'],
                        ['url' => config('site.socials.youtube'),   'icon' => 'fab fa-youtube',    'label' => 'YouTube'],
                        ['url' => config('site.socials.linkedin'),  'icon' => 'fab fa-linkedin-in','label' => 'LinkedIn'],
                        ['url' => config('site.socials.x'),         'icon' => 'fab fa-x-twitter',  'label' => 'X'],
                    ])->filter(fn ($s) => ! empty($s['url']));
                @endphp
                @if ($footerSocials->isNotEmpty())
                    <div class="flex items-center gap-2">
                        @foreach ($footerSocials as $s)
                            <a href="{{ $s['url'] }}" target="_blank" rel="noopener" aria-label="{{ $s['label'] }}"
                               class="group w-9 h-9 rounded-xl bg-white/[0.06] hover:bg-white border border-white/10 hover:border-white text-white/85 hover:text-deep-700 backdrop-blur transition-all duration-300 inline-flex items-center justify-center hover:-translate-y-0.5">
                                <i class="{{ $s['icon'] }} text-[13px]"></i>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Popüler Hizmetler — 2 kolonlu, geniş alan --}}
            <div class="lg:col-span-5 lg:pl-6">
                <h4 class="font-display font-bold text-white text-lg mb-6">
                    Popüler Hizmetler
                </h4>
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3.5 text-sm">
                    @foreach (config('treatments', []) as $t)
                        @php $ftHref = ($t['has_page'] ?? false) ? route('services.show', $t['slug']) : '#'; @endphp
                        <li>
                            <a href="{{ $ftHref }}"
                               class="group inline-flex items-center gap-2.5 text-ink-200/80 hover:text-white font-light transition-all">
                                <span class="w-1 h-1 rounded-full bg-leaf-500 group-hover:w-4 group-hover:h-0.5 transition-all duration-300 shrink-0"></span>
                                <span class="group-hover:translate-x-0.5 transition-transform">{{ $t['title'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact (sağa alındı) + Çalışma Saatleri minimal alt blok --}}
            <div class="lg:col-span-3">
                <h4 class="font-display font-bold text-white text-lg mb-6">
                    İletişim
                </h4>
                <ul class="space-y-4 text-sm">
                    <li>
                        <a href="tel:{{ config('site.phone_raw') }}" class="group flex items-start gap-3 text-ink-200/80 hover:text-white transition-colors">
                            <span class="mt-0.5 w-7 h-7 rounded-md bg-leaf-500/15 text-leaf-500 inline-flex items-center justify-center shrink-0 group-hover:bg-leaf-500 group-hover:text-white transition-all">
                                <i class="fas fa-phone text-[10px]"></i>
                            </span>
                            <span class="font-light pt-1">{{ config('site.phone') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:{{ config('site.email') }}" class="group flex items-start gap-3 text-ink-200/80 hover:text-white transition-colors">
                            <span class="mt-0.5 w-7 h-7 rounded-md bg-leaf-500/15 text-leaf-500 inline-flex items-center justify-center shrink-0 group-hover:bg-leaf-500 group-hover:text-white transition-all">
                                <i class="fas fa-envelope text-[10px]"></i>
                            </span>
                            <span class="font-light pt-1 break-all">{{ config('site.email') }}</span>
                        </a>
                    </li>
                    <li class="flex items-start gap-3 text-ink-200/80">
                        <span class="mt-0.5 w-7 h-7 rounded-md bg-leaf-500/15 text-leaf-500 inline-flex items-center justify-center shrink-0">
                            <i class="fas fa-map-marker-alt text-[10px]"></i>
                        </span>
                        <span class="font-light pt-1">{{ config('site.address') }}</span>
                    </li>
                </ul>

                {{-- Çalışma saatleri — minimal inline blok --}}
                <div class="mt-6 pt-5 border-t border-white/10">
                    <p class="text-[10px] uppercase tracking-[0.22em] font-semibold text-ink-200/60 mb-3 flex items-center gap-2">
                        <i class="far fa-clock text-leaf-500 text-[11px]"></i>
                        Çalışma Saatleri
                    </p>
                    <div class="space-y-1.5 text-[12px]">
                        <div class="flex items-center justify-between gap-2">
                            <span class="font-light text-ink-200/75">Pzt - Cmt</span>
                            <span class="font-semibold text-white tabular-nums">09:00 - 18:00</span>
                        </div>
                        <div class="flex items-center justify-between gap-2">
                            <span class="font-light text-ink-200/75">Pazar</span>
                            <span class="font-semibold text-brand-400">Kapalı</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Premium ayırıcı şerit (alt satıra geçmeden hemen önce) --}}
    <div class="relative">
        <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
    </div>

    {{-- Copyright bar --}}
    <div class="relative">
        <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-6 flex flex-col md:flex-row items-center justify-between gap-3 text-xs text-ink-200/65 font-light">
            <p>© {{ date('Y') }} Op. Dr. Yücel Polat — Tüm hakları saklıdır.</p>
            <div class="flex items-center gap-4">
                <a href="{{ route('sitemap.html') }}" class="inline-flex items-center gap-1.5 hover:text-white transition-colors">
                    <i class="fas fa-sitemap text-[10px] text-leaf-500"></i>
                    Site Haritası
                </a>
                <span class="text-ink-200/30">·</span>
                <p class="flex items-center gap-1.5">
                    <span>Code with</span>
                    <a href="https://mezbilisim.com" target="_blank" rel="noopener"
                       class="font-semibold text-white hover:text-brand-400 transition-colors">
                        MEZ
                    </a>
                </p>
            </div>
        </div>
    </div>
</footer>
