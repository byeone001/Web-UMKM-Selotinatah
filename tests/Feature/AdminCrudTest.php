<?php

namespace Tests\Feature;

use App\Models\Produk;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_update_and_delete_umkm(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->post(route('admin.umkm.store'), [
            'nama_umkm' => 'UMKM CRUD Test',
            'pemilik' => 'Pemilik Lama',
            'kategori' => 'Kuliner',
            'kontak' => '08123456789',
        ]);

        $response->assertRedirect(route('admin.umkm.index'));
        $umkm = Umkm::where('nama_umkm', 'UMKM CRUD Test')->firstOrFail();
        $this->assertSame('628123456789', $umkm->kontak);

        $this->actingAs($admin)->put(route('admin.umkm.update', $umkm->id_umkm), [
            'nama_umkm' => 'UMKM CRUD Updated',
            'pemilik' => 'Pemilik Baru',
            'kategori' => 'Kerajinan',
            'kontak' => '628123456789',
        ])->assertRedirect(route('admin.umkm.index'));

        $this->assertDatabaseHas('umkm', ['id_umkm' => $umkm->id_umkm, 'nama_umkm' => 'UMKM CRUD Updated']);

        $this->actingAs($admin)->delete(route('admin.umkm.destroy', $umkm->id_umkm))
            ->assertRedirect(route('admin.umkm.index'));
        $this->assertDatabaseMissing('umkm', ['id_umkm' => $umkm->id_umkm]);
    }

    public function test_admin_can_create_update_and_delete_product(): void
    {
        $admin = User::factory()->admin()->create();
        $umkm = Umkm::create([
            'nama_umkm' => 'UMKM Product CRUD',
            'pemilik' => 'Pemilik Produk',
            'kategori' => 'Kerajinan',
            'kontak' => '628123456789',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.produk.store'), [
            'id_umkm' => $umkm->id_umkm,
            'nama_produk' => 'Produk Lama',
            'harga' => 50000,
        ]);

        $response->assertRedirect(route('admin.produk.index'));
        $produk = Produk::where('nama_produk', 'Produk Lama')->firstOrFail();

        $this->actingAs($admin)->put(route('admin.produk.update', $produk->id_produk), [
            'id_umkm' => $umkm->id_umkm,
            'nama_produk' => 'Produk Baru',
            'harga' => 75000,
        ])->assertRedirect(route('admin.produk.index'));

        $this->assertDatabaseHas('produk', ['id_produk' => $produk->id_produk, 'nama_produk' => 'Produk Baru']);

        $this->actingAs($admin)->delete(route('admin.produk.destroy', $produk->id_produk))
            ->assertRedirect(route('admin.produk.index'));
        $this->assertDatabaseMissing('produk', ['id_produk' => $produk->id_produk]);

    }
}
