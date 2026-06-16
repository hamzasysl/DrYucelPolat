@php
    $errText  = 'text-[11.5px] text-brand-600 font-light mt-1.5';
    // Letter-spacing yok, Title Case, ince, input'a yakın
    $label    = 'block text-[12px] font-medium text-ink-500 mb-1';
    // İnce, kompakt input — height bir tık düşük
    $inputCls = 'w-full rounded-md border border-ink-200 bg-white px-3 py-2 text-[13.5px] text-ink-900 placeholder:text-ink-400 placeholder:font-light outline-none transition focus:border-brand-400 focus:ring-2 focus:ring-brand-100';
    // Zorunlu alan yıldızı
    $req = '<span class="text-brand-500 font-bold">*</span>';
@endphp

<div class="relative">
    <form wire:submit.prevent="submit" class="space-y-4">

        {{-- HEADING — yeşil çizgi + pembe kicker + büyük başlık (sayfa stiliyle uyumlu) --}}
        <div class="mb-5">
            <div class="inline-flex items-center gap-3 mb-3">
                <span class="h-px w-6 bg-gradient-to-r from-transparent to-leaf-500"></span>
                <p class="text-brand-500 font-bold text-[10px] tracking-[0.24em] uppercase">Randevu Talebi</p>
            </div>
            <h3 class="font-display text-[26px] font-bold text-deep-700 leading-tight tracking-tight mb-2">İletişime Geçin!</h3>
            <p class="text-[14px] font-light text-ink-500 leading-snug">Size en kısa sürede dönüş yapalım.</p>
        </div>

        {{-- Honeypot --}}
        <input type="text" wire:model="website" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">

        {{-- SUCCESS --}}
        @if ($success)
            <div class="rounded-md border border-emerald-200 bg-emerald-50/60 px-3 py-2">
                <p class="text-[12px] text-emerald-700 font-medium leading-snug">
                    Talebiniz alındı. En kısa sürede sizinle iletişime geçeceğiz.
                </p>
            </div>
        @endif

        {{-- FAIL --}}
        @if ($submitFailed)
            <div class="rounded-md border border-brand-200 bg-brand-50/60 px-3 py-2">
                <p class="text-[12px] text-brand-700 leading-snug">
                    Gönderilemedi. Lütfen biraz sonra tekrar deneyin.
                </p>
            </div>
        @endif

        {{-- Ad Soyad --}}
        <div>
            <label class="{{ $label }}">Ad Soyad {!! $req !!}</label>
            <input type="text" wire:model.live="name" autocomplete="name" placeholder="Adınız ve soyadınız" class="{{ $inputCls }}" required>
            @error('name') <p class="{{ $errText }}">{{ $message }}</p> @enderror
        </div>

        {{-- Telefon --}}
        <div>
            <label class="{{ $label }}">Telefon {!! $req !!}</label>
            @php($phoneId = 'svcphone-'.$this->getId())
            <div wire:ignore class="relative phone-iti" data-iti>
                <input id="{{ $phoneId }}" type="tel" autocomplete="tel" placeholder="+90 ..." class="{{ $inputCls }}" required>
            </div>
            <input type="hidden" id="{{ $phoneId }}_hidden" wire:model.live="phone">
            @error('phone') <p class="{{ $errText }}">{{ $message }}</p> @enderror
        </div>

        {{-- E-posta (opsiyonel) --}}
        <div>
            <label class="{{ $label }}">E-posta <span class="text-ink-300 font-normal text-[10.5px]">(opsiyonel)</span></label>
            <input type="email" wire:model.live="email" autocomplete="email" placeholder="ornek@mail.com" class="{{ $inputCls }}">
            @error('email') <p class="{{ $errText }}">{{ $message }}</p> @enderror
        </div>

        {{-- Submit — pembe, içerik kadar, kompakt height --}}
        <div class="pt-2">
            <button type="submit"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center gap-2 bg-brand-500 hover:bg-brand-600 text-white px-5 py-2.5 text-[12.5px] font-semibold rounded-lg shadow-[0_6px_16px_color-mix(in_srgb,var(--color-brand-500)_22%,transparent)] hover:shadow-[0_8px_20px_color-mix(in_srgb,var(--color-brand-500)_30%,transparent)] transition-all disabled:opacity-60 disabled:cursor-not-allowed">
                <span wire:loading.remove wire:target="submit">İletişime Geç</span>
                <span wire:loading wire:target="submit">Gönderiliyor...</span>
                <i wire:loading.remove wire:target="submit" class="fas fa-arrow-right text-[10px]"></i>
            </button>
        </div>
    </form>

    @include('livewire.ui.forms.iti-code')
</div>
