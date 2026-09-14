@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
  <!-- Hero Section -->
  <section class="hero-section text-white position-relative" style="background-image: url('https://images.unsplash.com/photo-1559628233-eb1b1a45564b?w=1600&h=900&fit=crop&auto=format');">
    <div class="hero-overlay"></div>
    <div class="container-xl px-3 px-sm-4 py-5 position-relative z-1 my-4">
      <div class="row">
        <div class="col-lg-7 col-md-9">
          <div class="d-inline-block px-3 py-1 rounded-pill bg-white bg-opacity-20 text-white small fw-medium mb-3" style="font-size: 0.8rem;">
            Etalase Digital UMKM Desa
          </div>
          <h1 class="font-serif fw-bold display-5 text-white lh-tight mb-3">
            Kenali Potensi UMKM Desa Selotinatah
          </h1>
          <p class="text-white text-opacity-85 fs-5 lh-base mb-4 pe-lg-4">
            Temukan berbagai usaha dan produk lokal Desa Selotinatah. Dukung pelaku usaha desa, kenali produknya, hubungi langsung.
          </p>
          <div class="d-flex flex-wrap gap-3">
            <a href="{{ route('umkm.index') }}" class="btn btn-light text-custom-primary fw-semibold px-4 py-2" style="border-radius: var(--radius-sm);">
              Jelajahi UMKM
            </a>
            <a href="{{ route('info-desa') }}" class="btn btn-custom-outline-white fw-semibold px-4 py-2">
              Informasi Desa
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Tentang Desa Section -->
  <section class="container-xl px-3 px-sm-4 py-5 my-3">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <div class="text-custom-accent fw-semibold small text-uppercase mb-2" style="letter-spacing: 0.1em; font-size: 0.75rem;">
          Tentang Desa
        </div>
        <h2 class="font-serif fw-bold text-custom-foreground display-6 mb-3">
          Desa Selotinatah
        </h2>
        <p class="text-custom-secondary lh-lg mb-3">
          Desa Selotinatah terletak di Kecamatan Ngariboyo, Kabupaten Magetan, Jawa Timur. Desa ini memiliki beragam potensi UMKM yang dikelola oleh warga setempat, mulai dari peternakan, kerajinan tangan, hingga kuliner khas.
        </p>
        <p class="text-custom-secondary lh-lg mb-4">
          Website ini hadir sebagai etalase digital untuk memperkenalkan dan mempromosikan UMKM Desa Selotinatah kepada masyarakat luas.
        </p>
        <a href="{{ route('info-desa') }}" class="text-decoration-none text-custom-primary fw-semibold small d-inline-flex align-items-center gap-1">
          Pelajari lebih lanjut &rarr;
        </a>
      </div>
      <div class="col-lg-6">
        <div class="position-relative">
          <img src="https://images.unsplash.com/photo-1588084188698-e626698fd8cb?w=700&h=500&fit=crop&auto=format" alt="Pemandangan Desa" class="w-100 object-fit-cover shadow-sm" style="height: 320px; border-radius: 16px;">
          <div class="position-absolute bg-custom-primary text-white px-4 py-2 rounded-3 small fw-medium shadow" style="bottom: -14px; left: -14px;">
            Kecamatan Ngariboyo, Magetan
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Statistik Desa Section (Dipertahankan dari lama, di-styling baru) -->
  <section class="bg-custom-primary-dark text-white py-5">
    <div class="container-xl px-3 px-sm-4">
      <div class="row text-center g-4">
        <div class="col-6 col-md-3">
          <h3 class="display-5 fw-bold text-warning mb-1">{{ $totalUmkm }}</h3>
          <p class="small text-white text-opacity-75 text-uppercase tracking-wider mb-0">UMKM Terdaftar</p>
        </div>
        <div class="col-6 col-md-3">
          <h3 class="display-5 fw-bold text-info mb-1">{{ $totalProduk }}</h3>
          <p class="small text-white text-opacity-75 text-uppercase tracking-wider mb-0">Produk Lokal</p>
        </div>
        <div class="col-6 col-md-3">
          <h3 class="display-5 fw-bold text-success mb-1">{{ $totalKategori }}</h3>
          <p class="small text-white text-opacity-75 text-uppercase tracking-wider mb-0">Kategori Usaha</p>
        </div>
        <div class="col-6 col-md-3">
          <h3 class="display-5 fw-bold text-warning mb-1">100%</h3>
          <p class="small text-white text-opacity-75 text-uppercase tracking-wider mb-0">Karya Asli Desa</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Potensi UMKM Kategori -->
  <section class="bg-custom-secondary py-5">
    <div class="container-xl px-3 px-sm-4">
      <div class="text-center mb-5">
        <div class="text-custom-accent fw-semibold small text-uppercase mb-2" style="letter-spacing: 0.1em; font-size: 0.75rem;">
          Kategori
        </div>
        <h2 class="font-serif fw-bold text-custom-foreground display-6">
          Potensi UMKM Desa
        </h2>
        <p class="text-custom-muted small mt-2">
          Sektor utama UMKM yang berkembang di Desa Selotinatah
        </p>
      </div>

      <div class="row g-4 justify-content-center">
        @if(isset($kategoriInfo))
          @foreach($kategoriInfo as $k)
            <div class="col-md-4">
              <div class="rounded-4 border p-4 text-center h-100 d-flex flex-column {{ $k['bgClass'] }} {{ $k['borderClass'] }}">
                <div class="fs-1 mb-2">{{ $k['icon'] }}</div>
                <h3 class="font-serif fw-semibold fs-5 mb-2">{{ $k['label'] }}</h3>
                <p class="text-custom-secondary small lh-base mb-3 flex-grow-1">
                  {{ $k['desc'] }}
                </p>
                <div>
                  <a href="{{ route('umkm.index', ['kategori' => $k['label']]) }}" class="text-decoration-none text-custom-primary small fw-semibold">
                    Lihat UMKM &rarr;
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </section>

  <!-- UMKM Unggulan -->
  <section class="container-xl px-3 px-sm-4 py-5 my-3">
    <div class="d-flex justify-content-between align-items-end mb-4">
      <div>
        <div class="text-custom-accent fw-semibold small text-uppercase mb-1" style="letter-spacing: 0.1em; font-size: 0.75rem;">
          Penggerak Ekonomi Desa
        </div>
        <h2 class="font-serif fw-bold text-custom-foreground display-6 mb-0">
          Pelaku UMKM Selotinatah
        </h2>
      </div>
      <a href="{{ route('umkm.index') }}" class="d-none d-sm-inline-flex text-decoration-none text-custom-primary small fw-semibold">
        Lihat Semua &rarr;
      </a>
    </div>

    <div class="row g-4">
      @foreach($umkm->take(3) as $u)
        <div class="col-md-4 col-sm-6">
          <x-umkm-card-new :umkm="$u" />
        </div>
      @endforeach
    </div>

    <div class="text-center mt-5">
      <a href="{{ route('umkm.index') }}" class="btn btn-custom-outline-thick">
        Lihat Semua UMKM
      </a>
    </div>
  </section>

  <!-- KATALOG PRODUK TERBARU -->
  <section class="bg-custom-secondary py-5">
    <div class="container-xl px-3 px-sm-4">
        <div class="d-flex flex-column sm:flex-row sm:items-end justify-content-between mb-4 gap-3">
            <div>
                <div class="text-custom-accent fw-semibold small text-uppercase mb-1" style="letter-spacing: 0.1em; font-size: 0.75rem;">
                    Katalog Unggulan
                </div>
                <h2 class="font-serif fw-bold text-custom-foreground display-6 mb-0">
                    Produk Terbaru UMKM
                </h2>
            </div>
            <a href="{{ route('katalog') }}" class="text-decoration-none text-custom-primary small fw-semibold">
                Lihat Seluruh Katalog &rarr;
            </a>
        </div>

        <div class="row g-4">
            @forelse($produk as $p)
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <x-produk-card-new :produk="$p" />
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted font-semibold">Produk tidak ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>
  </section>

  <!-- SEKSI BERITA DESA SELOTINATAH -->
  <section class="container-xl px-3 px-sm-4 py-5 my-3">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
          <div>
              <div class="text-custom-accent fw-semibold small text-uppercase mb-1" style="letter-spacing: 0.1em; font-size: 0.75rem;">
                  Kabar Terkini
              </div>
              <h2 class="font-serif fw-bold text-custom-foreground display-6 mb-0">
                  Berita & Informasi Desa
              </h2>
              <p class="text-custom-muted small mt-2 mb-0">
                  Dapatkan update seputar kegiatan, potensi, dan pembangunan Desa Selotinatah.
              </p>
          </div>
          <a href="https://selotinatah.magetan.go.id/" target="_blank" class="btn btn-custom-outline-primary d-inline-flex align-items-center gap-2">
              <span>Kunjungi Web Desa</span>
              <i class="bi bi-box-arrow-up-right"></i>
          </a>
      </div>

      <div class="row g-4">
          @forelse($berita as $b)
              <div class="col-md-4">
                  <div class="card-custom h-100">
                      @if(!empty($b['image']))
                          <div class="card-img-wrapper" style="height: 180px;">
                              <img src="{{ $b['image'] }}" alt="{{ $b['title'] }}" class="w-100 h-100 object-fit-cover" onerror="this.parentElement.style.display='none'">
                              <span class="position-absolute top-0 start-0 m-2 px-2 py-1 rounded bg-white bg-opacity-75 text-dark small fw-bold" style="font-size: 0.7rem; backdrop-filter: blur(4px);">
                                  Website Resmi Desa
                              </span>
                          </div>
                      @endif
                      <div class="p-4 d-flex flex-column flex-grow-1">
                          <div class="d-flex align-items-center justify-content-between mb-2">
                              <span class="badge bg-custom-primary bg-opacity-10 text-custom-primary">Berita Resmi</span>
                              <span class="small text-muted" style="font-size: 0.75rem;">{{ $b['date'] }}</span>
                          </div>
                          <h3 class="font-serif fw-bold fs-6 mb-2 line-clamp-2">
                              <a href="{{ $b['link'] }}" target="_blank" class="text-decoration-none text-dark">{{ $b['title'] }}</a>
                          </h3>
                          <p class="text-muted small line-clamp-3 mb-3 flex-grow-1">
                              {{ $b['description'] }}
                          </p>
                          <div class="border-top pt-3">
                              <a href="{{ $b['link'] }}" target="_blank" class="text-decoration-none text-custom-primary small fw-semibold d-flex align-items-center gap-1">
                                  Baca di Web Desa <i class="bi bi-arrow-right"></i>
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
          @empty
              <div class="col-12 text-center py-5 text-muted small">Belum ada berita.</div>
          @endforelse
      </div>
  </section>

  <!-- CTA Section -->
  <section class="bg-custom-primary text-white py-5 text-center">
    <div class="container-xl px-3 px-sm-4 py-3">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <h2 class="font-serif fw-bold display-6 mb-3">
            Temukan UMKM Lokal Selotinatah
          </h2>
          <p class="text-white text-opacity-80 mb-4 lh-base">
            Kenali lebih dekat para pelaku usaha desa. Temukan produk lokal berkualitas dan hubungi langsung UMKM pilihan Anda.
          </p>
          <a href="{{ route('umkm.index') }}" class="btn btn-light text-custom-primary fw-semibold px-4 py-2.5 rounded-3">
            Lihat Semua UMKM
          </a>
        </div>
      </div>
    </div>
  </section>
@endsection