<x-app-layout>
    <div class="space-y-6" x-data="{ deleteModal: false, deleteUrl: '' }">

        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Kelola UMKM</h1>
                <p class="page-subtitle">Data UMKM terdaftar di Desa Selotinatah</p>
            </div>
            <a href="{{ route('admin.umkm.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah UMKM
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
            <form action="{{ route('admin.umkm.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari nama UMKM, pemilik, atau kategori..."
                           class="form-input pl-10 py-2.5">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="btn-primary py-2.5 px-5">Cari</button>
                    @if(request()->filled('search'))
                        <a href="{{ route('admin.umkm.index') }}" class="btn-ghost py-2.5">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Data Table --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <p class="text-sm font-bold text-slate-700">
                    Total: <span class="text-emerald-600">{{ $umkms->total() }}</span> UMKM terdaftar
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
                            <th>Nama UMKM</th>
                            <th>Pemilik</th>
                            <th>Kategori</th>
                            <th>Kontak</th>
                            <th>Lokasi</th>
                            <th class="text-center pr-6">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($umkms as $item)
                            <tr>
                                <td class="pl-6">
                                    @if($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}"
                                             class="w-11 h-11 rounded-xl object-cover border border-slate-200">
                                    @else
                                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center text-emerald-700 font-black text-sm">
                                            {{ substr($item->nama_umkm, 0, 1) }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <p class="font-bold text-slate-800">{{ $item->nama_umkm }}</p>
                                </td>
                                <td>
                                    <p class="text-slate-600">{{ $item->pemilik }}</p>
                                </td>
                                <td>
                                    <span class="badge-green">{{ $item->kategori }}</span>
                                </td>
                                <td>
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $item->kontak) }}" target="_blank"
                                       class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 hover:text-emerald-700">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                        </svg>
                                        {{ $item->kontak }}
                                    </a>
                                </td>
                                <td>
                                    @if($item->link_lokasi)
                                        <a href="{{ $item->link_lokasi }}" target="_blank"
                                           class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 hover:text-blue-700">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            Peta
                                        </a>
                                    @else
                                        <span class="text-xs text-slate-400">—</span>
                                    @endif
                                </td>
                                <td class="pr-6">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.umkm.edit', $item->id_umkm) }}"
                                           class="btn-warning py-1.5 px-3 text-xs">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>
                                        <button type="button"
                                                @click="deleteModal = true; deleteUrl = '{{ route('admin.umkm.destroy', $item->id_umkm) }}'"
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
                                <td colspan="7" class="py-16 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">
                                            <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-600">Belum ada data UMKM</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Mulai tambahkan UMKM pertama Anda</p>
                                        </div>
                                        <a href="{{ route('admin.umkm.create') }}" class="btn-primary mt-1">
                                            + Tambah UMKM Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($umkms->hasPages())
                <div class="px-6 py-4 border-t border-slate-100">
                    {{ $umkms->links() }}
                </div>
            @endif
        </div>

        {{-- =============================================
             DELETE CONFIRMATION MODAL
             ============================================= --}}
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
                        <h3 class="text-lg font-black text-slate-900">Hapus Data UMKM</h3>
                        <p class="text-sm text-slate-500 mt-0.5">Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                </div>
                <p class="text-sm text-slate-600 mb-6 p-4 bg-red-50 rounded-xl border border-red-100">
                    ⚠️ Anda yakin ingin menghapus data UMKM ini beserta semua produk yang terkait? Data yang sudah dihapus tidak dapat dipulihkan.
                </p>
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
                            Ya, Hapus Data
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>