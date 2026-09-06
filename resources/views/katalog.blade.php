<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Katalog Produk Kerajinan Anyaman Bambu & Olahan Lokal Desa Selotinatah - Magetan">
    <title>Katalog Produk UMKM - Desa Selotinatah</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased selection:bg-emerald-600 selection:text-white flex flex-col min-h-screen">

    <!-- NAVBAR -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-700 text-white flex items-center justify-center font-black text-xl shadow-md group-hover:scale-105 transition-transform">
                    S
                </div>
                <div>
                    <span class="font-black text-lg tracking-tight text-slate-900 block leading-none">UMKM SELOTINATAH</span>
                    <span class="text-[11px] font-semibold text-emerald-700 tracking-wider uppercase">Kec. Ngariboyo, Magetan</span>
                </div>
            </a>

            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold">
                <a href="{{ route('home') }}" class="text-slate-600 hover:text-emerald-600 transition-colors">Beranda</a>
                <a href="{{ route('home') }}#profil-desa" class="text-slate-600 hover:text-emerald-600 transition-colors">Profil Desa</a>
                <a href="{{ route('katalog') }}" class="text-emerald-600">Katalog Produk</a>
                <a href="{{ route('home') }}#umkm" class="text-slate-600 hover:text-emerald-600 transition-colors">Mitra UMKM</a>
                <a href="{{ route('home') }}#berita" class="text-slate-600 hover:text-emerald-600 transition-colors">Kabar Desa</a>
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

    <!-- HEADER BANNER -->
    <div class="relative bg-gradient-to-r from-emerald-800 via-teal-800 to-slate-900 py-12 text-white overflow-hidden">
        <div class="absolute inset-0 weave-bg opacity-30"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <nav class="flex items-center gap-2 text-xs text-emerald-200 mb-2">
                        <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                        <span>/</span>
                        <span class="text-white font-semibold">Katalog Produk</span>
                    </nav>
                    <h1 class="text-3xl sm:text-4xl font-black tracking-tight">Katalog Produk Anyaman & UMKM</h1>
                    <p class="text-emerald-100/80 text-sm mt-1 max-w-xl">
                        Koleksi lengkap hasil kerajinan anyaman bambu, olahan pangan, dan produk unggulan warga Desa Selotinatah.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- FILTER & SEARCH BAR -->
        <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-card mb-8">
            <form action="{{ route('katalog') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-3">
                <div class="md:col-span-6 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari nama produk atau deskripsi..."
                           class="form-input pl-10">
                </div>

                <div class="md:col-span-4">
                    <select name="kategori" class="form-input">
                        <option value="">Semua Kategori Usaha</option>
                        @foreach($kategoriList as $kat)
                            <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                                {{ $kat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2 flex gap-2">
                    <button type="submit" class="flex-1 btn-primary justify-center text-xs">
                        Filter
                    </button>
                    @if(request()->filled('search') || request()->filled('kategori'))
                        <a href="{{ route('katalog') }}" class="btn-secondary px-3 text-xs justify-center" title="Reset filter">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- PRODUCT GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($produk as $p)
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <div>
                        <!-- Image -->
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

                        <!-- Content -->
                        <div class="p-5">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-black text-emerald-700">
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
                                {{ $p->deskripsi ?? 'Produk kerajinan dan olahan berkualitas khas Desa Selotinatah.' }}
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
                <div class="col-span-full bg-white p-12 rounded-3xl border border-dashed border-slate-300 text-center">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-800">Produk Tidak Ditemukan</h3>
                    <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                        Maaf, tidak ada produk yang cocok dengan pencarian atau filter yang Anda pilih. Coba gunakan kata kunci lain.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('katalog') }}" class="btn-secondary text-xs inline-flex">
                            Reset Filter Pencarian
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- PAGINATION -->
        <div class="mt-10">
            {{ $produk->links() }}
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-slate-900 text-white py-12 border-t border-slate-800 mt-auto">
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