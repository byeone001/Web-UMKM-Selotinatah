<?php

namespace Tests\Feature;

use App\Models\Umkm;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UmkmValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_invalid_whatsapp_number_is_rejected(): void
    {
        $response = $this->actingAs(User::factory()->admin()->create())
            ->post(route('admin.umkm.store'), $this->validPayload([
                'kontak' => '08123',
            ]));

        $response->assertSessionHasErrors('kontak');
    }

    public function test_non_google_maps_location_is_rejected(): void
    {
        $response = $this->actingAs(User::factory()->admin()->create())
            ->post(route('admin.umkm.store'), $this->validPayload([
                'link_lokasi' => 'https://example.com/location',
            ]));

        $response->assertSessionHasErrors('link_lokasi');
    }

    public function test_valid_whatsapp_number_is_normalized_before_storage(): void
    {
        $response = $this->actingAs(User::factory()->admin()->create())
            ->post(route('admin.umkm.store'), $this->validPayload([
                'kontak' => '08123456789',
                'link_lokasi' => 'https://maps.google.com/?q=Selotinatah',
            ]));

        $response->assertRedirect(route('admin.umkm.index'));
        $this->assertDatabaseHas('umkm', [
            'kontak' => '628123456789',
            'link_lokasi' => 'https://maps.google.com/?q=Selotinatah',
        ]);
    }

    public function test_product_gallery_photos_are_stored(): void
    {
        Storage::fake('public');
        $admin = User::factory()->admin()->create();
        $umkm = Umkm::create([
            'nama_umkm' => 'UMKM Gallery',
            'pemilik' => 'Pemilik Gallery',
            'kategori' => 'Kerajinan',
            'kontak' => '628123456789',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.produk.store'), [
            'id_umkm' => $umkm->id_umkm,
            'nama_produk' => 'Produk Gallery',
            'harga' => 50000,
            'fotos' => [
                UploadedFile::fake()->image('gallery-1.jpg'),
                UploadedFile::fake()->image('gallery-2.jpg'),
            ],
        ]);

        $response->assertRedirect(route('admin.produk.index'));
        $this->assertDatabaseCount('produk_fotos', 2);
    }

    /**
     * @param  array<string, string>  $overrides
     * @return array<string, string>
     */
    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'nama_umkm' => 'UMKM Test',
            'pemilik' => 'Pemilik Test',
            'kategori' => 'Kerajinan',
            'kontak' => '628123456789',
            'alamat' => 'Desa Selotinatah',
            'deskripsi' => 'Deskripsi test',
        ], $overrides);
    }
}
