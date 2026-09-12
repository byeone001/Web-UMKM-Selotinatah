<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('umkm', function (Blueprint $table): void {
            $table->index('kategori');
            $table->index('created_at');
        });

        Schema::table('produk', function (Blueprint $table): void {
            $table->index('id_umkm');
            $table->index('created_at');
        });

        Schema::table('produk_fotos', function (Blueprint $table): void {
            $table->index(['id_produk', 'urutan']);
        });
    }

    public function down(): void
    {
        Schema::table('umkm', function (Blueprint $table): void {
            $table->dropIndex(['umkm_kategori_index']);
            $table->dropIndex(['umkm_created_at_index']);
        });

        Schema::table('produk', function (Blueprint $table): void {
            $table->dropIndex(['produk_id_umkm_index']);
            $table->dropIndex(['produk_created_at_index']);
        });

        Schema::table('produk_fotos', function (Blueprint $table): void {
            $table->dropIndex(['produk_fotos_id_produk_urutan_index']);
        });
    }
};