<x-app-layout>
    <div class="space-y-6">

        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Edit Produk</h1>
                <p class="page-subtitle">Perbarui informasi produk: <span
                        class="font-bold text-blue-600">{{ $produk->nama_produk }}</span></p>
            </div>
            <a href="{{ route('admin.produk.index') }}" class="btn-ghost">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card">
            <div class="px-6 py-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <h2 class="text-sm font-black text-slate-800">Edit Formulir Produk</h2>
                </div>
            </div>

            <form action="{{ route('admin.produk.update', $produk->id_produk) }}" method="POST"
                enctype="multipart/form-data" class="p-6 space-y-5" x-data="{ photoPreview: null }">
                @csrf
                @method('PUT')

                {{-- UMKM Pemilik --}}
                <div>
                    <label class="form-label">UMKM Pemilik <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <select name="id_umkm" required
                            class="form-select pl-10 @error('id_umkm') border-red-400 @enderror">
                            @foreach($umkms as $u)
                                <option value="{{ $u->id_umkm }}" {{ old('id_umkm', $produk->id_umkm) == $u->id_umkm ? 'selected' : '' }}>
                                    {{ $u->nama_umkm }} ({{ $u->pemilik }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Nama Produk --}}
                <div>
                    <label class="form-label">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}"
                        required placeholder="contoh: Tas Anyaman Bambu Premium"
                        class="form-input @error('nama_produk') border-red-400 @enderror">
                    @error('nama_produk')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga --}}
                <div>
                    <label class="form-label">Harga (Rupiah) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                            <span class="text-sm font-bold text-slate-400">Rp</span>
                        </div>
                        <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" step="1000" min="0"
                            required class="form-input pl-10 @error('harga') border-red-400 @enderror">
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="form-label">Deskripsi Produk</label>
                    <textarea name="deskripsi" rows="3" placeholder="Deskripsi produk..."
                        class="form-textarea">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                </div>

                {{-- Foto Upload with existing preview --}}
                <div>
                    <label class="form-label">Foto Produk <span
                            class="text-slate-400 font-normal normal-case">(kosongkan jika tidak diubah)</span></label>

                    @if($produk->foto)
                        <div class="mb-3 p-3 bg-slate-50 rounded-xl border border-slate-200 flex items-center gap-3"
                            x-show="!photoPreview">
                            <img src="{{ asset('storage/' . $produk->foto) }}"
                                class="w-16 h-16 rounded-xl object-cover border border-slate-200">
                            <div>
                                <p class="text-xs font-bold text-slate-700">Foto produk saat ini</p>
                                <p class="text-xs text-slate-400 mt-0.5">Upload foto baru untuk mengganti</p>
                            </div>
                        </div>
                    @endif

                    <div class="upload-zone" @click="$refs.fotoInput.click()" @dragover.prevent @drop.prevent="
                            const file = $event.dataTransfer.files[0];
                            if(file) {
                                const reader = new FileReader();
                                reader.onload = e => photoPreview = e.target.result;
                                reader.readAsDataURL(file);
                                $refs.fotoInput.files = $event.dataTransfer.files;
                            }
                         ">
                        <input type="file" name="foto" ref="fotoInput" class="hidden" accept="image/*" @change="
                                const file = $event.target.files[0];
                                if(file) {
                                    const reader = new FileReader();
                                    reader.onload = e => photoPreview = e.target.result;
                                    reader.readAsDataURL(file);
                                }
                               ">

                        <label class="mt-4 block text-left text-xs font-bold text-slate-600" @click.stop>
                            Tambah foto gallery (maks. 6)
                            <input type="file" name="fotos[]" multiple accept="image/png,image/jpeg,image/webp"
                                class="form-input mt-2 text-xs">
                        </label>

                        <template x-if="photoPreview">
                            <div class="flex flex-col items-center">
                                <img :src="photoPreview"
                                    class="w-32 h-32 rounded-xl object-cover mx-auto border-2 border-amber-300 shadow-md mb-2">
                                <p class="text-xs text-amber-600 font-semibold">✓ Foto baru dipilih — klik untuk ganti
                                </p>
                            </div>
                        </template>

                        <template x-if="!photoPreview">
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-slate-600">Klik atau drag foto baru ke sini</p>
                                <p class="text-xs text-slate-400 mt-1">PNG, JPG, WEBP — maks. 2MB</p>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end gap-3 pt-2 border-t border-slate-100">
                    <a href="{{ route('admin.produk.index') }}" class="btn-ghost">Batal</a>
                    <button type="submit" class="btn-warning">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Perbarui Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>