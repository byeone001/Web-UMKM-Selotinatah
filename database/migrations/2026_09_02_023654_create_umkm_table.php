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
    Schema::create('umkm', function (Blueprint $table) {
        $table->id('id_umkm');
        $table->string('nama_umkm', 100);
        $table->string('pemilik', 100);
        $table->string('kategori', 50);
        $table->text('deskripsi')->nullable();
        $table->string('foto')->nullable();
        $table->text('alamat')->nullable();
        $table->string('kontak', 100)->nullable();
        $table->string('lokasi')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
