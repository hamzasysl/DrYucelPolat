@extends('admin.layouts.app')

@section('title', 'Gösterge Paneli')
@section('subtitle', 'Sitenize özet bakış')

@section('content')

<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-7">
    @foreach ([
        ['label' => 'Kullanıcı',       'value' => $stats['users'],       'icon' => 'fa-users',          'color' => 'deep'],
        ['label' => 'Blog Yazısı',     'value' => $stats['posts'],       'icon' => 'fa-newspaper',      'color' => 'leaf'],
        ['label' => 'Menü Öğesi',      'value' => $stats['menus'],       'icon' => 'fa-bars',           'color' => 'brand'],
        ['label' => 'Form Gönderimi',  'value' => $stats['submissions'], 'icon' => 'fa-paper-plane',    'color' => 'sun'],
    ] as $s)
        @php
            $cmap = [
                'deep'  => ['bg' => 'bg-deep-500/10',  'text' => 'text-deep-500'],
                'leaf'  => ['bg' => 'bg-leaf-500/15',  'text' => 'text-leaf-600'],
                'brand' => ['bg' => 'bg-brand-500/10', 'text' => 'text-brand-500'],
                'sun'   => ['bg' => 'bg-sun-500/15',   'text' => 'text-sun-500'],
            ];
            $c = $cmap[$s['color']];
        @endphp
        <div class="bg-white rounded-xl border border-ink-100 p-4 lg:p-5 shadow-[0_2px_8px_color-mix(in_srgb,var(--color-deep-700)_4%,transparent)]">
            <div class="flex items-center gap-3">
                <span class="w-11 h-11 rounded-lg {{ $c['bg'] }} {{ $c['text'] }} inline-flex items-center justify-center text-[16px] shrink-0">
                    <i class="fas {{ $s['icon'] }}"></i>
                </span>
                <div>
                    <p class="text-[10px] uppercase tracking-[0.18em] text-ink-400 font-bold leading-none mb-1">{{ $s['label'] }}</p>
                    <p class="font-display text-[22px] font-extrabold text-deep-700 leading-none tabular-nums">{{ $s['value'] }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="bg-white rounded-xl border border-ink-100 overflow-hidden">
    <div class="px-5 py-4 border-b border-ink-100 flex items-center justify-between">
        <h2 class="font-display text-[15px] font-bold text-deep-700">Son Form Gönderimleri</h2>
        <span class="text-[11px] font-bold text-ink-400 bg-ink-50 px-2.5 py-1 rounded-md tracking-[0.16em] uppercase">{{ $stats['recent_leads']->count() }}</span>
    </div>
    @if ($stats['recent_leads']->isEmpty())
        <div class="p-8 text-center">
            <p class="text-[13px] text-ink-400">Henüz form gönderimi yok.</p>
        </div>
    @else
        <div class="divide-y divide-ink-100">
            @foreach ($stats['recent_leads'] as $lead)
                <div class="flex items-center gap-4 px-5 py-3">
                    <span class="w-8 h-8 rounded-md bg-deep-50 text-deep-600 inline-flex items-center justify-center text-[11px] font-bold shrink-0">
                        {{ strtoupper(substr($lead->name ?? '?', 0, 1)) }}
                    </span>
                    <div class="flex-1 min-w-0">
                        <p class="text-[13px] font-semibold text-deep-700">{{ $lead->name ?: '—' }}</p>
                        <p class="text-[11.5px] text-ink-400 truncate">
                            {{ $lead->phone ?: '' }}
                            @if ($lead->email) · {{ $lead->email }} @endif
                        </p>
                    </div>
                    <span class="hidden sm:inline-flex items-center text-[10px] font-bold text-deep-500 bg-deep-50 px-2 py-0.5 rounded uppercase tracking-[0.14em]">{{ $lead->form_type }}</span>
                    <time class="text-[11px] text-ink-400 tabular-nums">{{ $lead->created_at?->format('d.m.Y H:i') }}</time>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
