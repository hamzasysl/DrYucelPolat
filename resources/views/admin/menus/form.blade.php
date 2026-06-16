@extends('admin.layouts.app')

@section('title', $menu->exists ? 'Menü Öğesi Düzenle' : 'Yeni Menü Öğesi')

@section('content')

@php
    $popularIcons = [
        'fa-house','fa-user-doctor','fa-stethoscope','fa-newspaper','fa-envelope',
        'fa-phone','fa-syringe','fa-bolt-lightning','fa-heart-pulse','fa-band-aid',
        'fa-hand-holding-droplet','fa-venus','fa-magnifying-glass','fa-circle-info',
        'fa-bars','fa-th-large','fa-arrow-right','fa-arrow-up-right-from-square',
        'fab fa-instagram','fab fa-facebook-f','fab fa-youtube','fab fa-whatsapp','fab fa-linkedin','fab fa-x-twitter',
    ];
@endphp

<form method="POST" action="{{ $menu->exists ? route('admin.menus.update', $menu) : route('admin.menus.store') }}"
      class="max-w-2xl bg-white rounded-xl border border-ink-100 p-6 space-y-5 shadow-[0_2px_8px_color-mix(in_srgb,var(--color-deep-700)_4%,transparent)]"
      x-data="{
          parentId: @js((string) old('parent_id', $menu->parent_id ?? '')),
          icon: '{{ old('icon', $menu->icon) }}',
          pageSelection: @js(old('route_name', $menu->route_name) ? 'route:' . old('route_name', $menu->route_name) : (old('url', $menu->url) ? 'url:' . old('url', $menu->url) : '')),
          customMode: false,
          routeName: @js(old('route_name', $menu->route_name)),
          url: @js(old('url', $menu->url)),
          handleSelection(val) {
              if (val === 'custom') { this.customMode = true; this.routeName = ''; this.url = ''; return; }
              if (val.startsWith('route:')) { this.routeName = val.substring(6); this.url = ''; this.customMode = false; return; }
              if (val.startsWith('url:')) { this.url = val.substring(4); this.routeName = ''; this.customMode = false; return; }
              this.routeName = ''; this.url = ''; this.customMode = false;
          }
      }">
    @csrf
    @if ($menu->exists) @method('PUT') @endif

    @if ($errors->any())
        <div class="rounded-lg bg-brand-50 border border-brand-200 px-4 py-3">
            <ul class="text-[12.5px] text-brand-700 list-disc list-inside">
                @foreach ($errors->all() as $err)<li>{{ $err }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">Lokasyon</label>
            <select name="location" class="w-full px-3 py-2.5 rounded-lg border border-ink-200 text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none">
                <option value="header" @selected(old('location', $menu->location) === 'header')>Header</option>
                <option value="footer" @selected(old('location', $menu->location) === 'footer')>Footer</option>
                <option value="mobile" @selected(old('location', $menu->location) === 'mobile')>Mobil</option>
            </select>
        </div>
        <div>
            <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">Üst Menü</label>
            <select name="parent_id" x-model="parentId" class="w-full px-3 py-2.5 rounded-lg border border-ink-200 text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none">
                <option value="">— Kök menü —</option>
                @foreach ($parents as $p)
                    <option value="{{ $p->id }}">{{ $p->label }}</option>
                @endforeach
            </select>
        </div>
        <div class="sm:col-span-2">
            <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">Etiket <span class="text-brand-500">*</span></label>
            <input type="text" name="label" value="{{ old('label', $menu->label) }}" required
                   class="w-full px-3 py-2.5 rounded-lg border border-ink-200 text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none">
        </div>
        <div class="sm:col-span-2">
            <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">Hangi Sayfaya Gitsin? <span class="text-brand-500">*</span></label>
            <select x-model="pageSelection" @change="handleSelection($event.target.value)"
                    class="w-full px-3 py-2.5 rounded-lg border border-ink-200 text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none">
                <option value="">— Sayfa seçin —</option>
                @php $grouped = collect($pageOptions)->groupBy('group'); @endphp
                @foreach ($grouped as $groupName => $items)
                    <optgroup label="{{ $groupName }}">
                        @foreach ($items as $opt)
                            <option value="{{ $opt['value'] }}">{{ $opt['label'] }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            {{-- Hidden inputs — gerçek kayıt buraya gider --}}
            <input type="hidden" name="route_name" :value="routeName">
            <input type="hidden" name="url"        :value="url">

            {{-- Custom URL gir --}}
            <div x-show="customMode" x-cloak class="mt-3">
                <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-1.5">Özel URL</label>
                <input type="text" x-model="url" placeholder="https://… veya /yol"
                       class="w-full px-3 py-2.5 rounded-lg border border-ink-200 text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none font-mono">
            </div>

            {{-- Mevcut seçim önizleme --}}
            <p class="text-[11px] text-ink-400 mt-1.5 font-mono">
                <span x-show="routeName" x-cloak>→ route: <span x-text="routeName" class="text-deep-500"></span></span>
                <span x-show="url && !routeName" x-cloak>→ <span x-text="url" class="text-deep-500"></span></span>
            </p>
        </div>
        <div class="sm:col-span-2" x-show="parentId" x-cloak>
            <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">İkon <span class="text-ink-300 normal-case tracking-normal font-normal">(sadece alt menülerde görünür)</span></label>
            <div class="flex items-center gap-3 mb-3">
                <span class="w-11 h-11 rounded-lg bg-deep-50 text-deep-500 inline-flex items-center justify-center text-[16px] shrink-0">
                    <i :class="'fas ' + icon" x-show="icon && !icon.startsWith('fab')"></i>
                    <i :class="icon" x-show="icon && icon.startsWith('fab')"></i>
                    <i class="fas fa-question text-ink-300" x-show="!icon"></i>
                </span>
                <input type="text" name="icon" x-model="icon" placeholder="fa-house veya fab fa-instagram"
                       class="flex-1 px-3 py-2.5 rounded-lg border border-ink-200 text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none font-mono">
            </div>
            <div class="grid grid-cols-8 sm:grid-cols-12 gap-1.5">
                @foreach ($popularIcons as $iconClass)
                    @php $faPrefix = str_starts_with($iconClass, 'fab ') ? '' : 'fas '; @endphp
                    <button type="button" @click="icon = '{{ $iconClass }}'"
                            :class="icon === '{{ $iconClass }}' ? 'bg-deep-100 text-deep-700 ring-2 ring-deep-500' : 'bg-ink-50 text-ink-600 hover:bg-ink-100'"
                            class="w-9 h-9 rounded-md inline-flex items-center justify-center text-[12px] transition">
                        <i class="{{ $faPrefix . $iconClass }}"></i>
                    </button>
                @endforeach
            </div>
        </div>
        <div>
            <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">Sıra</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $menu->sort_order ?? 0) }}" min="0"
                   class="w-full px-3 py-2.5 rounded-lg border border-ink-200 text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none font-mono">
        </div>
        <div>
            <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">Açılış</label>
            <select name="target" class="w-full px-3 py-2.5 rounded-lg border border-ink-200 text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none">
                <option value="_self"  @selected(old('target', $menu->target) === '_self')>Aynı sekme</option>
                <option value="_blank" @selected(old('target', $menu->target) === '_blank')>Yeni sekme</option>
            </select>
        </div>
    </div>

    <div class="flex flex-wrap gap-5 pt-2">
        <label class="inline-flex items-center gap-2 cursor-pointer">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $menu->is_active ?? 1) ? 'checked' : '' }} class="rounded border-ink-300 text-deep-500">
            <span class="text-[13px] text-ink-700">Aktif</span>
        </label>
        <label class="inline-flex items-center gap-2 cursor-pointer">
            <input type="hidden" name="is_dropdown" value="0">
            <input type="checkbox" name="is_dropdown" value="1" {{ old('is_dropdown', $menu->is_dropdown ?? 0) ? 'checked' : '' }} class="rounded border-ink-300 text-deep-500">
            <span class="text-[13px] text-ink-700">Dropdown (alt menü göster)</span>
        </label>
    </div>

    <div class="pt-3 border-t border-ink-100 flex items-center gap-3">
        <button type="submit" class="inline-flex items-center gap-2 bg-deep-700 hover:bg-deep-800 text-white font-semibold text-[13px] px-5 py-2.5 rounded-lg transition-colors">
            <i class="fas fa-floppy-disk text-[11px]"></i>
            Kaydet
        </button>
        <a href="{{ route('admin.menus.index', ['location' => $menu->location ?? 'header']) }}" class="text-[12.5px] text-ink-500 hover:text-deep-600">İptal</a>
    </div>
</form>

@endsection
