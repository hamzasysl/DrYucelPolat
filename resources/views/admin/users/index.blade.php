@extends('admin.layouts.app')

@section('title', 'Kullanıcılar')
@section('subtitle', 'Yönetici ve düzenleyici hesapları')

@section('content')

<div class="bg-white rounded-xl border border-ink-100 overflow-hidden">
    <div class="px-5 py-4 border-b border-ink-100 flex items-center justify-between">
        <h2 class="font-display text-[15px] font-bold text-deep-700">Tüm Kullanıcılar</h2>
        <a href="{{ route('admin.users.create') }}"
           class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white text-[12.5px] font-semibold px-3.5 py-2 rounded-lg shadow-[0_4px_10px_color-mix(in_srgb,var(--color-brand-500)_30%,transparent)] transition-all">
            <i class="fas fa-plus text-[11px]"></i>
            Yeni Kullanıcı
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-[13px]">
            <thead class="bg-ink-50/60">
                <tr>
                    <th class="text-left px-5 py-3 text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500">Kullanıcı</th>
                    <th class="text-left px-5 py-3 text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500 hidden md:table-cell">E-posta</th>
                    <th class="text-left px-5 py-3 text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500">Rol</th>
                    <th class="text-left px-5 py-3 text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500">Durum</th>
                    <th class="text-right px-5 py-3 text-[10.5px] font-bold tracking-[0.18em] uppercase text-ink-500">İşlem</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-ink-100">
                @forelse ($users as $user)
                    <tr class="hover:bg-ink-50/40">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <span class="w-9 h-9 rounded-lg bg-gradient-to-br from-deep-500 to-deep-700 text-white inline-flex items-center justify-center font-bold text-[12px] shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                                <div>
                                    <p class="font-semibold text-deep-700">{{ $user->name }}</p>
                                    <p class="text-[11px] text-ink-400 font-mono">@<span>{{ $user->username }}</span></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-ink-500 hidden md:table-cell">{{ $user->email }}</td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center text-[10.5px] font-bold px-2.5 py-1 rounded-md uppercase tracking-[0.14em]
                                         {{ $user->isAdmin() ? 'bg-brand-50 text-brand-600' : 'bg-deep-50 text-deep-600' }}">
                                {{ $user->roleLabel() }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center gap-1.5 text-[11.5px] font-medium
                                         {{ $user->is_active ? 'text-leaf-600' : 'text-ink-400' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $user->is_active ? 'bg-leaf-500' : 'bg-ink-300' }}"></span>
                                {{ $user->is_active ? 'Aktif' : 'Pasif' }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-right whitespace-nowrap">
                            <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-md hover:bg-ink-100 text-ink-600 hover:text-deep-600 transition-colors">
                                <i class="fas fa-pen text-[11px]"></i>
                            </a>
                            @if ($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Kullanıcıyı sil?')">
                                    @csrf @method('DELETE')
                                    <button class="inline-flex items-center justify-center w-8 h-8 rounded-md hover:bg-brand-50 text-ink-500 hover:text-brand-600 transition-colors">
                                        <i class="fas fa-trash text-[11px]"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-10 text-center text-ink-400 text-[13px]">Hiç kullanıcı yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($users->hasPages())
        <div class="px-5 py-3 border-t border-ink-100">{{ $users->links() }}</div>
    @endif
</div>

@endsection
