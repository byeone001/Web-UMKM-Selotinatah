@props(['produk'])

<div class="card-custom">
  <div class="card-img-wrapper" style="height: 175px;">
    @if($produk->foto)
      <img src="{{ Storage::disk('supabase')->url($produk->foto) }}" alt="{{ $produk->nama_produk }}" loading="lazy">
    @else
      <img src="https://images.unsplash.com/photo-1559628233-eb1b1a45564b?w=400&h=300&fit=crop&auto=format" alt="{{ $produk->nama_produk }}" loading="lazy">
    @endif
  </div>
  <div class="p-3 d-flex flex-column flex-grow-1">
    <h3 class="font-serif fw-semibold text-custom-foreground fs-6 mb-1 line-clamp-1" title="{{ $produk->nama_produk }}">
      {{ $produk->nama_produk }}
    </h3>
    @if($produk->umkm)
      <p class="text-custom-muted small mb-1" style="font-size: 0.78rem;">{{ $produk->umkm->nama_umkm }}</p>
    @endif
    <div class="mb-3">
      @if($produk->harga)
        <span class="small fw-semibold text-custom-primary">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
      @else
        <span class="small text-custom-muted fst-italic" style="font-size: 0.75rem;">Harga: Hubungi UMKM</span>
      @endif
    </div>
    <div class="mt-auto">
      <a href="{{ route('produk.detail', $produk->id_produk) }}" class="btn btn-custom-outline-primary w-100 text-center py-2" style="font-size: 0.875rem;">
        Lihat Detail
      </a>
    </div>
  </div>
</div>
