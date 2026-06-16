@php
    $formMenu = $formMenu ?? new \App\Models\Menu();
    $isUpdate = $formMenu->exists;
    $action   = $isUpdate ? route('admin.menus.update', $formMenu) : route('admin.menus.store');
    $popularIcons = [
        'fa-house','fa-user-doctor','fa-stethoscope','fa-newspaper','fa-envelope',
        'fa-phone','fa-syringe','fa-bolt-lightning','fa-heart-pulse','fa-band-aid',
        'fa-hand-holding-droplet','fa-venus','fa-magnifying-glass','fa-circle-info',
        'fa-bars','fa-th-large','fa-arrow-right','fa-arrow-up-right-from-square',
        'fab fa-instagram','fab fa-facebook-f','fab fa-youtube','fab fa-whatsapp','fab fa-linkedin','fab fa-x-twitter',
    ];
@endphp

<form method="POST" action="{{ $action }}" id="menu-inline-form"
      class="bg-deep-50/40 border border-deep-200/60 rounded-xl p-5 space-y-4"
      x-data="{
          parentId: @js((string) old('parent_id', $formMenu->parent_id ?? '')),
          icon: '{{ old('icon', $formMenu->icon) }}',
          pageSelection: @js(old('route_name', $formMenu->route_name) ? 'route:' . old('route_name', $formMenu->route_name) : (old('url', $formMenu->url) ? 'url:' . old('url', $formMenu->url) : '')),
          customMode: false,
          routeName: @js(old('route_name', $formMenu->route_name)),
          url: @js(old('url', $formMenu->url)),
          handleSelection(val) {
              if (val === 'custom') { this.customMode = true; this.routeName = ''; this.url = ''; return; }
              if (val.startsWith('route:')) { this.routeName = val.substring(6); this.url = ''; this.customMode = false; return; }
              if (val.startsWith('url:')) { this.url = val.substring(4); this.routeName = ''; this.customMode = false; return; }
              this.routeName = ''; this.url = ''; this.customMode = false;
          }
      }">
    @csrf
    @if ($isUpdate) @method('PUT') @endif

    {{-- Header --}}
    <div class="flex items-center gap-3 pb-3 border-b border-deep-200/60">
        <span class="w-9 h-9 rounded-lg bg-gradient-to-br from-deep-500 to-deep-700 text-white inline-flex items-center justify-center text-[13px]">
            <i class="fas {{ $isUpdate ? 'fa-pen' : 'fa-plus' }}"></i>
        </span>
        <div class="flex-1">
            <h3 class="font-display text-[14px] font-bold text-deep-700">
                {{ $isUpdate ? 'Düzenle — ' . $formMenu->label : 'Yeni Menü Öğesi' }}
            </h3>
            <p class="text-[11px] text-ink-400">{{ ucfirst($formMenu->location ?? 'header') }} menüsü</p>
        </div>
        <a href="{{ route('admin.menus.index', ['location' => $formMenu->location ?? 'header']) }}"
           class="w-8 h-8 rounded-md hover:bg-white inline-flex items-center justify-center text-ink-500 hover:text-deep-700 transition-colors" title="Kapat">
            <i class="fas fa-xmark text-[13px]"></i>
        </a>
    </div>

    @if ($errors->any())
        <div class="rounded-lg bg-brand-50 border border-brand-200 px-4 py-3">
            <ul class="text-[12.5px] text-brand-700 list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $err)<li>{{ $err }}</li>@endforeach
            </ul>
        </div>
    @endif

    <input type="hidden" name="location" value="{{ $formMenu->location }}">

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="sm:col-span-2">
            <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">Etiket <span class="text-brand-500">*</span></label>
            <input type="text" name="label" value="{{ old('label', $formMenu->label) }}" required autofocus
                   class="w-full px-3 py-2.5 rounded-lg border border-ink-200 bg-white text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none">
        </div>

        <div>
            <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">Üst Menü</label>
            <select name="parent_id" x-model="parentId" class="w-full px-3 py-2.5 rounded-lg border border-ink-200 bg-white text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none">
                <option value="">— Kök menü —</option>
                @foreach ($parents as $p)
                    @if ($p->id !== $formMenu->id)
                        <option value="{{ $p->id }}">{{ $p->label }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">Sıra</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $formMenu->sort_order ?? 0) }}" min="0"
                   class="w-full px-3 py-2.5 rounded-lg border border-ink-200 bg-white text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none font-mono">
        </div>

        <div class="sm:col-span-2">
            <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">Hangi Sayfaya Gitsin? <span class="text-brand-500">*</span></label>
            <select x-model="pageSelection" @change="handleSelection($event.target.value)"
                    class="w-full px-3 py-2.5 rounded-lg border border-ink-200 bg-white text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none">
                <option value="">— Sayfa seçin —</option>
                @php $grouped = collect($pageOptions)->groupBy('group'); @endphp
                @foreach ($grouped as $groupName => $items2)
                    <optgroup label="{{ $groupName }}">
                        @foreach ($items2 as $opt)
                            <option value="{{ $opt['value'] }}">{{ $opt['label'] }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            <input type="hidden" name="route_name" :value="routeName">
            <input type="hidden" name="url"        :value="url">

            <div x-show="customMode" x-cloak class="mt-3">
                <input type="text" x-model="url" placeholder="Özel URL: https://… veya /yol"
                       class="w-full px-3 py-2.5 rounded-lg border border-ink-200 bg-white text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none font-mono">
            </div>

            <p class="text-[11px] text-ink-400 mt-1.5 font-mono">
                <span x-show="routeName" x-cloak>→ route: <span x-text="routeName" class="text-deep-500"></span></span>
                <span x-show="url && !routeName" x-cloak>→ <span x-text="url" class="text-deep-500"></span></span>
            </p>
        </div>

        {{-- İkon picker — sadece alt menülerde --}}
        <div class="sm:col-span-2" x-show="parentId" x-cloak>
            <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">İkon <span class="text-ink-300 normal-case tracking-normal font-normal">(sadece alt menülerde görünür)</span></label>
            <div class="flex items-center gap-3 mb-3">
                <span class="w-11 h-11 rounded-lg bg-white border border-ink-100 text-deep-500 inline-flex items-center justify-center text-[16px] shrink-0">
                    <i :class="'fas ' + icon" x-show="icon && !icon.startsWith('fab')"></i>
                    <i :class="icon" x-show="icon && icon.startsWith('fab')"></i>
                    <i class="fas fa-question text-ink-300" x-show="!icon"></i>
                </span>
                <input type="text" name="icon" x-model="icon" placeholder="fa-house veya fab fa-instagram"
                       class="flex-1 px-3 py-2.5 rounded-lg border border-ink-200 bg-white text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none font-mono">
            </div>
            <div class="grid grid-cols-8 sm:grid-cols-12 gap-1.5">
                @foreach ($popularIcons as $iconClass)
                    @php $faPrefix = str_starts_with($iconClass, 'fab ') ? '' : 'fas '; @endphp
                    <button type="button" @click="icon = '{{ $iconClass }}'"
                            :class="icon === '{{ $iconClass }}' ? 'bg-deep-100 text-deep-700 ring-2 ring-deep-500' : 'bg-white text-ink-600 hover:bg-ink-100'"
                            class="w-9 h-9 rounded-md inline-flex items-center justify-center text-[12px] transition">
                        <i class="{{ $faPrefix . $iconClass }}"></i>
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Bayraklar --}}
        <div class="sm:col-span-2 flex flex-wrap items-center gap-5 pt-1">
            <label class="inline-flex items-center gap-2 cursor-pointer">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $formMenu->is_active ?? 1) ? 'checked' : '' }} class="rounded border-ink-300 text-deep-500">
                <span class="text-[13px] text-ink-700">Aktif</span>
            </label>
            <label class="inline-flex items-center gap-2 cursor-pointer">
                <input type="hidden" name="is_dropdown" value="0">
                <input type="checkbox" name="is_dropdown" value="1" {{ old('is_dropdown', $formMenu->is_dropdown ?? 0) ? 'checked' : '' }} class="rounded border-ink-300 text-deep-500">
                <span class="text-[13px] text-ink-700">Dropdown</span>
            </label>
            <label class="inline-flex items-center gap-2 cursor-pointer">
                <span class="text-[12px] text-ink-500">Açılış:</span>
                <select name="target" class="text-[12.5px] px-2 py-1 rounded border border-ink-200 bg-white">
                    <option value="_self"  @selected(old('target', $formMenu->target) === '_self')>Aynı sekme</option>
                    <option value="_blank" @selected(old('target', $formMenu->target) === '_blank')>Yeni sekme</option>
                </select>
            </label>
        </div>
    </div>

    <div class="pt-3 border-t border-deep-200/60 flex items-center gap-3">
        <button type="submit" class="inline-flex items-center gap-2 bg-deep-700 hover:bg-deep-800 text-white font-semibold text-[13px] px-5 py-2.5 rounded-lg transition-colors shadow-[0_4px_10px_color-mix(in_srgb,var(--color-deep-700)_25%,transparent)]">
            <i class="fas fa-floppy-disk text-[11px]"></i>
            {{ $isUpdate ? 'Güncelle' : 'Ekle' }}
        </button>
        <a href="{{ route('admin.menus.index', ['location' => $formMenu->location ?? 'header']) }}" class="text-[12.5px] text-ink-500 hover:text-deep-600">İptal</a>
    </div>
</form>
