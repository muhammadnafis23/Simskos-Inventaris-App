<x-layouts.app title="Tambah Produk">

    <div class="mb-8">
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1 text-[14px] font-medium text-[#114F11] mb-3">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
            Produk
        </a>
        <h1 class="text-[32px] font-bold text-[#1C1C1E] tracking-tight">Tambah Produk</h1>
    </div>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Group 1: Info Dasar --}}
        <div class="ios-card p-5 space-y-4">
            <p class="text-[13px] font-semibold text-[#8E8E93] uppercase tracking-wide">Informasi Dasar</p>

            <div>
                <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                @error('name') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Brand</label>
                    <input type="text" name="brand" value="{{ old('brand') }}" required
                        class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                    @error('brand') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Kategori</label>
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

            <div>
                <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">SKU <span class="text-[#8E8E93] font-normal">(kode unik produk)</span></label>
                <input type="text" name="sku" value="{{ old('sku') }}" required placeholder="mis. SK-001"
                    class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                @error('sku') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Group 2: Harga & Stok --}}
        <div class="ios-card p-5 space-y-4">
            <p class="text-[13px] font-semibold text-[#8E8E93] uppercase tracking-wide">Harga &amp; Stok</p>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Harga Beli (Rp)</label>
                    <input type="number" name="purchase_price" value="{{ old('purchase_price') }}" required min="0"
                        class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                    @error('purchase_price') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Harga Jual (Rp)</label>
                    <input type="number" name="sale_price" value="{{ old('sale_price') }}" required min="0"
                        class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                    @error('sale_price') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Stok Awal</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" required min="0"
                        class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                    @error('stock') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Stok Minimum</label>
                    <input type="number" name="min_stock" value="{{ old('min_stock', 5) }}" required min="0"
                        class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/40 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                    @error('min_stock') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
                    <p class="text-[12px] text-[#8E8E93] mt-1">Alert "stok menipis" muncul di dashboard jika stok ≤ angka ini.</p>
                </div>
            </div>
        </div>

        {{-- Group 3: Foto --}}
        <div class="ios-card p-5 space-y-3">
            <p class="text-[13px] font-semibold text-[#8E8E93] uppercase tracking-wide">Foto Produk</p>
            <input type="file" name="image" accept="image/*"
                class="w-full text-[14px] text-[#3A3A3C] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[13px] file:font-semibold file:bg-[#114F11]/10 file:text-[#114F11] hover:file:bg-[#114F11]/20">
            @error('image') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="bg-[#114F11] text-white text-[15px] font-semibold px-6 py-3 rounded-full hover:bg-[#0D3D0D] transition-colors">
                Simpan Produk
            </button>
            <a href="{{ route('products.index') }}" class="text-[15px] font-medium text-[#8E8E93] px-4 py-3">Batal</a>
        </div>
    </form>

</x-layouts.app>
