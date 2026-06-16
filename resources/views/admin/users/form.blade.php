@extends('admin.layouts.app')

@section('title', $user->exists ? 'Kullanıcı Düzenle' : 'Yeni Kullanıcı')
@section('subtitle', 'Hesap bilgileri ve yetki')

@section('content')

<div class="max-w-2xl">
    <form method="POST" action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}"
          class="bg-white rounded-xl border border-ink-100 p-6 space-y-5 shadow-[0_2px_8px_color-mix(in_srgb,var(--color-deep-700)_4%,transparent)]">
        @csrf
        @if ($user->exists) @method('PUT') @endif

        @if ($errors->any())
            <div class="rounded-lg bg-brand-50 border border-brand-200 px-4 py-3">
                <ul class="text-[12.5px] text-brand-700 leading-relaxed list-disc list-inside">
                    @foreach ($errors->all() as $err)<li>{{ $err }}</li>@endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">Ad Soyad <span class="text-brand-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full px-3 py-2.5 rounded-lg border border-ink-200 text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none transition">
            </div>
            <div>
                <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">Kullanıcı Adı <span class="text-brand-500">*</span></label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" required
                       class="w-full px-3 py-2.5 rounded-lg border border-ink-200 text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none transition font-mono">
            </div>
            <div>
                <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">E-posta <span class="text-brand-500">*</span></label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full px-3 py-2.5 rounded-lg border border-ink-200 text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none transition">
            </div>
            <div>
                <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">Rol <span class="text-brand-500">*</span></label>
                <select name="role" class="w-full px-3 py-2.5 rounded-lg border border-ink-200 text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none transition">
                    <option value="editor" @selected(old('role', $user->role) === 'editor')>Düzenleyici</option>
                    <option value="admin"  @selected(old('role', $user->role) === 'admin')>Yönetici</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 mb-2">
                Şifre {!! $user->exists ? '<span class="text-ink-300 normal-case tracking-normal font-normal text-[10px] ml-1">(boş = değişmesin)</span>' : '<span class="text-brand-500">*</span>' !!}
            </label>
            <input type="text" name="password" value="{{ old('password') }}" @if(!$user->exists) required @endif minlength="8"
                   class="w-full px-3 py-2.5 rounded-lg border border-ink-200 text-[14px] focus:border-deep-500 focus:ring-2 focus:ring-deep-100 outline-none transition font-mono">
        </div>

        <label class="flex items-center gap-2.5 cursor-pointer">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active ?? 1) ? 'checked' : '' }} class="rounded border-ink-300 text-deep-500 focus:ring-deep-200">
            <span class="text-[13px] text-ink-700">Hesap aktif</span>
        </label>

        <div class="pt-3 border-t border-ink-100 flex items-center gap-3">
            <button type="submit" class="inline-flex items-center gap-2 bg-deep-700 hover:bg-deep-800 text-white font-semibold text-[13px] px-5 py-2.5 rounded-lg transition-colors">
                <i class="fas fa-floppy-disk text-[11px]"></i>
                Kaydet
            </button>
            <a href="{{ route('admin.users.index') }}" class="text-[12.5px] text-ink-500 hover:text-deep-600 transition-colors">İptal</a>
        </div>
    </form>
</div>

@endsection
