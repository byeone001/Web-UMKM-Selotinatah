<footer class="relative overflow-hidden bg-[#08798a] text-white">
    <div
        class="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-6 py-12 sm:px-8 lg:grid-cols-[1.05fr_1fr_1.15fr_1fr] lg:gap-8 lg:px-10 lg:py-14">
        <section>
            <div class="flex items-start gap-4">
                <img src="{{ asset('images/logo-footer.svg') }}" alt="Logo UMKM Selotinatah"
                    class="mt-1 h-12 w-12 object-contain">
                <div>
                    <h2 class="text-xl font-black leading-tight">Desa Selotinatah</h2>
                    <h4>Kec. Ngariboyo, Kab. Magetan</h4>
                    <div class="mt-3 h-0.5 w-40 bg-white/30"></div>
                </div>
            </div>
            <p class="mt-6 max-w-xs text-sm leading-7 text-white/90">
                Media informasi dan katalog produk UMKM unggulan Desa Selotinatah, Kecamatan Ngariboyo, Kabupaten
                Magetan.
            </p>
            <p class="mt-4 text-sm leading-6 text-white/90">
                885C+4HJ, Unnamed Road, Natah, Selotinatah, Kec. Ngariboyo, Kabupaten Magetan, Jawa Timur 63351
            </p>
        </section>

        <section>
            <h2 class="text-xl font-black">Tautan Terkait</h2>
            <div class="mt-3 h-0.5 w-28 bg-white/30"></div>
            <nav class="mt-6 flex flex-col items-start gap-3 text-sm text-white/90" aria-label="Tautan terkait">
                <a href="{{ route('home') }}" class="transition hover:text-white hover:underline">Beranda Portal
                    UMKM</a>
                <a href="{{ route('katalog') }}" class="transition hover:text-white hover:underline">Katalog Produk</a>
                <a href="{{ route('home') }}#umkm" class="transition hover:text-white hover:underline">Direktori
                    UMKM</a>
                <a href="https://selotinatah.magetan.go.id/" target="_blank" rel="noopener noreferrer"
                    class="transition hover:text-white hover:underline">Website Resmi Desa ↗</a>
            </nav>
        </section>

        <section>
            <div class="overflow-hidden rounded-3xl bg-white text-slate-900 shadow-xl">
                <div class="flex items-center gap-3 border-b border-slate-200 px-5 py-4">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-red-50 text-red-500"
                        aria-hidden="true">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2a7 7 0 00-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 00-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z" />
                        </svg>
                    </span>
                    <h2 class="text-lg font-black">Lokasi Desa Selotinatah</h2>
                </div>
                <div class="p-3">
                    <iframe title="Peta lokasi Desa Selotinatah"
                        src="https://www.google.com/maps?q=Desa+Selotinatah,+Ngariboyo,+Magetan&output=embed"
                        class="h-48 w-full rounded-2xl border-0 sm:h-52" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <a href="https://maps.google.com/?q=Desa+Selotinatah,+Ngariboyo,+Magetan" target="_blank"
                    rel="noopener noreferrer"
                    class="mx-3 mb-3 inline-flex items-center gap-2 text-sm font-bold text-blue-600 hover:underline">
                    Buka di Google Maps
                    <span aria-hidden="true">↗</span>
                </a>
            </div>
        </section>

        <section>
            <h2 class="text-xl font-black">Hubungi Kami</h2>
            <div class="mt-3 h-0.5 w-28 bg-white/30"></div>
            <div class="mt-6 space-y-4 text-sm text-white/90">
                <a href="https://selotinatah.magetan.go.id/" target="_blank" rel="noopener noreferrer"
                    class="flex items-center gap-3 transition hover:text-white">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-white/40"
                        aria-hidden="true">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9" stroke-width="1.6" />
                            <path stroke-linecap="round" stroke-width="1.6"
                                d="M3 12h18M12 3c2.2 2.4 3.4 5.4 3.4 9s-1.2 6.6-3.4 9c-2.2-2.4-3.4-5.4-3.4-9S9.8 5.4 12 3z" />
                        </svg>
                    </span>
                    <span>Website Resmi Umkm Desa</span>
                </a>
                <a href="{{ route('katalog') }}" class="flex items-center gap-3 transition hover:text-white">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-white/40"
                        aria-hidden="true">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                d="M6 7h12l1 13H5L6 7zm3 0a3 3 0 016 0" />
                        </svg>
                    </span>
                    <span>Lihat Katalog Produk</span>
                </a>
                <a href="{{ route('home') }}#umkm" class="flex items-center gap-3 transition hover:text-white">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-white/40"
                        aria-hidden="true">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                d="M16 20a4 4 0 00-8 0M12 12a3 3 0 100-6 3 3 0 000 6zm8 8a4 4 0 00-3-3.87M17 6a3 3 0 010 6" />
                        </svg>
                    </span>
                    <span>Direktori Mitra UMKM</span>
                </a>
            </div>
        </section>
    </div>

    <div class="mx-6 border-t border-white/30 sm:mx-8 lg:mx-10"></div>
    <div class="mx-auto max-w-7xl px-6 py-6 text-center sm:px-8 lg:px-10">
        <p class="text-sm font-black uppercase tracking-wide">© {{ date('Y') }} Portal UMKM Desa Selotinatah</p>
        <p class="mt-2 text-sm italic text-white/85">Mendorong UMKM lokal tumbuh, dikenal, dan terhubung.</p>
        <p class="mt-2 text-xs text-white/70">Bagian dari ekosistem informasi Desa Selotinatah, Kecamatan Ngariboyo,
            Kabupaten Magetan.</p>
        <p class="mt-2 text-xs text-white/70">Powered by KKNT UNESA 2026.</p>
    </div>

    <a href="#top" aria-label="Kembali ke atas"
        class="fixed bottom-6 right-5 z-40 flex h-12 w-12 items-center justify-center rounded-full bg-blue-600 text-2xl font-bold text-white shadow-xl transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
        ↑
    </a>
</footer>