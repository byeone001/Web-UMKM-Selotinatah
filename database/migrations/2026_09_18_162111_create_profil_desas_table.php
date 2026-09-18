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
        Schema::create('profil_desas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa')->nullable();
            $table->text('sejarah')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('geografis')->nullable();
            $table->integer('jumlah_penduduk')->nullable()->default(0);
            $table->integer('jumlah_laki_laki')->nullable()->default(0);
            $table->integer('jumlah_perempuan')->nullable()->default(0);
            $table->integer('jumlah_kk')->nullable()->default(0);
            $table->string('kontak_telepon')->nullable();
            $table->string('kontak_email')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('foto_utama')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_desas');
    }
};
