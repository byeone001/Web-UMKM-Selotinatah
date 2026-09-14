@extends('layouts.public')

@section('title', $produk->nama_produk)

@section('content')
  <div class="container-xl px-3 px-sm-4 py-5" style="max-width: 1040px;">
    <!-- Breadcrumb -->
    <nav class="small text-custom-muted mb-4 d-flex align-items-center gap-2" style="font-size: 0.8rem;">
      <a href="{{ route('home') }}" class="text-decoration-none text-custom-muted hover-primary">Beranda</a>
      <span>/</span>
      <a href="{{ route('katalog') }}" class="text-decoration-none text-custom-muted hover-primary">Produk</a>
      <span>/</span>
      <span class="text-custom-foreground fw-medium">{{ $produk->nama_produk }}</span>
    </nav>

    <div class="row g-4 g-lg-5 align-items-start">
      <!-- Left Column: Foto Produk -->
      @php
          $galleryImages = collect([$produk->foto])
              ->filter()
              ->merge($produk->fotos->pluck('foto'))
              ->values();
          $firstGalleryImage = $galleryImages->first();
      @endphp
      <div class="col-lg-6">
        <div class="rounded-4 overflow-hidden bg-custom-muted shadow-sm position-relative mb-3" style="height: 380px;">
          @if($firstGalleryImage)
            <img id="mainImage" src="{{ asset('storage/' . $firstGalleryImage) }}" alt="{{ $produk->nama_produk }}" class="w-100 h-100 object-fit-cover" onerror="this.src='https://images.unsplash.com/photo-1559628233-eb1b1a45564b?w=800&h=600&fit=crop&auto=format'">
          @else
            <img src="https://images.unsplash.com/photo-1559628233-eb1b1a45564b?w=800&h=600&fit=crop&auto=format" alt="{{ $produk->nama_produk }}" class="w-100 h-100 object-fit-cover">
          @endif
          <div class="position-absolute top-0 start-0 m-3">
              <x-badge-kategori :kategori="$produk->umkm->kategori ?? 'Kerajinan'" />
          </div>
        </div>
        
        @if($galleryImages->count() > 1)
          <div class="d-flex gap-2 overflow-auto pb-2">
            @foreach($galleryImages as $index => $galleryImage)
              <div 
                class="rounded-3 overflow-hidden border border-2 border-custom cursor-pointer gallery-thumbnail" 
                style="width: 70px; height: 70px; flex-shrink: 0;"
                onclick="document.getElementById('mainImage').src = '{{ asset('storage/' . $galleryImage) }}'; document.querySelectorAll('.gallery-thumbnail').forEach(el => el.classList.remove('border-primary')); this.classList.add('border-primary');"
              >
                <img src="{{ asset('storage/' . $galleryImage) }}" alt="{{ $produk->nama_produk }} - foto {{ $index + 1 }}" class="w-100 h-100 object-fit-cover">
              </div>
            @endforeach
          </div>
        @endif
      </div>

      <!-- Right Column: Detail & Aksi -->
      <div class="col-lg-6">
        <div class="d-flex flex-column gap-4">
          <div>
            <div class="small text-custom-muted mb-2">Kode Produk: #PRD-{{ $produk->id_produk }}</div>
            <h1 class="font-serif fw-bold text-custom-foreground display-6 mb-1">
              {{ $produk->nama_produk }}
            </h1>
            @if($produk->umkm)
              <div class="mt-2">
                  <span class="small text-custom-muted">Oleh: </span>
                  <a href="{{ route('umkm.detail', $produk->umkm->id_umkm) }}" class="text-decoration-none text-custom-primary small fw-semibold">
                    {{ $produk->umkm->nama_umkm }}
                  </a>
              </div>
            @endif
          </div>

          <!-- Harga -->
          <div>
            @if($produk->harga)
              <div class="font-serif fw-bold fs-3 text-custom-primary">
                Rp {{ number_format($produk->harga, 0, ',', '.') }}
              </div>
            @else
              <div class="rounded-3 bg-custom-secondary px-3 py-2.5 small text-custom-muted">
                Harga: Hubungi UMKM untuk informasi harga.
              </div>
            @endif
          </div>

          <!-- Deskripsi Produk -->
          <div>
            <h2 class="fw-semibold text-custom-foreground fs-6 mb-2">Deskripsi Produk</h2>
            <p class="text-custom-secondary lh-lg mb-0" style="white-space: pre-line;">
              {{ $produk->deskripsi ?? 'Belum ada keterangan deskripsi tambahan untuk produk ini.' }}
            </p>
          </div>

          <!-- Action Buttons -->
          <div class="border-top border-custom pt-4 d-flex flex-column gap-2">
            @if($produk->umkm)
              <a href="{{ route('umkm.detail', $produk->umkm->id_umkm) }}" class="btn btn-custom-outline-primary w-100 text-center py-2.5 fw-medium">
                Lihat Profil UMKM
              </a>

              @if($linkWa)
                <a 
                  href="{{ $linkWa }}" 
                  target="_blank" 
                  rel="noopener noreferrer" 
                  class="btn w-100 d-flex align-items-center justify-content-center gap-2 py-2.5 rounded-3 fw-medium text-white shadow"
                  style="background-color: #25D366; border-color: #25D366;"
                >
                  <i class="bi bi-whatsapp fs-5"></i>
                  <span>Pesan via WhatsApp Sekarang</span>
                </a>
                <p class="text-center small text-custom-muted mt-1" style="font-size: 0.75rem;">
                    Pesan langsung terhubung dengan pengrajin / pemilik UMKM Desa
                </p>
              @else
                <div class="text-center py-2.5 rounded-3 bg-custom-muted text-custom-muted small fst-italic">
                  Nomor WhatsApp pemilik belum tersedia
                </div>
              @endif
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <style>
      .cursor-pointer { cursor: pointer; }
      .border-primary { border-color: var(--color-primary) !important; }
  </style>
@endsection