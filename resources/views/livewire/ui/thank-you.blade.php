@php
    $homeUrl = url('/');
@endphp

<section class="relative bg-white">
    <div class="pointer-events-none absolute -top-32 left-1/2 -translate-x-1/2 h-[300px] w-[480px] rounded-full bg-brand-100/20 blur-[160px]"></div>

    <div class="relative mx-auto max-w-3xl px-6 lg:px-10 py-24 lg:py-32 text-center">

        <div class="inline-flex items-center justify-center h-16 w-16 rounded-2xl bg-white border border-brand-100 shadow-[0_24px_60px_-30px_rgba(224,70,58,0.35)]">
            <i class="fa-solid fa-check text-[22px] text-brand-500"></i>
        </div>

        <h1 class="mt-8 font-display text-[34px] lg:text-[48px] leading-[1.05] tracking-[-0.02em] font-light text-ink-900">
            {{ __('thankyou.title') }}
        </h1>

        <p class="mt-5 text-[15px] lg:text-[16px] text-ink-600 leading-relaxed font-light">
            {{ __('thankyou.lead') }}
        </p>

        @if(!empty($thankYouData['name']))
            <p class="mt-4 text-[13px] uppercase tracking-[0.24em] text-ink-400">
                — {{ $thankYouData['name'] }}
            </p>
        @endif

        <div class="mt-10 inline-flex">
            <a href="{{ $homeUrl }}">
                <x-button variant="primary" size="lg">
                    <i class="fa-solid fa-arrow-left mr-2 text-[11px]"></i>
                    {{ __('thankyou.cta') }}
                </x-button>
            </a>
        </div>
    </div>
</section>
