<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-header.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon-32x32.png') }}">
    <meta name="description" content="{{ $produk->nama_produk }} - Produk UMKM Desa Selotinatah, Ngariboyo, Magetan">
    <title>{{ $produk->nama_produk }} - UMKM Selotinatah</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body id="top"
    class="bg-slate-50 font-sans text-slate-800 antialiased selection:bg-emerald-600 selection:text-white flex flex-col min-h-screen">

    <!-- NAVBAR -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200/80">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 min-h-16 sm:h-20 py-3 sm:py-0 flex items-center justify-between gap-3">
            <a href="{{ route('home') }}" aria-label="Beranda UMKM Selotinatah"
                class="flex min-w-0 items-center gap-2 sm:gap-3 group">
                <img src="{{ asset('images/logo-header.svg') }}" alt="Logo UMKM Selotinatah"
                    class="w-10 h-10 object-contain group-hover:scale-105 transition-transform">
                <div class="min-w-0">
                    <span
                        class="font-black text-sm sm:text-lg tracking-tight text-slate-900 block leading-none truncate">UMKM
                        SELOTINATAH</span>
                    <span
                        class="hidden sm:block text-[11px] font-semibold text-emerald-700 tracking-wider uppercase">Kec.
                        Ngariboyo, Magetan</span>
                </div>
            </a>

            <div class="flex-shrink-0">
                <a href="{{ route('katalog') }}"
                    class="inline-flex items-center gap-1.5 sm:gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700 transition-colors whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="hidden sm:inline">Kembali ke Katalog</span>
                    <span class="sm:hidden">Katalog</span>
                </a>
            </div>
        </div>
    </header>

    <!-- MAIN DETAIL CONTENT -->
    <main class="flex-1 max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10 pb-10">

        <!-- Breadcrumb -->
        <nav aria-label="Breadcrumb"
            class="flex min-w-0 items-center gap-1.5 sm:gap-2 text-xs text-slate-500 mb-4 sm:mb-6 overflow-hidden">
            <a href="{{ route('home') }}" class="hover:text-emerald-700 transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('katalog') }}" class="hover:text-emerald-700 transition-colors">Katalog Produk</a>
            <span>/</span>
            <span class="text-slate-800 font-semibold truncate min-w-0">{{ $produk->nama_produk }}</span>
        </nav>

        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-card overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12">

                <!-- Left: Product Gallery -->
                @php
                    $galleryImages = collect([$produk->foto])
                        ->filter()
                        ->merge($produk->fotos->pluck('foto'))
                        ->values();
                    $firstGalleryImage = $galleryImages->first();
                @endphp
                <div x-data="{
                    activeImage: @js($firstGalleryImage ? asset('storage/' . $firstGalleryImage) : null),
                    imageFailed: false
                }" class="lg:col-span-6 bg-slate-100 relative p-3 sm:p-4">
                    <div
                        class="relative aspect-[4/3] sm:aspect-auto min-h-0 sm:min-h-[360px] lg:min-h-[500px] flex items-center justify-center overflow-hidden rounded-2xl bg-slate-200">
                        <template x-if="activeImage && !imageFailed">
                            <img :src="activeImage" alt="{{ $produk->nama_produk }}" fetchpriority="high"
                                class="h-full w-full object-cover" x-on:error="imageFailed = true">
                        </template>
                        <div x-show="!activeImage || imageFailed"
                            class="absolute inset-0 flex flex-col items-center justify-center p-8 text-center bg-gradient-to-br from-emerald-50 to-teal-50 weave-bg">
                            <div
                                class="w-20 h-20 rounded-3xl bg-white shadow-sm flex items-center justify-center text-emerald-600 mb-3">
                                <svg class="w-10 h-10 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-slate-700">Foto produk belum tersedia</p>
                            <p class="text-xs text-slate-400 mt-0.5">Produk lokal Desa Selotinatah</p>
                        </div>
                    </div>
                    @if($galleryImages->count() > 1)
                        <div class="mt-3 grid grid-cols-5 gap-2" aria-label="Galeri foto produk">
                            @foreach($galleryImages as $index => $galleryImage)
                                <button type="button"
                                    @click="activeImage = @js(asset('storage/' . $galleryImage)); imageFailed = false"
                                    :class="activeImage === @js(asset('storage/' . $galleryImage)) ? 'ring-2 ring-emerald-500 ring-offset-2' : 'opacity-70 hover:opacity-100'"
                                    class="aspect-square overflow-hidden rounded-xl bg-slate-200 transition-opacity"
                                    aria-label="Tampilkan foto {{ $index + 1 }}">
                                    <img src="{{ asset('storage/' . $galleryImage) }}"
                                        alt="{{ $produk->nama_produk }} - foto {{ $index + 1 }}" loading="lazy" decoding="async"
                                        class="h-full w-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="badge-green text-xs backdrop-blur-md bg-white/90 shadow-sm">
                            {{ $produk->umkm->kategori ?? 'Kerajinan' }}
                        </span>
                    </div>
                </div>

                <!-- Right: Product Info & Order Action -->
                <div class="lg:col-span-6 p-5 sm:p-8 lg:p-10 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-xs font-semibold text-slate-400">Kode Produk:
                                #PRD-{{ $produk->id_produk }}</span>
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
                            <p class="text-xs font-semibold text-slate-400 mb-2 uppercase tracking-wider">Diproduksi
                                Oleh:</p>
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="flex min-w-0 items-center gap-3">
                                    <div
                                        class="w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-black text-lg shadow-sm">
                                        {{ substr($produk->umkm->nama_umkm ?? 'U', 0, 1) }}
                                    </div>
                                    <div class="min-w-0">
                                        <h3
                                            class="font-bold text-slate-900 text-sm hover:text-emerald-700 transition-colors">
                                            <a href="{{ route('umkm.detail', $produk->umkm->id_umkm) }}">
                                                <span class="truncate">{{ $produk->umkm->nama_umkm }} &rarr;</span>
                                            </a>
                                        </h3>
                                        <p class="text-xs text-slate-500">Pemilik: {{ $produk->umkm->pemilik }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('umkm.detail', $produk->umkm->id_umkm) }}"
                                    class="btn-secondary w-full sm:w-auto justify-center text-xs py-2 px-3">
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
                    <div
                        class="sticky bottom-0 z-20 -mx-5 px-5 pb-3 pt-5 bg-white/95 backdrop-blur-sm border-t border-slate-100 sm:static sm:mx-0 sm:px-0 sm:pb-0 sm:pt-6 sm:bg-transparent sm:backdrop-blur-none lg:sticky lg:bottom-4 lg:bg-white lg:pb-1">
                        @if($linkWa)
                            <a href="{{ $linkWa }}" target="_blank" rel="noopener noreferrer"
                                class="w-full flex items-center justify-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 px-6 rounded-2xl shadow-lg shadow-emerald-600/20 hover:shadow-xl hover:shadow-emerald-600/30 hover:-translate-y-0.5 transition-all text-sm">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z" />
                                </svg>
                                <span>Pesan via WhatsApp Sekarang</span>
                            </a>
                            <p class="text-center text-[11px] text-slate-400 mt-2">
                                Pesan langsung terhubung dengan pengrajin / pemilik UMKM Desa Selotinatah
                            </p>
                        @else
                            <p class="text-center text-sm font-semibold text-slate-500">Nomor WhatsApp pemilik belum
                                tersedia.</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </main>

    @include('components.public-footer')

</body>

</html>