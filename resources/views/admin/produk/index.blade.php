<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Data Produk</h2>
            <a href="{{ route('admin.produk.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm font-medium">+ Tambah Produk</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="p-3">Foto</th>
                            <th class="p-3">Nama Produk</th>
                            <th class="p-3">Pemilik UMKM</th>
                            <th class="p-3">Harga</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produk as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="w-12 h-12 object-cover rounded">
                                @else
                                    <span class="text-xs text-gray-400">No Image</span>
                                @endif
                            </td>
                            <td class="p-3 font-semibold">{{ $item->nama_produk }}</td>
                            <td class="p-3 text-gray-600">{{ $item->umkm->nama_umkm ?? '-' }}</td>
                            <td class="p-3 font-medium">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="p-3 text-center">
                                <a href="{{ route('admin.produk.edit', $item->id_produk) }}" class="text-yellow-600 hover:underline mr-2">Edit</a>
                                <form action="{{ route('admin.produk.destroy', $item->id_produk) }}" method="POST" class="inline" onsubmit="return confirm('Hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">Belum ada data produk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $produk->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>