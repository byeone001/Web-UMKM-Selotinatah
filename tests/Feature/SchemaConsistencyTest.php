<?php

namespace Tests\Feature;

use App\Models\Produk;
use App\Models\Umkm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SchemaConsistencyTest extends TestCase
{
    use RefreshDatabase;

    public function test_application_uses_singular_business_tables(): void
    {
        $this->assertTrue(Schema::hasTable('umkm'));
        $this->assertTrue(Schema::hasTable('produk'));
        $this->assertTrue(Schema::hasTable('produk_fotos'));
        $this->assertFalse(Schema::hasTable('umkms'));
        $this->assertFalse(Schema::hasTable('produks'));
        $this->assertSame('umkm', (new Umkm)->getTable());
        $this->assertSame('produk', (new Produk)->getTable());
    }

    public function test_required_columns_for_location_and_gallery_exist(): void
    {
        $this->assertTrue(Schema::hasColumn('umkm', 'link_lokasi'));
        $this->assertFalse(Schema::hasColumn('umkm', 'lokasi'));
        $this->assertTrue(Schema::hasColumn('produk_fotos', 'id_produk'));
        $this->assertTrue(Schema::hasColumn('produk_fotos', 'foto'));
        $this->assertTrue(Schema::hasColumn('produk_fotos', 'urutan'));
    }
}
