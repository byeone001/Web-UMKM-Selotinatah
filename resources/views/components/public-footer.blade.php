<footer class="site-footer">
  <div class="container-xl px-3 px-sm-4 py-5">
    <div class="row g-4 g-lg-5 justify-content-between">

      {{-- Col 1: Brand & Deskripsi (konten dari footer lama) --}}
      <div class="col-lg-4 col-md-6">
        <div class="d-flex align-items-center gap-3 mb-3">
          <img src="{{ asset('images/logo-footer.svg') }}" alt="Logo UMKM Selotinatah" style="width: 48px; height: 48px; object-fit: contain;">
          <div>
            <div class="fw-black text-white" style="font-size: 1.1rem; line-height: 1.2;">Desa Selotinatah</div>
            <div class="text-white text-opacity-75 small">Kec. Ngariboyo, Kab. Magetan</div>
            <div class="mt-2" style="height: 2px; width: 100px; background: rgba(255,255,255,0.3);"></div>
          </div>
        </div>
        <p class="text-white text-opacity-90 small lh-base mb-2" style="max-width: 360px;">
          Media informasi dan katalog produk UMKM unggulan Desa Selotinatah, Kecamatan Ngariboyo, Kabupaten Magetan.
        </p>
        <p class="text-white text-opacity-75 small lh-base mb-0" style="max-width: 360px;">
          885C+4HJ, Unnamed Road, Natah, Selotinatah, Kec. Ngariboyo, Kabupaten Magetan, Jawa Timur 63351
        </p>
      </div>

      {{-- Col 2: Tautan Terkait --}}
      <div class="col-lg-2 col-md-3 col-6">
        <h6 class="fw-black text-white mb-3" style="font-size: 1rem;">Tautan Terkait</h6>
        <div style="height: 2px; width: 80px; background: rgba(255,255,255,0.3); margin-bottom: 1rem;"></div>
        <ul class="list-unstyled small mb-0 d-flex flex-column gap-2">
          <li><a href="{{ route('home') }}">Beranda Portal UMKM</a></li>
          <li><a href="{{ route('katalog') }}">Katalog Produk</a></li>
          <li><a href="{{ route('umkm.index') }}">Direktori UMKM</a></li>
          <li>
            <a href="https://selotinatah.magetan.go.id/" target="_blank" rel="noopener noreferrer">
              Website Resmi Desa ↗
            </a>
          </li>
        </ul>
      </div>

      {{-- Col 3: Peta Google Maps (dari footer lama) --}}
      <div class="col-lg-3 col-md-6">
        <div class="rounded-4 overflow-hidden bg-white shadow" style="border-radius: 16px;">
          <div class="d-flex align-items-center gap-2 border-bottom px-3 py-2" style="border-color: #e2e8f0 !important;">
            <span class="d-flex align-items-center justify-content-center rounded-circle bg-danger bg-opacity-10 text-danger" style="width:32px;height:32px;flex-shrink:0;">
              <svg class="bi" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2a7 7 0 00-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 00-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z"/>
              </svg>
            </span>
            <span class="fw-bold text-dark small">Lokasi Desa Selotinatah</span>
          </div>
          <div class="p-2">
            <iframe title="Peta lokasi Desa Selotinatah"
              src="https://www.google.com/maps?q=Desa+Selotinatah,+Ngariboyo,+Magetan&output=embed"
              style="height: 180px; width: 100%; border: 0; border-radius: 10px;" loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
          <div class="px-3 pb-3">
            <a href="https://maps.google.com/?q=Desa+Selotinatah,+Ngariboyo,+Magetan" target="_blank" rel="noopener noreferrer"
              class="small fw-bold text-primary text-decoration-none">
              Buka di Google Maps ↗
            </a>
          </div>
        </div>
      </div>

      {{-- Col 4: Hubungi Kami --}}
      <div class="col-lg-2 col-md-3 col-6">
        <h6 class="fw-black text-white mb-3" style="font-size: 1rem;">Hubungi Kami</h6>
        <div style="height: 2px; width: 80px; background: rgba(255,255,255,0.3); margin-bottom: 1rem;"></div>
        <div class="d-flex flex-column gap-3">
          <a href="https://selotinatah.magetan.go.id/" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center gap-2 text-white text-opacity-75 text-decoration-none small hover-white">
            <span class="d-flex align-items-center justify-content-center rounded-circle border border-white border-opacity-40" style="width:36px;height:36px;flex-shrink:0;">
              <i class="bi bi-globe2"></i>
            </span>
            <span>Website Resmi Desa</span>
          </a>
          <a href="{{ route('katalog') }}" class="d-flex align-items-center gap-2 text-white text-opacity-75 text-decoration-none small">
            <span class="d-flex align-items-center justify-content-center rounded-circle border border-white border-opacity-40" style="width:36px;height:36px;flex-shrink:0;">
              <i class="bi bi-bag"></i>
            </span>
            <span>Lihat Katalog Produk</span>
          </a>
          <a href="{{ route('umkm.index') }}" class="d-flex align-items-center gap-2 text-white text-opacity-75 text-decoration-none small">
            <span class="d-flex align-items-center justify-content-center rounded-circle border border-white border-opacity-40" style="width:36px;height:36px;flex-shrink:0;">
              <i class="bi bi-people"></i>
            </span>
            <span>Direktori Mitra UMKM</span>
          </a>
        </div>
      </div>

    </div>
  </div>

  {{-- Bottom Bar --}}
  <div class="border-top border-white border-opacity-25 py-4 text-center">
    <div class="container-xl px-3 px-sm-4">
      <p class="fw-black text-white text-uppercase small tracking-wider mb-1" style="letter-spacing: 0.08em;">
        &copy; {{ date('Y') }} Portal UMKM Desa Selotinatah
      </p>
      <p class="text-white text-opacity-85 small fst-italic mb-1">Mendorong UMKM lokal tumbuh, dikenal, dan terhubung.</p>
      <p class="text-white text-opacity-70 mb-1" style="font-size: 0.75rem;">Bagian dari ekosistem informasi Desa Selotinatah, Kecamatan Ngariboyo, Kabupaten Magetan.</p>
      <p class="text-white text-opacity-70 mb-0" style="font-size: 0.75rem;">Powered by KKNT UNESA 2026.</p>
    </div>
  </div>

  {{-- Tombol Kembali ke Atas --}}
  <a href="#top" aria-label="Kembali ke atas"
    class="position-fixed bottom-0 end-0 mb-4 me-4 d-flex align-items-center justify-content-center rounded-circle bg-primary text-white shadow"
    style="width:48px;height:48px;font-size:1.25rem;font-weight:700;z-index:1050;text-decoration:none;">
    ↑
  </a>
</footer>

<style>
  .site-footer a:hover {
    color: rgba(255,255,255,1) !important;
  }
</style>