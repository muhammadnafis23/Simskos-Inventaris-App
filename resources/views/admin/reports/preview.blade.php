<x-layouts.app title="Export Laporan">

    <div class="mb-8">
        <p class="text-[13px] font-semibold text-[#114F11] uppercase tracking-wide mb-1">Laporan</p>
        <h1 class="text-[32px] font-bold text-[#1C1C1E] tracking-tight">Preview Laporan Stok</h1>
        <p class="text-[15px] text-[#8E8E93] mt-1">Tinjau data sebelum diunduh · {{ $products->count() }} produk</p>
    </div>

    <div class="ios-card overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-black/5">
                        <th class="px-5 py-3 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide">SKU</th>
                        <th class="px-5 py-3 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide">Produk</th>
                        <th class="px-5 py-3 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide">Kategori</th>
                        <th class="px-5 py-3 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide text-right">Stok</th>
                        <th class="px-5 py-3 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide text-right">Harga Jual</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5">
                    @foreach($products as $p)
                        <tr>
                            <td class="px-5 py-3 text-[13px] text-[#3A3A3C]">{{ $p->sku }}</td>
                            <td class="px-5 py-3 text-[14px] font-medium text-[#1C1C1E]">{{ $p->name }}</td>
                            <td class="px-5 py-3 text-[13px] text-[#3A3A3C]">{{ $p->category->name }}</td>
                            <td class="px-5 py-3 text-[14px] font-semibold text-right tabular-nums {{ $p->isLowStock() ? 'text-[#FF3B30]' : 'text-[#1C1C1E]' }}">{{ $p->stock }}</td>
                            <td class="px-5 py-3 text-[14px] text-right tabular-nums text-[#1C1C1E]">Rp{{ number_format($p->sale_price,0,',','.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tombol download di bawah preview --}}
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
        <a href="{{ route('reports.pdf') }}" class="inline-flex items-center justify-center gap-2 bg-[#114F11] text-white text-[15px] font-semibold px-6 py-3 rounded-full hover:bg-[#0D3D0D] transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M4 4h16v16H4V4z" /></svg>
            Download PDF
        </a>
        <a href="{{ route('reports.excel') }}" class="inline-flex items-center justify-center gap-2 bg-[#88E788]/30 text-[#114F11] text-[15px] font-semibold px-6 py-3 rounded-full hover:bg-[#88E788]/50 transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M4 4h16v16H4V4z" /></svg>
            Download Excel
        </a>
    </div>

</x-layouts.app>
