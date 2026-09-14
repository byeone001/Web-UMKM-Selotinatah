@extends('layouts.public')

@section('title', 'Informasi Desa')

@section('content')
  <div class="container-xl px-3 px-sm-4 py-5" style="max-width: 1040px;">
    <!-- Page Header -->
    <div class="mb-4">
      <div class="text-custom-accent fw-semibold small text-uppercase mb-2" style="letter-spacing: 0.1em; font-size: 0.75rem;">
        Profil Desa
      </div>
      <h1 class="font-serif fw-bold text-custom-foreground display-6 mb-2">
        Informasi Desa Selotinatah
      </h1>
      <p class="text-custom-muted mb-0">
        Mengenal lebih dekat Desa Selotinatah dan potensi UMKM-nya.
      </p>
    </div>

    <!-- Hero Image Banner -->
    <div class="position-relative rounded-4 overflow-hidden mb-5 bg-custom-muted shadow-sm" style="height: 300px;">
      <img src="https://images.unsplash.com/photo-1588084188698-e626698fd8cb?w=1200&h=500&fit=crop&auto=format" alt="Desa Selotinatah" class="w-100 h-100 object-fit-cover">
      <div class="position-absolute inset-0 w-100 h-100 top-0 start-0" style="background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0) 60%);"></div>
      <div class="position-absolute bottom-0 start-0 p-4 text-white">
        <div class="font-serif fw-semibold fs-4">Desa Selotinatah</div>
        <div class="text-white text-opacity-80 small">Kecamatan Ngariboyo, Kabupaten Magetan</div>
      </div>
    </div>

    <div class="row g-4">
      <!-- Left Content Column -->
      <div class="col-lg-8">
        <div class="d-flex flex-column gap-5">
          <!-- Profil Singkat -->
          <section>
            <h2 class="font-serif fw-semibold text-custom-foreground fs-4 mb-3">
              Profil Singkat Desa
            </h2>
            <div class="text-custom-secondary lh-lg d-flex flex-column gap-3">
              <p class="mb-0">
                Desa Selotinatah terletak di kawasan sejuk kaki Gunung Lawu, Kecamatan Ngariboyo, Kabupaten Magetan. Udara yang segar dan kekayaan alam lokal menjadi modal utama tumbuh dan berkembangnya kreativitas ekonomi masyarakat desa.
              </p>
              <p class="mb-0">
                Portal UMKM ini hadir sebagai sarana publikasi dan promosi produk lokal agar dapat menjangkau pasar yang lebih luas, baik di tingkat Kabupaten Magetan maupun skala nasional.
              </p>
            </div>
          </section>

          <!-- Potensi Desa -->
          <section>
            <h2 class="font-serif fw-semibold text-custom-foreground fs-4 mb-3">
              Potensi Desa
            </h2>
            <p class="text-custom-secondary lh-lg mb-0">
              Desa Selotinatah memiliki berbagai potensi alam dan sumber daya manusia yang mendukung perkembangan UMKM lokal. Potensi pertanian, peternakan, dan kerajinan menjadi kekuatan utama perekonomian desa. Wujud kemandirian ekonomi masyarakat Desa Selotinatah melalui ragam produk kuliner alami, kerajinan tangan, dan hasil usaha warga berkualitas.
            </p>
          </section>

          <!-- Potensi UMKM -->
          <section>
            <h2 class="font-serif fw-semibold text-custom-foreground fs-4 mb-3">
              Potensi UMKM
            </h2>
            <p class="text-custom-secondary lh-lg mb-4">
              UMKM di Desa Selotinatah mencakup tiga sektor utama yang terus berkembang dan berkontribusi pada perekonomian desa:
            </p>
            <div class="row g-3">
              <div class="col-sm-4">
                <div class="rounded-3 bg-custom-secondary p-3 border border-custom h-100">
                  <div class="fs-2 mb-2">🐓</div>
                  <div class="fw-semibold small text-custom-foreground mb-1">Peternakan</div>
                  <div class="text-custom-muted" style="font-size: 0.78rem; line-height: 1.4;">Peternakan dan produk olahan hasil ternak warga.</div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="rounded-3 bg-custom-secondary p-3 border border-custom h-100">
                  <div class="fs-2 mb-2">🧺</div>
                  <div class="fw-semibold small text-custom-foreground mb-1">Kerajinan</div>
                  <div class="text-custom-muted" style="font-size: 0.78rem; line-height: 1.4;">Anyaman bambu dan kerajinan tangan lokal.</div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="rounded-3 bg-custom-secondary p-3 border border-custom h-100">
                  <div class="fs-2 mb-2">🍲</div>
                  <div class="fw-semibold small text-custom-foreground mb-1">Kuliner</div>
                  <div class="text-custom-muted" style="font-size: 0.78rem; line-height: 1.4;">Aneka jajanan dan makanan khas asli Desa Selotinatah.</div>
                </div>
              </div>
            </div>
          </section>

          <!-- Info Pendukung -->
          <section>
            <h2 class="font-serif fw-semibold text-custom-foreground fs-4 mb-3">
              Kabar & Informasi
            </h2>
            <div class="rounded-3 bg-amber-light border border-amber-subtle p-4 small">
              <p class="fw-bold mb-1">Website Resmi Desa</p>
              <p class="mb-2 lh-base">
                Untuk mendapatkan informasi lebih lengkap terkait kependudukan, program desa, serta berita resmi pemerintah desa, silakan kunjungi website resmi Desa Selotinatah.
              </p>
              <a href="https://selotinatah.magetan.go.id/" target="_blank" class="btn btn-sm btn-outline-dark mt-2">
                Buka Website Desa <i class="bi bi-box-arrow-up-right"></i>
              </a>
            </div>
          </section>
        </div>
      </div>

      <!-- Right Sidebar Column -->
      <div class="col-lg-4">
        <div class="d-flex flex-column gap-4">
          <!-- Identitas Card -->
          <div class="rounded-4 border border-custom bg-custom-card p-4 shadow-sm">
            <h3 class="fw-semibold small text-custom-foreground mb-3 pb-1 border-bottom border-custom">
              Identitas Desa
            </h3>
            <dl class="mb-0 d-flex flex-column gap-3 small">
              <div>
                <dt class="text-custom-muted fw-normal" style="font-size: 0.75rem;">Nama Desa</dt>
                <dd class="fw-medium text-custom-foreground mb-0">Selotinatah</dd>
              </div>
              <div>
                <dt class="text-custom-muted fw-normal" style="font-size: 0.75rem;">Kecamatan</dt>
                <dd class="fw-medium text-custom-foreground mb-0">Ngariboyo</dd>
              </div>
              <div>
                <dt class="text-custom-muted fw-normal" style="font-size: 0.75rem;">Kabupaten</dt>
                <dd class="fw-medium text-custom-foreground mb-0">Magetan</dd>
              </div>
              <div>
                <dt class="text-custom-muted fw-normal" style="font-size: 0.75rem;">Provinsi</dt>
                <dd class="fw-medium text-custom-foreground mb-0">Jawa Timur</dd>
              </div>
              <div>
                <dt class="text-custom-muted fw-normal" style="font-size: 0.75rem;">Jumlah UMKM Terdokumentasi</dt>
                <dd class="fw-medium text-custom-foreground mb-0">{{ \App\Models\Umkm::count() }} UMKM</dd>
              </div>
            </dl>
          </div>

          <!-- Promo Box -->
          <div class="rounded-4 bg-custom-primary text-white p-4 shadow-sm">
            <h3 class="fw-semibold fs-6 mb-2">Ingin Tahu UMKM Kami?</h3>
            <p class="text-white text-opacity-80 small lh-base mb-4" style="font-size: 0.8rem;">
              Temukan berbagai UMKM yang telah terdokumentasi di Desa Selotinatah.
            </p>
            <a href="{{ route('umkm.index') }}" class="btn btn-light text-custom-primary fw-semibold w-100 py-2 small" style="border-radius: var(--radius-sm); font-size: 0.8rem;">
              Lihat Daftar UMKM
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
