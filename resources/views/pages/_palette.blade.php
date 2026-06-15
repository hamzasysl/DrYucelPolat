@extends('layouts.app')
@section('title', 'Renk Paleti')

@section('content')
<section class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 space-y-12">

        @php
            $palettes = [
                ['name' => 'brand', 'label' => 'Brand (Logo Kırmızı Flame)', 'note' => 'CTA aksiyonları, vurgu, kalp-acıl tonu',
                 'shades' => [
                    '50'  => '#FBE9EB', '100' => '#F5C7CB', '200' => '#ECA1A6', '300' => '#DF7479', '400' => '#D14F55',
                    '500' => '#E63946', '600' => '#C42B37', '700' => '#9F1F2A', '800' => '#7C1820', '900' => '#56101A',
                 ]],
                ['name' => 'deep',  'label' => 'Deep (Logo Mavi Flame)', 'note' => 'Menü, başlıklar, premium CTA, footer',
                 'shades' => [
                    '50'  => '#E6EEF5', '100' => '#C9DCEB', '200' => '#95B8D4', '300' => '#6093BC', '400' => '#2C6FA5',
                    '500' => '#1E5F9E', '600' => '#0F3D5A', '700' => '#0A2A40', '800' => '#061E2F', '900' => '#03121E',
                 ]],
                ['name' => 'accent', 'label' => 'Logo Aksanları', 'note' => 'Vurgu/ikon — yeşil yaprak + turuncu güneş',
                 'shades' => [
                    'leaf-500' => '#84CC16', 'sun-500' => '#F59E0B',
                 ]],
                ['name' => 'ink',   'label' => 'Ink (Nötr Gri)', 'note' => 'Metin, border, bg gri tonları',
                 'shades' => [
                    '50'  => '#F7F9FB', '100' => '#E5E7EB', '200' => '#D1D5DB', '300' => '#9CA3AF',
                    '400' => '#6B7280', '500' => '#374151', '700' => '#1F2937', '900' => '#0F172A',
                 ]],
            ];
        @endphp

        @foreach ($palettes as $p)
            <div>
                <div class="mb-5">
                    <h2 class="font-display text-2xl font-bold text-deep-700">{{ $p['label'] }}</h2>
                    <p class="text-ink-400 text-sm">{{ $p['note'] }}</p>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-5 lg:grid-cols-{{ count($p['shades']) > 5 ? '10' : (count($p['shades']) == 2 ? '2' : count($p['shades'])) }} gap-3">
                    @foreach ($p['shades'] as $shade => $hex)
                        @php
                            // light/dark text contrast
                            $hexClean = ltrim($hex, '#');
                            $r = hexdec(substr($hexClean,0,2)); $g = hexdec(substr($hexClean,2,2)); $b = hexdec(substr($hexClean,4,2));
                            $lum = (0.299*$r + 0.587*$g + 0.114*$b);
                            $txt = $lum > 160 ? '#0F172A' : '#FFFFFF';
                        @endphp
                        <div class="rounded-xl overflow-hidden shadow-sm border border-ink-100">
                            <div class="h-20 flex items-end justify-between p-3" style="background:{{ $hex }}; color:{{ $txt }};">
                                <span class="font-bold text-sm">{{ $shade }}</span>
                            </div>
                            <div class="px-3 py-2 bg-white">
                                <code class="text-[11px] font-mono text-ink-500">{{ $hex }}</code>
                                <p class="text-[10px] text-ink-400 mt-0.5">{{ $p['name'] }}-{{ $shade }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        {{-- Kullanım örnekleri --}}
        <div>
            <h2 class="font-display text-2xl font-bold text-deep-700 mb-5">Kullanım Eşlemesi</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
                <div class="p-5 rounded-xl bg-deep-50 border border-deep-100">
                    <p class="text-xs uppercase tracking-wider text-deep-500 font-bold mb-1">Primary Nav / Header CTA</p>
                    <p class="text-deep-700 font-semibold">deep-500 → deep-600</p>
                    <p class="text-deep-500 text-xs mt-2">Mavi gradient pill button</p>
                </div>
                <div class="p-5 rounded-xl bg-brand-50 border border-brand-100">
                    <p class="text-xs uppercase tracking-wider text-brand-600 font-bold mb-1">Acil / Vurgu Aksiyonu</p>
                    <p class="text-brand-700 font-semibold">brand-500 → brand-600</p>
                    <p class="text-brand-600 text-xs mt-2">"Randevu Al" hero, stat sayıları, hover</p>
                </div>
                <div class="p-5 rounded-xl bg-ink-50 border border-ink-100">
                    <p class="text-xs uppercase tracking-wider text-ink-500 font-bold mb-1">Bölüm Arkaplanı</p>
                    <p class="text-deep-700 font-semibold">ink-50 / white</p>
                    <p class="text-ink-500 text-xs mt-2">Alternatif zebra section bg</p>
                </div>
                <div class="p-5 rounded-xl bg-deep-700">
                    <p class="text-xs uppercase tracking-wider text-deep-200 font-bold mb-1">Footer / Dark Section</p>
                    <p class="text-white font-semibold">deep-700</p>
                    <p class="text-ink-300 text-xs mt-2">Footer ve CTA strip</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
