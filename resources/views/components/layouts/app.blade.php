<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'SIMSKOS' }} — Inventaris Kosmetik</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; }
        .ios-card { background: #fff; border-radius: 18px; box-shadow: 0 1px 2px rgba(0,0,0,0.04), 0 8px 24px rgba(0,0,0,0.03); }
        .ios-nav-item { transition: background-color .15s ease; }
        /* Warna aktif sidebar: hijau muda #88E788 sebagai background, hijau tua #114F11 sebagai teks */
        .ios-nav-item.active { background-color: rgba(136,231,136,0.35); color: #114F11; font-weight: 600; }
        .ios-nav-item:not(.active):hover { background-color: rgba(0,0,0,0.03); }
    </style>
</head>
<body class="bg-[#F2F2F7] text-[#1C1C1E] antialiased">
    <div class="min-h-screen flex flex-col md:flex-row">

        {{-- Sidebar (desktop) / Top bar (mobile) --}}
        <aside class="md:w-64 md:min-h-screen md:sticky md:top-0 bg-white border-b md:border-b-0 md:border-r border-black/5">
            <div class="px-5 py-5 flex items-center justify-between md:block">
                <div class="flex items-center gap-3">
                    {{-- GANTI LOGO: taruh file di public/images/logo.png lalu uncomment baris di bawah --}}
                    {{-- <img src="{{ asset('images/logo.png') }}" class="h-9 w-9 rounded-xl object-cover"> --}}
                    <div>
                        {{-- GANTI NAMA TOKO di 2 baris berikut --}}
                        <p class="text-[11px] font-semibold tracking-wide text-[#8E8E93] uppercase">Toko Kosmetik</p>
                        <h1 class="text-xl font-bold text-[#1C1C1E]">SIMSKOS</h1>
                    </div>
                </div>
                <button x-data @click="$dispatch('toggle-sidebar')" class="md:hidden p-2 rounded-full hover:bg-black/5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#1C1C1E]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <nav x-data="{ open: true }" @toggle-sidebar.window="open = !open" :class="open ? 'block' : 'hidden md:block'" class="px-3 pb-6 space-y-6">

                @if(auth()->user()->role === 'admin')
                <div>
                    <p class="px-3 text-[11px] font-semibold tracking-wide text-[#8E8E93] uppercase mb-1.5">Utama</p>
                    <div class="space-y-0.5">
                        <a href="{{ route('admin.dashboard') }}" class="ios-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-[#3A3A3C]' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-[15px]">
                            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                            Dashboard
                        </a>
                    </div>
                </div>

                <div>
                    <p class="px-3 text-[11px] font-semibold tracking-wide text-[#8E8E93] uppercase mb-1.5">Produk</p>
                    <div class="space-y-0.5">
                        <a href="{{ route('products.index') }}" class="ios-nav-item {{ request()->routeIs('products.index') ? 'active' : 'text-[#3A3A3C]' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-[15px]">
                            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                            Daftar Produk
                        </a>
                        <a href="{{ route('categories.index') }}" class="ios-nav-item {{ request()->routeIs('categories.*') ? 'active' : 'text-[#3A3A3C]' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-[15px]">
                            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                            Kategori
                        </a>
                    </div>
                </div>

                <div>
                    <p class="px-3 text-[11px] font-semibold tracking-wide text-[#8E8E93] uppercase mb-1.5">Laporan</p>
                    <div class="space-y-0.5">
                        {{-- Diarahkan ke halaman preview dulu, bukan langsung download --}}
                        <a href="{{ route('reports.preview') }}" class="ios-nav-item {{ request()->routeIs('reports.preview') ? 'active' : 'text-[#3A3A3C]' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-[15px]">
                            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M4 4h16v16H4V4z" /></svg>
                            Export Laporan
                        </a>
                    </div>
                </div>
                @endif

                {{-- Grup menu diubah: dari "Stok" jadi "Input Produk" dengan 2 submenu --}}
                <div>
                    <p class="px-3 text-[11px] font-semibold tracking-wide text-[#8E8E93] uppercase mb-1.5">Input Produk</p>
                    <div class="space-y-0.5">
                        @if(auth()->user()->role === 'admin')
                        <a href="{{ route('products.create') }}" class="ios-nav-item {{ request()->routeIs('products.create') ? 'active' : 'text-[#3A3A3C]' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-[15px]">
                            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            Input Produk Baru
                        </a>
                        @endif
                        <a href="{{ route('stock.create') }}" class="ios-nav-item {{ request()->routeIs('stock.create') ? 'active' : 'text-[#3A3A3C]' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-[15px]">
                            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                            Input Stok
                        </a>
                        <a href="{{ route('stock.index') }}" class="ios-nav-item {{ request()->routeIs('stock.index') ? 'active' : 'text-[#3A3A3C]' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-[15px]">
                            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                            Riwayat Stok
                        </a>
                    </div>
                </div>

                <div class="pt-2 border-t border-black/5">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        {{-- Tombol Keluar tetap warna merah, tidak ikut skema hijau --}}
                        <button type="submit" class="w-full ios-nav-item text-[#FF3B30] flex items-center gap-3 px-3 py-2.5 rounded-xl text-[15px]">
                            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                            Keluar ({{ auth()->user()->name }})
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <main class="flex-1 min-w-0">
            <div class="max-w-5xl mx-auto px-5 py-8 md:px-8 md:py-10">

                @if(session('success'))
                    <div class="ios-card mb-6 px-4 py-3 flex items-center gap-3 border-l-4 border-[#114F11]">
                        <svg class="w-5 h-5 text-[#114F11] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        <p class="text-[14px] text-[#1C1C1E]">{{ session('success') }}</p>
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
