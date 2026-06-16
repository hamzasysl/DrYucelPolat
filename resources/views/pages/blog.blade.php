@extends('layouts.app')

@section('title', 'Blog & Sağlık Yazıları — ' . config('app.name'))
@section('description', 'Kalp ve damar sağlığı, varis tedavisi, koroner bypass, endovasküler girişimler ve hasta bilgilendirme yazıları — Op. Dr. Yücel Polat tarafından kaleme alınan rehberler.')
@section('keywords', 'kalp damar blog, varis blog yazıları, sağlık makaleleri, kardiyovasküler sağlık, kalp sağlığı rehberi, damar hastalıkları bilgi, Op. Dr. Yücel Polat blog')
@section('og_title', 'Blog & Sağlık Yazıları — ' . config('app.name'))
@section('og_description', 'Kalp ve damar sağlığı, tedavi yöntemleri ve hasta bilgilendirme yazıları.')
@section('og_image', asset('img/doktor.webp'))
@section('og_type', 'website')

@section('structured_data')
@php
    $breadcrumbLd = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Anasayfa', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => route('blog.index')],
        ],
    ];
    $blogLd = [
        '@context' => 'https://schema.org',
        '@type' => 'Blog',
        '@id' => route('blog.index') . '#blog',
        'url' => route('blog.index'),
        'name' => 'Op. Dr. Yücel Polat — Blog',
        'description' => 'Kalp ve damar sağlığı, tedavi yöntemleri ve hasta bilgilendirme yazıları.',
        'inLanguage' => 'tr-TR',
        'publisher' => ['@id' => url('/') . '#person'],
        'isPartOf' => ['@id' => url('/') . '#website'],
    ];
@endphp
<script type="application/ld+json">{!! json_encode($breadcrumbLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($blogLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endsection

@section('content')

@include('partials.subheader', [
    'title'   => 'Blog',
    'current' => 'Blog',
])

<section class="bg-white py-16 lg:py-24">
    <div class="max-w-5xl mx-auto px-4 md:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-brand-50 text-brand-500 text-3xl mb-6">
            <i class="fas fa-pen-nib"></i>
        </div>
        <h2 class="font-display text-3xl font-bold text-deep-700 mb-4">Blog yazıları yakında burada</h2>
        <p class="text-ink-500 text-lg leading-relaxed mb-8 max-w-2xl mx-auto">
            İlk yazılarımızı hazırlıyoruz. Konu önerilerinizi veya merak ettiğiniz konuları
            bize iletmek için iletişim sayfasını kullanabilirsiniz.
        </p>
        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 bg-brand-500 hover:bg-deep-700 text-white px-7 py-4 text-sm font-extrabold uppercase tracking-wider rounded-sm transition-colors">
            Konu Öner <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</section>

@endsection
