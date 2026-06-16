@php
    // DB'den ayar + menüleri çek (admin panelden yönetilir)
    $headerMenu     = menu_items('header');
    $current        = request()->route() ? request()->route()->getName() : null;
    $whatsapp       = setting('whatsapp_url', 'https://wa.me/900000000000');
    $sitePhone      = setting('contact_phone', '+90 (000) 000 00 00');
    $sitePhoneTel   = setting('contact_phone_raw', '+900000000000');
    $siteEmail      = setting('contact_email', 'info@dryucelpolat.com');
    $siteAddress    = setting('contact_address', 'Klinik Adresi, Sarıyer / İstanbul');
    $siteLogo       = setting('site_logo', '/img/logo.png');
    $socials = [
        'instagram' => setting('social_instagram'),
        'facebook'  => setting('social_facebook'),
        'youtube'   => setting('social_youtube'),
        'linkedin'  => setting('social_linkedin'),
        'x'         => setting('social_x'),
    ];
    $treatments = config('treatments', []);

    // Eski yapı geriye dönük uyum — eğer menü tablosundan boş gelirse fallback
    if ($headerMenu->isEmpty()) {
        $nav = [
            ['title' => 'Anasayfa',  'route' => 'home'],
            ['title' => 'Hakkımda',  'route' => 'about'],
            ['title' => 'Hizmetler', 'dropdown' => true],
            ['title' => 'Blog',      'route' => 'blog.index'],
            ['title' => 'İletişim',  'route' => 'contact'],
        ];
    } else {
        $nav = $headerMenu->map(function ($m) {
            return [
                'title'      => $m->label,
                'route'      => $m->route_name,
                'url'        => $m->url,
                'icon'       => $m->icon,
                'target'     => $m->target,
                'dropdown'   => $m->is_dropdown,
                'children'   => $m->children,
            ];
        })->all();
    }
@endphp

<header class="bg-white border-b border-ink-100 sticky top-0 z-50">
    {{-- Top bar --}}
    <div class="bg-white border-b border-ink-100">
        <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-2.5 flex flex-wrap items-center gap-3">
            {{-- Contact info — minimal, hepsi yeşil tonda, light font --}}
            <div class="flex flex-wrap items-center gap-x-4 gap-y-1.5 lg:gap-x-4 text-[13px] text-ink-500 flex-1 min-w-0">
                {{-- Telefon — admin'den yönetilir --}}
                <a href="tel:{{ $sitePhoneTel }}"
                   class="group inline-flex items-center gap-2 pr-3 lg:pr-4 lg:border-r border-leaf-500/55 hover:text-leaf-500 transition-colors">
                    <span class="w-7 h-7 rounded-md bg-leaf-500/15
                                 text-leaf-500 inline-flex items-center justify-center
                                 shadow-[0_1px_3px_color-mix(in_srgb,var(--color-leaf-500)_20%,transparent)]
                                 group-hover:bg-leaf-500 group-hover:text-white
                                 transition-all duration-300">
                        <i class="fas fa-phone text-[10px]"></i>
                    </span>
                    <span class="font-light text-[12.5px] sm:text-[13px]">{{ $sitePhone }}</span>
                </a>

                {{-- Email --}}
                <a href="mailto:{{ $siteEmail }}"
                   class="group hidden sm:inline-flex items-center gap-2 pr-3 lg:pr-4 lg:border-r border-leaf-500/55 hover:text-leaf-500 transition-colors">
                    <span class="w-7 h-7 rounded-md bg-leaf-500/15
                                 text-leaf-500 inline-flex items-center justify-center
                                 shadow-[0_1px_3px_color-mix(in_srgb,var(--color-leaf-500)_20%,transparent)]
                                 group-hover:bg-leaf-500 group-hover:text-white
                                 transition-all duration-300">
                        <i class="fas fa-envelope text-[10px]"></i>
                    </span>
                    <span class="font-light hidden md:inline">{{ $siteEmail }}</span>
                </a>

                {{-- Adres --}}
                <div class="group hidden sm:inline-flex items-center gap-2">
                    <span class="w-7 h-7 rounded-md bg-leaf-500/15
                                 text-leaf-500 inline-flex items-center justify-center
                                 shadow-[0_1px_3px_color-mix(in_srgb,var(--color-leaf-500)_20%,transparent)]">
                        <i class="fas fa-map-marker-alt text-[10px]"></i>
                    </span>
                    <span class="font-light hidden lg:inline">{{ $siteAddress }}</span>
                </div>
            </div>

            {{-- Social: admin'den boş bırakılırsa gizli --}}
            <div class="flex items-center gap-1.5">
                @if ($socials['instagram'])
                    <a href="{{ $socials['instagram'] }}" target="_blank" rel="noopener" class="social-pill" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                @endif
                @if ($socials['facebook'])
                    <a href="{{ $socials['facebook'] }}" target="_blank" rel="noopener" class="social-pill" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                @endif
                @if ($socials['youtube'])
                    <a href="{{ $socials['youtube'] }}" target="_blank" rel="noopener" class="social-pill" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                @endif
                @if ($socials['linkedin'])
                    <a href="{{ $socials['linkedin'] }}" target="_blank" rel="noopener" class="social-pill" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                @endif
                @if ($socials['x'])
                    <a href="{{ $socials['x'] }}" target="_blank" rel="noopener" class="social-pill" aria-label="X"><i class="fab fa-x-twitter"></i></a>
                @endif
            </div>
        </div>
    </div>

    {{-- Main bar --}}
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-3 flex items-center gap-6 relative"
             x-data="{ open: false }">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex-shrink-0 inline-block">
                <img src="{{ str_starts_with($siteLogo, 'http') ? $siteLogo : asset(ltrim($siteLogo, '/')) }}" alt="{{ setting('site_name', config('app.name')) }}" class="h-[52px] lg:h-[60px] w-auto">
            </a>

            {{-- Desktop nav (logo mavisi tonu) --}}
            <nav class="hidden lg:flex items-center gap-1 flex-1 justify-end" aria-label="Ana navigasyon">
                @foreach ($nav as $item)
                    @if (!empty($item['dropdown']))
                        {{-- Hizmetler dropdown — hover-açılır kart --}}
                        <div class="relative"
                             x-data="{ dropOpen: false }"
                             @mouseenter="dropOpen = true"
                             @mouseleave="dropOpen = false">

                            @php $servicesActive = $current === 'services.index' || $current === 'services.show'; @endphp
                            <a href="{{ route('services.index') }}"
                               class="relative px-3 py-2 text-sm font-bold uppercase tracking-wider transition-colors inline-flex items-center gap-1.5
                                      {{ $servicesActive ? 'text-deep-500' : 'text-ink-900 hover:text-deep-500' }}">
                                {{ $item['title'] }}
                                <i class="fas fa-chevron-down text-[9px] transition-transform duration-200"
                                   :class="dropOpen ? 'rotate-180 text-deep-500' : ''"></i>
                                @if ($servicesActive)
                                    <span class="absolute left-1/2 -translate-x-1/2 -bottom-0.5 w-6 h-0.5 rounded-full bg-deep-500"></span>
                                @endif
                            </a>

                            {{-- Dropdown panel --}}
                            <div x-show="dropOpen" x-cloak
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 -translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 -translate-y-2"
                                 class="absolute top-full mt-3 z-50
                                        left-[-72px] w-[460px] text-[12px]
                                        min-[1200px]:left-0 min-[1200px]:w-[640px] min-[1200px]:text-[13px]"
                                 style="display:none"
                                 @click.outside="dropOpen = false">

                                {{-- Üst köprü — boşluk hover'ı kesmesin diye --}}
                                <div class="absolute -top-3 inset-x-0 h-3"></div>

                                <div class="relative bg-white rounded-2xl shadow-[0_20px_50px_-12px_color-mix(in_srgb,var(--color-deep-700)_25%,transparent)] border border-ink-100 overflow-hidden">
                                    {{-- Üst aksan şeridi --}}
                                    <div class="h-1 bg-gradient-to-r from-brand-500 via-leaf-500 to-deep-500"></div>

                                    <div class="p-5">
                                        {{-- Header --}}
                                        <div class="flex items-center justify-between mb-4 pb-3 border-b border-ink-100">
                                            <a href="{{ route('services.index') }}" class="group/header block">
                                                <p class="text-brand-500 font-semibold text-[11px] tracking-[0.22em] uppercase">Uzmanlık Alanları</p>
                                                <h3 class="font-display text-[15px] font-bold text-deep-600 mt-0.5 group-hover/header:text-brand-500 transition-colors inline-flex items-center gap-1.5">
                                                    Tüm Hizmetler
                                                    <i class="fas fa-arrow-right text-[10px] opacity-0 -translate-x-1 group-hover/header:opacity-100 group-hover/header:translate-x-0 transition-all duration-200"></i>
                                                </h3>
                                            </a>
                                            <span class="w-8 h-8 rounded-lg bg-deep-50 text-deep-500 inline-flex items-center justify-center text-xs">
                                                <i class="fas fa-stethoscope"></i>
                                            </span>
                                        </div>

                                        {{-- 2 kolon × 4 hizmet --}}
                                        @php
                                            $colors = [
                                                ['bg' => 'bg-deep-50',     'text' => 'text-deep-500',  'fill' => 'group-hover:bg-deep-500'],
                                                ['bg' => 'bg-brand-50',    'text' => 'text-brand-500', 'fill' => 'group-hover:bg-brand-500'],
                                                ['bg' => 'bg-leaf-500/15', 'text' => 'text-leaf-500',  'fill' => 'group-hover:bg-leaf-500'],
                                            ];
                                            $currentSlug = request()->route('slug');
                                        @endphp

                                        @php
                                            // Dropdown panel — Hizmetler menüsünün children'ı (admin'den yönetilir)
                                            $dropdownItems = $item['children'] ?? collect();
                                        @endphp
                                        <div class="grid grid-cols-2 gap-x-2 gap-y-1">
                                            @foreach ($dropdownItems as $i => $child)
                                                @php
                                                    $c = $colors[$i % 3];
                                                    $childUrl = $child->route_name && \Illuminate\Support\Facades\Route::has($child->route_name)
                                                        ? route($child->route_name)
                                                        : ($child->url ?? '#');
                                                    $isActive = request()->url() === $childUrl;
                                                    $childIconPrefix = $child->icon && str_starts_with($child->icon, 'fab ') ? '' : 'fas ';
                                                @endphp
                                                <a href="{{ $childUrl }}"
                                                   @if ($child->target === '_blank') target="_blank" rel="noopener" @endif
                                                   @if ($isActive) aria-current="page" @endif
                                                   class="group flex items-center gap-2 min-[1200px]:gap-3 p-1.5 min-[1200px]:p-2.5 rounded-lg transition-colors
                                                          {{ $isActive ? 'bg-ink-100' : 'hover:bg-ink-50' }}">
                                                    @if ($child->icon)
                                                        <span class="w-7 h-7 min-[1200px]:w-9 min-[1200px]:h-9 rounded-lg {{ $c['bg'] }} {{ $c['text'] }} inline-flex items-center justify-center shrink-0 transition-colors {{ $c['fill'] }} group-hover:text-white">
                                                            <i class="{{ $childIconPrefix . $child->icon }} text-[10px] min-[1200px]:text-sm"></i>
                                                        </span>
                                                    @endif
                                                    <div class="min-w-0 flex-1">
                                                        <p class="text-deep-700 text-[11px] min-[1200px]:text-[13px] font-semibold leading-snug group-hover:text-brand-500 transition-colors truncate min-[1200px]:whitespace-normal">
                                                            {{ $child->label }}
                                                        </p>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @php
                            $routeName = $item['route'] ?? null;
                            $href = $routeName ? (\Illuminate\Support\Facades\Route::has($routeName) ? route($routeName) : '#') : ($item['url'] ?? '#');
                            $active = $routeName && $current === $routeName;
                            $target = $item['target'] ?? '_self';
                        @endphp
                        <a href="{{ $href }}" @if ($target === '_blank') target="_blank" rel="noopener" @endif
                           class="relative px-3 py-2 text-sm font-bold uppercase tracking-wider transition-colors
                                  {{ $active ? 'text-deep-500' : 'text-ink-900 hover:text-deep-500' }}">
                            {{ $item['title'] }}
                            @if ($active)
                                <span class="absolute left-1/2 -translate-x-1/2 -bottom-0.5 w-6 h-0.5 rounded-full bg-deep-500"></span>
                            @endif
                        </a>
                    @endif
                @endforeach
            </nav>

            {{-- CTA — koyu üst → logo mavisi alt gradient + hover arrow --}}
            <a href="{{ $whatsapp }}" target="_blank" rel="noopener"
               class="hidden lg:inline-flex relative items-center group ml-5"
               aria-label="WhatsApp ile randevu al">
                {{-- Beyaz daire --}}
                <span class="absolute left-0 top-1/2 -translate-x-1/2 -translate-y-1/2 z-20
                             w-10 h-10 rounded-full bg-white text-deep-600
                             flex items-center justify-center
                             shadow-[0_4px_14px_color-mix(in_srgb,var(--color-deep-700)_20%,transparent)]
                             group-hover:scale-110 group-hover:text-brand-500
                             transition-all duration-300 ease-out">
                    <i class="fab fa-whatsapp text-[16px]"></i>
                </span>
                {{-- Buton gövdesi: koyu üst → logo mavisi alt, hover'da arrow slide-in --}}
                <span class="relative bg-gradient-to-b from-deep-700 to-deep-400
                             group-hover:from-deep-800 group-hover:to-deep-500
                             text-white pl-10 pr-6 py-3 rounded-lg
                             text-[11px] font-bold uppercase tracking-[0.18em] whitespace-nowrap
                             shadow-[0_2px_8px_color-mix(in_srgb,var(--color-deep-700)_15%,transparent)]
                             group-hover:shadow-[0_10px_28px_color-mix(in_srgb,var(--color-deep-500)_32%,transparent)]
                             transition-all duration-300
                             before:absolute before:inset-x-0 before:top-0 before:h-px
                             before:bg-white/25 before:rounded-t-lg">
                    <span class="relative inline-flex items-center gap-2">
                        Online Randevu Al
                        <i class="fas fa-arrow-right text-[10px] opacity-0 -ml-3
                                  group-hover:opacity-100 group-hover:ml-0
                                  transition-all duration-300"></i>
                    </span>
                </span>
            </a>

            {{-- Mobile hamburger — animated bars↔X --}}
            <button class="lg:hidden ml-auto relative w-10 h-10 inline-flex items-center justify-center text-ink-900 rounded-lg transition-colors hover:bg-ink-50"
                    @click="open = !open" :aria-expanded="open" aria-label="Menüyü aç/kapat">
                <span class="relative w-5 h-5 inline-block">
                    <span class="absolute left-0 top-1 h-0.5 w-full bg-current rounded-full transition-all duration-300"
                          :class="open ? 'rotate-45 translate-y-1.5' : ''"></span>
                    <span class="absolute left-0 top-1/2 -translate-y-1/2 h-0.5 w-full bg-current rounded-full transition-all duration-200"
                          :class="open ? 'opacity-0 scale-x-0' : 'opacity-100'"></span>
                    <span class="absolute left-0 bottom-1 h-0.5 w-full bg-current rounded-full transition-all duration-300"
                          :class="open ? '-rotate-45 -translate-y-1.5' : ''"></span>
                </span>
            </button>

            {{-- Mobile backdrop — menü arkasında yumuşak karartma --}}
            <div x-show="open" x-cloak
                 x-transition:enter="transition-opacity ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="open = false"
                 class="lg:hidden fixed inset-0 top-[var(--mob-top,124px)] bg-deep-900/30 backdrop-blur-sm z-40"
                 style="display:none"></div>

            {{-- Mobile menu drawer — slide-down + fade, brand accent strip, stagger items --}}
            <div x-show="open" x-cloak
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-y-3"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 :data-mob-menu="open ? 'open' : 'closed'"
                 class="mob-menu absolute top-full left-0 right-0 bg-white lg:hidden overflow-hidden z-50
                        shadow-[0_24px_50px_-16px_color-mix(in_srgb,var(--color-deep-700)_30%,transparent)] rounded-b-2xl"
                 style="display:none">

                {{-- Üst aksan şeridi — brand gradient --}}
                <div class="h-1 bg-gradient-to-r from-brand-500 via-leaf-500 to-deep-500"></div>

                <nav class="flex flex-col p-4 gap-1" aria-label="Mobil navigasyon">
                    @foreach ($nav as $idx => $item)
                        @if (!empty($item['dropdown']))
                            <div x-data="{ mobOpen: false }" class="mob-nav-item" style="--i: {{ $idx }};">
                                <button type="button" @click="mobOpen = !mobOpen"
                                        class="group w-full flex items-center justify-between px-3 py-3 text-sm font-bold uppercase tracking-wider text-ink-900 hover:bg-ink-50 hover:text-deep-500 rounded-lg transition-colors">
                                    <span class="inline-flex items-center gap-3">
                                        <span class="w-1.5 h-1.5 rounded-full bg-ink-200 group-hover:bg-deep-500 transition-colors"></span>
                                        {{ $item['title'] }}
                                    </span>
                                    <i class="fas fa-chevron-down text-[10px] transition-transform duration-300" :class="mobOpen ? 'rotate-180 text-deep-500' : ''"></i>
                                </button>
                                <div x-show="mobOpen" x-cloak style="display:none"
                                     x-transition:enter="transition ease-out duration-250"
                                     x-transition:enter-start="opacity-0 -translate-y-1 max-h-0"
                                     x-transition:enter-end="opacity-100 translate-y-0 max-h-[600px]"
                                     x-transition:leave="transition ease-in duration-200"
                                     x-transition:leave-start="opacity-100 max-h-[600px]"
                                     x-transition:leave-end="opacity-0 max-h-0"
                                     class="pl-3 mt-1 mb-2 space-y-0.5 overflow-hidden">
                                    <a href="{{ route('services.index') }}" class="group flex items-center justify-between px-3 py-2.5 rounded-lg text-[13px] font-bold text-brand-500 hover:bg-brand-50 transition-colors">
                                        <span class="inline-flex items-center gap-2.5">
                                            <i class="fas fa-th-large text-xs w-4 text-center"></i>
                                            Tüm Hizmetler
                                        </span>
                                        <i class="fas fa-arrow-right text-[10px] transition-transform group-hover:translate-x-1"></i>
                                    </a>
                                    @foreach (($item['children'] ?? collect()) as $child)
                                        @php
                                            $mobChildUrl = $child->route_name && \Illuminate\Support\Facades\Route::has($child->route_name)
                                                ? route($child->route_name)
                                                : ($child->url ?? '#');
                                            $mobActive = request()->url() === $mobChildUrl;
                                            $mobIconPrefix = $child->icon && str_starts_with($child->icon, 'fab ') ? '' : 'fas ';
                                        @endphp
                                        <a href="{{ $mobChildUrl }}"
                                           @if ($child->target === '_blank') target="_blank" rel="noopener" @endif
                                           @if ($mobActive) aria-current="page" @endif
                                           class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-[13px] font-medium transition-colors text-ink-700
                                                  {{ $mobActive ? 'bg-ink-100' : 'hover:bg-deep-50 hover:text-deep-600' }}">
                                            @if ($child->icon)
                                                <i class="{{ $mobIconPrefix . $child->icon }} text-deep-400 text-xs w-4 text-center"></i>
                                            @endif
                                            {{ $child->label }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            @php
                                $mobRoute = $item['route'] ?? null;
                                $mobHrefNav = $mobRoute ? (\Illuminate\Support\Facades\Route::has($mobRoute) ? route($mobRoute) : '#') : ($item['url'] ?? '#');
                                $isActive = $mobRoute && $current === $mobRoute;
                                $mobTarget = $item['target'] ?? '_self';
                            @endphp
                            <a href="{{ $mobHrefNav }}" @if ($mobTarget === '_blank') target="_blank" rel="noopener" @endif
                               class="group mob-nav-item flex items-center gap-3 px-3 py-3 text-sm font-bold uppercase tracking-wider rounded-lg transition-colors
                                      {{ $isActive ? 'bg-deep-50 text-deep-600' : 'text-ink-900 hover:bg-ink-50 hover:text-deep-500' }}"
                               style="--i: {{ $idx }};">
                                <span class="w-1.5 h-1.5 rounded-full transition-colors
                                             {{ $isActive ? 'bg-deep-500' : 'bg-ink-200 group-hover:bg-deep-500' }}"></span>
                                {{ $item['title'] }}
                            </a>
                        @endif
                    @endforeach
                </nav>
            </div>
        </div>
    </div>
</header>
