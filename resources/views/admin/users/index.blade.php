<x-layouts.app title="Manajemen Pengguna">

    <div class="mb-8 flex items-start justify-between gap-4">
        <div>
            <p class="text-[13px] font-semibold text-[#114F11] uppercase tracking-wide mb-1">Pengaturan</p>
            <h1 class="text-[32px] font-bold text-[#1C1C1E] tracking-tight">Kelola Pengguna</h1>
            <p class="text-[15px] text-[#8E8E93] mt-1">{{ $users->total() }} akun karyawan terdaftar</p>
        </div>
        <a href="{{ route('users.create') }}" class="shrink-0 inline-flex items-center gap-1.5 bg-[#114F11] text-white text-[14px] font-semibold px-4 py-2.5 rounded-full hover:bg-[#0D3D0D] transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
            Tambah Pengguna
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-[#D1E8D1] border border-[#114F11]/20 text-[#114F11] rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-[#FF3B30]/10 border border-[#FF3B30]/20 text-[#FF3B30] rounded-xl text-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="ios-card overflow-hidden">
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-black/5">
                        <th class="px-5 py-3 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide">Nama</th>
                        <th class="px-5 py-3 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide">Email</th>
                        <th class="px-5 py-3 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide">Peran (Role)</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5">
                    @foreach($users as $user)
                        <tr class="hover:bg-black/[0.015]">
                            <td class="px-5 py-3.5 font-medium text-[#1C1C1E] text-[14px]">{{ $user->name }}</td>
                            <td class="px-5 py-3.5 text-[#8E8E93] text-[14px]">{{ $user->email }}</td>
                            <td class="px-5 py-3.5">
                                <span class="text-[12px] px-2.5 py-1 rounded-full font-semibold {{ $user->role === 'admin' ? 'bg-[#114F11]/10 text-[#114F11]' : 'bg-[#F2F2F7] text-[#3A3A3C]' }}">
                                    {{ strtoupper($user->role) }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('users.edit', $user) }}" class="p-2 rounded-full hover:bg-black/5 text-[#8E8E93]">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </a>
                                    <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Hapus akun ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 rounded-full hover:bg-[#FF3B30]/10 text-[#FF3B30]">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>

</x-layouts.app>