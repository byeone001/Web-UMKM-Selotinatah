@extends('layouts.public')

@section('title', $umkm->nama_umkm)

@section('content')
  <div class="container-xl px-3 px-sm-4 py-5" style="max-width: 1040px;">
    <!-- Breadcrumb -->
    <nav class="small text-custom-muted mb-4 d-flex align-items-center gap-2" style="font-size: 0.8rem;">
      <a href="{{ route('home') }}" class="text-decoration-none text-custom-muted hover-primary">Beranda</a>
      <span>/</span>
      <a href="{{ route('umkm.index') }}" class="text-decoration-none text-custom-muted hover-primary">UMKM</a>
      <span>/</span>
      <span class="text-custom-foreground fw-medium">{{ $umkm->nama_umkm }}</span>
    </nav>

    <div class="row g-4 g-lg-5">
      <!-- Left Column: Foto, Info Card, & Kontak -->
      <div class="col-lg-5">
        <div class="d-flex flex-column gap-4">
          <!-- Foto UMKM -->
          <div class="rounded-4 overflow-hidden bg-custom-muted shadow-sm position-relative" style="height: 280px;">
            @if($umkm->foto)
              <img src="{{ Storage::disk('supabase')->url($umkm->foto) }}" alt="{{ $umkm->nama_umkm }}" class="w-100 h-100 object-fit-cover" onerror="this.src='https://images.unsplash.com/photo-1559628233-eb1b1a45564b?w=600&h=400&fit=crop&auto=format'">
            @else
              <img src="https://images.unsplash.com/photo-1559628233-eb1b1a45564b?w=600&h=400&fit=crop&auto=format" alt="{{ $umkm->nama_umkm }}" class="w-100 h-100 object-fit-cover">
            @endif
          </div>

          <!-- Info Card -->
          <div class="rounded-4 border border-custom bg-custom-card p-4 shadow-sm">
            <h3 class="fw-semibold small text-custom-foreground mb-3 pb-2 border-bottom border-custom">
              Informasi UMKM
            </h3>
            <dl class="mb-0 d-flex flex-column gap-3 small">
              <div>
                <dt class="text-custom-muted fw-normal" style="font-size: 0.75rem;">Pemilik</dt>
                <dd class="fw-semibold text-custom-foreground mb-0">{{ $umkm->pemilik }}</dd>
              </div>
              <div>
                <dt class="text-custom-muted fw-normal" style="font-size: 0.75rem;">Kategori</dt>
                <dd class="mb-0">
                  <x-badge-kategori :kategori="$umkm->kategori" />
                </dd>
              </div>
              <div>
                <dt class="text-custom-muted fw-normal" style="font-size: 0.75rem;">Tahun Mulai</dt>
                <dd class="fw-medium text-custom-foreground mb-0">
                  {{ $umkm->tahun_mulai ?? 'Data belum tersedia' }}
                </dd>
              </div>
              <div>
                <dt class="text-custom-muted fw-normal" style="font-size: 0.75rem;">Alamat</dt>
                <dd class="text-custom-secondary lh-base mb-0">{{ $umkm->alamat ?? 'Desa Selotinatah, Kec. Ngariboyo, Kab. Magetan' }}</dd>
              </div>
              <div>
                <dt class="text-custom-muted fw-normal" style="font-size: 0.75rem;">Kontak</dt>
                <dd class="text-custom-foreground mb-0">
                  {{ $umkm->kontak ?? 'Data belum tersedia' }}
                </dd>
              </div>
            </dl>
          </div>

          <!-- Actions: WhatsApp & Google Maps -->
          <div class="d-flex flex-column gap-2">
            @if($linkWa)
              <a 
                href="{{ $linkWa }}" 
                target="_blank" 
                rel="noopener noreferrer" 
                class="btn d-flex align-items-center justify-content-center gap-2 py-2.5 rounded-3 fw-medium small text-white shadow-sm"
                style="background-color: #25D366; border-color: #25D366;"
              >
                <i class="bi bi-whatsapp fs-5"></i>
                <span>Hubungi via WhatsApp</span>
              </a>
            @else
              <div class="text-center py-2.5 rounded-3 bg-custom-muted text-custom-muted small fst-italic">
                Kontak belum tersedia
              </div>
            @endif

            @if($umkm->hasValidLocationLink())
              <a 
                href="{{ $umkm->link_lokasi }}" 
                target="_blank" 
                rel="noopener noreferrer" 
                class="btn btn-outline-secondary d-flex align-items-center justify-content-center gap-2 py-2.5 rounded-3 fw-medium small text-custom-foreground border-custom"
              >
                <i class="bi bi-geo-alt-fill text-danger"></i>
                <span>Lihat Lokasi</span>
              </a>
            @else
              <div class="text-center py-2 rounded-3 border border-custom text-custom-muted small fst-italic">
                Lokasi belum tersedia
              </div>
            @endif
          </div>
        </div>
      </div>

      <!-- Right Column: Detail & Produk Terkait -->
      <div class="col-lg-7">
        <div class="d-flex flex-column gap-4">
          <!-- Title & Badges -->
          <div>
            <div class="mb-2">
              <x-badge-kategori :kategori="$umkm->kategori" />
            </div>
            <h1 class="font-serif fw-bold text-custom-foreground display-6 mb-1">
              {{ $umkm->nama_umkm }}
            </h1>
            <p class="text-custom-muted small">Pemilik: {{ $umkm->pemilik }}</p>
          </div>

          <!-- Tentang Usaha -->
          <div>
            <h2 class="fw-semibold text-custom-foreground fs-5 mb-2">Tentang Usaha</h2>
            <p class="text-custom-secondary lh-lg mb-0" style="white-space: pre-line;">
              {{ $umkm->deskripsi ?? 'UMKM pengrajin dan produsen unggulan yang berdedikasi menghasilkan karya berkualitas khas Desa Selotinatah.' }}
            </p>
          </div>

          <!-- Produk Section -->
          <div class="pt-2">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <h2 class="fw-semibold text-custom-foreground fs-5 mb-0">Produk / Hasil Usaha</h2>
              <a href="{{ route('katalog', ['search' => $umkm->nama_umkm]) }}" class="text-decoration-none text-custom-primary small fw-semibold">
                Lihat Semua &rarr;
              </a>
            </div>

            @if($umkm->produk->isEmpty())
              <div class="rounded-3 bg-custom-secondary p-4 text-center text-custom-muted small">
                Data produk belum tersedia.
              </div>
            @else
              <div class="row g-3">
                @foreach($umkm->produk as $p)
                  <div class="col-sm-6">
                    <x-produk-card-new :produk="$p" />
                  </div>
                @endforeach
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection