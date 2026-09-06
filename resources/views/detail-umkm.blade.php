<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Profil UMKM {{ $umkm->nama_umkm }} - Desa Selotinatah, Kecamatan Ngariboyo, Magetan">
    <title>{{ $umkm->nama_umkm }} - Profil UMKM Selotinatah</title>

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

            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}#umkm" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Direktori UMKM
                </a>
            </div>
        </div>
    </header>

    <!-- MAIN DETAIL CONTENT -->
    <main class="flex-1 max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-emerald-700 transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('home') }}#umkm" class="hover:text-emerald-700 transition-colors">Mitra UMKM</a>
            <span>/</span>
            <span class="text-slate-800 font-semibold truncate max-w-xs">{{ $umkm->nama_umkm }}</span>
        </nav>

        <!-- UMKM Hero Profile Card -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-card overflow-hidden mb-12">
            <!-- Decorative Banner -->
            <div class="h-32 bg-gradient-to-r from-emerald-700 via-teal-700 to-sapphire-700 relative">
                <div class="absolute inset-0 weave-bg opacity-40"></div>
            </div>

            <div class="p-6 sm:p-8">
                <div class="flex flex-col md:flex-row gap-6 items-start -mt-16 sm:-mt-20">
                    <!-- Photo / Avatar -->
                    <div class="relative flex-shrink-0">
                        @if($umkm->foto)
                            <img src="{{ asset('storage/' . $umkm->foto) }}" alt="{{ $umkm->nama_umkm }}"
                                 class="w-28 h-28 sm:w-32 sm:h-32 rounded-2xl object-cover border-4 border-white shadow-xl">
                        @else
                            <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-black text-4xl border-4 border-white shadow-xl weave-bg">
                                {{ substr($umkm->nama_umkm, 0, 1) }}
                            </div>
                        @endif
                    </div>

                    <!-- Details -->
                    <div class="flex-1 space-y-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="badge-green text-xs">
                                {{ $umkm->kategori }}
                            </span>
                            <span class="badge-blue text-xs">
                                Mitra Desa Selotinatah
                            </span>
                        </div>

                        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                            {{ $umkm->nama_umkm }}
                        </h1>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-slate-600 pt-1">
                            <p class="flex items-center gap-1.5">
                                <span class="font-bold text-slate-800">Pemilik Usaha:</span> {{ $umkm->pemilik }}
                            </p>
                            <p class="flex items-center gap-1.5">
                                <span class="font-bold text-slate-800">Kontak Telepon / WA:</span> {{ $umkm->kontak }}
                            </p>
                            <p class="flex items-center gap-1.5 sm:col-span-2">
                                <span class="font-bold text-slate-800">Alamat:</span> {{ $umkm->alamat ?? 'Desa Selotinatah, Kec. Ngariboyo, Kab. Magetan' }}
                            </p>
                        </div>

                        <p class="text-sm text-slate-600 leading-relaxed pt-2">
                            {{ $umkm->deskripsi ?? 'UMKM pengrajin dan produsen unggulan yang berdedikasi menghasilkan karya berkualitas khas Desa Selotinatah.' }}
                        </p>

                        <!-- Action Buttons -->
                        <div class="pt-4 flex flex-wrap gap-3">
                            <a href="{{ $linkWa }}" target="_blank"
                               class="btn-primary text-xs inline-flex items-center gap-2">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                </svg>
                                <span>Hubungi via WhatsApp</span>
                            </a>

                            @if($umkm->link_lokasi)
                                <a href="{{ $umkm->link_lokasi }}" target="_blank"
                                   class="btn-secondary text-xs inline-flex items-center gap-2">
                                    <svg class="w-4 h-4 text-sapphire-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span>Buka di Google Maps</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Produk yang Dihasilkan -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Katalog Spesifik</span>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight mt-0.5">Produk dari {{ $umkm->nama_umkm }}</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($umkm->produks as $p)
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <div>
                        <!-- Product Image -->
                        <div class="relative h-44 bg-slate-100 overflow-hidden">
                            @if($p->foto)
                                <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama_produk }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-emerald-50 to-teal-50 text-emerald-700/60 weave-bg">
                                    <svg class="w-9 h-9 mb-1 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-[10px] font-bold">Produk Kerajinan</span>
                                </div>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="p-5">
                            <div class="mb-2">
                                <span class="text-sm font-black text-emerald-700">
                                    Rp {{ number_format($p->harga, 0, ',', '.') }}
                                </span>
                            </div>
                            <h3 class="font-bold text-slate-900 text-sm group-hover:text-emerald-600 transition-colors line-clamp-1 mb-1">
                                {{ $p->nama_produk }}
                            </h3>
                            <p class="text-slate-500 text-xs leading-relaxed line-clamp-2">
                                {{ $p->deskripsi ?? 'Produk unggulan Desa Selotinatah.' }}
                            </p>
                        </div>
                    </div>

                    <div class="px-5 pb-5 pt-2 border-t border-slate-100">
                        <a href="{{ route('produk.detail', $p->id_produk) }}" class="btn-primary w-full justify-center text-xs py-2">
                            Lihat & Pesan Produk
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white p-12 rounded-3xl border border-dashed border-slate-300 text-center">
                    <p class="text-slate-600 font-semibold text-sm">UMKM ini belum menambahkan katalog produk.</p>
                    <p class="text-xs text-slate-400 mt-1">Silakan hubungi pemilik usaha melalui WhatsApp untuk informasi lebih lanjut.</p>
                </div>
            @endforelse
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