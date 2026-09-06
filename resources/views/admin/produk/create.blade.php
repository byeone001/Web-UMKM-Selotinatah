<x-app-layout>
    <div class="space-y-6">

        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Tambah Produk</h1>
                <p class="page-subtitle">Daftarkan produk anyaman bambu baru ke dalam sistem</p>
            </div>
            <a href="{{ route('admin.produk.index') }}" class="btn-ghost">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card">
            <div class="px-6 py-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <h2 class="text-sm font-black text-slate-800">Formulir Data Produk</h2>
                </div>
            </div>

            <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data"
                  class="p-6 space-y-5" x-data="{ photoPreview: null }">
                @csrf

                {{-- UMKM Pemilik --}}
                <div>
                    <label class="form-label">UMKM Pemilik <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <select name="id_umkm" required
                                class="form-select pl-10 @error('id_umkm') border-red-400 focus:border-red-400 @enderror">
                            <option value="">— Pilih UMKM Pemilik —</option>
                            @foreach($umkms as $u)
                                <option value="{{ $u->id_umkm }}" {{ old('id_umkm') == $u->id_umkm ? 'selected' : '' }}>
                                    {{ $u->nama_umkm }} ({{ $u->pemilik }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('id_umkm')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nama Produk --}}
                <div>
                    <label class="form-label">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" required
                           placeholder="contoh: Tas Anyaman Bambu Premium"
                           class="form-input @error('nama_produk') border-red-400 focus:border-red-400 @enderror">
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
                        <input type="number" name="harga" value="{{ old('harga') }}" step="1000" min="0" required
                               placeholder="50000"
                               class="form-input pl-10 @error('harga') border-red-400 focus:border-red-400 @enderror">
                    </div>
                    @error('harga')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="form-label">Deskripsi Produk</label>
                    <textarea name="deskripsi" rows="3"
                              placeholder="Jelaskan keunggulan, bahan baku, dan cara pembuatan produk ini..."
                              class="form-textarea">{{ old('deskripsi') }}</textarea>
                </div>

                {{-- Foto Upload --}}
                <div x-data="{ photoPreview: null, fileName: '' }">
                    <label class="form-label">Foto Produk <span class="text-slate-400 font-normal normal-case">(opsional)</span></label>
                    <div class="upload-zone"
                         @click="$refs.fotoInput.click()"
                         @dragover.prevent
                         @drop.prevent="
                            const file = $event.dataTransfer.files[0];
                            if(file) {
                                fileName = file.name;
                                const reader = new FileReader();
                                reader.onload = e => photoPreview = e.target.result;
                                reader.readAsDataURL(file);
                                $refs.fotoInput.files = $event.dataTransfer.files;
                            }
                         ">
                        <input type="file" name="foto" x-ref="fotoInput" class="hidden" accept="image/*"
                               @change="
                                const file = $event.target.files[0];
                                if(file) {
                                    fileName = file.name;
                                    const reader = new FileReader();
                                    reader.onload = e => photoPreview = e.target.result;
                                    reader.readAsDataURL(file);
                                }
                               ">

                        {{-- Preview --}}
                        <template x-if="photoPreview">
                            <div class="flex flex-col items-center py-2" @click.stop>
                                <img :src="photoPreview" class="w-36 h-36 rounded-2xl object-cover border-2 border-sapphire-400 shadow-md mb-2">
                                <p class="text-xs font-bold text-slate-700 max-w-xs truncate" x-text="fileName"></p>
                                <div class="flex items-center gap-2 mt-2">
                                    <button type="button" @click="$refs.fotoInput.click()" class="btn-secondary text-xs py-1 px-2.5">
                                        Ganti Foto
                                    </button>
                                    <button type="button" @click="photoPreview = null; fileName = ''; $refs.fotoInput.value = ''" class="btn-danger text-xs py-1 px-2.5">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </template>

                        <template x-if="!photoPreview">
                            <div class="flex flex-col items-center py-4 text-center">
                                <div class="w-14 h-14 rounded-2xl bg-sapphire-50 text-sapphire-600 flex items-center justify-center mb-3 shadow-sm border border-sapphire-100">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <p class="text-sm font-bold text-slate-700">Pilih Berkas Foto Produk atau Tarik ke Sini</p>
                                <p class="text-xs text-slate-400 mt-1 mb-3">Format: PNG, JPG, JPEG, WEBP (Maksimal 5 MB)</p>
                                <button type="button" @click.stop="$refs.fotoInput.click()" class="btn-secondary text-xs py-2 px-4 shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Telusuri Foto Produk
                                </button>
                            </div>
                        </template>
                    </div>
                    @error('foto')
                        <p class="form-error mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end gap-3 pt-2 border-t border-slate-100">
                    <a href="{{ route('admin.produk.index') }}" class="btn-ghost">Batal</a>
                    <button type="submit" class="btn-secondary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>