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
        Schema::create('desa_medias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profil_desa_id')->constrained('profil_desas')->cascadeOnDelete();
            $table->string('path');
            $table->enum('type', ['foto', 'video'])->default('foto');
            $table->string('judul')->nullable();
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desa_medias');
    }
};
