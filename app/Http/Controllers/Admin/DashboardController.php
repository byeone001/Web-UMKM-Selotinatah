<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUmkm = Umkm::count();
        $totalProduk = Produk::count();
        $totalKategori = Umkm::distinct('kategori')->count('kategori');

        $latestUmkms = Umkm::latest()->take(5)->get();
        $latestProduks = Produk::with('umkm')->latest()->take(5)->get();

        return view('dashboard', compact('totalUmkm', 'totalProduk', 'totalKategori', 'latestUmkms', 'latestProduks'));
    }
}