<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Yönetim Paneli') — MEZ Admin</title>
    <meta name="robots" content="noindex, nofollow">

    <link rel="icon" type="image/png" href="{{ asset('favicons/favicon-32.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @vite(['resources/css/app.css'])
    @stack('head')
</head>
<body class="font-sans antialiased bg-ink-50 text-ink-900 min-h-screen"
      x-data="{ sidebarOpen: false, userMenu: false }">

    @php
        $u   = auth()->user();
        $cur = request()->route()?->getName() ?? '';
        $nav = [
            ['key' => 'dashboard',     'label' => 'Gösterge Paneli', 'icon' => 'fa-gauge-high',  'route' => 'admin.dashboard'],
            ['key' => 'menus',         'label' => 'Menüler',         'icon' => 'fa-bars',         'route' => 'admin.menus.index'],
            ['key' => 'settings',      'label' => 'Site Ayarları',   'icon' => 'fa-gear',         'route' => 'admin.settings.index'],
            ['key' => 'users',         'label' => 'Kullanıcılar',    'icon' => 'fa-users',        'route' => 'admin.users.index',  'admin_only' => true],
        ];
    @endphp

    {{-- ============ SIDEBAR ============ --}}
    <aside class="fixed top-0 bottom-0 left-0 w-64 bg-deep-800 text-white z-40
                  transition-transform duration-300 ease-out
                  -translate-x-full lg:translate-x-0"
           :class="sidebarOpen ? 'translate-x-0' : ''"
           x-cloak>

        {{-- Logo --}}
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-5 h-16 border-b border-white/10">
            <div class="relative w-9 h-9 rounded-lg bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center shadow-[0_4px_10px_color-mix(in_srgb,var(--color-brand-500)_40%,transparent)]">
                <i class="fas fa-shield-halved text-white text-sm"></i>
                <span class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-leaf-500 ring-2 ring-deep-800"></span>
            </div>
            <div class="leading-tight">
                <p class="font-display text-[14px] font-bold text-white">MEZ Admin</p>
                <p class="text-[10px] text-white/55 tracking-[0.18em] uppercase font-bold">Yönetim</p>
            </div>
        </a>

        {{-- Nav --}}
        <nav class="p-3 space-y-1">
            @foreach ($nav as $item)
                @if (!empty($item['admin_only']) && !$u->isAdmin()) @continue @endif
                @php
                    $active = str_starts_with($cur, str_replace('.index', '', $item['route']));
                @endphp
                <a href="{{ route($item['route']) }}"
                   class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13px] font-medium transition-colors
                          {{ $active ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/[0.06] hover:text-white' }}">
                    <span class="w-7 h-7 rounded-md flex items-center justify-center
                                 {{ $active ? 'bg-brand-500/25 text-brand-300' : 'bg-white/[0.05] text-white/60 group-hover:bg-white/10 group-hover:text-white' }}">
                        <i class="fas {{ $item['icon'] }} text-[12px]"></i>
                    </span>
                    {{ $item['label'] }}
                    @if ($active)
                        <span class="ml-auto w-1 h-5 rounded-full bg-brand-500"></span>
                    @endif
                </a>
            @endforeach
        </nav>

        {{-- Alt — site önizleme --}}
        <div class="absolute bottom-0 inset-x-0 p-3 border-t border-white/10">
            <a href="{{ url('/') }}" target="_blank"
               class="flex items-center justify-between px-3 py-2.5 rounded-lg bg-white/[0.05] hover:bg-white/[0.10] text-white/80 hover:text-white text-[12.5px] font-medium transition-colors">
                <span class="inline-flex items-center gap-2.5">
                    <i class="fas fa-arrow-up-right-from-square text-[11px] text-leaf-500"></i>
                    Siteyi Görüntüle
                </span>
                <i class="fas fa-chevron-right text-[9px]"></i>
            </a>
        </div>
    </aside>

    {{-- Mobile backdrop --}}
    <div x-show="sidebarOpen" x-cloak
         x-transition.opacity
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-deep-900/50 backdrop-blur-sm z-30 lg:hidden"></div>

    {{-- ============ MAIN ============ --}}
    <div class="lg:pl-64 min-h-screen flex flex-col">

        {{-- Top bar --}}
        <header class="h-16 bg-white border-b border-ink-100 sticky top-0 z-20 flex items-center px-4 lg:px-7 gap-4">
            <button @click="sidebarOpen = !sidebarOpen"
                    class="lg:hidden w-9 h-9 rounded-lg hover:bg-ink-50 inline-flex items-center justify-center text-ink-700 transition-colors">
                <i class="fas fa-bars text-sm"></i>
            </button>

            <div class="flex-1 min-w-0">
                <h1 class="font-display text-[15px] font-bold text-deep-700 leading-tight">@yield('title', 'Gösterge Paneli')</h1>
                <p class="text-[11px] text-ink-400 mt-0.5">@yield('subtitle', 'MEZ Admin Panel')</p>
            </div>

            {{-- User dropdown --}}
            <div class="relative" @click.outside="userMenu = false">
                <button @click="userMenu = !userMenu"
                        class="flex items-center gap-2.5 pr-2 pl-1 py-1 rounded-lg hover:bg-ink-50 transition-colors">
                    <span class="w-9 h-9 rounded-lg bg-gradient-to-br from-deep-500 to-deep-700 text-white inline-flex items-center justify-center font-bold text-[13px] shrink-0">
                        {{ strtoupper(substr($u->name, 0, 1)) }}
                    </span>
                    <div class="hidden sm:block text-left leading-tight">
                        <p class="text-[12.5px] font-semibold text-deep-700">{{ $u->name }}</p>
                        <p class="text-[10px] text-ink-400 font-medium tracking-wider uppercase">{{ $u->roleLabel() }}</p>
                    </div>
                    <i class="fas fa-chevron-down text-[9px] text-ink-400"></i>
                </button>

                <div x-show="userMenu" x-cloak x-transition.opacity.duration.150ms
                     class="absolute right-0 top-full mt-2 w-56 bg-white rounded-xl shadow-[0_12px_32px_color-mix(in_srgb,var(--color-deep-700)_18%,transparent)] border border-ink-100 overflow-hidden">
                    <div class="px-4 py-3 border-b border-ink-100">
                        <p class="text-[12.5px] font-semibold text-deep-700">{{ $u->name }}</p>
                        <p class="text-[11px] text-ink-400 truncate">{{ $u->email }}</p>
                    </div>
                    <div class="p-1.5">
                        <a href="{{ url('/') }}" target="_blank"
                           class="flex items-center gap-2.5 px-3 py-2 rounded-md text-[12.5px] text-ink-700 hover:bg-ink-50 transition-colors">
                            <i class="fas fa-arrow-up-right-from-square text-[10px] text-leaf-500"></i>
                            Siteyi Aç
                        </a>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left flex items-center gap-2.5 px-3 py-2 rounded-md text-[12.5px] text-brand-600 hover:bg-brand-50 transition-colors">
                                <i class="fas fa-right-from-bracket text-[10px]"></i>
                                Çıkış Yap
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        {{-- Content --}}
        <main class="flex-1 p-4 lg:p-7">
            @if (session('ok'))
                <div class="mb-5 flex items-start gap-3 bg-leaf-500/10 border border-leaf-500/30 px-4 py-3 rounded-lg">
                    <i class="fas fa-circle-check text-leaf-600 mt-0.5"></i>
                    <p class="text-[13px] text-leaf-700 font-medium leading-snug">{{ session('ok') }}</p>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @stack('scripts')
</body>
</html>
