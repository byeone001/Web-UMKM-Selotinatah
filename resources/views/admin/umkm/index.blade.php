<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Data UMKM</h2>
            <a href="{{ route('admin.umkm.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm font-medium">+ Tambah UMKM</a>
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
                            <th class="p-3">Nama UMKM</th>
                            <th class="p-3">Pemilik</th>
                            <th class="p-3">Kategori</th>
                            <th class="p-3">Kontak</th>
                            <th class="p-3">Link Lokasi</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($umkm as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="w-12 h-12 object-cover rounded">
                                @else
                                    <span class="text-xs text-gray-400">No Image</span>
                                @endif
                            </td>
                            <td class="p-3 font-semibold">{{ $item->nama_umkm }}</td>
                            <td class="p-3">{{ $item->pemilik }}</td>
                            <td class="p-3"><span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ $item->kategori }}</span></td>
                            <td class="p-3">{{ $item->kontak }}</td>
                            <td class="p-3">
                                <a href="{{ $item->link_lokasi }}" target="_blank" class="text-blue-600 hover:underline">Lihat Peta</a>
                            </td>
                            <td class="p-3 text-center">
                                <a href="{{ route('admin.umkm.edit', $item->id_umkm) }}" class="text-yellow-600 hover:underline mr-2">Edit</a>
                                <form action="{{ route('admin.umkm.destroy', $item->id_umkm) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-500">Belum ada data UMKM.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $umkm ->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>