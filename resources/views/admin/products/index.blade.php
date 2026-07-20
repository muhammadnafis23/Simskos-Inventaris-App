<x-layouts.app title="Produk">

    <div class="mb-8 flex items-start justify-between gap-4">
        <div>
            <p class="text-[13px] font-semibold text-[#114F11] uppercase tracking-wide mb-1">Produk</p>
            <h1 class="text-[32px] font-bold text-[#1C1C1E] tracking-tight">Daftar Produk</h1>
            <p class="text-[15px] text-[#8E8E93] mt-1">{{ $products->total() }} produk terdaftar</p>
        </div>
        <a href="{{ route('products.create') }}" class="shrink-0 inline-flex items-center gap-1.5 bg-[#114F11] text-white text-[14px] font-semibold px-4 py-2.5 rounded-full hover:bg-[#0D3D0D] transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
            Tambah Produk
        </a>
    </div>

    <div class="ios-card overflow-hidden">
        {{-- Desktop table --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-black/5">
                        <th class="px-5 py-3 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide">Produk</th>
                        <th class="px-5 py-3 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide">Kategori</th>
                        <th class="px-5 py-3 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide text-right">Harga Jual</th>
                        <th class="px-5 py-3 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide text-right">Stok</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5">
                    @foreach($products as $product)
                        <tr class="hover:bg-black/[0.015]">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-[#F2F2F7] overflow-hidden shrink-0 flex items-center justify-center">
                                        @if($product->image)
                                            <img src="{{ Storage::url($product->image) }}" class="w-full h-full object-cover" alt="{{ $product->name }}">
                                        @else
                                            <svg class="w-5 h-5 text-[#C7C7CC]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 6h16a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V7a1 1 0 011-1z" /></svg>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[14px] font-medium text-[#1C1C1E] truncate">{{ $product->name }}</p>
                                        <p class="text-[12px] text-[#8E8E93]">{{ $product->brand }} · {{ $product->sku }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="text-[13px] px-2.5 py-1 rounded-full bg-[#F2F2F7] text-[#3A3A3C] font-medium">{{ $product->category->name }}</span>
                            </td>
                            <td class="px-5 py-3.5 text-right text-[14px] font-medium text-[#1C1C1E] tabular-nums">Rp{{ number_format($product->sale_price, 0, ',', '.') }}</td>
                            <td class="px-5 py-3.5 text-right">
                                <span class="text-[14px] font-semibold tabular-nums {{ $product->isLowStock() ? 'text-[#FF3B30]' : 'text-[#1C1C1E]' }}">{{ $product->stock }}</span>
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('products.edit', $product) }}" class="p-2 rounded-full hover:bg-black/5 text-[#8E8E93]">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </a>
                                    <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Hapus produk ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 rounded-full hover:bg-[#FF3B30]/10 text-[#FF3B30]">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Mobile cards --}}
        <div class="md:hidden divide-y divide-black/5">
            @foreach($products as $product)
                <div class="px-5 py-4 flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl bg-[#F2F2F7] overflow-hidden shrink-0 flex items-center justify-center">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" class="w-full h-full object-cover" alt="{{ $product->name }}">
                        @else
                            <svg class="w-5 h-5 text-[#C7C7CC]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 6h16a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V7a1 1 0 011-1z" /></svg>
                        @endif
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-[14px] font-medium text-[#1C1C1E] truncate">{{ $product->name }}</p>
                        <p class="text-[12px] text-[#8E8E93]">{{ $product->brand }} · Stok: <span class="{{ $product->isLowStock() ? 'text-[#FF3B30] font-semibold' : '' }}">{{ $product->stock }}</span></p>
                    </div>
                    <a href="{{ route('products.edit', $product) }}" class="p-2 rounded-full hover:bg-black/5 text-[#8E8E93] shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>

</x-layouts.app>
