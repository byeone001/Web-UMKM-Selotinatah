@extends('layouts.public')

@section('title', 'Katalog Produk')

@section('content')
  <div class="container-xl px-3 px-sm-4 py-5">
    <!-- Header -->
    <div class="mb-4">
      <div class="text-custom-accent fw-semibold small text-uppercase mb-1" style="letter-spacing: 0.1em; font-size: 0.75rem;">
        Produk UMKM
      </div>
      <h1 class="font-serif fw-bold text-custom-foreground display-6 mb-2">
        Katalog Produk Selotinatah
      </h1>
      <p class="text-custom-muted mb-0">
        Berbagai produk kerajinan anyaman bambu, olahan pangan, dan produk unggulan warga Desa Selotinatah.
      </p>
    </div>

    <!-- Search Box & Filter -->
    <form method="GET" action="{{ route('katalog') }}" class="d-flex flex-column flex-md-row gap-3 mb-5">
      <div class="position-relative flex-grow-1" style="max-width: 380px;">
        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-custom-muted"></i>
        <input 
          type="text" 
          name="search" 
          value="{{ request('search') }}" 
          placeholder="Cari produk..." 
          class="form-control ps-5 py-2 rounded-3 border-custom bg-custom-card text-custom-foreground"
          style="font-size: 0.875rem;"
        >
      </div>

      <div class="d-flex flex-grow-1" style="max-width: 250px;">
          <select name="kategori" class="form-select border-custom text-custom-foreground text-sm py-2 rounded-3">
              <option value="">Semua Kategori</option>
              @foreach($kategoriList as $kat)
                  <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                      {{ $kat }}
                  </option>
              @endforeach
          </select>
      </div>

      <div class="d-flex gap-2">
          <button type="submit" class="btn btn-custom-primary">
              Filter
          </button>
          @if(request()->filled('search') || request()->filled('kategori'))
              <a href="{{ route('katalog') }}" class="btn btn-outline-secondary d-flex align-items-center">
                  Reset
              </a>
          @endif
      </div>
    </form>

    <!-- Results -->
    @if(count($produk) === 0)
      <div class="text-center py-5 my-5 text-custom-muted border rounded-4 bg-custom-secondary">
        <div class="fs-1 mb-2">📦</div>
        <p class="fw-semibold fs-5 mb-1 text-custom-foreground">Produk tidak ditemukan.</p>
        <p class="small text-custom-muted">Coba cari dengan kata kunci lain atau pilih kategori yang berbeda.</p>
      </div>
    @else
      <div class="row g-4 mb-5">
        @foreach($produk as $p)
          <div class="col-xl-3 col-lg-4 col-sm-6">
            <x-produk-card-new :produk="$p" />
          </div>
        @endforeach
      </div>

      <!-- Pagination -->
      <div class="d-flex justify-content-center">
          {{ $produk->links('pagination::bootstrap-5') }}
      </div>
    @endif
  </div>
@endsection