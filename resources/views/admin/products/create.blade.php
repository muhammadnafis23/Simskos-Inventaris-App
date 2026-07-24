<x-layouts.app title="Tambah Produk">

    <div class="mb-8">
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1 text-[14px] font-medium text-[#114F11] mb-3">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
            Produk
        </a>
        <h1 class="text-[32px] font-bold text-[#1C1C1E] dark:text-white tracking-tight">Tambah Produk</h1>
    </div>

    <form method="POST" action="{{ route('products.store') }}" class="space-y-6">
        @csrf

        {{-- Group 1: Info Dasar --}}
        <div class="ios-card p-5 space-y-4">
            <p class="text-[13px] font-semibold text-[#8E8E93] uppercase tracking-wide">Informasi Dasar</p>

            <div>
                <label class="block text-[13px] font-medium text-[#3A3A3C] dark:text-[#E5E5EA] mb-1.5">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                @error('name') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[13px] font-medium text-[#3A3A3C] dark:text-[#E5E5EA] mb-1.5">Brand</label>
                    <select name="brand_id" required
                        class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                        <option value="">Pilih brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" @selected(old('brand_id') == $brand->id)>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[13px] font-medium text-[#3A3A3C] dark:text-[#E5E5EA] mb-1.5">Kategori</label>
                    <select name="category_id" required
                        class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                        <option value="">Pilih kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- SKU Dibuat Readonly Karena Dihasilkan Otomatis di Controller --}}
            <div>
                <label class="block text-[13px] font-medium text-[#3A3A3C] dark:text-[#E5E5EA] mb-1.5">SKU <span class="text-[#8E8E93] font-normal">(Otomatis oleh Sistem)</span></label>
                <input type="text" value="(Otomatis Dibuat saat Disimpan)" disabled
                    class="w-full rounded-xl border-black/10 bg-[#E5E5EA] dark:bg-[#2C2C2E] text-[#8E8E93] text-[15px] px-4 py-2.5 cursor-not-allowed">
            </div>
        </div>

        {{-- Group 2: Harga & Stok --}}
        <div class="ios-card p-5 space-y-4">
            <p class="text-[13px] font-semibold text-[#8E8E93] uppercase tracking-wide">Harga &amp; Stok</p>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[13px] font-medium text-[#3A3A3C] dark:text-[#E5E5EA] mb-1.5">Harga Beli (Rp)</label>
                    <input type="number" name="purchase_price" value="{{ old('purchase_price') }}" required min="0"
                        class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                    @error('purchase_price') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-[13px] font-medium text-[#3A3A3C] dark:text-[#E5E5EA] mb-1.5">Harga Jual (Rp)</label>
                    <input type="number" name="sale_price" value="{{ old('sale_price') }}" required min="0"
                        class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                    @error('sale_price') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[13px] font-medium text-[#3A3A3C] dark:text-[#E5E5EA] mb-1.5">Stok Awal</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" required min="0"
                        class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                    @error('stock') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-[13px] font-medium text-[#3A3A3C] dark:text-[#E5E5EA] mb-1.5">Stok Minimum</label>
                    <input type="number" name="min_stock" value="{{ old('min_stock', 5) }}" required min="0"
                        class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                    @error('min_stock') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
                    <p class="text-[12px] text-[#8E8E93] mt-1">Alert "stok menipis" muncul di dashboard jika stok ≤ angka ini.</p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="bg-[#114F11] text-white text-[15px] font-semibold px-6 py-3 rounded-full hover:bg-[#0D3D0D] transition-colors">
                Simpan Produk
            </button>
            <a href="{{ route('products.index') }}" class="text-[15px] font-medium text-[#8E8E93] px-4 py-3">Batal</a>
        </div>
    </form>

</x-layouts.app>