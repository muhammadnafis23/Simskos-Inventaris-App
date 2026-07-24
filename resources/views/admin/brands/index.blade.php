<x-layouts.app title="Brand">

    <div class="mb-8 flex items-start justify-between gap-4">
        <div>
            <p class="text-[13px] font-semibold text-[#114F11] uppercase tracking-wide mb-1">Produk</p>
            <h1 class="text-[32px] font-bold text-[#1C1C1E] tracking-tight">Daftar Brand</h1>
            <p class="text-[15px] text-[#8E8E93] mt-1">{{ $brands->total() }} brand terdaftar</p>
        </div>
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('brands.create') }}" class="shrink-0 inline-flex items-center gap-1.5 bg-[#114F11] text-white text-[14px] font-semibold px-4 py-2.5 rounded-full hover:bg-[#0D3D0D] transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
            Tambah Brand
        </a>
        @endif
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-[#D1E8D1] border border-[#114F11]/20 text-[#114F11] rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-[#FF3B30]/10 border border-[#FF3B30]/20 text-[#FF3B30] rounded-xl text-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="ios-card overflow-hidden">
        {{-- Desktop table --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-black/5">
                        <th class="px-5 py-3 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide">Brand</th>
                        <th class="px-5 py-3 text-[12px] font-semibold text-[#8E8E93] uppercase tracking-wide text-right">Jumlah Produk</th>
                        @if(auth()->user()->role === 'admin')
                            <th class="px-5 py-3"></th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5">
                    @foreach($brands as $brand)
                        <tr class="hover:bg-black/[0.015]">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-[#F2F2F7] overflow-hidden shrink-0 flex items-center justify-center">
                                        @if($brand->image && $brand->image !== 'brands/default.png')
                                            <img src="{{ Storage::url($brand->image) }}" class="w-full h-full object-cover" alt="{{ $brand->name }}">
                                        @else
                                            <svg class="w-5 h-5 text-[#C7C7CC]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 6h16a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V7a1 1 0 011-1z" /></svg>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[14px] font-medium text-[#1C1C1E] truncate">{{ $brand->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-right text-[14px] font-medium text-[#1C1C1E] tabular-nums">
                                {{ $brand->products_count ?? $brand->products()->count() }}
                            </td>
                            @if(auth()->user()->role === 'admin')
                                <td class="px-5 py-3.5 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('brands.edit', $brand) }}" class="p-2 rounded-full hover:bg-black/5 text-[#8E8E93]">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </a>
                                        <form method="POST" action="{{ route('brands.destroy', $brand) }}" onsubmit="return confirm('Hapus brand ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 rounded-full hover:bg-[#FF3B30]/10 text-[#FF3B30]">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Mobile cards --}}
        <div class="md:hidden divide-y divide-black/5">
            @foreach($brands as $brand)
                <div class="px-5 py-4 flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl bg-[#F2F2F7] overflow-hidden shrink-0 flex items-center justify-center">
                        @if($brand->image && $brand->image !== 'brands/default.png')
                            <img src="{{ Storage::url($brand->image) }}" class="w-full h-full object-cover" alt="{{ $brand->name }}">
                        @else
                            <svg class="w-5 h-5 text-[#C7C7CC]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 6h16a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V7a1 1 0 011-1z" /></svg>
                        @endif
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-[14px] font-medium text-[#1C1C1E] truncate">{{ $brand->name }}</p>
                        <p class="text-[12px] text-[#8E8E93]">{{ $brand->products_count ?? $brand->products()->count() }} Produk</p>
                    </div>
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('brands.edit', $brand) }}" class="p-2 rounded-full hover:bg-black/5 text-[#8E8E93] shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                    </a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-6">
        {{ $brands->links() }}
    </div>

</x-layouts.app>