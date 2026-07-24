<x-layouts.app title="Input Stok">

    {{-- Header --}}
    <div class="mb-8">
        <p class="text-[13px] font-semibold text-[#114F11] mb-1">Input Produk & Stok</p>
        <h1 class="text-[32px] font-bold text-[#1C1C1E] tracking-tight">Input Stok</h1>
        <p class="text-[15px] text-[#8E8E93] mt-1">Catat barang masuk atau keluar untuk produk yang sudah terdaftar</p>
    </div>

    {{-- Alert Notifikasi --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-[#D1E8D1] border border-[#114F11]/20 text-[#114F11] rounded-xl text-sm flex items-center gap-2">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-[#FF3B30]/10 border border-[#FF3B30]/20 text-[#FF3B30] rounded-xl text-sm flex items-center gap-2">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- Container Alpine JS dengan Spasi Vertikal Antar Kartu (space-y-6) --}}
    <div x-data="{
        type: 'in',
        selectedProduct: '{{ old('product_id') }}',
        isOpen: false,  {{-- Tambahan untuk Dropdown --}}
        search: '',     {{-- Tambahan untuk Pencarian --}}
        qty: {{ old('qty', 1) }},
        products: {{ json_encode($products) }},
        
        get currentProduct() {
            return this.products.find(p => p.id == this.selectedProduct) || null;
        },
        get filteredProducts() { {{-- Filter list produk berdasarkan pencarian --}}
            if (this.search === '') return this.products;
            return this.products.filter(p => p.name.toLowerCase().includes(this.search.toLowerCase()));
        },
        get newStock() {
            if (!this.currentProduct) return 0;
            let val = parseInt(this.qty) || 0;
            return this.type === 'in' 
                ? parseInt(this.currentProduct.stock) + val 
                : Math.max(0, parseInt(this.currentProduct.stock) - val);
        }
    }" class="space-y-6 max-w-4xl mx-auto">

        {{-- KARTU 1: Tab & Form Utama --}}
        <div class="space-y-6">

            {{-- Tab Switcher Stok Masuk / Stok Keluar --}}
            <div class="bg-[#E5E5EA] p-1 rounded-2xl flex text-[14px] font-semibold">
                <button type="button" @click="type = 'in'"
                    :class="type === 'in' ? 'bg-[#114F11] text-white shadow-sm' : 'text-[#8E8E93] hover:text-[#1C1C1E]'"
                    class="flex-1 py-2.5 rounded-xl transition-all duration-200 text-center">
                    Stok Masuk
                </button>
                <button type="button" @click="type = 'out'"
                    :class="type === 'out' ? 'bg-[#FF3B30] text-white shadow-sm' : 'text-[#8E8E93] hover:text-[#1C1C1E]'"
                    class="flex-1 py-2.5 rounded-xl transition-all duration-200 text-center">
                    Stok Keluar
                </button>
            </div>

            {{-- Form Input --}}
            <form method="POST" action="{{ route('stock.store') }}" class="ios-card p-6 space-y-5">
                @csrf
                <input type="hidden" name="type" :value="type">

                {{-- BAGIAN INPUT PRODUK (Diganti menjadi Searchable Dropdown) --}}
                <div class="relative">
                    <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Pilih Produk</label>
                    
                    {{-- Input hidden ini yang akan dikirim ke Laravel --}}
                    <input type="hidden" name="product_id" :value="selectedProduct">
                    
                    {{-- Tombol Dropdown --}}
                    <div @click="isOpen = !isOpen"
                         class="w-full flex items-center justify-between rounded-xl border border-black/10 bg-[#F2F2F7] px-4 py-3 cursor-pointer text-[15px] transition-all"
                         :class="isOpen ? 'bg-white ring-2 ring-[#114F11]/40 border-[#114F11]' : 'hover:bg-black/5'">
                        
                        <span class="truncate pr-4"
                              :class="currentProduct ? 'text-[#1C1C1E] font-medium' : 'text-[#8E8E93]'"
                              x-text="currentProduct ? currentProduct.name : '-- Pilih produk yang ingin dicatat --'"></span>
                        
                        <svg class="w-4 h-4 text-[#8E8E93] transition-transform duration-200 shrink-0" :class="{'rotate-180': isOpen}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    {{-- Panel Pencarian & List Produk --}}
                    <div x-show="isOpen"
                         @click.outside="isOpen = false"
                         x-transition.opacity.duration.200ms
                         style="display: none;"
                         class="absolute w-full top-full mt-2 left-0 bg-white border border-black/10 rounded-xl shadow-xl z-50 overflow-hidden">
                        
                        {{-- Kolom Input Pencarian --}}
                        <div class="p-3 border-b border-black/5 bg-black/5">
                            <div class="relative flex items-center">
                                <svg class="w-4 h-4 absolute left-3 text-[#8E8E93]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <input type="text"
                                       x-model="search"
                                       x-ref="searchInput"
                                       x-effect="if(isOpen) $nextTick(() => $refs.searchInput.focus())"
                                       placeholder="Cari nama produk..."
                                       autocomplete="off"
                                       class="w-full pl-9 pr-3 py-2 bg-white border border-black/10 rounded-lg text-[14px] text-[#1C1C1E] placeholder-[#8E8E93] focus:outline-none focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11]">
                            </div>
                        </div>

                        {{-- Daftar List Produk --}}
                        <div class="max-h-[250px] overflow-y-auto overscroll-contain">
                            <ul class="divide-y divide-black/5 text-left w-full">
                                <template x-for="item in filteredProducts" :key="item.id">
                                    <li @click="selectedProduct = item.id; isOpen = false; search = ''"
                                        class="px-4 py-3 hover:bg-black/5 cursor-pointer transition-colors block w-full">
                                        <div class="flex items-center justify-between">
                                            <p class="text-[14px] font-medium text-[#1C1C1E] truncate pr-4" x-text="item.name"></p>
                                            <p class="text-[12px] text-[#8E8E93] shrink-0 font-medium">Stok saat ini: <span class="text-[#114F11]" x-text="item.stock"></span></p>
                                        </div>
                                    </li>
                                </template>
                                <template x-if="filteredProducts.length === 0">
                                    <li class="px-4 py-6 text-center">
                                        <p class="text-[13px] text-[#8E8E93]">Produk tidak ditemukan.</p>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>
                    @error('product_id') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
                </div>
                {{-- AKHIR BAGIAN INPUT PRODUK --}}

                <div>
                    <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Jumlah (Pcs)</label>
                    <input type="number" name="qty" min="1" x-model="qty" required
                        class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-3 tabular-nums">
                    @error('qty') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Catatan <span class="text-[#8E8E93] font-normal">(opsional)</span></label>
                    <input type="text" name="note" placeholder="mis. Restock supplier, barang rusak, atau retur"
                        class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-3">
                    @error('note') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" 
                        :class="type === 'in' ? 'bg-[#114F11] hover:bg-[#0D3D0D]' : 'bg-[#FF3B30] hover:bg-[#D32F2F]'"
                        class="w-full text-white text-[15px] font-semibold py-3.5 rounded-full transition-colors shadow-sm">
                        Simpan Pergerakan Stok
                    </button>
                </div>
            </form>

        </div>

        {{-- KARTU 2: Detail Informasi Produk (Berjarak Pisah dari Kartu Form) --}}
        <div class="ios-card p-6 mt-6">
            <h3 class="text-[13px] font-semibold text-[#8E8E93] mb-4">Informasi Produk</h3>
            
            {{-- State Belum Pilih Produk --}}
            <template x-if="!currentProduct">
                <div class="py-8 text-center text-[#8E8E93]">
                    <svg class="w-10 h-10 mx-auto mb-2 text-[#C7C7CC]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                    <p class="text-[14px]">Pilih produk di atas untuk melihat simulasi perubahan stok.</p>
                </div>
            </template>

            {{-- State Produk Terpilih --}}
            <template x-if="currentProduct">
                <div class="space-y-4">
                    
                    {{-- Header Produk: Gambar Terkunci Kecil & Teks Berjarak --}}
                    <div class="flex items-center gap-6 pb-4 border-b border-black/5">
                        
                        {{-- Wadah Gambar Terkunci Ukuran 64x64px (Presisi & Kompak) --}}
                        <div class="shrink-0 rounded-2xl bg-[#F2F2F7] border border-black/5 flex items-center justify-center p-2" 
                            style="width: 64px; height: 64px; min-width: 64px; min-height: 64px;">
                            <template x-if="currentProduct.brand && currentProduct.brand.image">
                                <img :src="'/storage/' + currentProduct.brand.image" class="w-full h-full object-contain rounded-xl">
                            </template>
                            <template x-if="!currentProduct.brand || !currentProduct.brand.image">
                                <svg class="w-6 h-6 text-[#C7C7CC]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 6h16a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V7a1 1 0 011-1z" /></svg>
                            </template>
                        </div>

                        {{-- Informasi Teks Nama Produk dengan Jarak/Spasi yang Pas --}}
                        <div class="min-w-0 flex-1 pl-1">
                            <h4 class="text-[17px] font-bold text-[#1C1C1E] tracking-tight leading-snug" x-text="currentProduct.name"></h4>
                            <p class="text-[13px] text-[#8E8E93] mt-1" x-text="(currentProduct.brand ? currentProduct.brand.name : '') + ' · SKU: ' + currentProduct.sku"></p>
                        </div>

                    </div>

                    {{-- Kartu Angka Stok --}}
                    <div class="grid grid-cols-2 gap-4 pt-1">
                        <div class="p-3.5 bg-[#F2F2F7] rounded-2xl">
                            <p class="text-[12px] font-medium text-[#8E8E93]">Stok Saat Ini</p>
                            <p class="text-[22px] font-bold text-[#1C1C1E] tabular-nums mt-0.5" x-text="currentProduct.stock"></p>
                        </div>
                        <div class="p-3.5 rounded-2xl transition-colors duration-200"
                            :class="type === 'in' ? 'bg-[#D1E8D1]/50 text-[#114F11]' : 'bg-[#FF3B30]/10 text-[#FF3B30]'">
                            <p class="text-[12px] font-medium opacity-90" x-text="type === 'in' ? 'Estimasi Stok Baru' : 'Sisa Stok Akhir'"></p>
                            <p class="text-[22px] font-bold tabular-nums mt-0.5" x-text="newStock"></p>
                        </div>
                    </div>

                </div>
            </template>
        </div>

        {{-- KARTU 3: Mini-Tabel 5 Transaksi Terakhir --}}
        @if(isset($recentMovements) && $recentMovements->count() > 0)
            <div class="ios-card p-5 mt-6">
                <h3 class="text-[13px] font-semibold text-[#8E8E93] mb-3">5 Transaksi Terakhir</h3>
                <div class="divide-y divide-black/5 text-[13px]">
                    @foreach($recentMovements->take(5) as $movement)
                        <div class="py-2.5 flex items-center justify-between">
                            <div class="min-w-0 pr-2">
                                <p class="font-medium text-[#1C1C1E] truncate">{{ $movement->product->name ?? 'Produk' }}</p>
                                <p class="text-[12px] text-[#8E8E93]">{{ $movement->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="font-bold tabular-nums shrink-0 text-[14px] {{ $movement->type === 'in' ? 'text-[#114F11]' : 'text-[#FF3B30]' }}">
                                {{ $movement->type === 'in' ? '+' : '-' }}{{ $movement->qty ?? $movement->quantity }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

</x-layouts.app>