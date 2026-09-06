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
    public function index()
    {
       $umkm = Umkm::latest()->take(6)->get();
        $produk = Produk::with('umkm')->latest()->take(8)->get();

        // Menggunakan cache key baru 'berita_desa_v3' untuk memaksa reload data
        $berita = Cache::remember('berita_desa_v3', 1800, function () {
            $urls = [
                'https://selotinatah.magetan.go.id/first/rss',
                'https://selotinatah.magetan.go.id/rss',
                'https://selotinatah.magetan.go.id/feed',
            ];

            foreach ($urls as $url) {
                try {
                    $response = Http::withoutVerifying()
                        ->withHeaders([
                            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
                        ])
                        ->timeout(5)
                        ->get($url);

                    if ($response->successful()) {
                        $xml = @simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA);
                        $items = [];

                        if ($xml && isset($xml->channel->item)) {
                            foreach ($xml->channel->item as $item) {
                                $items[] = [
                                    'title'       => (string)$item->title,
                                    'link'        => (string)$item->link,
                                    'date'        => date('d M Y', strtotime((string)$item->pubDate)),
                                    'description' => Str::limit(strip_tags((string)$item->description), 110),
                                ];

                                if (count($items) >= 3) break;
                            }
                            if (!empty($items)) {
                                return $items;
                            }
                        }
                    }
                } catch (\Exception $e) {
                    continue;
                }
            }

            // Fallback default jika RSS web desa sedang down/offline
            return [
                [
                    'title'       => 'Portal Informasi & Berita Desa Selotinatah',
                    'link'        => 'https://selotinatah.magetan.go.id/',
                    'date'        => date('d M Y'),
                    'description' => 'Akses informasi terbaru mengenai kegiatan masyarakat, pembangunan, dan layanan administrasi Desa Selotinatah.',
                ],
                [
                    'title'       => 'Pemberdayaan Ekonomi Masyarakat Melalui UMKM Desa',
                    'link'        => 'https://selotinatah.magetan.go.id/',
                    'date'        => date('d M Y', strtotime('-2 days')),
                    'description' => 'Pemerintah Desa Selotinatah terus mendorong potensi produk lokal UMKM agar berdaya saing secara digital.',
                ],
                [
                    'title'       => 'Kegiatan Gotong Royong dan Pembangunan Infrastruktur',
                    'link'        => 'https://selotinatah.magetan.go.id/',
                    'date'        => date('d M Y', strtotime('-5 days')),
                    'description' => 'Warga desa aktif berpartisipasi dalam menjaga kebersihan lingkungan dan kelancaran program pembangunan desa.',
                ],
            ];
        });

        return view('welcome', compact('umkm', 'produk', 'berita'));
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