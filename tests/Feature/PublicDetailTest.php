<?php

namespace Tests\Feature;

use App\Models\Produk;
use App\Models\Umkm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_umkm_detail_page_displays_business_and_products(): void
    {
        $umkm = Umkm::create($this->umkmPayload());
        $produk = Produk::create([
            'id_umkm' => $umkm->id_umkm,
            'nama_produk' => 'Keranjang Bambu',
            'harga' => 75000,
            'deskripsi' => 'Produk anyaman test.',
        ]);

        $response = $this->get(route('umkm.detail', $umkm->id_umkm));

        $response->assertOk()
            ->assertSee($umkm->nama_umkm)
            ->assertSee($produk->nama_produk);
    }

    public function test_product_detail_page_displays_product_and_umkm(): void
    {
        $umkm = Umkm::create($this->umkmPayload());
        $produk = Produk::create([
            'id_umkm' => $umkm->id_umkm,
            'nama_produk' => 'Tas Anyaman',
            'harga' => 125000,
        ]);

        $response = $this->get(route('produk.detail', $produk->id_produk));

        $response->assertOk()
            ->assertSee($produk->nama_produk)
            ->assertSee($umkm->nama_umkm)
            ->assertSee('Pesan via WhatsApp Sekarang');
    }

    public function test_missing_detail_records_return_not_found(): void
    {
        $this->get(route('umkm.detail', 999999))->assertNotFound();
        $this->get(route('produk.detail', 999999))->assertNotFound();
    }

    /**
     * @return array<string, string>
     */
    private function umkmPayload(): array
    {
        return [
            'nama_umkm' => 'UMKM Detail Test',
            'pemilik' => 'Pemilik Detail',
            'kategori' => 'Kerajinan',
            'kontak' => '628123456789',
        ];
    }
}
