<header class="site-header">
  <div class="container-xl px-3 px-sm-4">
    <nav class="navbar navbar-expand-md py-2">
      <!-- Brand Logo -->
      <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="{{ route('home') }}">
        <img src="{{ asset('images/logo-header.svg') }}" alt="Logo UMKM Selotinatah" style="width: 36px; height: 36px; object-fit: contain;">
        <div class="lh-1">
          <div class="text-custom-muted small fw-medium d-none d-sm-block" style="font-size: 0.72rem;">Potensi Desa</div>
          <div class="font-serif fw-semibold text-custom-primary" style="font-size: 0.95rem;">UMKM Selotinatah</div>
        </div>
      </a>

      <!-- Mobile Toggler -->
      <button class="navbar-toggler border-0 p-1 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPublic" aria-controls="navbarPublic" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Nav Links & CTA -->
      <div class="collapse navbar-collapse justify-content-between mt-3 mt-md-0" id="navbarPublic">
        <ul class="navbar-nav mx-auto mb-2 mb-md-0 gap-1 text-center text-md-start">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('info-desa') ? 'active' : '' }}" href="{{ route('info-desa') }}">Informasi Desa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('umkm.index') ? 'active' : '' }}" href="{{ route('umkm.index') }}">UMKM</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('katalog') ? 'active' : '' }}" href="{{ route('katalog') }}">Produk</a>
          </li>
        </ul>

        <div class="d-flex justify-content-center">
          <a href="{{ route('login') }}" class="btn btn-custom-primary w-100 w-md-auto text-center d-flex align-items-center gap-2 justify-content-center" style="font-size: 0.875rem;">
            <i class="bi bi-person-lock"></i>
            Panel Admin
          </a>
        </div>
      </div>
    </nav>
  </div>
</header>
