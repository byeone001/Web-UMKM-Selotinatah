<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Produk</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Pilih UMKM Pemilik</label>
                        <select name="id_umkm" required class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                            @foreach($umkms as $u)
                                <option value="{{ $u->id_umkm }}" {{ $produk->id_umkm == $u->id_umkm ? 'selected' : '' }}>
                                    {{ $u->nama_umkm }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Nama Produk</label>
                        <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" required class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Harga (Rp)</label>
                        <input type="number" name="harga" value="{{ $produk->harga }}" step="1000" required class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Deskripsi Produk</label>
                        <textarea name="deskripsi" rows="3" class="w-full border-gray-300 rounded-md shadow-sm mt-1">{{ $produk->deskripsi }}</textarea>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Foto Produk</label>
                        @if($produk->foto)
                            <img src="{{ asset('storage/' . $produk->foto) }}" class="w-20 h-20 object-cover rounded mb-2 mt-1">
                        @endif
                        <input type="file" name="foto" class="w-full mt-1">
                    </div>
                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('admin.produk.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Update Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>