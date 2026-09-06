<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $produk->nama_produk }} - Produk UMKM Desa Selotinatah, Ngariboyo, Magetan">
    <title>{{ $produk->nama_produk }} - UMKM Selotinatah</title>

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
                <a href="{{ route('katalog') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Katalog
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
            <a href="{{ route('katalog') }}" class="hover:text-emerald-700 transition-colors">Katalog Produk</a>
            <span>/</span>
            <span class="text-slate-800 font-semibold truncate max-w-xs">{{ $produk->nama_produk }}</span>
        </nav>

        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-card overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12">

                <!-- Left: Product Photo -->
                <div class="lg:col-span-6 bg-slate-100 relative min-h-[360px] lg:min-h-[500px] flex items-center justify-center overflow-hidden">
                    @if($produk->foto)
                        <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama_produk }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center p-8 text-center bg-gradient-to-br from-emerald-50 to-teal-50 weave-bg">
                            <div class="w-20 h-20 rounded-3xl bg-white shadow-sm flex items-center justify-center text-emerald-600 mb-3">
                                <svg class="w-10 h-10 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-slate-700">Kerajinan Desa Selotinatah</p>
                            <p class="text-xs text-slate-400 mt-0.5">Anyaman Bambu & Produk Lokal</p>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="badge-green text-xs backdrop-blur-md bg-white/90 shadow-sm">
                            {{ $produk->umkm->kategori ?? 'Kerajinan' }}
                        </span>
                    </div>
                </div>

                <!-- Right: Product Info & Order Action -->
                <div class="lg:col-span-6 p-8 lg:p-10 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-xs font-semibold text-slate-400">Kode Produk: #PRD-{{ $produk->id_produk }}</span>
                        </div>

                        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-snug mb-3">
                            {{ $produk->nama_produk }}
                        </h1>

                        <!-- Price Tag -->
                        <div class="inline-block p-4 rounded-2xl bg-emerald-50/80 border border-emerald-200/80 mb-6">
                            <p class="text-xs font-semibold text-emerald-800 uppercase tracking-wider">Harga Produk</p>
                            <p class="text-3xl font-black text-emerald-700 mt-0.5">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </p>
                        </div>

                        <!-- Producer UMKM Card -->
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 mb-6">
                            <p class="text-xs font-semibold text-slate-400 mb-2 uppercase tracking-wider">Diproduksi Oleh:</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-black text-lg shadow-sm">
                                        {{ substr($produk->umkm->nama_umkm ?? 'U', 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-900 text-sm hover:text-emerald-700 transition-colors">
                                            <a href="{{ route('umkm.detail', $produk->umkm->id_umkm) }}">
                                                {{ $produk->umkm->nama_umkm }} &rarr;
                                            </a>
                                        </h3>
                                        <p class="text-xs text-slate-500">Pemilik: {{ $produk->umkm->pemilik }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('umkm.detail', $produk->umkm->id_umkm) }}" class="btn-secondary text-xs py-1.5 px-3">
                                    Lihat Profil
                                </a>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="space-y-2 mb-8">
                            <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Deskripsi Produk:</h4>
                            <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                                {{ $produk->deskripsi ?? 'Belum ada keterangan deskripsi tambahan untuk produk ini.' }}
                            </p>
                        </div>
                    </div>

                    <!-- CTA WhatsApp Order -->
                    <div class="pt-6 border-t border-slate-100">
                        <a href="{{ $linkWa }}" target="_blank"
                           class="w-full flex items-center justify-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 px-6 rounded-2xl shadow-lg shadow-emerald-600/20 hover:shadow-xl hover:shadow-emerald-600/30 hover:-translate-y-0.5 transition-all text-sm">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                            </svg>
                            <span>Pesan via WhatsApp Sekarang</span>
                        </a>
                        <p class="text-center text-[11px] text-slate-400 mt-2">
                            Pesan langsung terhubung dengan pengrajin / pemilik UMKM Desa Selotinatah
                        </p>
                    </div>

                </div>
            </div>
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