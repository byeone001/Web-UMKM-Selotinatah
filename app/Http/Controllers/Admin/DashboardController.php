<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Umkm;
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

        $latestUmkms = Umkm::latest()
            ->take(5)
            ->get(['id_umkm', 'nama_umkm', 'pemilik', 'kategori', 'foto']);
        $latestProduks = Produk::with('umkm:id_umkm,nama_umkm')
            ->latest()
            ->take(5)
            ->get(['id_produk', 'id_umkm', 'nama_produk', 'harga', 'foto', 'created_at']);

        $berita = Cache::remember('berita_admin_live_v2', 3600, function () {
            try {
                $response = Http::withoutVerifying()
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                    ])
                    ->connectTimeout(1)
                    ->timeout(2)
                    ->get('https://selotinatah.magetan.go.id/berita/fetch-data?page=1');

                if ($response->successful()) {
                    $json = $response->json();
                    if (isset($json['posts']) && is_array($json['posts']) && count($json['posts']) > 0) {
                        $items = [];
                        foreach (array_slice($json['posts'], 0, 4) as $post) {
                            $id = $post['id_berita'] ?? '';
                            $title = $post['judul'] ?? 'Berita Desa Selotinatah';
                            $slug = Str::slug($title);
                            $img = $post['img_url'] ?? '';
                            if ($img && str_starts_with($img, '/')) {
                                $img = 'https://selotinatah.magetan.go.id'.$img;
                            }
                            $link = "https://selotinatah.magetan.go.id/berita/view/{$id}-{$slug}";

                            $rawKonten = strip_tags(html_entity_decode($post['konten'] ?? ''));
                            $date = 'Warta Desa';
                            if (preg_match('/(Senin|Selasa|Rabu|Kamis|Jum[\'a-z]+|Sabtu|Minggu),\s*\d{1,2}\s+[A-Za-z]+\s+\d{4}/u', $rawKonten, $matches)) {
                                $date = $matches[0];
                            }

                            $cleanDesc = preg_replace('/^Selotinatah,\s*Ngariboyo,\s*Magetan\s*—\s*[^—]+—\s*/ui', '', $rawKonten);
                            $desc = Str::limit(trim($cleanDesc), 100);

                            $items[] = [
                                'title' => $title,
                                'link' => $link,
                                'image' => $img,
                                'date' => $date,
                                'description' => $desc,
                            ];
                        }
                        if (! empty($items)) {
                            return $items;
                        }
                    }
                }
            } catch (\Throwable $e) {
                // Fallback
            }

            return [
                [
                    'title' => 'Peringatan Maulid Nabi Muhammad SAW di Jrakah, Dusun Banaran',
                    'link' => 'https://selotinatah.magetan.go.id/berita',
                    'image' => 'https://selotinatah.magetan.go.id/media/img/berita/berita_14451_6a95811165caa7.55701157.jpeg',
                    'date' => 'Sabtu, 29 Agustus 2026',
                    'description' => 'Masyarakat Jrakah, Dusun Banaran, Desa Selotinatah melaksanakan kegiatan peringatan Maulid Nabi dengan khidmat.',
                ],
                [
                    'title' => 'Kerja Bakti Masyarakat Desa Selotinatah',
                    'link' => 'https://selotinatah.magetan.go.id/berita',
                    'image' => 'https://selotinatah.magetan.go.id/media/img/berita/berita_14450_6a957e63af5187.96721326.jpeg',
                    'date' => 'Minggu, 9 Agustus 2026',
                    'description' => 'Pemerintah Desa Selotinatah bersama warga melaksanakan kerja bakti lingkungan desa.',
                ],
            ];
        });

        return view('dashboard', compact(
            'totalUmkm',
            'totalProduk',
            'totalKategori',
            'latestUmkms',
            'latestProduks',
            'berita'
        ));
    }
}
