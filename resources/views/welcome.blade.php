<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Situs Resmi UMKM Desa Selotinatah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">UMKM Selotinatah</a>
            <div class="space-x-4">
                <a href="{{ route('home') }}" class="hover:text-blue-600 font-medium">Beranda</a>
                <a href="{{ route('katalog') }}" class="hover:text-blue-600 font-medium">Katalog Produk</a>
                @auth
                    <a href="{{ route('admin.umkm.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md font-medium">Panel Admin</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-medium">Masuk Admin</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-blue-600 text-white py-16 text-center px-4">
        <h1 class="text-4xl font-extrabold mb-3">Produk Lokal Berkualitas Desa Selotinatah</h1>
        <p class="text-lg max-w-2xl mx-auto mb-6 opacity-90">Dukung perekonomian lokal dengan membeli produk kuliner, kerajinan, dan jasa langsung dari para pelaku UMKM Desa Selotinatah.</p>
        <a href="{{ route('katalog') }}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-bold shadow hover:bg-gray-100">Jelajahi Katalog Produk</a>
    </div>

    <!-- Section UMKM Terbaru -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-6">Pelaku UMKM Selotinatah</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($umkm as $u)
            <div class="bg-white rounded-lg shadow overflow-hidden flex flex-col">
                @if($u->foto)
                    <img src="{{ asset('storage/' . $u->foto) }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">Tidak Ada Foto</div>
                @endif
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded font-semibold">{{ $u->kategori }}</span>
                        <h3 class="text-lg font-bold mt-2">{{ $u->nama_umkm }}</h3>
                        <p class="text-sm text-gray-600">Pemilik: {{ $u->pemilik }}</p>
                    </div>
                    <a href="{{ route('umkm.detail', $u->id_umkm) }}" class="mt-4 block text-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 rounded">Lihat Profil UMKM</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Section Produk Terbaru -->
    <div class="bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6">Produk Terbaru</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($produk as $p)
                <div class="bg-white rounded-lg shadow overflow-hidden flex flex-col">
                    @if($p->foto)
                        <img src="{{ asset('storage/' . $p->foto) }}" class="w-full h-40 object-cover">
                    @else
                        <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                    @endif
                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-gray-800 line-clamp-1">{{ $p->nama_produk }}</h3>
                            <p class="text-sm text-gray-500 mb-2">{{ $p->umkm->nama_umkm ?? '-' }}</p>
                            <p class="text-blue-600 font-extrabold">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ route('produk.detail', $p->id_produk) }}" class="mt-3 block text-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 rounded">Detail & Pesan</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

     <!-- Seksi Berita Desa -->
<section class="py-12 bg-slate-50 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-8">
            <div>
                <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Kabar Terkini</span>
                <h2 class="text-2xl font-extrabold text-gray-900 mt-1">Berita Desa Selotinatah</h2>
            </div>
            <a href="https://selotinatah.magetan.go.id/" target="_blank" class="text-sm font-semibold text-blue-600 hover:text-blue-800">
                Lihat Web Desa &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($berita as $b)
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-xs text-gray-400 mb-2">{{ $b['date'] }}</p>
                        <h3 class="font-bold text-gray-800 text-base mb-2 line-clamp-2 hover:text-blue-600">
                            <a href="{{ $b['link'] }}" target="_blank">{{ $b['title'] }}</a>
                        </h3>
                        <p class="text-gray-600 text-xs leading-relaxed mb-4">
                            {{ $b['description'] }}
                        </p>
                    </div>
                    <a href="{{ $b['link'] }}" target="_blank" class="text-xs font-bold text-blue-600 hover:underline inline-flex items-center gap-1">
                        Baca Selengkapnya
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

    <footer class="bg-white border-t py-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Portal UMKM Desa Selotinatah. All rights reserved.
    </footer>
</body>
</html>