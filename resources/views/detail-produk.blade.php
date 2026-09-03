<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produk->nama_produk }} - UMKM Selotinatah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">UMKM Selotinatah</a>
            <a href="{{ route('katalog') }}" class="text-gray-600 hover:text-blue-600 font-medium">&larr; Kembali ke Katalog</a>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-4 py-10">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden md:flex">
            <div class="md:w-1/2">
                @if($produk->foto)
                    <img src="{{ asset('storage/' . $produk->foto) }}" class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gray-200 flex items-center justify-center text-gray-400">Tidak Ada Foto</div>
                @endif
            </div>
            <div class="p-8 md:w-1/2 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-semibold bg-blue-100 text-blue-700 px-3 py-1 rounded-full">{{ $produk->umkm->kategori ?? 'Umum' }}</span>
                    <h1 class="text-3xl font-extrabold mt-3 text-gray-900">{{ $produk->nama_produk }}</h1>
                    <p class="text-2xl font-black text-blue-600 mt-2">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    
                    <div class="mt-6 border-t pt-4">
                        <p class="text-sm text-gray-500 font-medium">Diproduksi oleh:</p>
                        <a href="{{ route('umkm.detail', $produk->umkm->id_umkm) }}" class="text-lg font-bold text-gray-800 hover:text-blue-600 underline">
                            {{ $produk->umkm->nama_umkm }}
                        </a>
                        <p class="text-sm text-gray-600">Pemilik: {{ $produk->umkm->pemilik }}</p>
                    </div>

                    <div class="mt-6">
                        <h3 class="font-bold text-gray-700 mb-1">Deskripsi Produk:</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $produk->deskripsi ?? 'Belum ada deskripsi untuk produk ini.' }}</p>
                    </div>
                </div>

                <!-- Tombol Pesan WhatsApp -->
                <div class="mt-8 pt-4 border-t">
                    <a href="{{ $linkWa }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        Pesan via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>