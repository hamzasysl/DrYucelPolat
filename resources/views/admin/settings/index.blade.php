@extends('admin.layouts.app')

@section('title', 'Site Ayarları')
@section('subtitle', 'Genel bilgiler, iletişim, sosyal medya ve SEO')

@section('content')

@php
    $groupLabels = [
        'general' => ['title' => 'Genel',          'icon' => 'fa-circle-info', 'color' => 'deep'],
        'contact' => ['title' => 'İletişim',       'icon' => 'fa-phone',       'color' => 'leaf'],
        'social'  => ['title' => 'Sosyal Medya',   'icon' => 'fa-share-nodes', 'color' => 'brand'],
        'seo'     => ['title' => 'SEO Varsayılan', 'icon' => 'fa-magnifying-glass', 'color' => 'deep'],
        'brand'   => ['title' => 'Renk & Marka',   'icon' => 'fa-palette',     'color' => 'sun'],
    ];
@endphp

<form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-5 max-w-4xl">
    @csrf

    @foreach ($groupLabels as $key => $meta)
        @if (!isset($settings[$key])) @continue @endif
        @php
            $cmap = [
                'deep'  => ['bg' => 'bg-deep-500/10',  'text' => 'text-deep-500'],
                'leaf'  => ['bg' => 'bg-leaf-500/15',  'text' => 'text-leaf-600'],
                'brand' => ['bg' => 'bg-brand-500/10', 'text' => 'text-brand-500'],
                'sun'   => ['bg' => 'bg-sun-500/15',   'text' => 'text-sun-500'],
            ][$meta['color']];
        @endphp
        <div class="bg-white rounded-xl border border-ink-100 overflow-hidden">
            <div class="px-5 py-4 border-b border-ink-100 flex items-center gap-3">
                <span class="w-9 h-9 rounded-lg {{ $cmap['bg'] }} {{ $cmap['text'] }} inline-flex items-center justify-center text-[13px]">
                    <i class="fas {{ $meta['icon'] }}"></i>
                </span>
                <div>
                    <h2 class="font-display text-[14.5px] font-bold text-deep-700">{{ $meta['title'] }}</h2>
                    <p class="text-[11px] text-ink-400">{{ count($settings[$key]) }} alan</p>
                </div>
            </div>
            <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($settings[$key] as $setting)
                    <div class="{{ in_array($setting->key, ['contact_address', 'site_tagline', 'seo_default_description']) ? 'md:col-span-2' : '' }}">
                        <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-1.5">{{ $setting->label ?? $setting->key }}</label>
                        @if (str_starts_with($setting->key, 'brand_color_'))
                            <div class="flex items-center gap-2"
                                 x-data="{
                                     color: '{{ $setting->value ?? '#000000' }}',
                                     normalize() {
                                         let v = (this.color || '').trim();
                                         if (!v.startsWith('#')) v = '#' + v;
                                         v = v.toLowerCase();
                                         // 7 karakter (# + 6 hex) ve geçerli hex
                                         if (/^#[0-9a-f]{6}$/.test(v)) this.color = v;
                                     }
                                 }">
                                {{-- Renk kodu input — birincil + tek "name" sahibi --}}
                                <input type="text" name="settings[{{ $setting->key }}]" x-model="color"
                                       @blur="normalize()"
                                       maxlength="7" placeholder="#000000"
                                       class="flex-1 px-3 py-2.5 rounded-lg border border-ink-200 text-[14px] font-mono uppercase focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none transition">
                                {{-- Color picker swatch — senkron, sadece görsel/seçici --}}
                                <input type="color" x-model="color"
                                       class="w-12 h-11 rounded-lg border border-ink-200 cursor-pointer shrink-0"
                                       :style="'background-color:' + color">
                            </div>
                        @elseif (in_array($setting->key, ['contact_address', 'seo_default_description', 'site_tagline']))
                            <textarea name="settings[{{ $setting->key }}]" rows="2"
                                      class="w-full px-3 py-2 rounded-lg border border-ink-200 text-[13.5px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none transition">{{ $setting->value }}</textarea>
                        @else
                            <input type="text" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}"
                                   class="w-full px-3 py-2 rounded-lg border border-ink-200 text-[13.5px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none transition {{ str_contains($setting->key, 'url') || str_contains($setting->key, 'email') ? 'font-mono' : '' }}">
                        @endif
                        <p class="text-[10.5px] text-ink-300 mt-1 font-mono">{{ $setting->key }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <div class="sticky bottom-4 bg-white rounded-xl border border-ink-100 p-4 shadow-[0_8px_24px_color-mix(in_srgb,var(--color-deep-700)_10%,transparent)] flex items-center justify-between">
        <p class="text-[12.5px] text-ink-500">Değişiklikler tüm sitede anında geçerli olur.</p>
        <button type="submit" class="inline-flex items-center gap-2 bg-deep-700 hover:bg-deep-800 text-white font-semibold text-[13px] px-5 py-2.5 rounded-lg transition-colors">
            <i class="fas fa-floppy-disk text-[11px]"></i>
            Ayarları Kaydet
        </button>
    </div>
</form>

@endsection
