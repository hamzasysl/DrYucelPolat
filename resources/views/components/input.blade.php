@props([
    'type'         => 'text',
    'placeholder'  => null,
    'autocomplete' => null,
])

<input
    type="{{ $type }}"
    @if($placeholder) placeholder="{{ $placeholder }}" @endif
    @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
    {{ $attributes->merge([
        'class' => 'w-full rounded-lg border border-ink-200 bg-white px-3.5 py-2.5 text-[14px] text-ink-900 placeholder:text-ink-400 outline-none transition focus:border-brand-400 focus:ring-2 focus:ring-brand-100'
    ]) }}
>
