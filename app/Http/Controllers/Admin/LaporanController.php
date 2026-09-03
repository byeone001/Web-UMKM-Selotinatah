<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\Produk;

class LaporanController extends Controller
{
    // Export File Excel (.csv)
    public function exportExcel()
    {
        $filename = "Laporan_UMKM_Selotinatah_" . date('Y-m-d') . ".csv";
        $umkms = Umkm::with('produks')->get();

        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($umkms) {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF"); // Format UTF-8 Excel

            fputcsv($file, ['No', 'Nama UMKM', 'Pemilik', 'Kategori', 'Kontak WA', 'Alamat', 'Jumlah Produk']);

            foreach ($umkms as $index => $u) {
                fputcsv($file, [
                    $index + 1,
                    $u->nama_umkm,
                    $u->pemilik,
                    $u->kategori,
                    $u->kontak,
                    $u->alamat,
                    $u->produks->count()
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Tampilan Cetak PDF Resmi Desa
    public function exportPdf()
    {
        $umkms = Umkm::with('produks')->get();
        $totalProduk = Produk::count();

        return view('admin.laporan.pdf', compact('umkms', 'totalProduk'));
    }
}