<x-app-layout>
    <div class="space-y-6" x-data="{ deleteModal: false, deleteUrl: '', deleteName: '' }">

        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Kelola Produk</h1>
                <p class="page-subtitle">Data produk anyaman bambu & produk lokal Desa Selotinatah</p>
            </div>
            <a href="{{ route('admin.produk.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Produk
            </a>
        </div>

        {{-- Alert --}}
        @if(session('success'))
            <div class="alert-success">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- Search Bar --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card p-4">
            <form action="{{ route('admin.produk.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari nama produk atau nama UMKM..."
                           class="form-input pl-10 py-2.5">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="btn-primary py-2.5 px-5">Cari</button>
                    @if(request()->filled('search'))
                        <a href="{{ route('admin.produk.index') }}" class="btn-ghost py-2.5">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Data Table --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <p class="text-sm font-bold text-slate-700">
                    Total: <span class="text-blue-600">{{ $produks->total() }}</span> produk terdaftar
                </p>
                @if(request()->filled('search'))
                    <span class="badge-blue text-xs">Filter: "{{ request('search') }}"</span>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th class="pl-6">Foto</th>
                            <th>Nama Produk</th>
                            <th>UMKM Pemilik</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th class="text-center pr-6">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produks as $item)
                            <tr>
                                <td class="pl-6">
                                    @if($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}"
                                             class="w-11 h-11 rounded-xl object-cover border border-slate-200">
                                    @else
                                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center text-blue-700 font-black text-sm">
                                            {{ substr($item->nama_produk, 0, 1) }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <p class="font-bold text-slate-800">{{ $item->nama_produk }}</p>
                                </td>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-xs flex-shrink-0">
                                            {{ substr($item->umkm->nama_umkm ?? '-', 0, 1) }}
                                        </div>
                                        <span class="text-slate-600 text-sm">{{ $item->umkm->nama_umkm ?? '—' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="font-bold text-slate-800">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                                </td>
                                <td>
                                    <span class="badge-green">Aktif</span>
                                </td>
                                <td class="pr-6">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.produk.edit', $item->id_produk) }}"
                                           class="btn-warning py-1.5 px-3 text-xs">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>
                                        <button type="button"
                                                @click="deleteModal = true; deleteUrl = '{{ route('admin.produk.destroy', $item->id_produk) }}'; deleteName = '{{ $item->nama_produk }}'"
                                                class="btn-danger py-1.5 px-3 text-xs">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-16 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">
                                            <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-600">Belum ada data produk</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Mulai tambahkan produk anyaman bambu pertama</p>
                                        </div>
                                        <a href="{{ route('admin.produk.create') }}" class="btn-primary mt-1">
                                            + Tambah Produk Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($produks->hasPages())
                <div class="px-6 py-4 border-t border-slate-100">
                    {{ $produks->links() }}
                </div>
            @endif
        </div>

        {{-- Delete Modal --}}
        <div x-show="deleteModal"
             x-cloak
             class="modal-overlay"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="modal-box" @click.stop>
                <div class="flex items-center gap-4 mb-5">
                    <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-slate-900">Hapus Produk</h3>
                        <p class="text-sm text-slate-500 mt-0.5">Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                </div>
                <div class="mb-6 p-4 bg-red-50 rounded-xl border border-red-100">
                    <p class="text-sm text-slate-700">
                        ⚠️ Anda akan menghapus produk:
                        <span class="font-black text-red-700" x-text='"' + deleteName + '"'"></span>
                    </p>
                    <p class="text-xs text-slate-500 mt-1">Data yang sudah dihapus tidak dapat dipulihkan.</p>
                </div>
                <div class="flex items-center gap-3">
                    <button type="button"
                            @click="deleteModal = false"
                            class="flex-1 py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-sm rounded-xl transition-all">
                        Batal
                    </button>
                    <form :action="deleteUrl" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full py-2.5 px-4 bg-red-600 hover:bg-red-700 text-white font-bold text-sm rounded-xl transition-all active:scale-95 shadow-sm shadow-red-600/20">
                            Ya, Hapus Produk
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>