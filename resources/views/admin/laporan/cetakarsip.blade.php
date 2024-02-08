<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Arsip</title>
    <link href="{{ asset('assets/img/logo.png')}}" rel="icon">
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
            table-layout: fixed;
            border: 1px solid #ededed;
        }

        table,
        th,
        td {
            font-size: 5px;
        }

        th:nth-child(1),
        td:nth-child(1) {
            width: 3%;
        }

        /* # */
        th:nth-child(2),
        td:nth-child(2) {
            width: 8%;
        }

        /* Nomor Arsip */
        th:nth-child(3),
        td:nth-child(3) {
            width: 12%;
        }

        /* Dari */
        th:nth-child(4),
        td:nth-child(4) {
            width: 12%;
        }

        /* Kepada */
        th:nth-child(5),
        td:nth-child(5) {
            width: 11%;
        }

        /* Disposisi Kepada */
        th:nth-child(6),
        td:nth-child(6) {
            width: 6%;
        }

        /* Status Disposisi */
        th:nth-child(7),
        td:nth-child(7) {
            width: 5%;
        }

        /* Jenis Arsip */
        th:nth-child(8),
        td:nth-child(8) {
            width: 6%!important;;
        }

        /* Keamanan Arsip */
        th:nth-child(9),
        td:nth-child(9) {
            width: 9%;
        }

        /* Keterangan */
        th:nth-child(10),
        td:nth-child(10) {
            width: 6%;
        }

        /* Tanggal Arsip */
        th:nth-child(11),
        td:nth-child(11) {
            width: 7%;
        }

        /* Klasifikasi */

        th:nth-child(15),
        td:nth-child(15) {
            width: 5%;
        }

        /* Status Arsip */

        .col-lemari,
        .col-rak,
        .col-folder {
            width: 4% !important;
        }

        table th {
            white-space: normal;
            overflow: hidden;
            border: 1px solid #ededed;
            padding: 5px;
            font-size: 8px;
            background-color: #ddd;

        }

        table td {
            word-wrap: break-word;
            overflow-wrap: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            border: 1px solid #ededed;
            padding: 5px;
            font-size: 8px;
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
            font-size: 10px;
        }

        .footer-style1 {
            margin-top: 1rem !important;
            font-size: 10px;
            /* margin-right: 3rem; */
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
            width: 20px;
            height: 20px;
            object-fit: cover;
        }

        .subtitle {
            font-weight: bold;
        }

        /* badge status disposisi */
        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
            color: #fff;
        }

        .bg-primary {
            background-color: #007bff;
        }

        .bg-success {
            background-color: #28a745;
        }

        .bg-danger {
            background-color: #dc3545;
        }

        .bg-warning {
            background-color: #ffc107;
        }

        .bg-info {
            background-color: #17a2b8;
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

    <div class="date">Tanggal & Jam Laporan: {{ date('d/m/Y H:i') }} WIB</div>
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
                <th rowspan="2">Nomor Arsip</th>
                <th rowspan="2">Dari</th>
                <th rowspan="2">Kepada</th>
                <th rowspan="2">Disposisi Kepada</th>
                <th rowspan="2">Status Disposisi</th>
                <th rowspan="2" class="text-center">Jenis Arsip</th>
                <th rowspan="2">Keamanan Arsip</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Tanggal Arsip</th>
                <th rowspan="2">Klasifikasi</th>
                <th colspan="3" class="text-center">Lokasi</th>
                <th rowspan="2" class="text-center">Status Arsip</th>
            </tr>
            <tr>
                <th class="col-lemari">Lemari</th>
                <th class="col-rak">Rak</th>
                <th class="col-folder">Folder</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($disposisis as $disposisi)
            @if(empty($jenisArsip) || ($disposisi->arsip && $disposisi->arsip->jenis_arsip == $jenisArsip))
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>{{ $disposisi->arsip->nomor_surat }}</td>
                <td>{{ $disposisi->arsip->dari }}</td>

                <td>
                    @foreach ($disposisi->arsip->users as $user)
                    {{ $user->nama }}<br>
                    @endforeach
                </td>
                @if(!auth()->user()->hasRole('user'))
                <td>
                    @foreach ($disposisi->users as $user)
                    @if($user->pivot->status == 'diterima')
                    {{ $user->nama }}<br>
                    @endif
                    @endforeach
                </td>
                @endif
                <td class="text-center">
                    @php
                    $statusDiterima = false;
                    @endphp

                    @foreach ($disposisi->users as $user)
                    @if($user->pivot->status == 'diterima')
                    @php
                    $statusDiterima = true;
                    @endphp
                    <span class="badge bg-success">Diterima</span>
                    @break

                    @endif
                    @endforeach

                    @if(!$statusDiterima)
                    @foreach ($disposisi->users as $user)
                    <span class="badge {{ $user->pivot->status == 'disposisi' ? 'bg-danger' : 'bg-secondary' }}">
                        {{ strtoupper($user->pivot->status) }}
                    </span><br>
                    @endforeach
                    @endif
                </td>
                <td class="text-center">
                    @if($disposisi->arsip->jenis_arsip == 'masuk')
                    <span class="badge bg-success">{{ UCfirst($disposisi->arsip->jenis_arsip) }}</span>
                    @elseif($disposisi->arsip->jenis_arsip == 'keluar')
                    <span class="badge bg-danger">{{ UCfirst($disposisi->arsip->jenis_arsip) }}</span>
                    @endif
                </td>
                <td>{{$disposisi->arsip->keamanan_arsip }}</td>
                <td>{{$disposisi->arsip->keterangan }}</td>
                <td>{{$disposisi->arsip->tanggal_arsip ? \Carbon\Carbon::parse($disposisi->arsip->tanggal_arsip)->format('d-m-Y') : '-' }}</td>
                <td>{{$disposisi->arsip->klasifikasi->nomor_klasifikasi }} - {{$disposisi->arsip->klasifikasi->daftarArsip->nama_daftar }}</td>
                <td class="text-center">{{$disposisi->arsip->lemari->lemari }}</td> <!-- Kolom Lemari -->
                <td class="text-center">{{$disposisi->arsip->rak->rak }}</td> <!-- Kolom Rak -->
                <td class="text-center">{{$disposisi->arsip->folder->folder }}</td> <!-- Kolom Folder -->
                <td class="text-center">
                    @if($disposisi->arsip->status_arsip == 'diproses')
                    <span class="badge bg-primary">{{ UCfirst($disposisi->arsip->status_arsip) }}</span>
                    @elseif($disposisi->arsip->status_arsip == 'selesai')
                    <span class="badge bg-success">{{ UCfirst($disposisi->arsip->status_arsip) }}</span>
                    @elseif($disposisi->arsip->status_arsip == 'palsu')
                    <span class="badge bg-danger">{{ UCfirst($disposisi->arsip->status_arsip) }}</span>
                    @elseif($disposisi->arsip->status_arsip == 'meragukan')
                    <span class="badge bg-warning">{{ UCfirst($disposisi->arsip->status_arsip) }}</span>
                    @elseif($disposisi->arsip->status_arsip == 'disposisi')
                    <span class="badge bg-info">{{ UCfirst($disposisi->arsip->status_arsip) }}</span>
                    @endif
                </td>
            </tr>
            @endif
            @endforeach

            <!-- tabel arsip -->

            @foreach($arsips as $arsip)
            @if(empty($jenisArsip) || $arsip->jenis_arsip == $jenisArsip)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>{{ $arsip->nomor_surat }}</td>
                @if($arsip->jenis_arsip == 'keluar')
                <td>
                    @forelse ($arsip->users as $user)
                    {{ $user->nama }}<br>
                    @empty
                    -
                    @endforelse
                </td>
                <td>{{ $arsip->dari }}</td>
                @else
                <!-- Untuk Arsip Masuk, tampilkan Dari terlebih dahulu -->
                <td>{{ $arsip->dari }}</td>
                <td>
                    @forelse ($arsip->users as $user)
                    {{ $user->nama }}<br>
                    @empty
                    -
                    @endforelse
                </td>
                @endif
                <td class="text-center">
                    {{ $arsip->status_disposisi ? $arsip->status_disposisi : '-' }}
                </td>
                <td>
                    {{-- Asumsi ada relasi atau logika untuk menentukan kepada siapa disposisi dikirim --}}
                    {{ $arsip->disposisi_kepada ?? '-' }}
                </td>
                <td class="text-center">
                    @if($arsip->jenis_arsip == 'masuk')
                    <span class="badge bg-success">{{ UCfirst($arsip->jenis_arsip) }}</span>
                    @elseif($arsip->jenis_arsip == 'keluar')
                    <span class="badge bg-danger">{{ UCfirst($arsip->jenis_arsip) }}</span>
                    @endif
                </td>
                <td>{{$arsip->keamanan_arsip }}</td>
                <td>
                    {{ $arsip->keterangan ?? '-' }}
                </td>
                <td>{{$arsip->tanggal_arsip ? \Carbon\Carbon::parse($arsip->tanggal_arsip)->format('d-m-Y') : '-' }}</td>
                <td>{{$arsip->klasifikasi->nomor_klasifikasi }} - {{$arsip->klasifikasi->daftarArsip->nama_daftar }}</td>
                <td class="col-lemari text-center">{{$arsip->lemari->lemari }}
                <td class="col-rak text-center">{{$arsip->rak->rak }}</td>
                <td class="col-folder text-center">{{$arsip->folder->folder }}</td>
                <td class="text-center">
                    @if($arsip->status_arsip == 'diproses')
                    <span class="badge bg-primary">{{ UCfirst($arsip->status_arsip) }}</span>
                    @elseif($arsip->status_arsip == 'selesai')
                    <span class="badge bg-success">{{ UCfirst($arsip->status_arsip) }}</span>
                    @elseif($arsip->status_arsip == 'palsu')
                    <span class="badge bg-danger">{{ UCfirst($arsip->status_arsip) }}</span>
                    @elseif($arsip->status_arsip == 'meragukan')
                    <span class="badge bg-warning">{{ UCfirst($arsip->status_arsip) }}</span>
                    @elseif($arsip->status_arsip == 'disposisi')
                    <span class="badge bg-info">{{ UCfirst($arsip->status_arsip) }}</span>
                    @endif
                </td>
            </tr>
            @endif
            @endforeach

        </tbody>
    </table>
    <footer>
        <br>
        <p style="text-align: right;" class="footer-style1">Tertanda,</p>
        <p class="footer-style" style="text-align: right; ">Direktur AKN Yogyakarta</p>
    </footer>



</body>
</html>
