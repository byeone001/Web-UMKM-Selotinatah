<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('produks', function (Blueprint $table) {
        $table->id('id_produk');
        $table->foreignId('id_umkm')->constrained('umkms', 'id_umkm')->onDelete('cascade');
        $table->string('nama_produk', 100);
        $table->text('deskripsi')->nullable();
        $table->decimal('harga', 12, 2)->default(0);
        $table->string('foto')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
