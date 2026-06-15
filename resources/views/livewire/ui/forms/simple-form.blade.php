@php
    $errText = 'text-[12px] text-brand-600 font-light';
    $label   = 'block text-[10.5px] font-medium tracking-[0.20em] uppercase text-ink-400';
    $req     = '<span class="text-brand-500 font-bold ml-0.5">*</span>';
    $optTag  = '<span class="text-ink-300 font-normal text-[9.5px] tracking-normal lowercase ml-1">(opsiyonel)</span>';
@endphp

<div class="space-y-6 relative">
    <form wire:submit.prevent="submit" class="space-y-5">

        {{-- HEADING --}}
        <div class="space-y-1.5">
            <p class="text-[11px] tracking-[0.22em] uppercase text-brand-600">{{ __('form.kicker') }}</p>
            <h3 class="text-[22px] sm:text-[24px] font-light leading-snug text-ink-900">{{ __('form.title') }}</h3>
            <p class="text-[13.5px] font-light text-ink-500 leading-relaxed">{{ __('form.subtitle') }}</p>
        </div>

        {{-- Honeypot --}}
        <input type="text" wire:model="website" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">

        {{-- SUCCESS --}}
        @if($success)
            <div class="rounded-xl border border-emerald-200 bg-emerald-50/60 px-4 py-3">
                <div class="flex items-start gap-3">
                    <span class="mt-1 inline-block h-2 w-2 rounded-full bg-emerald-500 shadow-[0_0_0_3px_rgba(16,185,129,0.18)]"></span>
                    <div class="min-w-0">
                        <p class="text-[11px] uppercase tracking-[0.22em] text-emerald-700">{{ __('form.success.kicker') }}</p>
                        <p class="mt-1 text-[13px] text-ink-700 font-light leading-relaxed">{{ __('form.success.body') }}</p>
                    </div>
                    <button type="button" wire:click="$set('success', false)" class="ml-auto inline-flex h-8 w-8 items-center justify-center rounded-full text-ink-400 hover:text-ink-900 hover:bg-white transition">×</button>
                </div>
            </div>
        @endif

        {{-- FAIL --}}
        @if($submitFailed)
            <div class="rounded-xl border border-brand-200 bg-brand-50/60 px-4 py-3">
                <div class="flex items-start gap-3">
                    <span class="mt-1 inline-block h-2 w-2 rounded-full bg-brand-500 shadow-[0_0_0_3px_rgba(224,70,58,0.18)]"></span>
                    <div class="min-w-0">
                        <p class="text-[11px] uppercase tracking-[0.22em] text-brand-700">{{ __('form.failed.kicker') }}</p>
                        <p class="mt-1 text-[13px] text-ink-700 font-light leading-relaxed">{{ __('form.failed.body') }}</p>
                    </div>
                    <button type="button" wire:click="$set('submitFailed', false)" class="ml-auto inline-flex h-8 w-8 items-center justify-center rounded-full text-ink-400 hover:text-ink-900 hover:bg-white transition">×</button>
                </div>
            </div>
        @endif

        {{-- Name + İlgilendiğiniz Tedavi (custom styled select) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label class="{{ $label }}">{{ __('form.fields.name') }} {!! $req !!}</label>
                <x-input type="text" wire:model.live="name" autocomplete="name" :placeholder="__('form.placeholders.name')" />
                @error('name') <p class="{{ $errText }}">{{ $message }}</p> @enderror
            </div>

            @php
                $treatments = config('treatments', []);
                $treatmentLabels = collect($treatments)
                    ->pluck('title', 'slug')
                    ->put('diger', __('form.treatment_other'))
                    ->all();
            @endphp

            <div class="space-y-1.5">
                <label class="{{ $label }}">{{ __('form.fields.treatment') }} {!! $req !!}</label>
                <div class="relative"
                     x-data="{
                        open: false,
                        labels: @js($treatmentLabels),
                        selected: @entangle('treatment').live,
                        get currentLabel() {
                            return this.selected && this.labels[this.selected]
                                ? this.labels[this.selected]
                                : '{{ __('form.placeholders.treatment') }}';
                        }
                     }"
                     @click.outside="open = false"
                     @keydown.escape.window="open = false">

                    {{-- Button (tetik) — sade, halo yok --}}
                    <button type="button" @click="open = !open"
                            :class="open ? 'border-deep-500 ring-2 ring-deep-100' : 'border-ink-200 hover:border-ink-300'"
                            class="w-full flex items-center justify-between gap-2 rounded-lg border bg-white px-3.5 py-2.5 text-[14px] text-left transition cursor-pointer">
                        <span :class="selected ? 'text-ink-900' : 'text-ink-400'" x-text="currentLabel" class="truncate"></span>
                        <i class="fas fa-chevron-down text-[10px] text-ink-400 transition-transform shrink-0"
                           :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    {{-- Dropdown listesi — her seçeneğin başında küçük halo --}}
                    <div x-show="open" x-transition.opacity.duration.150ms
                         x-cloak style="display:none"
                         class="absolute left-0 right-0 top-full mt-2 z-50
                                bg-white border border-ink-100 rounded-xl shadow-[0_12px_32px_rgba(15,61,90,0.15)]
                                max-h-[280px] overflow-y-auto py-1.5">
                        <template x-for="(label, slug) in labels" :key="slug">
                            <button type="button"
                                    @click="selected = slug; open = false"
                                    :class="selected === slug ? 'bg-deep-50 text-deep-700 font-semibold' : 'text-ink-700 hover:bg-ink-50'"
                                    class="w-full text-left px-3 py-2 text-[13px] cursor-pointer flex items-center gap-2.5 transition-colors">

                                {{-- Mini iç-içe halo (dış şeffaf yeşil + iç solid yeşil) --}}
                                <span class="relative inline-flex items-center justify-center w-2.5 h-2.5 shrink-0">
                                    <span class="absolute inset-0 rounded-full bg-leaf-500/25"></span>
                                    <span class="relative w-1 h-1 rounded-full bg-leaf-500"></span>
                                </span>

                                <span x-text="label" class="flex-1 truncate"></span>
                                <i x-show="selected === slug" class="fas fa-check text-[10px] text-deep-500 shrink-0"></i>
                            </button>
                        </template>
                    </div>
                </div>
                @error('treatment') <p class="{{ $errText }}">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Phone + Email --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label class="{{ $label }}">{{ __('form.fields.phone') }} {!! $req !!}</label>
                @php($phoneId = 'phone-'.$this->getId())
                <div wire:ignore class="relative phone-iti" data-iti>
                    <x-input
                        id="{{ $phoneId }}"
                        type="tel"
                        autocomplete="tel"
                        :placeholder="__('form.placeholders.phone')"
                    />
                </div>
                <input type="hidden" id="{{ $phoneId }}_hidden" wire:model.live="phone">
                @error('phone') <p class="{{ $errText }}">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="{{ $label }}">{{ __('form.fields.email') }} {!! $optTag !!}</label>
                <x-input type="email" wire:model.live="email" autocomplete="email" :placeholder="__('form.placeholders.email')" />
                @error('email') <p class="{{ $errText }}">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Message --}}
        <div class="space-y-1.5">
            <label class="{{ $label }}">{{ __('form.fields.message') }}</label>
            <x-textarea rows="2" wire:model.live="message" :placeholder="__('form.placeholders.message')" />
            @error('message') <p class="{{ $errText }}">{{ $message }}</p> @enderror
        </div>

        {{-- Submit --}}
        <div class="pt-1">
            <x-button type="submit" variant="primary" size="lg" wire:loading.attr="disabled" class="w-full sm:w-auto">
                <span wire:loading.remove wire:target="submit">{{ __('form.cta.submit') }}</span>
                <span wire:loading wire:target="submit">{{ __('form.cta.submitting') }}</span>
                <i wire:loading.remove wire:target="submit" class="fa-solid fa-paper-plane ml-2 text-[11px]"></i>
            </x-button>

        </div>
    </form>

    @include('livewire.ui.forms.iti-code')
</div>
