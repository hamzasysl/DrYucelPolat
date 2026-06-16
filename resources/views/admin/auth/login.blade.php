<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Yönetim Paneli — Giriş | Op. Dr. Yücel Polat</title>
    <meta name="robots" content="noindex, nofollow">

    <link rel="icon" type="image/png" href="{{ asset('favicons/favicon-32.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @vite(['resources/css/app.css'])
</head>
<body class="font-sans antialiased min-h-screen flex items-center justify-center relative overflow-hidden bg-gradient-to-br from-deep-50 via-white to-brand-50/30">

    {{-- Dekoratif arka plan --}}
    <div class="absolute -top-32 -right-32 w-[520px] h-[520px] bg-deep-100/60 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -left-32 w-[480px] h-[480px] bg-brand-100/40 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 w-72 h-72 bg-leaf-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative w-full max-w-md px-5">

        {{-- Ortalı ikon — sade --}}
        <div class="flex justify-center mb-6">
            <div class="relative w-14 h-14 rounded-2xl bg-gradient-to-br from-deep-600 to-deep-800 flex items-center justify-center shadow-[0_10px_28px_color-mix(in_srgb,var(--color-deep-700)_35%,transparent)]">
                <i class="fas fa-shield-halved text-white text-xl"></i>
                <span class="absolute -top-1 -right-1 w-3.5 h-3.5 rounded-full bg-leaf-500 ring-2 ring-white"></span>
            </div>
        </div>

        {{-- Kart --}}
        <div class="relative bg-white rounded-2xl shadow-[0_20px_50px_-12px_color-mix(in_srgb,var(--color-deep-700)_20%,transparent)] border border-ink-100 overflow-hidden">
            {{-- Üst aksan --}}
            <div class="h-1 bg-gradient-to-r from-brand-500 via-leaf-500 to-deep-500"></div>

            <form method="POST" action="{{ route('admin.login.attempt') }}" class="p-7 space-y-5">
                @csrf

                @if ($errors->any())
                    <div class="rounded-lg bg-brand-50/70 border border-brand-200 px-4 py-3">
                        <div class="flex items-start gap-2.5">
                            <i class="fas fa-circle-exclamation text-brand-500 text-[14px] mt-0.5"></i>
                            <p class="text-[13px] text-brand-700 leading-snug">{{ $errors->first() }}</p>
                        </div>
                    </div>
                @endif

                <div>
                    <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">
                        Kullanıcı Adı veya E-posta
                    </label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-3.5 top-1/2 -translate-y-1/2 text-ink-300 text-[12px]"></i>
                        <input type="text" name="login" value="{{ old('login') }}" autofocus required autocomplete="username"
                               class="w-full pl-10 pr-3 py-2.5 rounded-lg border border-ink-200 bg-white text-[14px] text-ink-900 placeholder:text-ink-400 placeholder:font-light focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none transition"
                               placeholder="mezbilisim">
                    </div>
                </div>

                <div>
                    <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">
                        Şifre
                    </label>
                    <div class="relative" x-data="{ show: false }">
                        <i class="fas fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-ink-300 text-[12px]"></i>
                        <input :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password"
                               class="w-full pl-10 pr-10 py-2.5 rounded-lg border border-ink-200 bg-white text-[14px] text-ink-900 placeholder:text-ink-400 focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none transition"
                               placeholder="••••••••">
                        <button type="button" @click="show = !show"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-ink-400 hover:text-deep-500 transition-colors cursor-pointer">
                            <i x-show="!show" class="fas fa-eye text-[12px]"></i>
                            <i x-show="show" x-cloak class="fas fa-eye-slash text-[12px]"></i>
                        </button>
                    </div>
                </div>

                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" value="1" class="rounded border-ink-300 text-deep-500 focus:ring-deep-200">
                    <span class="text-[12.5px] text-ink-500">Beni hatırla</span>
                </label>

                <button type="submit"
                        class="w-full bg-gradient-to-b from-deep-700 to-deep-500 hover:from-deep-800 hover:to-deep-600 text-white font-semibold text-[13.5px] py-3 rounded-lg shadow-[0_8px_20px_color-mix(in_srgb,var(--color-deep-700)_30%,transparent)] hover:shadow-[0_12px_28px_color-mix(in_srgb,var(--color-deep-700)_40%,transparent)] transition-all inline-flex items-center justify-center gap-2 tracking-wide">
                    <i class="fas fa-arrow-right-to-bracket text-[12px]"></i>
                    Giriş Yap
                </button>
            </form>
        </div>

        {{-- Footer brand --}}
        <p class="text-center text-[11px] text-ink-400 mt-6">
            Powered by
            <a href="https://mezbilisim.com" target="_blank" class="font-bold text-deep-600 hover:text-brand-500 transition-colors">
                MEZ Bilişim
            </a>
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
