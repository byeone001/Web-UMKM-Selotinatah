@props(['umkm'])

<div class="card-custom">
  <div class="card-img-wrapper" style="height: 190px;">
    @if($umkm->foto)
      <img src="{{ Storage::disk('supabase')->url($umkm->foto) }}" alt="{{ $umkm->nama_umkm }}" loading="lazy">
    @else
      <img src="https://images.unsplash.com/photo-1559628233-eb1b1a45564b?w=400&h=300&fit=crop&auto=format" alt="{{ $umkm->nama_umkm }}" loading="lazy">
    @endif
    <div class="position-absolute top-0 start-0 m-3">
      <x-badge-kategori :kategori="$umkm->kategori" />
    </div>
  </div>
  <div class="p-3 d-flex flex-column flex-grow-1">
    <h3 class="font-serif fw-semibold text-custom-foreground fs-6 mb-1 line-clamp-1" title="{{ $umkm->nama_umkm }}">
      {{ $umkm->nama_umkm }}
    </h3>
    <p class="text-custom-muted small mb-2" style="font-size: 0.78rem;">Pemilik: {{ $umkm->pemilik }}</p>
    <p class="text-custom-secondary small line-clamp-2 mb-3 lh-base" style="font-size: 0.85rem;">
      {{ $umkm->deskripsi ?? '-' }}
    </p>
    <div class="mt-auto">
      <a href="{{ route('umkm.detail', $umkm->id_umkm) }}" class="btn btn-custom-primary w-100 text-center py-2" style="font-size: 0.875rem;">
        Lihat Detail
      </a>
    </div>
  </div>
</div>
