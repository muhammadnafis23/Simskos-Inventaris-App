<x-layouts.guest>
    <h2 class="text-[20px] font-bold text-[#1C1C1E] mb-1">Daftar Akun</h2>
    <p class="text-[14px] text-[#8E8E93] mb-6">Buat akun staff baru</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus
                class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/30 focus:border-[#114F11] text-[15px] px-4 py-2.5">
            @error('name') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/30 focus:border-[#114F11] text-[15px] px-4 py-2.5">
            @error('email') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Password</label>
            <input type="password" name="password" required
                class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/30 focus:border-[#114F11] text-[15px] px-4 py-2.5">
            @error('password') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required
                class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/30 focus:border-[#114F11] text-[15px] px-4 py-2.5">
        </div>

        <button type="submit" class="w-full bg-[#114F11] text-white text-[15px] font-semibold py-3 rounded-xl hover:bg-[#0D3D0D] transition-colors">
            Daftar
        </button>

        <p class="text-center text-[13px] text-[#8E8E93] pt-1">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-[#114F11] font-medium">Masuk</a>
        </p>
    </form>
</x-layouts.guest>
