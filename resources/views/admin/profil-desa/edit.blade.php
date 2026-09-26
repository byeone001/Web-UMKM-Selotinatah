<x-app-layout>
    <div class="space-y-6">

        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Profil Desa</h1>
                <p class="page-subtitle">Kelola informasi utama dan data demografis Desa Selotinatah</p>
            </div>
        </div>

        {{-- Alert --}}
        @if(session('success'))
            <div class="alert-success">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        
        @if ($errors->any())
            <div class="bg-red-50 text-red-500 p-4 rounded-xl border border-red-100 mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.profil-desa.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT') 

            {{-- Info Utama --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card p-6 space-y-5">
                    <h2 class="text-lg font-black text-slate-800 mb-4 border-b border-slate-100 pb-2">Informasi Utama</h2>
                    
                    <div>
                        <label class="form-label">Nama Desa</label>
                        <input type="text" name="nama_desa" value="{{ old('nama_desa', $profil->nama_desa ?? 'Selotinatah') }}" class="form-input">
                    </div>

                    <div>
                        <label class="form-label">Sejarah Desa</label>
                        <textarea name="sejarah" rows="10" class="form-input tinymce-editor">{{ old('sejarah', $profil->sejarah) }}</textarea>
                    </div>

                    <div>
                        <label class="form-label">Visi</label>
                        <textarea name="visi" rows="10" class="form-input tinymce-editor">{{ old('visi', $profil->visi) }}</textarea>
                    </div>

                    <div>
                        <label class="form-label">Misi</label>
                        <textarea name="misi" rows="10" class="form-input tinymce-editor">{{ old('misi', $profil->misi) }}</textarea>
                    </div>
                    
                    <div>
                        <label class="form-label">Kondisi Geografis</label>
                        <textarea name="geografis" rows="5" class="form-input tinymce-editor">{{ old('geografis', $profil->geografis) }}</textarea>
                    </div>
                </div>

                <!-- {{-- Demografi --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card p-6 space-y-5">
                    <h2 class="text-lg font-black text-slate-800 mb-4 border-b border-slate-100 pb-2">Data Demografis (Statistika)</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">Total Penduduk (Jiwa)</label>
                            <input type="number" name="jumlah_penduduk" value="{{ old('jumlah_penduduk', $profil->jumlah_penduduk) }}" class="form-input">
                        </div>
                        <div>
                            <label class="form-label">Total Kepala Keluarga (KK)</label>
                            <input type="number" name="jumlah_kk" value="{{ old('jumlah_kk', $profil->jumlah_kk) }}" class="form-input">
                        </div>
                        <div>
                            <label class="form-label">Jumlah Laki-laki (Jiwa)</label>
                            <input type="number" name="jumlah_laki_laki" value="{{ old('jumlah_laki_laki', $profil->jumlah_laki_laki) }}" class="form-input">
                        </div>
                        <div>
                            <label class="form-label">Jumlah Perempuan (Jiwa)</label>
                            <input type="number" name="jumlah_perempuan" value="{{ old('jumlah_perempuan', $profil->jumlah_perempuan) }}" class="form-input">
                        </div>
                    </div>
                </div> -->

                {{-- Kontak --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card p-6 space-y-5">
                    <h2 class="text-lg font-black text-slate-800 mb-4 border-b border-slate-100 pb-2">Kontak & Lokasi</h2> 
                    <div>
                        <label class="form-label">Telepon / WhatsApp</label>
                        <input type="text" name="kontak_telepon" value="{{ old('kontak_telepon', $profil->kontak_telepon) }}" class="form-input">
                    </div>

                    <div>
                        <label class="form-label">Email</label>
                        <input type="email" name="kontak_email" value="{{ old('kontak_email', $profil->kontak_email) }}" class="form-input">
                    </div>

                    <div>
                        <label class="form-label">Alamat Lengkap Balai Desa</label>
                        <textarea name="alamat_lengkap" rows="3" class="form-input">{{ old('alamat_lengkap', $profil->alamat_lengkap) }}</textarea>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <button type="submit" class="btn-primary py-2.5 px-8">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>

                <!-- {{-- Bagian Kanan: Demografi & Kontak --}}
                <div class="space-y-6">
                     
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card p-6 space-y-5">
                    </div>

                    
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card p-6 space-y-5">   
                    </div>
                </div> -->

            <!-- <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">    
            </div> -->
        </form>

        {{-- =============================================
             GALERI MEDIA DESA
             ============================================= --}}
        @if($profil->exists)
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card p-6">
            <div class="flex items-center justify-between mb-5 pb-3 border-b border-slate-100">
                <div>
                    <h2 class="text-lg font-black text-slate-800">Galeri Media Desa</h2>
                    <p class="text-sm text-slate-500 mt-0.5">Foto & video yang tampil di carousel halaman Informasi Desa dan Beranda</p>
                </div>
                <span class="text-xs font-semibold bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full border border-emerald-200">
                    {{ $medias->count() }} Media
                </span>
            </div>

            {{-- Grid Preview Media Existing --}}
            @if($medias->count() > 0)
            <div class="grid gap-3 mb-6" id="media-grid" style="grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));">
                @foreach($medias as $media)
                @php $mediaUrl = Storage::disk('supabase')->url($media->path); @endphp
                <div class="relative group rounded-xl overflow-hidden border border-slate-200 bg-slate-100" style="aspect-ratio: 1/1;">
                    @if($media->type === 'video')
                        <video src="{{ $mediaUrl }}#t=0.1" class="w-full h-full object-cover" muted preload="metadata"></video>
                        <div class="absolute inset-0 flex items-center justify-center bg-black/30">
                            <svg class="w-8 h-8 text-white drop-shadow" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                    @else
                        <img src="{{ $mediaUrl }}" alt="{{ $media->judul ?? 'Media desa' }}" class="w-full h-full object-cover">
                    @endif

                    {{-- Overlay info & delete --}}
                    <div class="absolute inset-0 bg-black/40 flex flex-col justify-between p-2">
                        <div class="flex justify-between items-start">
                            <span class="text-[10px] font-bold uppercase px-1.5 py-0.5 rounded {{ $media->type === 'video' ? 'bg-purple-600' : 'bg-blue-600' }} text-white">
                                {{ $media->type }}
                            </span>
                            <span class="text-[10px] bg-black/60 text-white px-1.5 py-0.5 rounded">#{{ $media->urutan + 1 }}</span>
                        </div>
                        <div>
                            @if($media->judul)
                                <p class="text-black text-xs font-medium truncate mb-1">{{ $media->judul }}</p>
                            @endif
                            <form action="{{ route('admin.profil-desa.media.destroy', $media->id) }}" method="POST"
                                  class="delete-media-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full text-xs font-semibold bg-red-600 hover:bg-red-700 text-white py-1.5 px-2 rounded-lg transition-colors flex items-center justify-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8 text-slate-400 mb-6">
                <svg class="w-12 h-12 mx-auto mb-2 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-sm font-medium">Belum ada media diunggah</p>
                <p class="text-xs mt-1">Upload foto atau video desa di bawah ini</p>
            </div>
            @endif

            {{-- Form Upload Media Baru --}}
            {{-- Form Upload Media Baru --}}
            <div class="border-t border-slate-100 pt-5">
                <h3 class="text-sm font-bold text-slate-700 mb-4">Upload Media Baru</h3>

                <form
                    action="{{ route('admin.profil-desa.media.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    id="media-upload-form"
                >
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">

                        <div class="sm:col-span-2">
                            <label class="form-label">File Foto / Video</label>

                            <div class="relative">
                                <input
                                    type="file"
                                    name="file"
                                    id="media-file-input"
                                    accept="image/jpeg,image/png,image/webp,image/gif,video/mp4,video/webm,video/quicktime"
                                    class="form-input file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer"
                                    required
                                >
                            </div>

                            <p class="text-xs text-slate-400 mt-1">
                                Foto: JPG, PNG, WebP, GIF • Video: MP4, WebM, MOV • Maks. 50 MB
                            </p>
                        </div>

                        <div>
                            <label class="form-label">Judul (Opsional)</label>

                            <input
                                type="text"
                                name="judul"
                                id="media-title-input"
                                placeholder="Contoh: Balai Desa..."
                                class="form-input"
                            >
                        </div>

                    </div>

                    {{-- Upload progress --}}
                    <div id="upload-progress" class="hidden mt-4">

                        <div class="flex items-center gap-2 text-sm text-slate-600">

                            <svg
                                class="animate-spin w-4 h-4 text-emerald-600"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"
                                ></circle>

                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                                ></path>
                            </svg>

                            <span id="upload-status">
                                Mengunggah, mohon tunggu...
                            </span>

                        </div>

                        {{-- Progress bar --}}
                        <div class="w-full bg-slate-200 rounded-full h-2 mt-3 overflow-hidden">
                            <div
                                id="upload-progress-bar"
                                class="bg-emerald-600 h-2 rounded-full transition-all duration-300"
                                style="width: 0%"
                            ></div>
                        </div>

                        <p
                            id="upload-percentage"
                            class="text-xs text-slate-400 mt-1 text-right"
                        >
                            0%
                        </p>

                    </div>

                    <div class="flex justify-end gap-3 mt-6">

                        <button
                            type="submit"
                            id="upload-btn"
                            class="btn-primary py-2.5 px-8"
                        >
                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                                />
                            </svg>

                            Upload Media
                        </button>

                    </div>
                </form>
            </div>
        </div>
        @else
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 text-sm text-amber-700">
            <strong>Catatan:</strong> Simpan profil desa terlebih dahulu sebelum bisa mengunggah media galeri.
        </div>
        @endif

    </div>
    
    <!-- <script>
        document.getElementById('media-upload-form')?.addEventListener('submit', function() {
            document.getElementById('upload-progress').classList.remove('hidden');
            document.getElementById('upload-btn').disabled = true;
            document.getElementById('upload-btn').classList.add('opacity-60');
        });
    </script> -->

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const form = document.getElementById('media-upload-form');
        const fileInput = document.getElementById('media-file-input');
        const titleInput = document.getElementById('media-title-input');
        const uploadBtn = document.getElementById('upload-btn');

        const progress = document.getElementById('upload-progress');
        const progressBar = document.getElementById('upload-progress-bar');
        const percentage = document.getElementById('upload-percentage');
        const statusText = document.getElementById('upload-status');

        if (!form || !fileInput) {
            return;
        }

        form.addEventListener('submit', async function (event) {

            event.preventDefault();

            const file = fileInput.files[0];

            if (!file) {
                alert('Silakan pilih file terlebih dahulu.');
                return;
            }

            const maxSize = 50 * 1024 * 1024;

            if (file.size > maxSize) {
                alert('Ukuran file maksimal 50 MB.');
                return;
            }

            const extension = file.name
                .split('.')
                .pop()
                .toLowerCase();

            const videoExtensions = ['mp4', 'webm', 'mov'];

            const type = videoExtensions.includes(extension)
                ? 'video'
                : 'foto';

            uploadBtn.disabled = true;
            uploadBtn.classList.add('opacity-50', 'cursor-not-allowed');

            progress.classList.remove('hidden');

            progressBar.style.width = '0%';
            percentage.textContent = '0%';
            statusText.textContent = 'Menyiapkan upload...';

            try {

                // 1. Minta upload URL dari Laravel
                const uploadUrlResponse = await fetch(
                    "{{ route('admin.profil-desa.media.upload-url') }}",
                    {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            filename: file.name,
                            content_type: file.type
                        })
                    }
                );

                if (!uploadUrlResponse.ok) {
                    const error = await uploadUrlResponse.json();

                    throw new Error(
                        error.message || 'Gagal mendapatkan URL upload.'
                    );
                }

                const uploadData = await uploadUrlResponse.json();

                // 2. Upload langsung ke Supabase
                statusText.textContent = 'Mengunggah ke Supabase...';

                await uploadFileWithProgress(
                    uploadData.upload_url,
                    file,
                    uploadData.headers || {},
                    function (percent) {
                        progressBar.style.width = percent + '%';
                        percentage.textContent = percent + '%';
                    }
                );

                // 3. Simpan informasi media ke database
                statusText.textContent = 'Menyimpan informasi media...';

                const completeResponse = await fetch(
                    "{{ route('admin.profil-desa.media.complete') }}",
                    {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            path: uploadData.path,
                            type: type,
                            judul: titleInput.value
                        })
                    }
                );

                if (!completeResponse.ok) {
                    const error = await completeResponse.json();

                    throw new Error(
                        error.message || 'Gagal menyimpan data media.'
                    );
                }

                const result = await completeResponse.json();

                progressBar.style.width = '100%';
                percentage.textContent = '100%';
                statusText.textContent = 'Upload berhasil!';

                showToast(
                    result.message || 'Media berhasil diunggah.',
                    'success',
                    function () {
                        window.location.reload();
                    }
                );

            } catch (error) {

                console.error('Upload error:', error);

                alert(
                    'Upload gagal: ' +
                    (error.message || 'Terjadi kesalahan.')
                );

                progress.classList.add('hidden');

            } finally {

                uploadBtn.disabled = false;

                uploadBtn.classList.remove(
                    'opacity-50',
                    'cursor-not-allowed'
                );
            }
        });


        function uploadFileWithProgress(
            url,
            file,
            headers,
            onProgress
        ) {
            return new Promise(function (resolve, reject) {

                const xhr = new XMLHttpRequest();

                xhr.open('PUT', url, true);

                Object.keys(headers).forEach(function (key) {
                    xhr.setRequestHeader(
                        key,
                        headers[key]
                    );
                });

                xhr.upload.addEventListener(
                    'progress',
                    function (event) {

                        if (event.lengthComputable) {

                            const percent = Math.round(
                                (event.loaded / event.total) * 100
                            );

                            onProgress(percent);
                        }
                    }
                );

                xhr.onload = function () {

                    if (
                        xhr.status >= 200 &&
                        xhr.status < 300
                    ) {
                        resolve();
                    } else {
                        reject(
                            new Error(
                                'Supabase menolak upload. HTTP ' +
                                xhr.status
                            )
                        );
                    }
                };

                xhr.onerror = function () {
                    reject(
                        new Error(
                            'Koneksi ke Supabase gagal.'
                        )
                    );
                };

                xhr.onabort = function () {
                    reject(
                        new Error(
                            'Upload dibatalkan.'
                        )
                    );
                };

                xhr.send(file);
            });
        }

    });
</script>

</x-app-layout>
