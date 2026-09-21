<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\ProfilDesaController;
use App\Http\Controllers\Admin\UmkmController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Rute Publik (Tidak Perlu Login)
Route::get('/', [PublicController::class, 'index'])->name('home');

// Sitemap untuk Google
Route::get('/sitemap.xml', function () {
    $urls = [
        url('/'),
        url('/informasi-desa'),
        url('/katalog'),
        url('/daftar-umkm'),
    ];

    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    foreach ($urls as $url) {
        $xml .= '<url>';
        $xml .= '<loc>' . htmlspecialchars($url, ENT_XML1, 'UTF-8') . '</loc>';
        $xml .= '</url>';
    }

    $xml .= '</urlset>';

    return response($xml, 200)
        ->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::get('/informasi-desa', [PublicController::class, 'informasiDesa'])->name('info-desa');
Route::get('/katalog', [PublicController::class, 'katalog'])->name('katalog');
Route::get('/daftar-umkm', [PublicController::class, 'daftarUmkm'])->name('umkm.index');
Route::get('/produk/{id}', [PublicController::class, 'detailProduk'])->name('produk.detail');
Route::get('/umkm/{id}', [PublicController::class, 'detailUmkm'])->name('umkm.detail');

// Rute Terproteksi (Wajib Login)
Route::middleware('auth')->group(function () {

    // Halaman Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->group(function () {
        // Halaman Dashboard Utama
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Rute Kelola Data Admin
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/laporan/excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');
            Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
            Route::resource('umkm', UmkmController::class);
            Route::resource('produk', ProdukController::class);
            Route::get('profil-desa', [ProfilDesaController::class, 'edit'])->name('profil-desa.edit');
            Route::put('profil-desa', [ProfilDesaController::class, 'update'])->name('profil-desa.update');
            Route::post('profil-desa/media', [ProfilDesaController::class, 'storeMedia'])->name('profil-desa.media.store');
            Route::delete('profil-desa/media/{desaMedia}', [ProfilDesaController::class, 'destroyMedia'])->name('profil-desa.media.destroy');
        });
    });
});

require __DIR__.'/auth.php';
