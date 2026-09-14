@props(['kategori'])

@php
  $kategoriClass = match(strtolower($kategori ?? '')) {
      'peternakan' => 'peternakan',
      'kerajinan'  => 'kerajinan',
      'kuliner'    => 'kuliner',
      default      => 'peternakan',
  };
@endphp

<span class="badge-kategori {{ $kategoriClass }}">
  {{ $kategori }}
</span>
