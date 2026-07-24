<x-layouts.app title="Edit Pengguna">

    <div class="mb-8">
        <a href="{{ route('users.index') }}" class="inline-flex items-center gap-1 text-[14px] font-medium text-[#114F11] mb-3">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
            Kelola Pengguna
        </a>
        <h1 class="text-[32px] font-bold text-[#1C1C1E] tracking-tight">Edit Akun Pengguna</h1>
    </div>

    <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-6 max-w-xl">
        @csrf
        @method('PUT')

        <div class="ios-card p-5 space-y-4">
            <div>
                <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                    class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                @error('name') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                @error('email') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Role / Hak Akses</label>
                <select name="role" required class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                    <option value="user" @selected($user->role === 'user')>User / Karyawan</option>
                    <option value="admin" @selected($user->role === 'admin')>Admin</option>
                </select>
                @error('role') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Password Baru <span class="text-[#8E8E93] font-normal">(opsional)</span></label>
                <input type="password" name="password" placeholder="Biarkan kosong jika tidak ingin mengubah password"
                    class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                @error('password') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="bg-[#114F11] text-white text-[15px] font-semibold px-6 py-3 rounded-full hover:bg-[#0D3D0D] transition-colors">
                Perbarui Pengguna
            </button>
            <a href="{{ route('users.index') }}" class="text-[15px] font-medium text-[#8E8E93] px-4 py-3">Batal</a>
        </div>
    </form>

</x-layouts.app>