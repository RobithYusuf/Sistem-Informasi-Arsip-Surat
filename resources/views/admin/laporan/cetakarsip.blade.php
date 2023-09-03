<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Arsip</title>
    <style type="text/css" media="all">
        * {
            font-family: DejaVu Sans, sans-serif !important;
        }

        html {
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
            border: 1px solid #ededed;
        }

        table,
        th,
        td {
            font-size: 10px;
            /* Anda bisa menyesuaikan ukuran ini */
        }


        table th {
            white-space: normal;
            overflow: hidden;
            text-overflow: ellipsis;
            border: 1px solid #ededed;
            padding: 5px;
            font-size: 9px;
            background-color: #ddd;
        }

        table td {
            word-wrap: break-word;
            overflow-wrap: break-word;
            /* Tambahkan baris ini */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            /* Ubah ini */
            border: 1px solid #ededed;
            padding: 5px;
            font-size: 9px;
            margin-bottom: 2rem;

        }

        .header {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            text-align: center;
            margin-bottom: 10px;

        }

        .title {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .date {
            font-size: 8;
            margin-bottom: 5px;
        }

        .logo {
            width: 75px;
            height: 75px;
            margin-left: 15px;
        }

        .table-title {
            text-align: center;
            font-size: 13px;
        }

        .report-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .report-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .report-period {
            font-size: 12px;
            color: #333;
            padding: 0;
            margin: 0;
        }

        .data-count {
            font-size: 12px;
            color: #333;
            padding: 0;
            margin: 0;
        }

        .report-period span,
        .data-count span {
            font-weight: bold;
        }

        .footer-style {
            margin-top: 4rem !important;
        }

        .footer-style1 {
            margin-top: 1rem !important;
        }

        /* thumbnaik akta dan kk */
        .thumbnail-link {
            display: inline-block;
            /* background-color: #f3f3f3; */
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }

        .thumbnail-link:hover {
            transform: scale(1.05);
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }

        .img-thumbnail {

            width: 40px;
            height: 40px;
            object-fit: cover;
        }

        .subtitle {
            font-weight: bold;
            /* Tambahkan baris ini */
        }
    </style>
</head>

<body>
    <div class="header">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 15%;">
                    <img src="assets/img/logo.png" alt="Aswirusani" class="logo">
                </td>
                <td style="width: 80%;">
                    <div class="title">
                        <span class="logo-title"> KEMENTRIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI
                        </span>
                    </div>
                    <div class="subtitle">
                        <span class="logo-subtitle"> AKADEMI KOMUNITAS NEGERI SENI DAN BUDAYA YOGYAKARTA
                        </span>
                    </div>
                    <div class="address">
                        <span class="logo-address"> Jl. Parangtritis No.364, Pandes, Panggungharjo, Kec. Sewon, Bantul, Daerah Istimewa Yogyakarta 55188</span>
                    </div>
                    <div class="contact">
                        <span class="logo-contact">Email: info@aknsby.com | Telp: 0274774289 | Web : https://www.aknyogya.ac.id </span>
                    </div>
                </td>
            </tr>
        </table>
        <hr style="border-top: 3px solid #000000;">
    </div>

    <div class="date">Tanggal dan Jam Laporan: {{ date('d/m/Y H:i') }}</div>
    <div class="report-title">Laporan Arsip</div>
    <div class="report-info">
        <div class="report-period">
            Periode: <span>{{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}</span> sampai <span>{{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</span>
        </div>
        <div class="data-count">
            Jumlah Data: <span>{{ $totalRows }}</span>
        </div>


    </div>
    <table>
        <thead>
            <tr>
                <th rowspan="2">#</th>
                <th rowspan="2">Nomor Berkas</th>
                <th rowspan="2">Uraian Berkas</th>
                <th rowspan="2">Jumlah</th>
                <th rowspan="2">Keamanan Arsip</th>
                <th rowspan="2">Uraian Arsip</th>
                <th rowspan="2">Gambar</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">Pengarsip</th>
                <th rowspan="2">Klasifikasi</th>
                <th colspan="3" class="text-center">Lokasi</th>
                <th rowspan="2" class="text-center">Status Arsip</th> <!-- Ini perbaikannya -->
            </tr>
            <tr>
                <th>Lemari</th>
                <th>Rak</th>
                <th>Folder</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $arsip)
            <tr>
                <td>{{ $arsip->id_arsip }}</td>
                <td>{{ $arsip->nomor_berkas }}</td>
                <td>{{ $arsip->uraian_berkas }}</td>
                <td>{{ $arsip->jumlah }}</td>
                <td>{{ $arsip->keamanan_arsip }}</td>
                <td>{{ $arsip->uraian_arsip }}</td>
                <td class="text-center">
                    <a href="{{ asset('storage/gambar/' . basename($arsip->gambar)) }}" target="_blank" class="thumbnail-link">
                        <img src="{{ asset('storage/gambar/' . $arsip->gambar) }}" alt="Gambar Arsip" width="100" class="img-thumbnail"> <!-- Anda bisa mengatur width sesuai kebutuhan -->
                </td>

                <td>{{ $arsip->keterangan }}</td>
                <td>{{ $arsip->tanggal }}</td>
                <td>{{ $arsip->user->nama }}</td>
                <td>{{ $arsip->klasifikasi->nomor_klasifikasi }} - {{ $arsip->klasifikasi->daftarArsip->nama_daftar }}</td>
                <td class="text-center">{{ $arsip->lemari->lemari }}</td> <!-- Kolom Lemari -->
                <td class="text-center">{{ $arsip->rak->rak }}</td> <!-- Kolom Rak -->
                <td class="text-center">{{ $arsip->folder->folder }}</td> <!-- Kolom Folder -->
                <td class="text-center">
                    @if($arsip->status_arsip == 'masuk')
                    <span class="badge bg-success">{{ strtolower($arsip->status_arsip) }}</span>
                    @elseif($arsip->status_arsip == 'keluar')
                    <span class="badge bg-danger">{{ strtolower($arsip->status_arsip) }}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <footer>
        <br>
        <p style="text-align: right;" class="footer-style1">Tertanda,</p>
        <p class="footer-style" style="text-align: right; ">Pimpinan Arsip</p>
    </footer>

</body>

</html>