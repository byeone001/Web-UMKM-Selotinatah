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
        if (Schema::hasColumn('umkm', 'lokasi') && ! Schema::hasColumn('umkm', 'link_lokasi')) {
            Schema::table('umkm', function (Blueprint $table) {
                $table->renameColumn('lokasi', 'link_lokasi');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('umkm', 'link_lokasi') && ! Schema::hasColumn('umkm', 'lokasi')) {
            Schema::table('umkm', function (Blueprint $table) {
                $table->renameColumn('link_lokasi', 'lokasi');
            });
        }
    }
};
