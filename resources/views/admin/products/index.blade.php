<x-layouts.app title="Daftar Produk">

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.4s ease-out forwards;
        }
        .animation-delay-100 { animation-delay: 100ms; }
    </style>
    
    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <p class="text-[13px] font-semibold text-[#114F11] dark:text-[#88E788] uppercase tracking-wide mb-1">Produk</p>
            <h1 class="text-[32px] font-bold text-[#1C1C1E] dark:text-white tracking-tight">Daftar Produk</h1>
            <p class="text-[15px] text-[#8E8E93] dark:text-[#A1A1A6] mt-1">{{ $products->total() }} produk terdaftar</p>
        </div>

        @if(auth()->user()->role === 'admin')
        <a href="{{ route('products.create') }}" class="bg-[#114F11] hover:bg-[#0d3f0d] text-white text-[14px] font-semibold px-4 py-2.5 rounded-xl shadow-sm transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
            Tambah Produk
        </a>
        @endif
    </div>

    {{-- SECTION PENCARIAN --}}
    <div class="ios-card p-5 mb-6 relative z-50" 
         x-data="{ 
             search: '{{ request('search') }}',
             results: [],
             isOpen: false,
             isLoading: false,
             
             fetchPreview() {
                 if (this.search.trim().length < 1) {
                     this.results = [];
                     this.isOpen = false;
                     return;
                 }
                 
                 this.isLoading = true;
                 
                 fetch('{{ route('products.index') }}?search=' + encodeURIComponent(this.search), {
                     headers: {
                         'X-Requested-With': 'XMLHttpRequest',
                         'Accept': 'application/json'
                     }
                 })
                 .then(res => res.json())
                 .then(data => {
                     this.results = data;
                     this.isOpen = true;
                     this.isLoading = false;
                 })
                 .catch(() => { this.isLoading = false; });
             },
             
             selectItem(itemName) {
                 this.search = itemName;
                 this.isOpen = false;
                 $refs.searchForm.submit(); 
             }
         }">
        
        <form x-ref="searchForm" method="GET" action="{{ url()->current() }}" class="flex gap-3 relative">
            
            <div class="relative flex-1 w-full">
                <input type="text" 
                    name="search" 
                    x-model="search"
                    @input.debounce.300ms="fetchPreview()"
                    @focus="if(results.length > 0 && search.trim().length > 0) isOpen = true"
                    @keydown.escape="isOpen = false"
                    @keydown.enter.prevent="$refs.searchForm.submit()"
                    autocomplete="off"
                    placeholder="Cari nama produk, brand, atau harga..." 
                    class="w-full flex-1 rounded-xl border-black/10 dark:border-white/10 bg-[#F2F2F7] dark:bg-[#1C1C1E] focus:bg-white dark:focus:bg-[#2C2C2E] focus:ring-2 focus:ring-[#114F11]/30 dark:focus:ring-[#88E788]/30 focus:border-[#114F11] dark:focus:border-[#88E788] text-[15px] text-[#1C1C1E] dark:text-white px-4 py-2.5 transition-all">
                
                <div x-show="isOpen" 
                     @click.outside="isOpen = false"
                     x-transition.opacity.duration.200ms
                     style="display: none;"
                     class="absolute w-full top-full mt-2 left-0 bg-white dark:bg-[#2C2C2E] border border-black/5 dark:border-white/10 rounded-xl shadow-xl z-50 overflow-hidden">
                    
                    <div class="max-h-[300px] overflow-y-auto overscroll-contain">
                        <template x-if="results.length > 0">
                            <ul class="divide-y divide-black/5 dark:divide-white/10 text-left w-full">
                                <template x-for="item in results" :key="item.sku">
                                    <li @click="selectItem(item.name)" class="px-4 py-2.5 hover:bg-black/5 dark:hover:bg-white/5 cursor-pointer transition-colors group block w-full">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-[13px] font-semibold text-[#1C1C1E] dark:text-white group-hover:text-[#114F11] dark:group-hover:text-[#88E788] transition-colors" x-text="item.name"></p>
                                                <p class="text-[11px] text-[#8E8E93] dark:text-[#A1A1A6] mt-0.5">
                                                    <span x-text="item.brand"></span> · <span x-text="item.category"></span>
                                                </p>
                                            </div>
                                            <div class="text-right shrink-0 ml-3">
                                                <p class="text-[13px] font-semibold text-[#1C1C1E] dark:text-white">Rp<span x-text="item.price"></span></p>
                                                <p class="text-[11px] text-[#8E8E93] mt-0.5">Stok: <span x-text="item.stock"></span></p>
                                            </div>
                                        </div>
                                    </li>
                                </template>
                                
                                <li @click="$refs.searchForm.submit()" class="px-4 py-3 bg-black/[0.02] dark:bg-white/[0.02] hover:bg-black/5 dark:hover:bg-white/5 cursor-pointer text-center transition-colors block w-full">
                                    <p class="text-[12px] font-semibold text-[#114F11] dark:text-[#88E788]">
                                        Lihat semua hasil &rarr;
                                    </p>
                                </li>
                            </ul>
                        </template>

                        <template x-if="results.length === 0 && search.trim().length > 0">
                            <div class="px-4 py-6 text-center text-[#8E8E93] dark:text-[#A1A1A6] w-full">
                                <svg class="w-6 h-6 mx-auto mb-1 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                <p class="text-[13px] font-medium">Tidak ada preview yang cocok</p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <button type="submit" class="bg-[#114F11] text-white text-[14px] font-semibold px-5 rounded-xl hover:bg-[#0D3D0D] transition-colors shrink-0">
                Cari
            </button>
        </form>

        @if(request('search'))
            <div class="mt-3 opacity-0 animate-fade-in-up">
                <p class="text-[13px] text-[#8E8E93] dark:text-[#A1A1A6]">
                    Menampilkan hasil untuk "<span class="font-semibold text-[#1C1C1E] dark:text-white">{{ request('search') }}</span>"
                </p>
            </div>
        @endif
    </div>

    {{-- TABEL PRODUK --}}
    <div class="ios-card overflow-hidden opacity-0 animate-fade-in-up animation-delay-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-black/5 dark:border-white/10 text-[11px] font-semibold text-[#8E8E93] dark:text-[#A1A1A6] uppercase tracking-wider bg-black/[0.01] dark:bg-white/[0.01]">
                        <th class="px-5 py-3.5">Produk</th>
                        <th class="px-5 py-3.5">Kategori</th>
                        <th class="px-5 py-3.5">Harga Jual</th>
                        <th class="px-5 py-3.5">Stok</th>
                        @if(auth()->user()->role === 'admin')
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5 dark:divide-white/10 text-[14px]">
                    @forelse($products as $product)
                    <tr class="hover:bg-black/[0.02] dark:hover:bg-white/[0.02] transition-colors duration-150">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-black/5 dark:bg-white/10 shrink-0 flex items-center justify-center text-[#8E8E93]">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-[#1C1C1E] dark:text-white leading-snug">{{ $product->name }}</p>
                                    <p class="text-[12px] text-[#8E8E93] dark:text-[#A1A1A6]">
                                        {{ $product->brand->name ?? '-' }} · <span class="font-mono">{{ $product->sku }}</span>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-flex px-2.5 py-1 rounded-lg text-[12px] font-medium bg-black/5 dark:bg-white/10 text-[#3A3A3C] dark:text-[#E5E5EA]">
                                {{ $product->category->name ?? '-' }}
                            </span>
                        </td>
                        <td class="px-5 py-4 font-semibold text-[#1C1C1E] dark:text-white">
                            Rp{{ number_format($product->selling_price, 0, ',', '.') }}
                        </td>
                        <td class="px-5 py-4 font-semibold {{ $product->stock <= $product->min_stock ? 'text-[#FF3B30]' : 'text-[#1C1C1E] dark:text-white' }}">
                            {{ $product->stock }}
                        </td>
                        @if(auth()->user()->role === 'admin')
                        <td class="px-5 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('products.edit', $product) }}" class="p-1.5 text-[#8E8E93] hover:text-[#114F11] dark:hover:text-[#88E788] transition-colors rounded-lg hover:bg-black/5 dark:hover:bg-white/5" title="Edit">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                </a>
                                
                                {{-- Tombol Hapus (Sekarang default warna merah) --}}
                                <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-[#FF3B30] hover:bg-[#FF3B30]/10 transition-colors rounded-lg" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center text-[#8E8E93] dark:text-[#A1A1A6]">
                            Tidak ada produk yang ditemukan{{ request('search') ? ' untuk "' . request('search') . '"' : '' }}.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
        <div class="px-5 py-4 border-t border-black/5 dark:border-white/10">
            {{ $products->links() }}
        </div>
        @endif
    </div>

</x-layouts.app>