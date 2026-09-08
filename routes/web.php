<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\UmkmController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Rute Publik (Tidak Perlu Login)
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/katalog', [PublicController::class, 'katalog'])->name('katalog');
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
        });
    });
});

require __DIR__.'/auth.php';
