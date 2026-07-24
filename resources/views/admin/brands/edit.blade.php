<x-layouts.app title="Edit Brand">
    <div class="mb-6">
        <a href="{{ route('brands.index') }}" class="text-sm font-medium text-[#114F11] mb-2 inline-block">&larr; Kembali ke Brand</a>
        <h1 class="text-[28px] font-bold text-[#1C1C1E]">Edit Brand</h1>
    </div>

    <form method="POST" action="{{ route('brands.update', $brand) }}" enctype="multipart/form-data" class="ios-card p-6 space-y-4 max-w-lg">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium text-[#3A3A3C] mb-1">Nama Brand</label>
            <input type="text" name="name" value="{{ old('name', $brand->name) }}" required
                   class="w-full rounded-xl border-black/10 bg-[#F2F2F7] px-4 py-2.5 text-sm focus:bg-white focus:ring-2 focus:ring-[#114F11]">
            @error('name') <p class="text-xs text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-[#3A3A3C] mb-1">Gambar Logo Saat Ini</label>
            <img src="{{ asset('storage/' . ($brand->image ?? 'brands/default.png')) }}" class="w-16 h-16 object-cover rounded-lg border mb-2">
            <input type="file" name="image" accept="image/*"
                   class="w-full text-sm text-[#3A3A3C] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#114F11]/10 file:text-[#114F11]">
            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
            @error('image') <p class="text-xs text-[#FF3B30] mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-[#114F11] text-white px-6 py-2.5 rounded-full text-sm font-semibold hover:bg-[#0D3D0D]">
            Perbarui Brand
        </button>
    </form>
</x-layouts.app>