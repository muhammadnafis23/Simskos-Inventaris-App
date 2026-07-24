<x-layouts.app title="Dashboard">

    <div class="mb-6 sm:mb-8">
        <p class="text-[13px] font-semibold text-[#114F11] uppercase tracking-wide mb-1">Ringkasan</p>
        <h1 class="text-2xl sm:text-[32px] font-bold text-[#1C1C1E] tracking-tight">Dashboard</h1>
        <p class="text-[14px] sm:text-[15px] text-[#8E8E93] mt-1">{{ now()->translatedFormat('l, d F Y') }}</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-8">
        <div class="ios-card p-5">
            <div class="w-9 h-9 rounded-full bg-[#88E788]/30 flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-[#114F11]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
            </div>
            <p class="text-[13px] text-[#8E8E93] font-medium">Total Produk</p>
            <p class="text-2xl sm:text-[26px] font-bold text-[#1C1C1E] tabular-nums">{{ $totalProducts }}</p>
        </div>

        <div class="ios-card p-5">
            <div class="w-9 h-9 rounded-full bg-[#88E788]/30 flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-[#114F11]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 10v2" /></svg>
            </div>
            <p class="text-[13px] text-[#8E8E93] font-medium">Nilai Inventori</p>
            <p class="text-2xl sm:text-[26px] font-bold text-[#1C1C1E] tabular-nums">Rp{{ number_format($totalStockValue, 0, ',', '.') }}</p>
        </div>

        <div class="ios-card p-5 sm:col-span-2 md:col-span-1">
            <div class="w-9 h-9 rounded-full bg-[#FF3B30]/10 flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-[#FF3B30]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-8.99 3.75h.008v.008h-.008v-.008z" /></svg>
            </div>
            <p class="text-[13px] text-[#8E8E93] font-medium">Stok Menipis</p>
            <p class="text-2xl sm:text-[26px] font-bold text-[#1C1C1E] tabular-nums">{{ $lowStock->count() }} item</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="ios-card overflow-hidden">
            <div class="px-5 pt-5 pb-3 flex items-center justify-between">
                <h2 class="text-[17px] font-bold text-[#1C1C1E]">Perlu Restock</h2>
                @if($lowStock->count() > 0)
                    <span class="text-[12px] font-semibold px-2.5 py-0.5 rounded-full bg-[#FF3B30]/10 text-[#FF3B30]">{{ $lowStock->count() }}</span>
                @endif
            </div>
            <div class="divide-y divide-black/5">
                @forelse($lowStock as $product)
                    <div class="px-5 py-3.5 flex items-center justify-between gap-4">
                        <div class="min-w-0 flex-1">
                            <p class="text-[15px] font-medium text-[#1C1C1E] truncate">{{ $product->name }}</p>
                            <p class="text-[13px] text-[#8E8E93]">
                                {{ is_object($product->brand) ? $product->brand->name : ($product->brand ?? 'Tanpa Brand') }}
                            </p>
                        </div>
                        <span class="shrink-0 text-[13px] font-semibold text-[#FF3B30] tabular-nums">
                            {{ $product->stock }} <span class="text-[12px] font-normal text-[#8E8E93]">/ min {{ $product->min_stock }}</span>
                        </span>
                    </div>
                @empty
                    <div class="px-5 py-8 text-center">
                        <p class="text-[14px] text-[#8E8E93]">Semua stok masih aman.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="ios-card overflow-hidden">
            <div class="px-5 pt-5 pb-3">
                <h2 class="text-[17px] font-bold text-[#1C1C1E]">Pergerakan Stok Terbaru</h2>
            </div>
            <div class="divide-y divide-black/5">
                @forelse($recentMovements as $m)
                    <div class="px-5 py-3.5 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 {{ $m->type === 'in' ? 'bg-[#88E788]/30' : 'bg-[#FF3B30]/10' }}">
                            @if($m->type === 'in')
                                <svg class="w-4 h-4 text-[#114F11]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m0 0l-6 6m6-6l6 6" /></svg>
                            @else
                                <svg class="w-4 h-4 text-[#FF3B30]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m0 0l-6-6m6 6l6-6" /></svg>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-[14px] font-medium text-[#1C1C1E] truncate">{{ $m->product->name ?? 'Produk' }}</p>
                            <p class="text-[12px] text-[#8E8E93]">{{ $m->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="text-[13px] font-semibold tabular-nums {{ $m->type === 'in' ? 'text-[#114F11]' : 'text-[#FF3B30]' }}">
                            {{ $m->type === 'in' ? '+' : '−' }}{{ $m->qty ?? $m->quantity }}
                        </span>
                    </div>
                @empty
                    <div class="px-5 py-8 text-center">
                        <p class="text-[14px] text-[#8E8E93]">Belum ada pergerakan stok.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</x-layouts.app>