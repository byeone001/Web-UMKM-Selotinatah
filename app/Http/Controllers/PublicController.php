<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    // Halaman Beranda Utama
    public function index(Request $request)
    {
        $search = $request->input('q');
        $kategoriSelected = $request->input('kategori');

        // Data Statistik Desa
        $totalUmkm = Umkm::count();
        $totalProduk = Produk::count();
        $totalKategori = Umkm::distinct('kategori')->whereNotNull('kategori')->count('kategori');

        // List Kategori untuk Filter Badges
        $kategoriList = Umkm::whereNotNull('kategori')
            ->where('kategori', '!=', '')
            ->distinct()
            ->pluck('kategori');

        // Query Produk Terbaru (Filter jika ada pencarian)
        $produkQuery = Produk::with('umkm');
        if ($search) {
            $produkQuery->where(function($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }
        if ($kategoriSelected) {
            $produkQuery->whereHas('umkm', function($q) use ($kategoriSelected) {
                $q->where('kategori', $kategoriSelected);
            });
        }
        $produk = $produkQuery->latest()->take(8)->get();

       $umkm = Umkm::latest()->take(6)->get();      

        // Ambil berita langsung dari website resmi Desa Selotinatah
        $berita = Cache::remember('berita_desa_live_v2', 3600, function () {
            try {
                $response = Http::withoutVerifying()
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
                    ])
                    ->timeout(6)
                    ->get('https://selotinatah.magetan.go.id/berita/fetch-data?page=1');

                if ($response->successful()) {
                    $json = $response->json();
                    if (isset($json['posts']) && is_array($json['posts']) && count($json['posts']) > 0) {
                        $items = [];
                        foreach (array_slice($json['posts'], 0, 6) as $post) {
                            $id = $post['id_berita'] ?? '';
                            $title = $post['judul'] ?? 'Berita Desa Selotinatah';
                            $slug = Str::slug($title);
                            $img = $post['img_url'] ?? '';
                            if ($img && str_starts_with($img, '/')) {
                                $img = 'https://selotinatah.magetan.go.id' . $img;
                            }
                            $link = "https://selotinatah.magetan.go.id/berita/view/{$id}-{$slug}";
                            
                            $rawKonten = strip_tags(html_entity_decode($post['konten'] ?? ''));
                            
                            // Ekstrak tanggal jika terdapat dalam konten
                            $date = 'Warta Desa';
                            if (preg_match('/(Senin|Selasa|Rabu|Kamis|Jum[\'a-z]+|Sabtu|Minggu),\s*\d{1,2}\s+[A-Za-z]+\s+\d{4}/u', $rawKonten, $matches)) {
                                $date = $matches[0];
                            }

                            // Bersihkan deskripsi dari prefiks tempat/tanggal
                            $cleanDesc = preg_replace('/^Selotinatah,\s*Ngariboyo,\s*Magetan\s*—\s*[^—]+—\s*/ui', '', $rawKonten);
                            $desc = Str::limit(trim($cleanDesc), 125);

                            $items[] = [
                                'title'       => $title,
                                'link'        => $link,
                                'image'       => $img,
                                'date'        => $date,
                                'description' => $desc,
                            ];
                        }
                        if (!empty($items)) {
                            return $items;
                        }
                    }
                }
            } catch (\Throwable $e) {
                // Fallback jika website desa tidak merespon
            }

            return [
                [
                    'title'       => 'Peringatan Maulid Nabi Muhammad SAW di Jrakah, Dusun Banaran',
                    'link'        => 'https://selotinatah.magetan.go.id/berita',
                    'image'       => 'https://selotinatah.magetan.go.id/media/img/berita/berita_14451_6a95811165caa7.55701157.jpeg',
                    'date'        => 'Sabtu, 29 Agustus 2026',
                    'description' => 'Masyarakat Jrakah, Dusun Banaran, Desa Selotinatah melaksanakan kegiatan peringatan Maulid Nabi dengan khidmat dan penuh kebersamaan.',
                ],
                [
                    'title'       => 'Kerja Bakti Masyarakat Desa Selotinatah',
                    'link'        => 'https://selotinatah.magetan.go.id/berita',
                    'image'       => 'https://selotinatah.magetan.go.id/media/img/berita/berita_14450_6a957e63af5187.96721326.jpeg',
                    'date'        => 'Minggu, 9 Agustus 2026',
                    'description' => 'Pemerintah Desa Selotinatah bersama warga melaksanakan kerja bakti demi memelihara kebersihan lingkungan dan kenyamanan desa.',
                ],
                [
                    'title'       => 'Penyaluran Bantuan PLN Kepada Masyarakat Desa Selotinatah',
                    'link'        => 'https://selotinatah.magetan.go.id/berita',
                    'image'       => 'https://selotinatah.magetan.go.id/media/img/berita/berita_14449_6a957b82959409.69264733.jpeg',
                    'date'        => 'Senin, 13 Juli 2026',
                    'description' => 'Penyaluran bantuan program tanggung jawab sosial dari PLN kepada warga masyarakat Desa Selotinatah untuk meningkatkan kesejahteraan.',
                ],
            ];
        });

        // Kirimkan $kategoriList ke view
        return view('welcome', compact(
            'totalUmkm',
            'totalProduk',
            'totalKategori',
            'kategoriList',
            'produk',
            'umkm',
            'berita'
        ));

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
        $umkm = Umkm::with('produk')->findOrFail($id);

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