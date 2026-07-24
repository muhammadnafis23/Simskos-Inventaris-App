<x-layouts.app title="Preview Laporan">

    <div class="mb-6 sm:mb-8 flex flex-col md:flex-row md:items-start justify-between gap-4">
        <div>
            <p class="text-[13px] font-semibold text-[#114F11] uppercase tracking-wide mb-1">Laporan</p>
            <h1 class="text-2xl sm:text-[32px] font-bold text-[#1C1C1E] tracking-tight">Preview Laporan Stok & Aset</h1>
            <p class="text-[14px] sm:text-[15px] text-[#8E8E93] mt-1">Tinjau rekapitulasi nilai modal dan estimasi keuntungan · {{ $totalProducts }} produk</p>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-2 shrink-0 w-full md:w-auto">
            <a href="{{ route('reports.pdf') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#FF3B30] text-white text-[14px] font-semibold px-4 py-2.5 rounded-full hover:bg-[#D32F2F] transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M4 4h16v16H4V4z" /></svg>
                Export PDF
            </a>
            <a href="{{ route('reports.excel') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#114F11] text-white text-[14px] font-semibold px-4 py-2.5 rounded-full hover:bg-[#0D3D0D] transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M4 4h16v16H4V4z" /></svg>
                Export Excel
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="ios-card p-5">
            <p class="text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide mb-1">Total Modal (Aset)</p>
            <h3 class="text-xl sm:text-[24px] font-bold text-[#1C1C1E] tabular-nums">
                Rp{{ number_format($totalAssetModal, 0, ',', '.') }}
            </h3>
            <p class="text-[12px] text-[#8E8E93] mt-1">Total akumulasi modal produk</p>
        </div>

        <div class="ios-card p-5">
            <p class="text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide mb-1">Nilai Potensi Jual</p>
            <h3 class="text-xl sm:text-[24px] font-bold text-[#1C1C1E] tabular-nums">
                Rp{{ number_format($totalAssetJual, 0, ',', '.') }}
            </h3>
            <p class="text-[12px] text-[#8E8E93] mt-1">Jika seluruh stok habis terjual</p>
        </div>

        <div class="ios-card p-5">
            <p class="text-[12px] font-semibold text-[#114F11] uppercase tracking-wide mb-1">Estimasi Keuntungan</p>
            <h3 class="text-xl sm:text-[24px] font-bold text-[#114F11] tabular-nums">
                +Rp{{ number_format($totalEstimasiProfit, 0, ',', '.') }}
            </h3>
            <p class="text-[12px] text-[#8E8E93] mt-1">Potensi laba kotor toko</p>
        </div>
    </div>

    <div class="ios-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[700px]">
                <thead>
                    <tr class="border-b border-black/5 bg-black/[0.02]">
                        <th class="px-5 py-3.5 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide">SKU</th>
                        <th class="px-5 py-3.5 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide">Produk</th>
                        <th class="px-5 py-3.5 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide">Kategori</th>
                        <th class="px-5 py-3.5 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide text-right">Stok</th>
                        <th class="px-5 py-3.5 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide text-right">Harga Beli</th>
                        <th class="px-5 py-3.5 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide text-right">Harga Jual</th>
                        <th class="px-5 py-3.5 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide text-right">Total Nilai Modal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5">
                    @foreach($products as $product)
                        @php
                            $subtotalModal = $product->stock * $product->purchase_price;
                        @endphp
                        <tr class="hover:bg-black/[0.015]">
                            <td class="px-5 py-3.5 text-[13px] font-medium text-[#8E8E93]">{{ $product->sku }}</td>
                            <td class="px-5 py-3.5">
                                <p class="text-[14px] font-medium text-[#1C1C1E]">{{ $product->name }}</p>
                                <p class="text-[12px] text-[#8E8E93]">{{ $product->brand->name ?? $product->brand }}</p>
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="text-[12px] px-2.5 py-1 rounded-full bg-black/5 opacity-80 font-medium">{{ $product->category->name }}</span>
                            </td>
                            <td class="px-5 py-3.5 text-right font-semibold text-[14px] tabular-nums text-[#1C1C1E]">
                                {{ $product->stock }}
                            </td>
                            <td class="px-5 py-3.5 text-right text-[14px] text-[#8E8E93] tabular-nums">
                                Rp{{ number_format($product->purchase_price, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-3.5 text-right text-[14px] font-medium text-[#1C1C1E] tabular-nums">
                                Rp{{ number_format($product->selling_price ?? $product->sale_price, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-3.5 text-right text-[14px] font-semibold text-[#1C1C1E] tabular-nums">
                                Rp{{ number_format($subtotalModal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="border-t-2 border-black/10 bg-black/[0.02]">
                    <tr>
                        <td colspan="3" class="px-5 py-4 font-bold text-[14px] text-[#1C1C1E]">TOTAL AKUMULASI</td>
                        <td class="px-5 py-4 text-right font-bold text-[14px] text-[#1C1C1E] tabular-nums">{{ $products->sum('stock') }}</td>
                        <td colspan="2" class="px-5 py-4"></td>
                        <td class="px-5 py-4 text-right font-bold text-[15px] text-[#114F11] tabular-nums">Rp{{ number_format($totalAssetModal, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</x-layouts.app>