@extends('layouts.public')

@section('title', 'Daftar UMKM')

@section('content')
  <div class="container-xl px-3 px-sm-4 py-5">
    <!-- Header -->
    <div class="mb-4">
      <div class="text-custom-accent fw-semibold small text-uppercase mb-1" style="letter-spacing: 0.1em; font-size: 0.75rem;">
        UMKM yang Telah Terdokumentasi
      </div>
      <h1 class="font-serif fw-bold text-custom-foreground display-6 mb-2">
        UMKM Desa Selotinatah
      </h1>
      <p class="text-custom-muted mb-0">
        Temukan berbagai usaha lokal yang ada di Desa Selotinatah.
      </p>
    </div>

    <!-- Search and Filter Section -->
    <form method="GET" action="{{ route('umkm.index') }}" class="d-flex flex-column flex-md-row gap-3 mb-4">
      <!-- Search Input -->
      <div class="position-relative flex-grow-1" style="max-width: 380px;">
        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-custom-muted"></i>
        <input 
          type="text" 
          name="search" 
          value="{{ request('search') }}" 
          placeholder="Cari nama UMKM..." 
          class="form-control ps-5 py-2 rounded-3 border-custom bg-custom-card text-custom-foreground"
          style="font-size: 0.875rem;"
        >
        @if(request('kategori'))
          <input type="hidden" name="kategori" value="{{ request('kategori') }}">
        @endif
      </div>
      <div class="d-flex gap-2">
          <button type="submit" class="btn btn-custom-primary">
              Cari
          </button>
      </div>
    </form>

    <!-- Kategori Filter Buttons -->
    <div class="d-flex gap-2 flex-wrap mb-4">
      <a 
        href="{{ route('umkm.index', array_filter(['search' => request('search')])) }}"
        class="btn-filter {{ !request('kategori') ? 'active' : '' }}"
      >
        Semua
      </a>
      @foreach($kategoriList as $k)
        <a 
          href="{{ route('umkm.index', array_filter(['kategori' => $k, 'search' => request('search')])) }}"
          class="btn-filter {{ request('kategori') === $k ? 'active' : '' }}"
        >
          {{ $k }}
        </a>
      @endforeach
    </div>

    <!-- Results Section -->
    @if(count($umkmList) === 0)
      <div class="text-center py-5 my-5 text-custom-muted border rounded-4 bg-custom-secondary">
        <div class="fs-1 mb-2">🔍</div>
        <p class="fw-semibold fs-5 mb-1 text-custom-foreground">Data UMKM tidak ditemukan.</p>
        <p class="small text-custom-muted">Coba ubah kata kunci atau filter kategori.</p>
      </div>
    @else
      <div class="d-flex justify-content-between align-items-center mb-4">
          <p class="small text-custom-muted mb-0">
            Menampilkan UMKM
          </p>
      </div>
      
      <div class="row g-4 mb-5">
        @foreach($umkmList as $u)
          <div class="col-xl-3 col-lg-4 col-sm-6">
            <x-umkm-card-new :umkm="$u" />
          </div>
        @endforeach
      </div>

      <!-- Pagination -->
      <div class="d-flex justify-content-center">
          {{ $umkmList->links('pagination::bootstrap-5') }}
      </div>
    @endif
  </div>
@endsection
