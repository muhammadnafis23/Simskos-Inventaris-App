<x-layouts.guest>
    <h2 class="text-[20px] font-bold text-[#1C1C1E] mb-1">Masuk</h2>
    <p class="text-[14px] text-[#8E8E93] mb-6">Masuk untuk mengelola inventaris toko</p>

    @if (session('status'))
        <div class="mb-4 text-[13px] text-[#114F11] font-medium">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/30 focus:border-[#114F11] text-[15px] px-4 py-2.5">
            @error('email') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Password</label>
            <input type="password" name="password" required
                class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/30 focus:border-[#114F11] text-[15px] px-4 py-2.5">
            @error('password') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
        </div>

        <label class="flex items-center gap-2 text-[13px] text-[#3A3A3C]">
            <input type="checkbox" name="remember" class="rounded border-black/20 text-[#114F11] focus:ring-[#114F11]/30">
            Ingat saya
        </label>

        <button type="submit" class="w-full bg-[#114F11] text-white text-[15px] font-semibold py-3 rounded-xl hover:bg-[#0D3D0D] transition-colors">
            Masuk
        </button>

        <div class="flex items-center justify-between text-[13px] pt-1">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-[#114F11] font-medium">Lupa password?</a>
            @endif
            <a href="{{ route('register') }}" class="text-[#8E8E93]">Belum punya akun?</a>
        </div>
    </form>
</x-layouts.guest>
