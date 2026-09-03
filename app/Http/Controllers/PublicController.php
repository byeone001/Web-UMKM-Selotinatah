<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Umkm;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    // Halaman Beranda Utama
    public function index()
    {
        $umkm = Umkm::latest()->take(6)->get();
        $produk = Produk::with('umkm')->latest()->take(8)->get();
        return view('welcome', compact('umkm', 'produk'));
    }

    // Halaman Katalog Produk + Filter
    public function katalog(Request $request)
    {
        $query = Produk::with('umkm');

        // Filter berdasarkan pencarian nama produk
        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori UMKM
        if ($request->filled('kategori')) {
            $query->whereHas('umkm', function ($q) use ($request) {
                $q->where('kategori', $request->kategori);
            });
        }

        $produk = $query->latest()->paginate(12);
        $kategoriList = Umkm::select('kategori')->distinct()->pluck('kategori');

        return view('katalog', compact('produk', 'kategoriList'));
    }

    // Detail Produk & Format Link WhatsApp
    public function detailProduk($id)
    {
        $produk = Produk::with('umkm')->findOrFail($id);

        // Format nomor WhatsApp (Ubah 08xx menjadi 628xx)
        $noWa = preg_replace('/[^0-9]/', '', $produk->umkm->kontak ?? '');
        if (str_starts_with($noWa, '0')) {
            $noWa = '62' . substr($noWa, 1);
        }

        // Format Pesan Otomatis WhatsApp
        $pesan = "Halo " . $produk->umkm->pemilik . " (" . $produk->umkm->nama_umkm . "), saya ingin memesan/bertanya tentang produk *" . $produk->nama_produk . "* yang terdaftar di Website UMKM Selotinatah.";
        $linkWa = "https://wa.me/" . $noWa . "?text=" . urlencode($pesan);

        return view('detail-produk', compact('produk', 'linkWa'));
    }

    // Detail Profil UMKM & Produknya
    public function detailUmkm($id)
    {
        $umkm = Umkm::with('produks')->findOrFail($id);

        // Format nomor WhatsApp untuk tombol tanya profil
        $noWa = preg_replace('/[^0-9]/', '', $umkm->kontak ?? '');
        if (str_starts_with($noWa, '0')) {
            $noWa = '62' . substr($noWa, 1);
        }
        $pesan = "Halo " . $umkm->pemilik . " (" . $umkm->nama_umkm . "), saya ingin bertanya mengenai UMKM Anda.";
        $linkWa = "https://wa.me/" . $noWa . "?text=" . urlencode($pesan);

        return view('detail-umkm', compact('umkm', 'linkWa'));
    }
}