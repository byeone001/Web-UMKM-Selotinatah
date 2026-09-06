<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\Produk;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUmkm = Umkm::count();
        $totalProduk = Produk::count();
        $totalKategori = Umkm::distinct('kategori')->count('kategori');

        $latestUmkms = Umkm::latest()->take(5)->get();
        $latestProduks = Produk::with('umkm')->latest()->take(5)->get();

        $beritas = Cache::remember('berita_admin_v3', 1800, function () {
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

        return view('dashboard', compact(
            'totalUmkm', 
            'totalProduk', 
            'totalKategori', 
            'latestUmkms', 
            'latestProduks',
            'beritas'
        ));
    }
}