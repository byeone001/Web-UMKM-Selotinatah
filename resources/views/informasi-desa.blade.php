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
        Informasi {{ $profil->nama_desa ?? 'Desa Selotinatah' }}
      </h1>
      <p class="text-custom-muted mb-0">
        Mengenal lebih dekat {{ $profil->nama_desa ?? 'Desa Selotinatah' }} dan potensi UMKM-nya.
      </p>
    </div>

    {{-- Hero Media Carousel (Foto / Video) --}}
    @php
        $hasBannerMedia = $desaMedias->count() > 0;
        $fallbackImg = 'https://images.unsplash.com/photo-1588084188698-e626698fd8cb?w=1200&h=500&fit=crop&auto=format';
    @endphp
    <div class="position-relative rounded-4 overflow-hidden mb-5 bg-custom-muted shadow-sm" style="height: 320px;">
      @if($hasBannerMedia)
        <div id="desaBannerCarousel" class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="5000">
          <div class="carousel-inner h-100">
            @foreach($desaMedias as $index => $media)
              @php $mediaUrl = Storage::disk('supabase')->url($media->path); @endphp
              <div class="carousel-item h-100 {{ $index === 0 ? 'active' : '' }}">
                @if($media->type === 'video')
                  <video src="{{ $mediaUrl }}" class="d-block w-100 h-100 object-fit-cover" muted loop playsinline></video>
                @else
                  <img src="{{ $mediaUrl }}" alt="{{ $media->judul ?? ($profil->nama_desa ?? 'Desa Selotinatah') }}" class="d-block w-100 h-100 object-fit-cover" onerror="this.src='{{ $fallbackImg }}'">
                @endif
              </div>
            @endforeach
          </div>

          @if($desaMedias->count() > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#desaBannerCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#desaBannerCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
            <div class="carousel-indicators">
              @foreach($desaMedias as $index => $media)
                <button type="button" data-bs-target="#desaBannerCarousel" data-bs-slide-to="{{ $index }}"
                  class="{{ $index === 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
              @endforeach
            </div>
          @endif
        </div>
      @else
        <img src="{{ $fallbackImg }}" alt="Desa Selotinatah" class="w-100 h-100 object-fit-cover">
      @endif

      <div class="position-absolute inset-0 w-100 h-100 top-0 start-0" style="background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0) 60%); pointer-events: none; z-index: 2;"></div>
      <div class="position-absolute bottom-0 start-0 p-4 text-white" style="z-index: 5;">
        <div class="font-serif fw-semibold fs-4">{{ $profil->nama_desa ?? 'Desa Selotinatah' }}</div>
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
              @if($profil->sejarah)
                <div class="mb-0">{!! $profil->sejarah !!}</div>
              @else
                <p class="mb-0">
                  Desa Selotinatah terletak di kawasan sejuk kaki Gunung Lawu, Kecamatan Ngariboyo, Kabupaten Magetan. Udara yang segar dan kekayaan alam lokal menjadi modal utama tumbuh dan berkembangnya kreativitas ekonomi masyarakat desa.
                </p>
                <p class="mb-0">
                  Portal UMKM ini hadir sebagai sarana publikasi dan promosi produk lokal agar dapat menjangkau pasar yang lebih luas, baik di tingkat Kabupaten Magetan maupun skala nasional.
                </p>
              @endif
            </div>
          </section>

          <!-- Potensi / Geografis Desa -->
          <section>
            <h2 class="font-serif fw-semibold text-custom-foreground fs-4 mb-3">
              Kondisi Geografis & Potensi
            </h2>
            <div class="text-custom-secondary lh-lg mb-0">
              @if($profil->geografis)
                <div>{!! $profil->geografis !!}</div>
              @else
                <p>Desa Selotinatah memiliki berbagai potensi alam dan sumber daya manusia yang mendukung perkembangan UMKM lokal. Potensi pertanian, peternakan, dan kerajinan menjadi kekuatan utama perekonomian desa. Wujud kemandirian ekonomi masyarakat Desa Selotinatah melalui ragam produk kuliner alami, kerajinan tangan, dan hasil usaha warga berkualitas.</p>
              @endif
            </div>
          </section>

          <!-- Visi & Misi -->
          @if($profil->visi || $profil->misi)
          <section>
            <div class="row g-4">
                <div class="col-md-6">
                    <h2 class="font-serif fw-semibold text-custom-foreground fs-4 mb-3">Visi</h2>
                    <div class="text-custom-secondary lh-lg">{!! $profil->visi !!}</div>
                </div>
                <div class="col-md-6">
                    <h2 class="font-serif fw-semibold text-custom-foreground fs-4 mb-3">Misi</h2>
                    <div class="text-custom-secondary lh-lg">{!! $profil->misi !!}</div>
                </div>
            </div>
          </section>
          @endif

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
          <div class="rounded-4 border border-custom bg-custom-card p-4 shadow-sm mb-4">
            <h3 class="fw-semibold small text-custom-foreground mb-3 pb-1 border-bottom border-custom">
              Identitas Desa
            </h3>
            <dl class="mb-0 d-flex flex-column gap-3 small">
              <div>
                <dt class="text-custom-muted fw-normal" style="font-size: 0.75rem;">Nama Desa</dt>
                <dd class="fw-medium text-custom-foreground mb-0">{{ $profil->nama_desa ?? 'Selotinatah' }}</dd>
              </div>
              <div>
                <dt class="text-custom-muted fw-normal" style="font-size: 0.75rem;">Alamat</dt>
                <dd class="fw-medium text-custom-foreground mb-0">{{ $profil->alamat_lengkap ?? 'Kecamatan Ngariboyo, Kabupaten Magetan, Jawa Timur' }}</dd>
              </div>
              <div>
                <dt class="text-custom-muted fw-normal" style="font-size: 0.75rem;">Jumlah UMKM Terdokumentasi</dt>
                <dd class="fw-medium text-custom-foreground mb-0">{{ \App\Models\Umkm::count() }} UMKM</dd>
              </div>
            </dl>
          </div>

          <!-- Statistik Demografi LIVE -->
          @php
            $totalPenduduk = $demografi['total_penduduk'] ?? ($profil->jumlah_penduduk ?? null);
            $lakiLaki = $demografi['laki_laki'] ?? ($profil->jumlah_laki_laki ?? null);
            $perempuan = $demografi['perempuan'] ?? ($profil->jumlah_perempuan ?? null);
            $agamaList = $demografi['agama'] ?? [];
            $isLive = isset($demografi['source']) && $demografi['source'] === 'live';
          @endphp

          @if($totalPenduduk)
          <div class="rounded-4 border border-custom bg-custom-card p-4 shadow-sm mb-4">
            <div class="d-flex align-items-center justify-content-between mb-3 pb-1 border-bottom border-custom">
              <h3 class="fw-semibold small text-custom-foreground mb-0">Statistik Demografi</h3>
              @if($isLive)
                <a href="https://selotinatah.magetan.go.id/desa/jenis-kelamin" target="_blank"
                   class="badge d-flex align-items-center gap-1 text-decoration-none"
                   style="background-color: #d1fae5; color: #065f46; font-size: 0.65rem; font-weight: 600; padding: 3px 8px; border-radius: 999px;"
                   title="Data diambil real-time dari website resmi desa">
                  <span style="width:6px;height:6px;background:#10b981;border-radius:50%;display:inline-block;"></span>
                  Live • selotinatah.go.id
                </a>
              @endif
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <div class="p-3 rounded-3 border border-custom text-center" style="background: linear-gradient(135deg, #ecfdf5, #d1fae5);">
                        <div class="fs-3 fw-bold" style="color: var(--color-primary);">{{ number_format($totalPenduduk, 0, ',', '.') }}</div>
                        <div class="small text-custom-muted fw-medium">Total Penduduk (Jiwa)</div>
                    </div>
                </div>
                @if($lakiLaki || $perempuan)
                <div class="col-6">
                    <div class="p-3 bg-custom-secondary rounded-3 border border-custom text-center">
                        <div class="fs-5 fw-bold text-custom-foreground">{{ number_format($lakiLaki, 0, ',', '.') }}</div>
                        <div class="text-custom-muted" style="font-size: 0.72rem;">♂ Laki-laki</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 bg-custom-secondary rounded-3 border border-custom text-center">
                        <div class="fs-5 fw-bold text-custom-foreground">{{ number_format($perempuan, 0, ',', '.') }}</div>
                        <div class="text-custom-muted" style="font-size: 0.72rem;">♀ Perempuan</div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Agama Breakdown --}}
            @if(count($agamaList) > 0)
            <div class="mt-3">
                <div class="small text-custom-muted fw-semibold mb-2" style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.05em;">Berdasarkan Agama</div>
                <div class="d-flex flex-column gap-1">
                    @foreach($agamaList as $agama)
                    @php
                      $pct = $totalPenduduk > 0 ? round($agama['y'] / $totalPenduduk * 100, 1) : 0;
                    @endphp
                    <div>
                        <div class="d-flex justify-content-between" style="font-size: 0.75rem;">
                            <span class="text-custom-foreground">{{ ucfirst(strtolower($agama['name'])) }}</span>
                            <span class="text-custom-muted">{{ number_format($agama['y'], 0, ',', '.') }} <span class="text-custom-accent">({{ $pct }}%)</span></span>
                        </div>
                        <div class="rounded" style="height:5px; background: var(--color-border); overflow:hidden; margin-top: 2px;">
                            <div class="rounded" style="height:100%; width:{{ $pct }}%; background: var(--color-primary); transition: width 1s ease;"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
          </div>
          @endif

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


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var carouselEl = document.getElementById('desaBannerCarousel');
    if (!carouselEl) return;
    var firstActive = carouselEl.querySelector('.carousel-item.active');
    if (firstActive) { var v = firstActive.querySelector('video'); if (v) v.play(); }
    carouselEl.addEventListener('slid.bs.carousel', function(event) {
        carouselEl.querySelectorAll('video').forEach(function(v){ v.pause(); });
        var av = event.relatedTarget.querySelector('video');
        if (av) av.play();
    });
});
</script>
@endpush
