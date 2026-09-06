<x-app-layout>
    <div class="space-y-6">

        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Edit Data UMKM</h1>
                <p class="page-subtitle">Perbarui informasi UMKM: <span class="font-bold text-emerald-600">{{ $umkm->nama_umkm }}</span></p>
            </div>
            <a href="{{ route('admin.umkm.index') }}" class="btn-ghost">
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
                    <div class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <h2 class="text-sm font-black text-slate-800">Edit Formulir Data UMKM</h2>
                </div>
            </div>

            <form action="{{ route('admin.umkm.update', $umkm->id_umkm) }}" method="POST" enctype="multipart/form-data"
                  class="p-6 space-y-5"
                  x-data="{ photoPreview: null, hasExisting: {{ $umkm->foto ? 'true' : 'false' }} }">
                @csrf
                @method('PUT')

                {{-- Nama UMKM --}}
                <div>
                    <label class="form-label">Nama UMKM <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_umkm" value="{{ old('nama_umkm', $umkm->nama_umkm) }}" required
                           placeholder="contoh: Anyaman Bambu Bu Sari"
                           class="form-input @error('nama_umkm') border-red-400 focus:border-red-400 @enderror">
                    @error('nama_umkm')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Pemilik & Kategori --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="form-label">Nama Pemilik <span class="text-red-500">*</span></label>
                        <input type="text" name="pemilik" value="{{ old('pemilik', $umkm->pemilik) }}" required
                               placeholder="Nama pemilik UMKM"
                               class="form-input @error('pemilik') border-red-400 focus:border-red-400 @enderror">
                        @error('pemilik')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="form-label">Kategori Usaha <span class="text-red-500">*</span></label>
                        <input type="text" name="kategori" value="{{ old('kategori', $umkm->kategori) }}" required
                               placeholder="misal: Kerajinan Anyaman Bambu"
                               class="form-input @error('kategori') border-red-400 focus:border-red-400 @enderror">
                        @error('kategori')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Kontak --}}
                <div>
                    <label class="form-label">Nomor WhatsApp / Kontak</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </div>
                        <input type="text" name="kontak" value="{{ old('kontak', $umkm->kontak) }}"
                               placeholder="08xxx atau 628xxx"
                               class="form-input pl-10">
                    </div>
                </div>

                {{-- Alamat --}}
                <div>
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat" rows="2"
                              placeholder="Alamat lengkap UMKM..."
                              class="form-textarea">{{ old('alamat', $umkm->alamat) }}</textarea>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="form-label">Deskripsi UMKM</label>
                    <textarea name="deskripsi" rows="3"
                              placeholder="Deskripsi UMKM..."
                              class="form-textarea">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                </div>

                {{-- Link Lokasi --}}
                <div>
                    <label class="form-label">Link Lokasi (Google Maps)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <input type="text" name="link_lokasi" value="{{ old('link_lokasi', $umkm->link_lokasi) }}"
                               placeholder="https://maps.google.com/..."
                               class="form-input pl-10">
                    </div>
                </div>

                {{-- Foto Upload with existing preview --}}
                <div x-data="{ photoPreview: null, fileName: '' }">
                    <label class="form-label">Foto UMKM <span class="text-slate-400 font-normal normal-case">(kosongkan jika tidak diubah)</span></label>

                    {{-- Existing Photo --}}
                    @if($umkm->foto)
                        <div class="mb-3 p-4 bg-slate-50 rounded-2xl border border-slate-200 flex items-center justify-between" x-show="!photoPreview">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('storage/' . $umkm->foto) }}"
                                     class="w-16 h-16 rounded-xl object-cover border border-slate-300 shadow-sm">
                                <div>
                                    <p class="text-xs font-bold text-slate-800">Foto Saat Ini Tersimpan</p>
                                    <p class="text-[11px] text-slate-400 mt-0.5">Biarkan kosong jika tetap menggunakan foto ini</p>
                                </div>
                            </div>
                            <button type="button" @click="$refs.fotoInput.click()" class="btn-secondary text-xs py-1.5 px-3">
                                Ganti Foto
                            </button>
                        </div>
                    @endif

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

                        <template x-if="photoPreview">
                            <div class="flex flex-col items-center py-2" @click.stop>
                                <img :src="photoPreview" class="w-32 h-32 rounded-2xl object-cover border-2 border-amber-400 shadow-md mb-2">
                                <p class="text-xs font-bold text-slate-700 max-w-xs truncate" x-text="fileName"></p>
                                <p class="text-xs text-amber-600 font-bold mt-1">✓ Foto baru siap diupload untuk menggantikan foto lama</p>
                                <div class="flex items-center gap-2 mt-2">
                                    <button type="button" @click="$refs.fotoInput.click()" class="btn-secondary text-xs py-1 px-2.5">
                                        Pilih Foto Lain
                                    </button>
                                    <button type="button" @click="photoPreview = null; fileName = ''; $refs.fotoInput.value = ''" class="btn-danger text-xs py-1 px-2.5">
                                        Batalkan Penggantian
                                    </button>
                                </div>
                            </div>
                        </template>

                        <template x-if="!photoPreview">
                            <div class="flex flex-col items-center py-4 text-center">
                                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mb-3 shadow-sm border border-amber-100">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <p class="text-sm font-bold text-slate-700">Upload Foto Baru (Opsional)</p>
                                <p class="text-xs text-slate-400 mt-1 mb-3">Tarik foto ke sini atau telusuri berkas (PNG, JPG, WEBP maks. 5MB)</p>
                                <button type="button" @click.stop="$refs.fotoInput.click()" class="btn-primary text-xs py-2 px-4 shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Pilih Foto Baru
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
                    <a href="{{ route('admin.umkm.index') }}" class="btn-ghost">Batal</a>
                    <button type="submit" class="btn-warning">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Perbarui Data UMKM
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>