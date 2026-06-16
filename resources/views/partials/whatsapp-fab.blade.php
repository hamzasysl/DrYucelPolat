{{-- ============================================================
     Sabit floating WhatsApp butonu — sol alt
     Mobil  : lacivert gradient pill (header'daki tasarım)
     Desktop: yeşil yuvarlak ikon + hafif glow pulse
     ============================================================ --}}

{{-- MOBILE: Lacivert gradient pill + pulsing mavi glow halo --}}
<a href="{{ $siteSettings['whatsapp_url'] ?? 'https://wa.me/900000000000' }}"
   target="_blank"
   rel="noopener"
   aria-label="WhatsApp ile randevu al"
   class="group lg:hidden fixed bottom-8 left-11 z-50 inline-flex items-center">

    {{-- Pulsing mavi glow halo — pill'in arkasında yumuşak nefes --}}
    <span class="absolute -inset-4 rounded-2xl bg-deep-500/45 blur-2xl animate-pulse pointer-events-none"
          style="animation-duration: 2.6s;"></span>

    {{-- Beyaz daire — WhatsApp ikon --}}
    <span class="absolute left-0 top-1/2 -translate-x-1/2 -translate-y-1/2 z-20
                 w-[52px] h-[52px] rounded-full bg-white text-deep-600
                 flex items-center justify-center
                 shadow-[0_5px_16px_color-mix(in_srgb,var(--color-deep-700)_30%,transparent)]
                 group-active:scale-95
                 transition-all duration-300 ease-out">
        <i class="fab fa-whatsapp text-[22px]"></i>
    </span>

    {{-- Lacivert gradient gövde --}}
    <span class="relative z-10 bg-gradient-to-b from-deep-700 to-deep-400
                 text-white pl-11 pr-6 py-3.5 rounded-lg
                 text-[12px] font-bold uppercase tracking-[0.18em] whitespace-nowrap
                 shadow-[0_8px_22px_color-mix(in_srgb,var(--color-deep-700)_40%,transparent)]
                 before:absolute before:inset-x-0 before:top-0 before:h-px
                 before:bg-white/25 before:rounded-t-lg">
        Online Randevu
    </span>
</a>

{{-- DESKTOP: Yeşil yuvarlak ikon, çok hafif glow pulse --}}
<a href="{{ $siteSettings['whatsapp_url'] ?? 'https://wa.me/900000000000' }}"
   target="_blank"
   rel="noopener"
   aria-label="WhatsApp ile iletişim"
   class="group hidden lg:inline-flex fixed bottom-7 left-7 z-50 items-center justify-center
          w-13 h-13 rounded-full
          bg-[#25D366] hover:bg-[#1FA950] text-white
          shadow-[0_6px_18px_rgba(31,169,80,0.30)]
          hover:shadow-[0_10px_24px_rgba(31,169,80,0.40)]
          transition-all duration-300 hover:scale-105 active:scale-95"
   style="width: 56px; height: 56px;">

    {{-- Hafif pulse ring — daha az opaklık, yavaş döngü --}}
    <span class="absolute inset-0 rounded-full bg-[#25D366] opacity-30 animate-ping pointer-events-none"
          style="animation-duration: 3.5s;"></span>

    {{-- İkon --}}
    <i class="fab fa-whatsapp text-[28px] relative z-10"></i>
</a>
