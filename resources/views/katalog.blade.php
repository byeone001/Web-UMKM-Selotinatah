<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk UMKM Selotinatah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">UMKM Selotinatah</a>
            <div class="space-x-4">
                <a href="{{ route('home') }}" class="hover:text-blue-600 font-medium">Beranda</a>
                <a href="{{ route('katalog') }}" class="text-blue-600 font-bold">Katalog Produk</a>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-extrabold mb-6">Katalog Produk Selotinatah</h1>

        <!-- Form Pencarian & Filter -->
        <form action="{{ route('katalog') }}" method="GET" class="bg-white p-4 rounded-lg shadow mb-8 flex flex-col md:flex-row gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..." class="flex-1 border rounded-lg px-4 py-2 focus:outline-blue-500">
            
            <select name="kategori" class="border rounded-lg px-4 py-2 focus:outline-blue-500">
                <option value="">Semua Kategori</option>
                @foreach($kategoriList as $kat)
                    <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2 rounded-lg">Cari</button>
            @if(request()->filled('search') || request()->filled('kategori'))
                <a href="{{ route('katalog') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium px-4 py-2 rounded-lg text-center">Reset</a>
            @endif
        </form>

        <!-- List Produk -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($produk as $p)
            <div class="bg-white rounded-lg shadow overflow-hidden flex flex-col">
                @if($p->foto)
                    <img src="{{ asset('storage/' . $p->foto) }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                @endif
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-gray-800 text-lg">{{ $p->nama_produk }}</h3>
                        <p class="text-sm text-gray-500 mb-2">{{ $p->umkm->nama_umkm ?? '-' }}</p>
                        <p class="text-blue-600 font-extrabold text-lg">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                    </div>
                    <a href="{{ route('produk.detail', $p->id_produk) }}" class="mt-4 block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded">Detail & Pesan WA</a>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center text-gray-500">
                Produk tidak ditemukan sesuai kata kunci atau filter Anda.
            </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $produk->links() }}
        </div>
    </div>
</body>
</html>