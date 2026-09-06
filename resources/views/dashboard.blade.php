<x-app-layout>
    {{-- No header slot — using topbar title detection from route name --}}

    <div class="space-y-6">

        {{-- =============================================
             PAGE HEADER
             ============================================= --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Dashboard Rekap</h1>
                <p class="page-subtitle">Ringkasan data UMKM & Produk Anyaman Bambu Desa Selotinatah</p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('admin.laporan.excel') }}"
                   class="btn-primary gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export Excel
                </a>
                <a href="{{ route('admin.laporan.pdf') }}" target="_blank"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-xl shadow-sm hover:shadow-md transition-all duration-200 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Cetak PDF
                </a>
            </div>
        </div>

        {{-- =============================================
             METRIC CARDS
             ============================================= --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

            {{-- Total UMKM --}}
            <div class="metric-card">
                {{-- Decorative gradient blob --}}
                <div class="absolute -right-6 -top-6 w-32 h-32 rounded-full bg-emerald-100/60 pointer-events-none"></div>
                <div class="relative z-10">
                    <div class="metric-card-icon bg-gradient-to-br from-emerald-100 to-emerald-50">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Total UMKM</p>
                        <p class="text-4xl font-black text-slate-800">{{ $totalUmkm }}</p>
                        <div class="flex items-center gap-1.5 mt-2">
                            <span class="badge-green text-[10px]">Aktif</span>
                            <a href="{{ route('admin.umkm.index') }}" class="text-xs text-emerald-600 hover:underline font-semibold">Lihat semua →</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Produk --}}
            <div class="metric-card">
                <div class="absolute -right-6 -top-6 w-32 h-32 rounded-full bg-blue-100/60 pointer-events-none"></div>
                <div class="relative z-10">
                    <div class="metric-card-icon bg-gradient-to-br from-blue-100 to-blue-50">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Total Produk</p>
                        <p class="text-4xl font-black text-slate-800">{{ $totalProduk }}</p>
                        <div class="flex items-center gap-1.5 mt-2">
                            <span class="badge-blue text-[10px]">Anyaman Bambu</span>
                            <a href="{{ route('admin.produk.index') }}" class="text-xs text-blue-600 hover:underline font-semibold">Lihat semua →</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Kategori --}}
            <div class="metric-card">
                <div class="absolute -right-6 -top-6 w-32 h-32 rounded-full bg-purple-100/60 pointer-events-none"></div>
                <div class="relative z-10">
                    <div class="metric-card-icon bg-gradient-to-br from-purple-100 to-purple-50">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Total Kategori</p>
                        <p class="text-4xl font-black text-slate-800">{{ $totalKategori }}</p>
                        <div class="flex items-center gap-1.5 mt-2">
                            <span class="badge-amber text-[10px]">Jenis Produk</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- =============================================
             QUICK ACTIONS
             ============================================= --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <a href="{{ route('admin.umkm.create') }}"
               class="flex flex-col items-center gap-2 p-4 bg-white hover:bg-emerald-50 rounded-2xl border border-slate-200 hover:border-emerald-300 transition-all duration-200 group">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 group-hover:bg-emerald-200 flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-slate-600 group-hover:text-emerald-700 text-center">Tambah UMKM</span>
            </a>
            <a href="{{ route('admin.produk.create') }}"
               class="flex flex-col items-center gap-2 p-4 bg-white hover:bg-blue-50 rounded-2xl border border-slate-200 hover:border-blue-300 transition-all duration-200 group">
                <div class="w-10 h-10 rounded-xl bg-blue-100 group-hover:bg-blue-200 flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-slate-600 group-hover:text-blue-700 text-center">Tambah Produk</span>
            </a>
            <a href="{{ route('admin.laporan.pdf') }}" target="_blank"
               class="flex flex-col items-center gap-2 p-4 bg-white hover:bg-red-50 rounded-2xl border border-slate-200 hover:border-red-300 transition-all duration-200 group">
                <div class="w-10 h-10 rounded-xl bg-red-100 group-hover:bg-red-200 flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-slate-600 group-hover:text-red-700 text-center">Cetak PDF</span>
            </a>
            <a href="{{ route('home') }}" target="_blank"
               class="flex flex-col items-center gap-2 p-4 bg-white hover:bg-slate-100 rounded-2xl border border-slate-200 hover:border-slate-300 transition-all duration-200 group">
                <div class="w-10 h-10 rounded-xl bg-slate-100 group-hover:bg-slate-200 flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-slate-600 group-hover:text-slate-800 text-center">Web Publik</span>
            </a>
        </div>

        {{-- =============================================
             RECENT ACTIVITY GRID
             ============================================= --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

            {{-- UMKM Terbaru --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-emerald-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-black text-slate-800">UMKM Terbaru</h3>
                            <p class="text-xs text-slate-400">Pendaftar terkini</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.umkm.index') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition-colors">Lihat Semua →</a>
                </div>
                <div class="divide-y divide-slate-100">
                    @forelse($latestUmkms as $u)
                        <div class="flex items-center justify-between px-6 py-3.5 hover:bg-slate-50 transition-colors group">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center text-emerald-700 font-black text-sm flex-shrink-0">
                                    {{ substr($u->nama_umkm, 0, 1) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-slate-800 text-sm truncate">{{ $u->nama_umkm }}</p>
                                    <p class="text-xs text-slate-400">{{ $u->pemilik }} &middot; {{ $u->kategori }}</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.umkm.show', $u->id_umkm) }}"
                               class="flex-shrink-0 text-xs font-bold text-emerald-600 hover:text-emerald-700 bg-emerald-50 hover:bg-emerald-100 px-3 py-1.5 rounded-lg transition-all">
                                Detail
                            </a>
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center">
                            <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <p class="text-sm text-slate-400 font-medium">Belum ada data UMKM</p>
                            <a href="{{ route('admin.umkm.create') }}" class="mt-2 inline-block text-xs text-emerald-600 font-bold">+ Tambah UMKM</a>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Produk Terbaru --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-black text-slate-800">Produk Terbaru</h3>
                            <p class="text-xs text-slate-400">Anyaman bambu terkini</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.produk.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 transition-colors">Lihat Semua →</a>
                </div>
                <div class="divide-y divide-slate-100">
                    @forelse($latestProduks as $p)
                        <div class="flex items-center justify-between px-6 py-3.5 hover:bg-slate-50 transition-colors">
                            <div class="flex items-center gap-3 min-w-0">
                                @if($p->foto)
                                    <img src="{{ asset('storage/' . $p->foto) }}"
                                         class="w-9 h-9 rounded-xl object-cover flex-shrink-0 border border-slate-200">
                                @else
                                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center text-blue-700 font-black text-sm flex-shrink-0">
                                        {{ substr($p->nama_produk, 0, 1) }}
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="font-bold text-slate-800 text-sm truncate">{{ $p->nama_produk }}</p>
                                    <p class="text-xs text-slate-400">Rp {{ number_format($p->harga, 0, ',', '.') }} &middot; {{ $p->umkm->nama_umkm ?? '-' }}</p>
                                </div>
                            </div>
                            <span class="badge-green text-[10px] flex-shrink-0">Aktif</span>
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center">
                            <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <p class="text-sm text-slate-400 font-medium">Belum ada data produk</p>
                            <a href="{{ route('admin.produk.create') }}" class="mt-2 inline-block text-xs text-blue-600 font-bold">+ Tambah Produk</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- =============================================
             KABAR DESA WIDGET
             ============================================= --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card overflow-hidden">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between px-6 py-4 border-b border-slate-100 gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-black text-slate-800">Kabar & Informasi Desa</h3>
                        <p class="text-xs text-slate-400">Sinkronisasi dari Portal Web Desa Selotinatah</p>
                    </div>
                </div>
                <a href="https://selotinatah.magetan.go.id/berita" target="_blank"
                   class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 px-3 py-2 rounded-lg border border-blue-200 transition-colors">
                    <span>Buka Web Desa</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-0 divide-y md:divide-y-0 md:divide-x divide-slate-100">
                @forelse($berita as $b)
                    <a href="{{ $b['link'] }}" target="_blank"
                       class="block p-5 hover:bg-slate-50/80 transition-colors group">
                        <div class="flex items-center justify-between text-xs text-slate-400 mb-3">
                            <span class="px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 font-bold text-[10px] uppercase tracking-wider border border-blue-100">Kabar Desa</span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $b['date'] }}
                            </span>
                        </div>
                        <h4 class="font-bold text-slate-800 text-sm group-hover:text-blue-600 transition-colors line-clamp-2 mb-2">
                            {{ $b['title'] }}
                        </h4>
                        <p class="text-slate-500 text-xs leading-relaxed line-clamp-3 mb-3">
                            {{ $b['description'] }}
                        </p>
                        <div class="flex items-center gap-1 text-xs font-bold text-blue-600 group-hover:gap-2 transition-all">
                            <span>Baca selengkapnya</span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 py-12 text-center">
                        <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                        <p class="text-sm text-slate-500 font-semibold">Belum ada kabar desa yang tersedia</p>
                        <p class="text-xs text-slate-400 mt-1">Konten akan muncul saat portal desa bisa diakses</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</x-app-layout>
