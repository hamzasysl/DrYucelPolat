@extends('layouts.app')

@section('title', '404 — Sayfa Bulunamadı | Op. Dr. Yücel Polat')
@section('description', 'Aradığınız sayfa bulunamadı. Anasayfaya dönerek devam edebilirsiniz.')

@section('content')

<section class="relative overflow-hidden bg-gradient-to-br from-deep-50 via-white to-ink-50">
    {{-- Dekoratif yumuşak orb'lar --}}
    <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-40 -left-40 w-[480px] h-[480px] bg-brand-100 rounded-full blur-3xl opacity-40"></div>
        <div class="absolute -bottom-40 -right-40 w-[480px] h-[480px] bg-deep-100 rounded-full blur-3xl opacity-40"></div>
        <div class="absolute top-1/3 right-1/4 w-72 h-72 bg-leaf-500/8 rounded-full blur-3xl"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 md:px-6 lg:px-8 pt-16 pb-20 lg:pt-20 lg:pb-24 text-center">
        {{-- 404 numarası — kompakt + EKG pulse hattı --}}
        <h1 class="font-display font-extrabold leading-none tracking-tighter text-brand-500 select-none mb-5"
            style="font-size: clamp(80px, 14vw, 150px);">
            404
        </h1>
        <div class="mx-auto mb-8 max-w-sm">
            <svg viewBox="0 0 500 80" class="w-full h-11" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M 0 40 L 160 40 L 175 12 L 195 68 L 215 22 L 235 58 L 250 40 L 500 40"
                      stroke="url(#hp-grad)"
                      stroke-width="3"
                      stroke-linecap="round"
                      stroke-linejoin="round">
                    <animate attributeName="stroke-dasharray"
                             from="0 600" to="600 0" dur="2.5s"
                             repeatCount="indefinite"/>
                </path>
                <defs>
                    <linearGradient id="hp-grad" x1="0" y1="0" x2="1" y2="0">
                        <stop offset="0%"   stop-color="#84CC16" stop-opacity="0"/>
                        <stop offset="35%"  stop-color="#E63946"/>
                        <stop offset="65%"  stop-color="#E63946"/>
                        <stop offset="100%" stop-color="#1E5F9E" stop-opacity="0"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        {{-- Başlık + açıklama --}}
        <h2 class="font-display text-2xl lg:text-3xl font-bold text-deep-600 mb-4 tracking-tight">
            Aradığınız sayfa bulunamadı
        </h2>
        <p class="text-ink-500 text-base lg:text-[16px] max-w-xl mx-auto mb-10 font-extralight leading-relaxed">
            Linkin tarihi geçmiş, adres yanlış yazılmış veya sayfa kaldırılmış olabilir.
            Aşağıdan devam edebilirsiniz.
        </p>

        {{-- Aksiyon butonları --}}
        <div class="flex flex-wrap items-center justify-center gap-3">
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white
                      px-6 py-3.5 text-xs font-bold uppercase tracking-wider rounded-lg
                      shadow-[0_8px_24px_color-mix(in_srgb,var(--color-brand-500)_25%,transparent)] hover:shadow-[0_10px_28px_color-mix(in_srgb,var(--color-brand-500)_32%,transparent)]
                      transition-all">
                <i class="fas fa-house text-xs"></i>
                Anasayfaya dön
            </a>
            <a href="{{ route('contact') }}"
               class="inline-flex items-center gap-2 border border-ink-300 hover:border-deep-600 text-ink-700 hover:text-deep-700
                      px-6 py-3.5 text-xs font-bold uppercase tracking-wider rounded-lg bg-white hover:bg-ink-50 transition-all">
                <i class="fas fa-envelope text-xs"></i>
                İletişime geç
            </a>
        </div>
    </div>
</section>

@endsection
