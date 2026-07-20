<x-layouts.app title="Riwayat Stok">

    <div class="mb-8">
        <p class="text-[13px] font-semibold text-[#114F11] uppercase tracking-wide mb-1">Stok</p>
        <h1 class="text-[32px] font-bold text-[#1C1C1E] tracking-tight">Riwayat Stok</h1>
        <p class="text-[15px] text-[#8E8E93] mt-1">{{ $movements->total() }} pergerakan tercatat</p>
    </div>

    <div class="ios-card overflow-hidden">
        <div class="divide-y divide-black/5">
            @forelse($movements as $m)
                <div class="px-5 py-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 {{ $m->type === 'in' ? 'bg-[#88E788]/30' : 'bg-[#FF3B30]/10' }}">
                        @if($m->type === 'in')
                            <svg class="w-5 h-5 text-[#114F11]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m0 0l-6 6m6-6l6 6" /></svg>
                        @else
                            <svg class="w-5 h-5 text-[#FF3B30]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m0 0l-6-6m6 6l6-6" /></svg>
                        @endif
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-[15px] font-medium text-[#1C1C1E] truncate">{{ $m->product->name }}</p>
                        <p class="text-[13px] text-[#8E8E93]">
                            {{ $m->user->name }} · {{ $m->created_at->format('d M Y, H:i') }}
                            @if($m->note) · {{ $m->note }} @endif
                        </p>
                    </div>
                    <span class="text-[15px] font-bold tabular-nums shrink-0 {{ $m->type === 'in' ? 'text-[#114F11]' : 'text-[#FF3B30]' }}">
                        {{ $m->type === 'in' ? '+' : '−' }}{{ $m->qty }}
                    </span>
                </div>
            @empty
                <div class="px-5 py-12 text-center">
                    <p class="text-[15px] text-[#8E8E93]">Belum ada riwayat pergerakan stok.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="mt-6">
        {{ $movements->links() }}
    </div>

</x-layouts.app>
