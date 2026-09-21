@props(['slug', 'fallback' => null])
{{--
    Hizmet ikonları — özel çizim SVG seti (çizgi stili, tek kalınlık).
    Renk currentColor'dan gelir: çağıran yer text-brand-500 / text-deep-500 / text-leaf-500 verir
    (config/site.php 'systems'). Tanımsız slug'da Font Awesome yedeğine düşer.
--}}
@php
    $svg = 'viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"';
@endphp

@switch($slug)

    {{-- Varis — bacak içinde kıvrımlı, genişlemiş toplardamar --}}
    @case('varis-tedavisi')
        <svg {!! $svg !!} {{ $attributes }}>
            <path d="M16 4c-1 6-2.5 12-2 18 .5 5 3 9 3.5 14 .3 2.5 0 4-.5 5.5-.5 1.5 0 2.5 1.5 2.5H36c2 0 2.5-2 .5-3-3.5-1.5-7-1-9-.5"/>
            <path d="M29 4c.5 6 1.5 11 1 17-.5 6-3 11-3.5 15-.2 2 0 3.5 1 4.5"/>
            <path d="M22 7c-2.5 3 2.5 6 0 10s2 7-.5 11c-1.5 3 1.5 5 0 8"/>
            <path d="M22 17c2.5 1 4 3 3.5 5.5"/>
        </svg>
        @break

    {{-- Lipödem — kalçadan dize simetrik genişleme, ince bilek, yağ dokusu noktaları --}}
    @case('lipodem')
        <svg {!! $svg !!} {{ $attributes }}>
            <path d="M9 5c-2 10 0 20 4 28 1 3 1 7 .5 11"/>
            <path d="M22.5 5c.5 10-.5 20-3 28-.7 3-.7 7-.3 11"/>
            <path d="M25.5 5c-.5 10 .5 20 3 28 .7 3 .7 7 .3 11"/>
            <path d="M39 5c2 10 0 20-4 28-1 3-1 7-.5 11"/>
            <g fill="currentColor" stroke="none">
                <circle cx="13.5" cy="11" r="1.3"/><circle cx="17.5" cy="16" r="1.3"/><circle cx="13.5" cy="21" r="1.3"/><circle cx="18" cy="9" r="1.3"/>
                <circle cx="34.5" cy="11" r="1.3"/><circle cx="30.5" cy="16" r="1.3"/><circle cx="34.5" cy="21" r="1.3"/><circle cx="30" cy="9" r="1.3"/>
            </g>
        </svg>
        @break

    {{-- Lenfödem — şişmiş uzuv, dallanan lenf damarı ve lenf nodları --}}
    @case('lenfodem')
        <svg {!! $svg !!} {{ $attributes }}>
            <path d="M15 4c-3 10-4 20-2 30 1 4 1.5 7 1 10"/>
            <path d="M33 4c3 10 4 20 2 30-1 4-1.5 7-1 10"/>
            <path d="M24 6c-2 8 2 16 0 24-1 4 0 7 0 10"/>
            <path d="M24.5 15c2.5-1 4.5-3 5.5-5M23.5 22c-2.5-1-4.5-3-5.5-5.5M24 30c2.5-.5 4.5-2 5.5-4"/>
            <circle cx="30.5" cy="9.5" r="2" fill="currentColor" fill-opacity=".3"/>
            <circle cx="17.8" cy="16" r="2" fill="currentColor" fill-opacity=".3"/>
            <circle cx="30" cy="25.5" r="2" fill="currentColor" fill-opacity=".3"/>
        </svg>
        @break

    {{-- Pelvik Konjesyon — rahim, yumurtalıklar ve genişlemiş pelvik toplardamarlar --}}
    @case('pelvik-konjesyon')
        <svg {!! $svg !!} {{ $attributes }}>
            <path d="M18 15c0-4 12-4 12 0v7c0 5-3 8-4 11v5h-4v-5c-1-3-4-6-4-11z"/>
            <path d="M18 15c-4-3-8-2-9 2M30 15c4-3 8-2 9 2"/>
            <ellipse cx="9" cy="20" rx="3" ry="2.4" fill="currentColor" fill-opacity=".2"/>
            <ellipse cx="39" cy="20" rx="3" ry="2.4" fill="currentColor" fill-opacity=".2"/>
            <path d="M9 23c-2 4 2 6 0 10s1 6 0 9M39 23c2 4-2 6 0 10s-1 6 0 9"/>
        </svg>
        @break

    {{-- DVT — toplardamar içinde pıhtı, üstte akış yönü --}}
    @case('dvt-tromboz')
        <svg {!! $svg !!} {{ $attributes }}>
            <path d="M17 4c2 12-2 26 0 40M31 4c-2 12 2 26 0 40"/>
            <path d="M24 7v6M21.5 10.5 24 13l2.5-2.5"/>
            <path d="M20 20c1-3 7-3 8 0 2 2 1 7-1 8-2 2-6 1-7-1-1.5-2-1.2-5 0-7z" fill="currentColor" fill-opacity=".25"/>
            <circle cx="22.5" cy="23" r="1" fill="currentColor" stroke="none"/>
            <circle cx="25.5" cy="25.5" r="1" fill="currentColor" stroke="none"/>
            <path d="M24 34v4" stroke-dasharray="1.5 3"/>
        </svg>
        @break

    {{-- Periferik Damar Hastalığı — atardamar kesiti, plakla daralmış lümen --}}
    @case('periferik-damar-hastaligi')
        <svg {!! $svg !!} {{ $attributes }}>
            <circle cx="24" cy="24" r="17"/>
            <path fill="currentColor" fill-opacity=".22" stroke="none" fill-rule="evenodd"
                  d="M24 12a12 12 0 1 0 .01 0zM28 14a6 6 0 1 0 .01 0z"/>
            <circle cx="24" cy="24" r="12"/>
            <circle cx="28" cy="20" r="6"/>
        </svg>
        @break

    {{-- Diyabetik Ayak — ayak izi ve yara odağı --}}
    @case('diyabetik-ayak')
        <svg {!! $svg !!} {{ $attributes }}>
            <path d="M20 12c7-1 11 5 10 12-.5 5 1 9 .5 13-.5 5-4.5 8-9.5 7.5-5-.5-7-4.5-6-9.5 1-5-2-9-1.5-15 .5-5 2.5-7.5 6.5-8z"/>
            <circle cx="14.5" cy="8" r="2.2"/><circle cx="19.5" cy="5.5" r="2.3"/><circle cx="25" cy="5.5" r="2.1"/>
            <circle cx="29.5" cy="7.5" r="1.8"/><circle cx="33" cy="10.5" r="1.5"/>
            <circle cx="23" cy="31" r="3.4" fill="currentColor" fill-opacity=".25"/>
            <circle cx="23" cy="31" r="1.2" fill="currentColor" stroke="none"/>
        </svg>
        @break

    {{-- Cardisiography — kalp ve EKG dalgası --}}
    @case('cardisiography')
        <svg {!! $svg !!} {{ $attributes }}>
            <path d="M24 40C14 33 7 27 7 18c0-6 4-10 9-10 3.5 0 6.5 2 8 5 1.5-3 4.5-5 8-5 5 0 9 4 9 10 0 9-7 15-17 22z"/>
            <path d="M11 23h6l2.5-5 3.5 11 3.5-10 2.5 4h8"/>
        </svg>
        @break

    @default
        @if ($fallback)
            <i class="fas {{ $fallback }}" {{ $attributes }}></i>
        @endif
@endswitch
