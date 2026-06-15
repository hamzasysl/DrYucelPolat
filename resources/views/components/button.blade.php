@props([
    'variant' => 'primary', // primary | outline | ghost
    'type'    => 'button',
    'size'    => 'md',      // sm | md | lg
])

@php
    // letter-spacing kaldırıldı (tracking-normal), header WhatsApp CTA dili: vertical gradient mavi-lacivert geçişli
    $base = 'inline-flex items-center justify-center font-semibold tracking-normal cursor-pointer transition-all disabled:opacity-60 disabled:pointer-events-none relative overflow-hidden';

    $sizes = [
        'sm' => 'px-4 py-2 text-[12px]',
        'md' => 'px-5 py-3 text-[13px]',
        'lg' => 'px-6 py-3.5 text-[14px]',
    ];

    $variants = [
        // Header CTA paralel: from-deep-700 (lacivert) → to-deep-400 (logo mavisi) + üstte 1px white highlight
        'primary' => 'rounded-lg bg-gradient-to-b from-deep-700 to-deep-400 text-white shadow-[0_4px_14px_rgba(15,61,90,0.22)] hover:from-deep-800 hover:to-deep-500 hover:shadow-[0_10px_28px_rgba(30,95,158,0.30)] before:absolute before:inset-x-0 before:top-0 before:h-px before:bg-white/25 before:rounded-t-lg active:scale-[0.985]',
        'outline' => 'rounded-lg border border-ink-200 bg-white text-ink-800 hover:border-ink-900 hover:bg-ink-50',
        'ghost'   => 'rounded-lg text-ink-700 hover:bg-ink-50',
    ];

    $cls = $base . ' ' . ($sizes[$size] ?? $sizes['md']) . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $cls]) }}>
    {{ $slot }}
</button>
