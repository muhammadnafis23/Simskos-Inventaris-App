<x-layouts.app title="Input Stok">

    <div class="mb-8">
        <p class="text-[13px] font-semibold text-[#114F11] uppercase tracking-wide mb-1">Input Produk</p>
        <h1 class="text-[32px] font-bold text-[#1C1C1E] tracking-tight">Input Stok</h1>
        <p class="text-[15px] text-[#8E8E93] mt-1">Catat barang masuk atau keluar untuk produk yang sudah terdaftar</p>
    </div>

    <form method="POST" action="{{ route('stock.store') }}"
          x-data="{
              type: '{{ old('type', 'in') }}',
              search: '',
              selectedId: '{{ old('product_id') }}',
              selectedLabel: '',
              open: false,
              products: {{ $products->map(fn($p) => ['id' => $p->id, 'name' => $p->name, 'stock' => $p->stock, 'sku' => $p->sku])->toJson() }},
              get filtered() {
                  if (this.search === '') return this.products;
                  return this.products.filter(p => p.name.toLowerCase().includes(this.search.toLowerCase()) || p.sku.toLowerCase().includes(this.search.toLowerCase()));
              },
              select(p) {
                  this.selectedId = p.id;
                  this.selectedLabel = p.name + ' — stok saat ini: ' + p.stock;
                  this.search = '';
                  this.open = false;
              }
          }"
          class="space-y-6">
        @csrf

        {{-- Segmented control: Masuk / Keluar --}}
        <div class="ios-card p-1.5">
            <div class="grid grid-cols-2 gap-1">
                <label class="relative">
                    <input type="radio" name="type" value="in" x-model="type" class="peer sr-only">
                    <div class="cursor-pointer text-center py-2.5 rounded-xl text-[14px] font-semibold transition-colors"
                         :class="type === 'in' ? 'bg-[#114F11] text-white' : 'text-[#8E8E93]'">
                        Stok Masuk
                    </div>
                </label>
                <label class="relative">
                    <input type="radio" name="type" value="out" x-model="type" class="peer sr-only">
                    <div class="cursor-pointer text-center py-2.5 rounded-xl text-[14px] font-semibold transition-colors"
                         :class="type === 'out' ? 'bg-[#FF3B30] text-white' : 'text-[#8E8E93]'">
                        Stok Keluar
                    </div>
                </label>
            </div>
        </div>

        <div class="ios-card p-5 space-y-4">
            {{-- Search + dropdown produk --}}
            <div class="relative">
                <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Produk</label>
                <input type="hidden" name="product_id" x-bind:value="selectedId" required>

                <div class="relative">
                    <svg class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#8E8E93]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    <input type="text"
                        x-model="search"
                        @focus="open = true"
                        @click.outside="open = false"
                        :placeholder="selectedLabel || 'Cari nama produk atau SKU...'"
                        class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/30 focus:border-[#114F11] text-[15px] pl-10 pr-4 py-2.5">
                </div>

                <div x-show="open" x-cloak class="absolute z-10 mt-1.5 w-full max-h-64 overflow-y-auto ios-card p-2">
                    <template x-for="p in filtered" :key="p.id">
                        <button type="button" @click="select(p)"
                            class="w-full text-left px-3 py-2.5 rounded-xl hover:bg-[#88E788]/20 flex items-center justify-between">
                            <div>
                                <p class="text-[14px] font-medium text-[#1C1C1E]" x-text="p.name"></p>
                                <p class="text-[12px] text-[#8E8E93]" x-text="p.sku"></p>
                            </div>
                            <span class="text-[12px] font-semibold text-[#8E8E93]" x-text="'Stok: ' + p.stock"></span>
                        </button>
                    </template>
                    <p x-show="filtered.length === 0" class="text-[13px] text-[#8E8E93] text-center py-3">Produk tidak ditemukan</p>
                </div>
                @error('product_id') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Jumlah</label>
                <input type="number" name="qty" value="{{ old('qty') }}" required min="1"
                    class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/30 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                @error('qty') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-[13px] font-medium text-[#3A3A3C] mb-1.5">Catatan <span class="text-[#8E8E93] font-normal">(opsional)</span></label>
                <input type="text" name="note" value="{{ old('note') }}" placeholder="mis. Restock dari supplier, atau Rusak/kadaluarsa"
                    class="w-full rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/30 focus:border-[#114F11] text-[15px] px-4 py-2.5">
                @error('note') <p class="text-[12px] text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <button type="submit" class="w-full md:w-auto bg-[#114F11] text-white text-[15px] font-semibold px-6 py-3 rounded-full hover:bg-[#0D3D0D] transition-colors">
            Simpan Pergerakan Stok
        </button>
    </form>

</x-layouts.app>
