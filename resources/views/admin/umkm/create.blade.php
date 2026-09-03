<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Data UMKM</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.umkm.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Nama UMKM</label>
                        <input type="text" name="nama_umkm" required class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Nama Pemilik</label>
                            <input type="text" name="pemilik" required class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Kategori Usaha</label>
                            <input type="text" name="kategori" placeholder="misal: Kuliner, Kerajinan" required class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                        </div>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Nomor WhatsApp/Kontak (Format: 08xxx / 628xxx)</label>
                        <input type="text" name="kontak" class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Alamat Lengkap</label>
                        <textarea name="alamat" rows="2" class="w-full border-gray-300 rounded-md shadow-sm mt-1"></textarea>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Deskripsi UMKM</label>
                        <textarea name="deskripsi" rows="3" class="w-full border-gray-300 rounded-md shadow-sm mt-1"></textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Link Lokasi UMKM</label>
                        <textarea name="link_lokasi" rows="1" class="w-full border-gray-300 rounded-md shadow-sm mt-1"></textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Foto UMKM / Tempat Usaha</label>
                        <input type="file" name="foto" class="w-full mt-1">
                    </div>
                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('admin.umkm.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>