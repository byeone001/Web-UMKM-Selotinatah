<x-app-layout>
    <x-slot name="header">
        <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Ringkasan') }}
        </h2> -->

        <div class="flex justify-between items-center mb-6">
            <h2 class="font-bold text-xl text-gray-800 leading-tight">Rekapitulasi Data</h2>
            <div class="flex gap-3">
                <a href="{{ route('admin.laporan.excel') }}" class="bg-green-600 hover:bg-green-700 text-white text-sm font-bold px-4 py-2 rounded-lg flex items-center gap-1">
                    Export Excel (.csv)
                </a>
                <a href="{{ route('admin.laporan.pdf') }}" target="_blank" class="bg-red-600 hover:bg-red-700 text-white text-sm font-bold px-4 py-2 rounded-lg flex items-center gap-1">
                    Cetak / PDF
                </a>
            </div>
        </div>
    </x-slot>


    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Cards Ringkasan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Total UMKM</p>
                    <p class="text-3xl font-black text-gray-800 mt-2">{{ $totalUmkm }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Total Produk</p>
                    <p class="text-3xl font-black text-gray-800 mt-2">{{ $totalProduk }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-purple-500">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Total Kategori</p>
                    <p class="text-3xl font-black text-gray-800 mt-2">{{ $totalKategori }}</p>
                </div>
            </div>

            <!-- Tabel Data Terbaru -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- UMKM Terbaru -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h3 class="font-bold text-lg text-gray-800 mb-4 border-b pb-2">UMKM Terbaru</h3>
                    <div class="space-y-3">
                        @forelse($latestUmkms as $u)
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-bold text-gray-800">{{ $u->nama_umkm }}</p>
                                    <p class="text-xs text-gray-500">{{ $u->pemilik }} ({{ $u->kategori }})</p>
                                </div>
                                <a href="{{ route('admin.umkm.show', $u->id_umkm) }}" class="text-xs text-blue-600 font-semibold hover:underline">Detail</a>
                            </div>
                        @empty
                            <p class="text-sm text-gray-400">Belum ada data UMKM.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Produk Terbaru -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h3 class="font-bold text-lg text-gray-800 mb-4 border-b pb-2">Produk Terbaru</h3>
                    <div class="space-y-3">
                        @forelse($latestProduks as $p)
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-bold text-gray-800">{{ $p->nama_produk }}</p>
                                    <p class="text-xs text-gray-500">Rp {{ number_format($p->harga, 0, ',', '.') }} - {{ $p->umkm->nama_umkm ?? '-' }}</p>
                                </div>
                                <span class="text-xs font-semibold bg-green-100 text-green-700 px-2 py-1 rounded">Aktif</span>
                            </div>
                        @empty
                            <p class="text-sm text-gray-400">Belum ada data produk.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
