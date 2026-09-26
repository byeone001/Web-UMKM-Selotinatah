<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-header.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon-32x32.png') }}">

    <title>Laporan Rekapitulasi UMKM Selotinatah</title>

    <style>
        /* =========================================
           DASAR
           ========================================= */

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #000;
        }


        /* =========================================
           TOMBOL CETAK
           ========================================= */

        .no-print {
            margin-bottom: 15px;
        }

        .print-button {
            padding: 10px 20px;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
        }

        .print-button:hover {
            background: #1d4ed8;
        }


        /* =========================================
           KOP SURAT
           ========================================= */

        .header {
            position: relative;
            width: 100%;
            min-height: 105px;
            text-align: center;
            border-bottom: 5px solid #000;
            /*padding-bottom: 10px;*/
            /*margin-bottom: 20px;*/
            box-sizing: border-box;
        }
        
        /* =========================================
           GARIS KOP
           ========================================= */

        .header-line {
            margin-top: 3px;
            border-top: 2px solid #000;
            padding-top: 5px;
            font-size: 11px;
            line-height: 1;
            text-align: center;
        }


        /* =========================================
           LOGO DI KIRI
           ========================================= */

        .header-logo {
            position: absolute;
            left: 10px;
            top: 5px;
            width: 85px;
            height: 85px;
            object-fit: contain;
        }


        /* =========================================
           TEKS KOP
           CENTER PENUH HALAMAN
           ========================================= */

        .header-content {
            width: 100%;
            text-align: center;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        .header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            line-height: 1.4;
            text-transform: uppercase;
        }


        .header h3 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            line-height: 1.4;
            text-transform: uppercase;
        }


        .header h4 {
            margin: 0;
            font-size: 15px;
            font-weight: bold;
            line-height: 1.4;
            text-transform: uppercase;
        }


        /* =========================================
           ALAMAT
           ========================================= */

        .header-address {
            margin-top: 4px;
            font-size: 10px;
            line-height: 1.4;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        /* =========================================
           JUDUL LAPORAN
           ========================================= */

        .report-title {
            text-align: center;
            margin-top: 18px;
            margin-bottom: 15px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }


        /* =========================================
           TANGGAL CETAK
           ========================================= */

        .print-date {
            margin-bottom: 10px;
        }


        /* =========================================
           TABEL
           ========================================= */

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }


        table,
        th,
        td {
            border: 1px solid #000;
        }


        th,
        td {
            padding: 8px;
            text-align: left;
            vertical-align: middle;
        }


        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }


        /* Kolom nomor */
        td:first-child {
            text-align: center;
        }


        /* Kolom jumlah produk */
        td:last-child {
            text-align: center;
        }


        /* =========================================
           FOOTER / TANDA TANGAN
           ========================================= */

           .footer {
            margin-top: 35px;
            width: max-content;
            margin-left: auto;
            margin-right: 10px;
            text-align: left;
        }

        .signature {
            margin-top: 8px;
        }

        .signature p {
            margin: 0;
        }

        .ttd-space {
            height: 55px;
        }

        .signature .nama {
            margin-bottom: 4px;
        }

        .signature .nip {
            margin-top: 0;
        }

        /* =========================================
           PRINT
           ========================================= */

        @media print {

            .no-print {
                display: none !important;
            }

            body {
                margin: 15px;
            }

            .header {
                border-bottom: 3px solid #000;
            }

            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
        }

    </style>
</head>


<body>


    <!-- =========================================
         TOMBOL CETAK
         ========================================= -->

    <div class="no-print">
        <button
            onclick="window.print()"
            class="print-button"
        >
            Cetak / Simpan PDF
        </button>
    </div>



    <!-- =========================================
         KOP SURAT
         ========================================= -->

    <div class="header">

        <!-- LOGO DI KIRI -->
        <img
            src="{{ asset('images/logo-utama.svg') }}"
            alt="Logo Desa Selotinatah"
            class="header-logo"
        >

        <!-- TEKS KOP CENTER -->
        <div class="header-content">
            <h2>
                PEMERINTAH KABUPATEN MAGETAN
            </h2>
            <h3>
                KECAMATAN NGARIBOYO
            </h3>
            <h4>
                DESA SELOTINATAH
            </h4>

            <div class="header-address">
                Alamat: Jalan Majapahit RT 06 RW 02 Dukuh Natah Desa Selotinatah Kecamatan Ngariboyo Kabupaten Magetan
            </div>
        </div>
    </div>



    <!-- =========================================
         JUDUL LAPORAN
         ========================================= -->

    <!-- GARIS KOP  -->
    <div class="header-line">

    </div>

    <div class="report-title">
        REKAPITULASI DATA UMKM DESA
    </div>



    <!-- =========================================
         TANGGAL CETAK
         ========================================= -->

    <p class="print-date">
        <strong>Tanggal Cetak:</strong>
        {{ date('d-m-Y') }}

    </p>



    <!-- =========================================
         TABEL DATA UMKM
         ========================================= -->

    <table>
        <thead>
            <tr>
                <th width="5%">
                    No
                </th>
                <th width="25%">
                    Nama UMKM
                </th>
                <th width="20%">
                    Pemilik
                </th>
                <th width="15%">
                    Kategori
                </th>
                <th width="15%">
                    Kontak
                </th>
                <th width="10%">
                    Jml Produk
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach($umkms as $index => $u)
                <tr>
                    <td>
                        {{ $index + 1 }}
                    </td>
                    <td>
                        {{ $u->nama_umkm }}
                    </td>
                    <td>
                        {{ $u->pemilik }}
                    </td>
                    <td>
                        {{ $u->kategori }}
                    </td>
                    <td>
                        {{ $u->kontak }}
                    </td>
                    <td>
                        {{ $u->produk->count() }} Item
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- =========================================
         TANDA TANGAN
         ========================================= -->
    <div class="footer">
        <p>
            Magetan, {{ date('d-m-Y') }}
        </p>
    <div class="signature">
        <p>
            <strong>Kepala Desa Selotinatah</strong>
        </p>
        <div class="ttd-space"></div>
        <p class="nama">
            <strong>Mulyono</strong>
        </p>
        <p class="nip">
            <strong>NIP: __________________________</strong>
        </p>
    </div>
</div>

    <!-- =========================================
         AUTO PRINT
         ========================================= -->

    <script>
        window.onload = function () {
            window.print();
        };
    </script>
</body>

</html>