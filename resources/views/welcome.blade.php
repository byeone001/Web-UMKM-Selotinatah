<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal UMKM & Potensi Desa Selotinatah - Magetan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased selection:bg-emerald-600 selection:text-white">

    <!-- NAVBAR -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-700 text-white flex items-center justify-center font-black text-xl shadow-md group-hover:scale-105 transition-transform">
                    S
                </div>
                <div>
                    <span class="font-black text-lg tracking-tight text-slate-900 block leading-none">UMKM SELOTINATAH</span>
                    <span class="text-[11px] font-semibold text-emerald-700 tracking-wider uppercase">Kec. Ngariboyo, Magetan</span>
                </div>
            </a>

            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold">
                <a href="#beranda" class="text-emerald-600">Beranda</a>
                <a href="#profil-desa" class="text-slate-600 hover:text-emerald-600 transition-colors">Profil Desa</a>
                <a href="#produk" class="text-slate-600 hover:text-emerald-600 transition-colors">Katalog Produk</a>
                <a href="#umkm" class="text-slate-600 hover:text-emerald-600 transition-colors">Mitra UMKM</a>
                <a href="#berita" class="text-slate-600 hover:text-emerald-600 transition-colors">Kabar Desa</a>
            </nav>

            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-emerald-600 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-all shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Panel Admin
                </a>
            </div>
        </div>
    </header>

    <!-- HERO SECTION WITH QUICK SEARCH -->
    <section id="beranda" class="relative py-16 lg:py-24 bg-gradient-to-b from-emerald-50/70 via-emerald-50/20 to-slate-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-100/80 border border-emerald-200 text-emerald-800 text-xs font-bold mb-6">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-600 animate-pulse"></span>
                    ⛰️ Kaki Gunung Lawu · Desa Selotinatah, Magetan
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-tight mb-6">
                    Jelajahi Produk Unggulan & <span class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Potensi Alam Desa</span>
                </h1>
                <p class="text-base sm:text-lg text-slate-600 leading-relaxed mb-8">
                    Wujud kemandirian ekonomi masyarakat Desa Selotinatah melalui ragam produk kuliner alami, kerajinan tangan, dan hasil usaha warga berkualitas dari lereng pegunungan yang sejuk.
                </p>

                <!-- FORM PENCARIAN INTERAKTIF -->
                <form action="{{ url('/') }}#produk" method="GET" class="relative max-w-2xl mx-auto mb-6">
                    <div class="flex items-center bg-white p-2 rounded-2xl shadow-xl border border-slate-200/80 focus-within:border-emerald-500 focus-within:ring-4 focus-within:ring-emerald-100 transition-all">
                        <div class="pl-3 text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari produk desa, jajanan, hasil tani, atau usaha..." class="w-full px-4 py-2.5 text-sm font-medium text-slate-800 placeholder-slate-400 bg-transparent border-none focus:outline-none focus:ring-0">
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-6 py-3 rounded-xl transition-all shadow-md">
                            Cari Produk
                        </button>
                    </div>
                </form>

                <!-- QUICK FILTER BADGES -->
                @if(isset($kategoriList) && count($kategoriList) > 0)
                    <div class="flex flex-wrap items-center justify-center gap-2 text-xs font-semibold text-slate-500">
                        <span class="text-slate-400">Kategori Pilihan:</span>
                        <a href="{{ url('/') }}#produk" class="px-3 py-1 rounded-lg bg-white border border-slate-200 hover:border-emerald-400 hover:text-emerald-600 transition-all">Semua</a>
                        @foreach($kategoriList as $kat)
                            <a href="{{ url('/?kategori=' . urlencode($kat)) }}#produk" class="px-3 py-1 rounded-lg bg-white border border-slate-200 hover:border-emerald-400 hover:text-emerald-600 transition-all">
                                {{ $kat }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- STATISTIK INTERAKTIF DESA -->
    <section class="py-10 bg-slate-900 text-white border-y border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-4">
                    <p class="text-3xl sm:text-4xl font-black text-emerald-400 mb-1">{{ $totalUmkm }}</p>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">UMKM Terdaftar</p>
                </div>
                <div class="p-4">
                    <p class="text-3xl sm:text-4xl font-black text-teal-300 mb-1">{{ $totalProduk }}</p>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Produk Lokal</p>
                </div>
                <div class="p-4">
                    <p class="text-3xl sm:text-4xl font-black text-lime-400 mb-1">{{ $totalKategori }}</p>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Kategori Usaha</p>
                </div>
                <div class="p-4">
                    <p class="text-3xl sm:text-4xl font-black text-amber-400 mb-1">100%</p>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Karya Asli Desa</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SEKSI PROFIL & POTENSI DESA SELOTINATAH -->
    <section id="profil-desa" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-6 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700 text-xs font-bold uppercase tracking-wider">
                        🌿 Pesona & Profil Desa
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                        Mengenal Desa Selotinatah
                    </h2>
                    <p class="text-slate-600 leading-relaxed">
                        Desa Selotinatah terletak di kawasan sejuk kaki Gunung Lawu, Kecamatan Ngariboyo, Kabupaten Magetan. Udara yang segar dan kekayaan alam lokal menjadi modal utama tumbuh dan berkembangnya kreativitas ekonomi masyarakat desa.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div class="p-4 rounded-xl bg-emerald-50/50 border border-emerald-100">
                            <h4 class="font-bold text-slate-900 text-sm mb-1">🍃 Olahan Pangan Alami</h4>
                            <p class="text-xs text-slate-600">Jajanan khas, camilan renyah, serta hasil olahan pertanian warga desa.</p>
                        </div>
                        <div class="p-4 rounded-xl bg-emerald-50/50 border border-emerald-100">
                            <h4 class="font-bold text-slate-900 text-sm mb-1">🎨 Kerajinan Tangan Lokal</h4>
                            <p class="text-xs text-slate-600">Kreativitas pengrajin desa yang memanfaatkan bahan alami berkualitas.</p>
                        </div>
                    </div>
                    <div class="pt-2">
                        <a href="https://selotinatah.magetan.go.id/" target="_blank" class="inline-flex items-center gap-2 font-bold text-sm text-emerald-700 hover:text-emerald-800">
                            <span>Kunjungi Website Resmi Desa Selotinatah</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-6">
                    <div class="relative bg-gradient-to-br from-emerald-800 via-teal-800 to-slate-900 rounded-3xl p-8 text-white shadow-2xl overflow-hidden">
                        <div class="relative z-10 space-y-4">
                            <span class="px-3 py-1 rounded-md bg-white/20 backdrop-blur-md text-xs font-semibold uppercase tracking-wider">Info Geografis</span>
                            <h3 class="text-2xl font-bold">Pusat Penggerak Ekonomi Kreatif Desa</h3>
                            <p class="text-sm text-emerald-100 leading-relaxed">
                                Portal UMKM ini hadir sebagai sarana publikasi dan promosi produk lokal agar dapat menjangkau pasar yang lebih luas, baik di tingkat Kabupaten Magetan maupun skala nasional.
                            </p>
                            <div class="pt-4 border-t border-white/20 flex items-center justify-between text-xs text-emerald-200">
                                <span>📍 Kec. Ngariboyo</span>
                                <span>Kab. Magetan, Jawa Timur</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- KATALOG PRODUK TERBARU -->
    <section id="produk" class="py-16 bg-slate-50 border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
                <div>
                    <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Katalog Unggulan</span>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight mt-1">Produk Terbaru UMKM</h2>
                </div>
                @if(isset($search) || isset($kategoriSelected))
                    <a href="{{ url('/') }}#produk" class="text-xs font-bold text-red-600 hover:underline">Reset Filter / Pencarian</a>
                @endif
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($produk as $p)
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                        <div>
                            <!-- Product Image -->
                            <div class="relative h-48 bg-slate-100 overflow-hidden">
                                @if($p->foto)
                                    <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama_produk }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-emerald-50 to-teal-50 text-emerald-700/60 weave-bg">
                                        <svg class="w-10 h-10 mb-1 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="text-[11px] font-bold">Kerajinan Selotinatah</span>
                                    </div>
                                @endif
                                <span class="absolute top-3 left-3 px-2.5 py-1 rounded-lg bg-white/90 backdrop-blur-md text-slate-800 font-bold text-[10px] shadow-sm">
                                    {{ $p->umkm->kategori ?? 'Kerajinan' }}
                                </span>
                            </div>

                            <div class="p-5">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold text-emerald-700">
                                        Rp {{ number_format($p->harga, 0, ',', '.') }}
                                    </span>
                                </div>

                                <h3 class="font-bold text-slate-900 text-base group-hover:text-emerald-600 transition-colors line-clamp-1 mb-1">
                                    {{ $p->nama_produk }}
                                </h3>
                                <p class="text-xs font-semibold text-slate-400 mb-2">
                                    Oleh: <span class="text-slate-700 font-medium">{{ $p->umkm->nama_umkm ?? 'UMKM Desa' }}</span>
                                </p>
                                <p class="text-slate-500 text-xs leading-relaxed line-clamp-2">
                                    {{ $p->deskripsi ?? 'Produk kerajinan dan olahan khas Desa Selotinatah, Magetan.' }}
                                </p>
                            </div>
                        </div>

                        <div class="px-5 pb-5 pt-3 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-[11px] text-slate-400 truncate max-w-[120px]">{{ $p->umkm->pemilik ?? '-' }}</span>
                            <a href="{{ route('produk.detail', $p->id_produk) }}" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-600 hover:text-emerald-800 transition-colors">
                                Detail & Pesan
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white p-12 rounded-2xl border border-dashed border-slate-300 text-center">
                        <p class="text-slate-600 font-semibold">Produk tidak ditemukan.</p>
                        <p class="text-xs text-slate-400 mt-1">Coba gunakan kata kunci lain atau pilih kategori berbeda.</p>
                    </div>
                @endforelse
            </div>

            <!-- Tombol Lihat Semua Katalog -->
            <div class="mt-10 text-center">
                <a href="{{ route('katalog') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white border border-slate-200 hover:border-emerald-400 text-slate-800 hover:text-emerald-700 font-bold text-sm shadow-sm hover:shadow-md transition-all">
                    <span>Lihat Seluruh Katalog Produk ({{ $totalProduk }})</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- DIREKTORI MITRA UMKM DESA -->
    <section id="umkm" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center max-w-2xl mx-auto">
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Penggerak Ekonomi Desa</span>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight mt-1">Pelaku UMKM Selotinatah</h2>
                <p class="text-slate-500 text-sm mt-2">Daftar usaha lokal warga desa yang siap melayani kebutuhan Anda dengan kualitas terbaik.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($umkm as $u)
                    <div class="bg-slate-50/80 p-6 rounded-2xl border border-slate-200/80 hover:border-emerald-300 hover:bg-white hover:shadow-lg transition-all group">
                        <div class="flex items-start gap-4 mb-4">
                            @if($u->foto)
                                <img src="{{ asset('storage/' . $u->foto) }}" alt="{{ $u->nama_umkm }}" class="w-14 h-14 rounded-xl object-cover border border-slate-200 shadow-sm flex-shrink-0">
                            @else
                                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-black text-xl shadow-sm flex-shrink-0">
                                    {{ substr($u->nama_umkm, 0, 1) }}
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <h3 class="font-bold text-slate-900 text-base truncate group-hover:text-emerald-700 transition-colors">{{ $u->nama_umkm }}</h3>
                                </div>
                                <p class="text-xs text-slate-500 font-medium">Pemilik: {{ $u->pemilik }}</p>
                                <span class="inline-block mt-1 px-2.5 py-0.5 rounded-md bg-emerald-100/80 text-emerald-800 font-semibold text-[10px]">
                                    {{ $u->kategori }}
                                </span>
                            </div>
                        </div>
                        <p class="text-xs text-slate-600 line-clamp-2 mb-4">
                            📍 {{ $u->alamat ?? 'Desa Selotinatah, Kec. Ngariboyo, Magetan' }}
                        </p>
                        <div class="pt-3 border-t border-slate-200/60 flex items-center justify-between">
                            <span class="text-[11px] text-slate-400">Hubungi: {{ $u->kontak }}</span>
                            <a href="{{ route('umkm.detail', $u->id_umkm) }}" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-600 hover:text-emerald-800">
                                Profil & Produk &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-8 text-slate-400 text-sm">Belum ada data UMKM.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- SEKSI BERITA DESA SELOTINATAH -->
    <section id="berita" class="py-16 bg-gradient-to-b from-slate-50 to-white border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700 text-xs font-bold uppercase tracking-wider mb-3">
                        Kabar Terkini
                    </div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight">Berita & Informasi Desa</h2>
                    <p class="text-slate-500 text-sm mt-1">Dapatkan update seputar kegiatan, potensi, dan pembangunan Desa Selotinatah.</p>
                </div>
                <a href="https://selotinatah.magetan.go.id/" target="_blank" class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-600 hover:text-emerald-700 bg-white hover:bg-emerald-50 px-4 py-2.5 rounded-xl border border-slate-200 hover:border-emerald-200 transition-all shadow-sm">
                    <span>Kunjungi Web Desa</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($berita as $b)
                    <article class="group bg-white rounded-2xl shadow-card border border-slate-200/80 hover:border-emerald-300 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden">
                        <div>
                            @if(!empty($b['image']))
                                <div class="h-44 w-full overflow-hidden bg-slate-100 relative">
                                    <img src="{{ $b['image'] }}" alt="{{ $b['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" onerror="this.parentElement.style.display='none'">
                                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-md bg-white/90 backdrop-blur-md text-emerald-800 text-[10px] font-bold shadow-sm">
                                        Website Resmi Desa
                                    </span>
                                </div>
                            @else
                                <div class="h-24 w-full bg-gradient-to-r from-emerald-700 to-teal-800 weave-bg p-4 flex items-end">
                                    <span class="px-2.5 py-1 rounded-md bg-white/90 backdrop-blur-md text-emerald-800 text-[10px] font-bold shadow-sm">
                                        Kabar Desa
                                    </span>
                                </div>
                            @endif

                            <div class="p-6">
                                <div class="flex items-center justify-between gap-2 mb-3">
                                    <span class="px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-700 text-[11px] font-semibold">Berita Resmi</span>
                                    <span class="text-xs font-medium text-slate-400">{{ $b['date'] }}</span>
                                </div>
                                <h3 class="font-bold text-slate-900 text-base group-hover:text-emerald-600 transition-colors duration-200 line-clamp-2 mb-3">
                                    <a href="{{ $b['link'] }}" target="_blank" rel="noopener noreferrer">{{ $b['title'] }}</a>
                                </h3>
                                <p class="text-slate-600 text-xs leading-relaxed line-clamp-3">
                                    {{ $b['description'] }}
                                </p>
                            </div>
                        </div>
                        <div class="px-6 pb-6 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-emerald-600">
                            <a href="{{ $b['link'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 hover:text-emerald-800">
                                <span>Baca di Web Desa</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                            <div class="w-8 h-8 rounded-xl bg-emerald-50 group-hover:bg-emerald-600 group-hover:text-white flex items-center justify-center transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-8 text-slate-400 text-sm">Belum ada berita.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-slate-900 text-white py-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left flex flex-col sm:flex-row justify-between items-center gap-6">
            <div>
                <p class="font-black text-lg text-white">PORTAL UMKM DESA SELOTINATAH</p>
                <p class="text-xs text-slate-400 mt-1">Lereng Gunung Lawu · Kec. Ngariboyo, Kab. Magetan, Jawa Timur</p>
            </div>
            <p class="text-xs text-slate-500">
                &copy; {{ date('Y') }} Portal UMKM Desa Selotinatah. All rights reserved.
            </p>
        </div>
    </footer>

</body>
</html>