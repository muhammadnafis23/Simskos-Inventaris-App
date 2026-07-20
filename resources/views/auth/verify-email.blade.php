<x-layouts.guest>
    <h2 class="text-[20px] font-bold text-[#1C1C1E] mb-1">Verifikasi Email</h2>
    <p class="text-[14px] text-[#8E8E93] mb-6">Kami sudah mengirim link verifikasi ke email kamu. Klik link tersebut sebelum melanjutkan.</p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-[13px] text-[#114F11] font-medium">Link verifikasi baru sudah dikirim ke email kamu.</div>
    @endif

    <div class="flex items-center gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="bg-[#114F11] text-white text-[14px] font-semibold px-5 py-2.5 rounded-xl hover:bg-[#0D3D0D]">
                Kirim Ulang Email
            </button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-[14px] text-[#8E8E93] font-medium">Keluar</button>
        </form>
    </div>
</x-layouts.guest>
