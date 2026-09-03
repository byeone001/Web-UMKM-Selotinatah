<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $umkm->nama_umkm }} - UMKM Selotinatah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">UMKM Selotinatah</a>
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 font-medium">&larr; Kembali ke Beranda</a>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4 py-10">
        <!-- Informasi UMKM -->
        <div class="bg-white rounded-xl shadow-md p-6 md:p-8 mb-10 md:flex gap-8 items-center">
            @if($umkm->foto)
                <img src="{{ asset('storage/' . $umkm->foto) }}" class="w-full md:w-64 h-64 object-cover rounded-lg mb-6 md:mb-0">
            @else
                <div class="w-full md:w-64 h-64 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 mb-6 md:mb-0">Tidak Ada Foto</div>
            @endif
            <div class="flex-1 space-y-3">
                <span class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-semibold">{{ $umkm->kategori }}</span>
                <h1 class="text-3xl font-extrabold text-gray-900">{{ $umkm->nama_umkm }}</h1>
                <p class="text-gray-600 font-medium">Pemilik: <span class="text-gray-800 font-bold">{{ $umkm->pemilik }}</span></p>
                <p class="text-gray-600">Kontak WA: <span class="text-gray-800 font-bold">{{ $umkm->kontak }}</span></p>
                <p class="text-gray-600">Alamat: {{ $umkm->alamat }}</p>
                <p class="text-gray-600">{{ $umkm->deskripsi }}</p>

                <div class="pt-2 flex flex-wrap gap-3">
                    <a href="{{ $linkWa }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white font-bold px-4 py-2 rounded-lg text-sm inline-flex items-center gap-2">
                        Hubungi via WhatsApp
                    </a>
                    @if($umkm->link_lokasi)
                        <a href="{{ $umkm->link_lokasi }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded-lg text-sm inline-flex items-center gap-2">
                            Lihat di Google Maps &rarr;
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Daftar Produk UMKM Ini -->
        <h2 class="text-2xl font-bold mb-6">Produk dari {{ $umkm->nama_umkm }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($umkm->produks as $p)
            <div class="bg-white rounded-lg shadow overflow-hidden flex flex-col">
                @if($p->foto)
                    <img src="{{ asset('storage/' . $p->foto) }}" class="w-full h-40 object-cover">
                @else
                    <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                @endif
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-gray-800">{{ $p->nama_produk }}</h3>
                        <p class="text-blue-600 font-extrabold mt-1">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                    </div>
                    <a href="{{ route('produk.detail', $p->id_produk) }}" class="mt-3 block text-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 rounded">Detail & Pesan</a>
                </div>
            </div>
            @empty
            <div class="col-span-full py-8 text-center text-gray-500">
                UMKM ini belum mengunggah produk.
            </div>
            @endforelse
        </div>
    </div>
</body>
</html>