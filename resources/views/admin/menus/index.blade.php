@extends('admin.layouts.app')

@section('title', 'Menüler')
@section('subtitle', 'Header / Footer / Mobil menü öğeleri')

@section('content')

@php
    $locations = [
        'header' => 'Header',
        'footer' => 'Footer',
        'mobile' => 'Mobil',
    ];
@endphp

<div class="flex items-center justify-between mb-5">
    <div class="inline-flex bg-white rounded-lg border border-ink-100 p-1 shadow-[0_2px_8px_color-mix(in_srgb,var(--color-deep-700)_4%,transparent)]">
        @foreach ($locations as $key => $label)
            <a href="{{ route('admin.menus.index', ['location' => $key]) }}"
               class="px-4 py-1.5 rounded-md text-[12.5px] font-semibold transition-colors
                      {{ $location === $key ? 'bg-deep-700 text-white' : 'text-ink-600 hover:text-deep-700' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
    <a href="{{ route('admin.menus.index', ['location' => $location, 'create' => 1]) }}#menu-inline-form"
       class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white text-[12.5px] font-semibold px-3.5 py-2 rounded-lg shadow-[0_4px_10px_color-mix(in_srgb,var(--color-brand-500)_30%,transparent)] transition-all">
        <i class="fas fa-plus text-[11px]"></i>
        Yeni Menü Öğesi
    </a>
</div>

{{-- Üst inline form: kök menü yeni öğesi --}}
@if ($newMenu && ! $parentId)
    <div class="mb-5">
        @include('admin.menus._inline_form', ['formMenu' => $newMenu])
    </div>
@endif

<div class="bg-white rounded-xl border border-ink-100 overflow-hidden">
    @if ($rootItems->isEmpty())
        <div class="p-10 text-center">
            <p class="text-[13px] text-ink-400">Bu lokasyonda menü öğesi yok.</p>
        </div>
    @else
        <ul class="divide-y divide-ink-100">
            @foreach ($rootItems as $item)
                @php $children = $items->where('parent_id', $item->id); @endphp
                <li>
                    <div class="flex items-center gap-3 px-5 py-3.5 hover:bg-ink-50/50">
                        <i class="fas fa-grip-vertical text-ink-300 text-[12px] cursor-move"></i>
                        @if ($item->icon)
                            @php $iconPrefix = str_starts_with($item->icon, 'fab ') ? '' : 'fas '; @endphp
                            <span class="w-8 h-8 rounded-md bg-deep-50 text-deep-500 inline-flex items-center justify-center">
                                <i class="{{ $iconPrefix . $item->icon }} text-[11px]"></i>
                            </span>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-deep-700 text-[14px]">{{ $item->label }}</p>
                            <p class="text-[11.5px] text-ink-400 font-mono truncate">
                                {{ $item->route_name ? "route: {$item->route_name}" : $item->url }}
                            </p>
                        </div>
                        @if ($item->is_dropdown)
                            <span class="text-[9.5px] font-bold text-deep-600 bg-deep-50 px-2 py-0.5 rounded uppercase tracking-[0.14em]">Dropdown</span>
                        @endif
                        <span class="inline-flex items-center gap-1.5 text-[11px] {{ $item->is_active ? 'text-leaf-600' : 'text-ink-400' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $item->is_active ? 'bg-leaf-500' : 'bg-ink-300' }}"></span>
                            {{ $item->is_active ? 'Aktif' : 'Pasif' }}
                        </span>
                        <span class="text-[11px] text-ink-400 font-mono">#{{ $item->sort_order }}</span>
                        @php $isEditingThis = $editingMenu && $editingMenu->id === $item->id; @endphp
                        <a href="{{ $isEditingThis ? route('admin.menus.index', ['location' => $location]) : route('admin.menus.index', ['location' => $location, 'edit' => $item->id]) }}#menu-inline-form"
                           class="w-8 h-8 rounded-md hover:bg-ink-100 inline-flex items-center justify-center transition-colors {{ $isEditingThis ? 'bg-deep-100 text-deep-700' : 'text-ink-600 hover:text-deep-600' }}" title="Düzenle">
                            <i class="fas {{ $isEditingThis ? 'fa-xmark' : 'fa-pen' }} text-[11px]"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.menus.destroy', $item) }}" class="inline" onsubmit="return confirm('Silmek istediğine emin misin? Alt menüler de silinir.')">
                            @csrf @method('DELETE')
                            <button class="w-8 h-8 rounded-md hover:bg-brand-50 inline-flex items-center justify-center text-ink-500 hover:text-brand-600 transition-colors" title="Sil">
                                <i class="fas fa-trash text-[11px]"></i>
                            </button>
                        </form>
                    </div>

                    {{-- Bu root satırı için inline edit form --}}
                    @if ($editingMenu && $editingMenu->id === $item->id)
                        <div class="border-t border-ink-100 p-4 bg-deep-50/20">
                            @include('admin.menus._inline_form', ['formMenu' => $editingMenu])
                        </div>
                    @endif

                    {{-- Bu root'un altına yeni alt menü ekleme form'u --}}
                    @if ($newMenu && $parentId == $item->id)
                        <div class="border-t border-ink-100 p-4 bg-deep-50/20">
                            @include('admin.menus._inline_form', ['formMenu' => $newMenu])
                        </div>
                    @endif
                    @if ($item->is_dropdown)
                        <ul class="border-t border-ink-100 bg-ink-50/40 divide-y divide-ink-100">
                            @foreach ($children as $child)
                                @php $cIconPrefix = $child->icon && str_starts_with($child->icon, 'fab ') ? '' : 'fas '; @endphp
                                <li class="flex items-center gap-3 px-5 py-2.5 pl-14 group hover:bg-white/60">
                                    <i class="fas fa-grip-vertical text-ink-200 text-[11px] cursor-move"></i>
                                    @if ($child->icon)
                                        <span class="w-7 h-7 rounded-md bg-white border border-ink-100 text-deep-500 inline-flex items-center justify-center shrink-0">
                                            <i class="{{ $cIconPrefix . $child->icon }} text-[10.5px]"></i>
                                        </span>
                                    @else
                                        <span class="w-7 h-7 rounded-md bg-white border border-ink-100 text-ink-300 inline-flex items-center justify-center shrink-0">
                                            <i class="fas fa-arrow-turn-down-right text-[9px]"></i>
                                        </span>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <p class="text-[13px] font-medium text-ink-800 leading-tight">{{ $child->label }}</p>
                                        <p class="text-[10.5px] text-ink-400 font-mono truncate">
                                            {{ $child->route_name ? "route: {$child->route_name}" : ($child->url ?: '—') }}
                                        </p>
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 text-[10.5px] {{ $child->is_active ? 'text-leaf-600' : 'text-ink-400' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $child->is_active ? 'bg-leaf-500' : 'bg-ink-300' }}"></span>
                                        {{ $child->is_active ? 'Aktif' : 'Pasif' }}
                                    </span>
                                    <span class="text-[10.5px] text-ink-400 font-mono">#{{ $child->sort_order }}</span>
                                    @php $isEditingChild = $editingMenu && $editingMenu->id === $child->id; @endphp
                                    <a href="{{ $isEditingChild ? route('admin.menus.index', ['location' => $location]) : route('admin.menus.index', ['location' => $location, 'edit' => $child->id]) }}#menu-inline-form"
                                       class="w-7 h-7 rounded-md hover:bg-white inline-flex items-center justify-center transition-colors {{ $isEditingChild ? 'bg-deep-100 text-deep-700' : 'text-ink-500 hover:text-deep-600' }}" title="Düzenle">
                                        <i class="fas {{ $isEditingChild ? 'fa-xmark' : 'fa-pen' }} text-[10px]"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.menus.destroy', $child) }}" class="inline" onsubmit="return confirm('Bu alt menüyü sil?')">
                                        @csrf @method('DELETE')
                                        <button class="w-7 h-7 rounded-md hover:bg-brand-50 inline-flex items-center justify-center text-ink-400 hover:text-brand-600 transition-colors" title="Sil">
                                            <i class="fas fa-trash text-[10px]"></i>
                                        </button>
                                    </form>
                                </li>
                                {{-- Bu alt menü için inline edit form --}}
                                @if ($editingMenu && $editingMenu->id === $child->id)
                                    <li class="px-5 py-3 pl-14 bg-white">
                                        @include('admin.menus._inline_form', ['formMenu' => $editingMenu])
                                    </li>
                                @endif
                            @endforeach
                            <li class="px-5 py-2.5 pl-14">
                                <a href="{{ route('admin.menus.index', ['location' => $location, 'create' => 1, 'parent' => $item->id]) }}#menu-inline-form"
                                   class="inline-flex items-center gap-2 text-[12px] font-semibold text-deep-500 hover:text-brand-500 transition-colors">
                                    <span class="w-5 h-5 rounded-md bg-deep-50 inline-flex items-center justify-center">
                                        <i class="fas fa-plus text-[9px]"></i>
                                    </span>
                                    {{ $item->label }} altına yeni alt menü ekle
                                </a>
                            </li>
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>

@endsection
