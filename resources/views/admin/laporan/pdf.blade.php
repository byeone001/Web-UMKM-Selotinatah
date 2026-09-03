<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekapitulasi UMKM Selotinatah</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .header h3 { margin: 5px 0 0 0; font-size: 14px; font-weight: normal; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .footer { margin-top: 30px; text-align: right; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom: 15px;">
        <button onclick="window.print()" style="padding: 8px 16px; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
            Cetak / Simpan PDF
        </button>
    </div>

    <div class="header">
        <h2>Pemerintah Desa Selotinatah</h2>
        <h3>Rekapitulasi Data Pelaku UMKM & Produk Desa</h3>
    </div>

    <p><strong>Tanggal Cetak:</strong> {{ date('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama UMKM</th>
                <th width="20%">Pemilik</th>
                <th width="15%">Kategori</th>
                <th width="15%">Kontak</th>
                <th width="10%">Jml Produk</th>
            </tr>
        </thead>
        <tbody>
            @foreach($umkms as $index => $u)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $u->nama_umkm }}</td>
                <td>{{ $u->pemilik }}</td>
                <td>{{ $u->kategori }}</td>
                <td>{{ $u->kontak }}</td>
                <td>{{ $u->produks->count() }} Item</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Desa Selotinatah, {{ date('d F Y') }}</p>
        <br><br><br>
        <p><strong>( Perangkat Desa Selotinatah )</strong></p>
    </div>

    <script>
        // Otomatis membuka dialog cetak saat halaman dimuat
        window.onload = function() { window.print(); }
    </script>
</body>
</html>