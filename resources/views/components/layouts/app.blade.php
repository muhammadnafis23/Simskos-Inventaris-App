    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'SIMSKOS' }} — Inventaris Kosmetik</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        {{-- Script Inisialisasi Dark Mode --}}
        <script>
            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; }
            
            .ios-card { background: #fff; border-radius: 18px; box-shadow: 0 1px 2px rgba(0,0,0,0.04), 0 8px 24px rgba(0,0,0,0.03); }
            .ios-nav-item { transition: background-color .15s ease, color .15s ease; }
            .ios-nav-item.active { background-color: rgba(136,231,136,0.35); color: #114F11; font-weight: 600; }
            .ios-nav-item:not(.active):hover { background-color: rgba(0,0,0,0.03); }

            html.dark body { background-color: #000000; color: #F2F2F7; }
            html.dark aside { background-color: #1C1C1E; border-color: rgba(255,255,255,0.1); }
            html.dark .ios-card { background-color: #1C1C1E; color: #F2F2F7; box-shadow: 0 4px 20px rgba(0,0,0,0.5); }
            html.dark .ios-nav-item.active { background-color: #114F11; color: #ffffff; }
            html.dark .ios-nav-item:not(.active) { color: #A1A1A6; }
            html.dark .ios-nav-item:not(.active):hover { background-color: rgba(255,255,255,0.08); color: #FFFFFF; }
            html.dark input, html.dark select, html.dark textarea { background-color: #2C2C2E !important; color: #FFFFFF !important; border-color: rgba(255,255,255,0.1) !important; }
            
            html.dark .text-\[\#1C1C1E\] { color: #FFFFFF !important; }
            html.dark .text-\[\#3A3A3C\] { color: #E5E5EA !important; }
            html.dark .bg-\[\#F2F2F7\] { background-color: #2C2C2E !important; }
            
            html.dark .text-\[\#114F11\] { color: #88E788 !important; }
            html.dark .bg-\[\#D1E8D1\] { background-color: rgba(136,231,136,0.15) !important; }
            html.dark .border-\[\#114F11\]\/20 { border-color: rgba(136,231,136,0.2) !important; }

            .simskos-title { color: #000000 !important; }
            html.dark .simskos-title { color: #FFFFFF !important; }
        </style>
    </head>
    <body class="bg-[#F2F2F7] text-[#1C1C1E] antialiased transition-colors duration-200">
        <div class="min-h-screen flex flex-col md:flex-row">

            {{-- Sidebar Responsif --}}
            <aside class="w-full md:w-72 shrink-0 md:min-h-screen md:sticky md:top-0 bg-white border-b md:border-b-0 md:border-r border-black/5 transition-colors duration-200 z-30">
                
                {{-- Header Sidebar --}}
                <div class="px-4 sm:px-5 py-4 sm:py-5 flex items-center justify-between border-b md:border-b-0 border-black/5">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-10 h-10 rounded-xl bg-[#114F11] overflow-hidden shrink-0 flex items-center justify-center text-white font-bold text-lg shadow-sm">
                            <img src="{{ asset('images/logo.png') }}" alt="SIMSKOS Logo" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <span style="display:none;">S</span>
                        </div>

                        <div class="flex flex-col justify-center min-w-0">
                            <h1 class="simskos-title text-[17px] font-bold leading-none tracking-tight">SIMSKOS</h1>
                            <p class="text-[10px] font-semibold tracking-wider text-[#8E8E93] dark:text-[#A1A1A6] uppercase mt-1 whitespace-nowrap">Toko Kosmetik</p>
                        </div>
                    </div>

                    {{-- Tombol Switch Dark Mode & Hamburger Menu --}}
                    <div class="flex items-center gap-1 shrink-0 pl-2">
                        <button type="button" 
                            x-data 
                            @click="
                                if (document.documentElement.classList.contains('dark')) {
                                    document.documentElement.classList.remove('dark');
                                    localStorage.setItem('theme', 'light');
                                } else {
                                    document.documentElement.classList.add('dark');
                                    localStorage.setItem('theme', 'dark');
                                }
                            "
                            class="p-2 rounded-full hover:bg-black/5 dark:hover:bg-white/10 text-[#8E8E93] dark:text-[#A1A1A6] transition-colors"
                            title="Ubah Tema">
                            <svg class="w-5 h-5 dark:hidden text-[#3A3A3C]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                            <svg class="w-5 h-5 hidden dark:block text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </button>

                        <button x-data @click="$dispatch('toggle-sidebar')" class="md:hidden p-2 rounded-full hover:bg-black/5 dark:hover:bg-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#1C1C1E] dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Navigation Items --}}
                <nav x-data="{ open: false }" @toggle-sidebar.window="open = !open" :class="open ? 'block' : 'hidden md:block'" class="px-3 py-4 md:pb-6 space-y-6">

                    @if(auth()->user()->role === 'admin')
                    <div>
                        <p class="px-3 text-[11px] font-semibold tracking-wide text-[#8E8E93] uppercase mb-1.5 dark:text-[#A1A1A6]">Utama</p>
                        <div class="space-y-0.5">
                            <a href="{{ route('admin.dashboard') }}" class="ios-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-[#3A3A3C]' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-[15px]">
                                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 v4a1 1 0 001 1m-6 0h6" /></svg>
                                Dashboard
                            </a>
                        </div>
                    </div>
                    @endif

                    <div>
                        <p class="px-3 text-[11px] font-semibold tracking-wide text-[#8E8E93] uppercase mb-1.5 dark:text-[#A1A1A6]">Katalog Produk</p>
                        <div class="space-y-0.5">
                            <a href="{{ auth()->user()->role === 'admin' ? route('products.index') : route('products.public_index') }}" class="ios-nav-item {{ (request()->routeIs('products.index') || request()->routeIs('products.public_index') || request()->routeIs('products.edit')) ? 'active' : 'text-[#3A3A3C]' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-[15px]">
                                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                                Daftar Produk
                            </a>
                            <a href="{{ auth()->user()->role === 'admin' ? route('categories.index') : route('categories.public_index') }}" class="ios-nav-item {{ request()->routeIs('categories.*') ? 'active' : 'text-[#3A3A3C]' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-[15px]">
                                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                                Kategori
                            </a>
                            <a href="{{ auth()->user()->role === 'admin' ? route('brands.index') : route('brands.public_index') }}" class="ios-nav-item {{ request()->routeIs('brands.*') ? 'active' : 'text-[#3A3A3C]' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-[15px]">
                                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 002.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" /></svg>
                                Brand
                            </a>
                        </div>
                    </div>

                    @if(auth()->user()->role === 'admin')
                    <div>
                        <p class="px-3 text-[11px] font-semibold tracking-wide text-[#8E8E93] uppercase mb-1.5 dark:text-[#A1A1A6]">Laporan</p>
                        <div class="space-y-0.5">
                            <a href="{{ route('reports.preview') }}" class="ios-nav-item {{ request()->routeIs('reports.*') ? 'active' : 'text-[#3A3A3C]' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-[15px]">
                                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M4 4h16v16H4V4z" /></svg>
                                Export Laporan
                            </a>
                        </div>
                    </div>
                    @endif

                    <div>
                        <p class="px-3 text-[11px] font-semibold tracking-wide text-[#8E8E93] uppercase mb-1.5 dark:text-[#A1A1A6]">Input Produk & Stok</p>
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

                    @if(auth()->user()->role === 'admin')
                    <div>
                        <p class="px-3 text-[11px] font-semibold tracking-wide text-[#8E8E93] uppercase mb-1.5 dark:text-[#A1A1A6]">Pengaturan</p>
                        <div class="space-y-0.5">
                            <a href="{{ route('users.index') }}" class="ios-nav-item {{ request()->routeIs('users.*') ? 'active' : 'text-[#3A3A3C]' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-[15px]">
                                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                Kelola Pengguna
                            </a>
                        </div>
                    </div>
                    @endif

                    <div class="pt-2 border-t border-black/5 dark:border-white/10">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full ios-nav-item text-[#FF3B30] flex items-center gap-3 px-3 py-2.5 rounded-xl text-[15px]">
                                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                Keluar ({{ auth()->user()->name }})
                            </button>
                        </form>
                    </div>
                </nav>
            </aside>

            {{-- Area Konten Utama --}}
            <main class="flex-1 min-w-0">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 py-6 sm:py-8 md:px-8 md:py-10">

                    @if(session('success'))
                        <div class="ios-card mb-6 px-4 py-3 flex items-center gap-3 border-l-4 border-[#114F11]">
                            <svg class="w-5 h-5 text-[#114F11] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                            <p class="text-[14px] text-[#1C1C1E] dark:text-white">{{ session('success') }}</p>
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
    </html>