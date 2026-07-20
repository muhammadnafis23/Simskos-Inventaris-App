<x-layouts.app title="Kategori">

    <div class="mb-8">
        <p class="text-[13px] font-semibold text-[#114F11] uppercase tracking-wide mb-1">Produk</p>
        <h1 class="text-[32px] font-bold text-[#1C1C1E] tracking-tight">Kategori</h1>
    </div>

    <div class="ios-card p-5 mb-6">
        <form method="POST" action="{{ route('categories.store') }}" class="flex gap-3">
            @csrf
            <input type="text" name="name" placeholder="Nama kategori baru" required
                class="flex-1 rounded-xl border-black/10 bg-[#F2F2F7] focus:bg-white focus:ring-2 focus:ring-[#114F11]/30 focus:border-[#114F11] text-[15px] px-4 py-2.5">
            <button type="submit" class="bg-[#114F11] text-white text-[14px] font-semibold px-5 rounded-xl hover:bg-[#0D3D0D]">Tambah</button>
        </form>
        @error('name') <p class="text-[12px] text-[#FF3B30] mt-2">{{ $message }}</p> @enderror
    </div>

    <div class="ios-card overflow-hidden">
        <div class="divide-y divide-black/5">
            @foreach($categories as $category)
                <div class="px-5 py-3.5 flex items-center justify-between">
                    <div>
                        <p class="text-[15px] font-medium text-[#1C1C1E]">{{ $category->name }}</p>
                        <p class="text-[12px] text-[#8E8E93]">{{ $category->products_count }} produk</p>
                    </div>
                    <form method="POST" action="{{ route('categories.destroy', $category) }}" onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 rounded-full hover:bg-[#FF3B30]/10 text-[#FF3B30]">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

</x-layouts.app>
