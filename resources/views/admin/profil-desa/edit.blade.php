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

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                {{-- Bagian Kiri: Info Utama --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card p-6 space-y-5">
                    <h2 class="text-lg font-black text-slate-800 mb-4 border-b border-slate-100 pb-2">Informasi Utama</h2>
                    
                    <div>
                        <label class="form-label">Nama Desa</label>
                        <input type="text" name="nama_desa" value="{{ old('nama_desa', $profil->nama_desa ?? 'Selotinatah') }}" class="form-input">
                    </div>

                    <div>
                        <label class="form-label">Sejarah Desa</label>
                        <textarea name="sejarah" rows="5" class="form-input">{{ old('sejarah', $profil->sejarah) }}</textarea>
                    </div>

                    <div>
                        <label class="form-label">Visi</label>
                        <textarea name="visi" rows="3" class="form-input">{{ old('visi', $profil->visi) }}</textarea>
                    </div>

                    <div>
                        <label class="form-label">Misi</label>
                        <textarea name="misi" rows="3" class="form-input">{{ old('misi', $profil->misi) }}</textarea>
                    </div>
                    
                    <div>
                        <label class="form-label">Kondisi Geografis</label>
                        <textarea name="geografis" rows="3" class="form-input">{{ old('geografis', $profil->geografis) }}</textarea>
                    </div>
                </div>

                {{-- Bagian Kanan: Demografi & Kontak --}}
                <div class="space-y-6">
                    {{-- Demografi --}}
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
                    </div>

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
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="submit" class="btn-primary py-2.5 px-8">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</x-app-layout>
