@extends('layouts.mastertabel')
@section('title','Tabel Arsip')
@section('content')
<style>
    .custom-table th,
    .custom-table td {
        font-size: 0.8rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }

    .custom-table td.max-width-250 {
        max-width: 250px;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info {
        font-size: 0.8rem;
        margin-bottom: 20px;

    }

    .dataTables_wrapper .fa {
        /* Jika Anda menggunakan Font Awesome */
        font-size: 0.8rem;

    }

    .dataTables_wrapper .dataTables_paginate {
        font-size: 0.7rem;

    }

    .dataTables_wrapper .table {
        border-top: 1px solid #4f5152;
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


    /*laporan card bawah  */
    /* Spesifik untuk bagian laporan */
    .laporan-section .card {
        border: 1px solid #dee2e6;
        box-shadow: 0 2px 4px rgb(0 0 0 / 10%);
    }

    .laporan-section .card-body h5 {
        color: #343a40;
    }

    .laporan-section .card-body .card-text {
        font-size: 1rem;
        color: #495057;
        margin-bottom: -20px;
    }

    /* Menambahkan spasi antara ikon dan judul pada laporan */
    .laporan-section .card-body h5 i {
        margin-right: 0.5rem;
        /* Atur ini sesuai dengan keinginan */
    }


    .laporan-section .card-body .card-text span {
        font-size: 2rem;
        color: #0056b3;
        font-weight: 700;
    }

    #resetButton {
        background-color: #6c757d;
        color: white;
        border: none;
        transition: background-color 0.3s ease;
        margin-left: 10px;
    }

    #resetButton:hover {
        background-color: #5a6268;
    }

    #resetButton i {
        margin-right: 2px;
    }
</style>
<div class="pagetitle">
    <h1>Tabel Arsip</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route(auth()->user()->role->role . '.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active">Laporan</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <h4 class="card-title filter-label font-weight-bold text-primary mb-4 mt-2"><i class="bi bi-bar-chart-line-fill"></i> Laporan Arsip Surat</h4>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start_date" class="form-label"><i class="bi bi-calendar-day"></i> Dari Tanggal:</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="end_date" class="form-label"><i class="bi bi-calendar2-day"></i> s/d</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status_filter" class="form-label"><i class="bi bi-archive"></i> Jenis Arsip:</label>
                                    <select id="status_filter" class="form-select" required>
                                        <option value="">Semua</option>
                                        <option value="masuk">Masuk</option>
                                        <option value="keluar">Keluar</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3 d-flex justify-content-end">
                            <a href="#" id="cetak_laporan" class="btn btn-primary " target="_blank">Cetak PDF</a>
                        </div>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="table-responsive mt-3">
                        <table id="datatable-table-laporan" class="table table-bordered table-striped custom-table">
                            <thead>
                                <tr>
                                    <th rowspan="2">#</th>
                                    <th rowspan="2">Nomor Arsip</th>
                                    <th rowspan="2">Dari</th>
                                    <th rowspan="2">Kepada</th>
                                    <th rowspan="2">Status Disposisi</th>
                                    <th rowspan="2">Disposisi Kepada</th>
                                    <th rowspan="2" class="text-center">Jenis Arsip</th>
                                    <th rowspan="2">Keamanan Arsip</th>
                                    <th rowspan="2">Lampiran</th>
                                    <th rowspan="2">Keterangan</th>
                                    <th rowspan="2">Tanggal Arsip</th>
                                    <th rowspan="2">Klasifikasi</th>
                                    <th colspan="3" class="text-center">Lokasi</th>
                                    <th rowspan="2" class="text-center">Status Arsip</th>
                                </tr>
                                <tr>
                                    <th>Lemari</th>
                                    <th>Rak</th>
                                    <th>Folder</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($disposisis as $index =>$disposisi)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{$disposisi->arsip->nomor_surat }}</td>
                                    <td>{{$disposisi->arsip->dari }}</td>
                                    <td class="max-width-250">
                                        @foreach ($disposisi->arsip->users as $user)
                                        {{ $user->nama }}<br>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @php
                                        $statusDiterima = false;
                                        @endphp

                                        @foreach ($disposisi->users as $user)
                                        @if($user->pivot->status == 'diterima')
                                        @php
                                        $statusDiterima = true;
                                        @endphp
                                        <span class="badge bg-success">DITERIMA</span>
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

                                    @if(!auth()->user()->hasRole('user'))
                                    <td class="max-width-250">
                                        @foreach ($disposisi->users as $user)
                                        @if($user->pivot->status == 'diterima')
                                        {{ $user->nama }}<br>
                                        @endif
                                        @endforeach
                                    </td>
                                    @endif

                                    <td class="text-center">
                                        @if($disposisi->arsip->jenis_arsip == 'masuk')
                                        <span class="badge bg-success">{{ strtoupper($disposisi->arsip->jenis_arsip) }}</span>
                                        @elseif($disposisi->arsip->jenis_arsip == 'keluar')
                                        <span class="badge bg-danger">{{ strtoupper($disposisi->arsip->jenis_arsip) }}</span>
                                        @endif
                                    </td>
                                    <td>{{$disposisi->arsip->keamanan_arsip }}</td>
                                    <td class="text-center">
                                        @if ($disposisi->arsip->lampiran)
                                        @php
                                        $extension = pathinfo($disposisi->arsip->lampiran, PATHINFO_EXTENSION);
                                        $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx'];
                                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png']);
                                        @endphp

                                        @if ($isImage)
                                        <!-- Jika berkas adalah gambar, tampilkan dengan elemen <img> -->
                                        <a href="{{ asset('storage/lampiran/' . basename($arsip->lampiran)) }}" target="_blank" class="thumbnail-link">
                                            <img src="{{ asset('storage/lampiran/' . $arsip->lampiran) }}" alt="lampiran Arsip" width="100" class="img-thumbnail">
                                            @else
                                            <!-- Jika bukan gambar, berikan tautan ke berkas dengan target="_blank" -->
                                            <a href="javascript:void(0);" onclick="window.open('{{ asset('storage/lampiran/' . $disposisi->arsip->lampiran) }}')">Lihat Lampiran</a>

                                            @endif
                                            @else
                                            <!-- Jika tidak ada lampiran -->
                                            -
                                            @endif
                                    </td>

                                    <td>{{$disposisi->arsip->keterangan }}</td>
                                    <td>{{$disposisi->arsip->tanggal_arsip ? \Carbon\Carbon::parse($disposisi->arsip->tanggal_arsip)->format('d F Y') : '-' }}</td>
                                    <td>{{$disposisi->arsip->klasifikasi->nomor_klasifikasi }} - {{$disposisi->arsip->klasifikasi->daftarArsip->nama_daftar }}</td>
                                    <td class="text-center">{{$disposisi->arsip->lemari->lemari }}</td> <!-- Kolom Lemari -->
                                    <td class="text-center">{{$disposisi->arsip->rak->rak }}</td> <!-- Kolom Rak -->
                                    <td class="text-center">{{$disposisi->arsip->folder->folder }}</td> <!-- Kolom Folder -->
                                    <td class="text-center">
                                        @if($disposisi->arsip->status_arsip == 'diproses')
                                        <span class="badge bg-primary">{{ strtoupper($disposisi->arsip->status_arsip) }}</span>
                                        @elseif($disposisi->arsip->status_arsip == 'selesai')
                                        <span class="badge bg-success">{{ strtoupper($disposisi->arsip->status_arsip) }}</span>
                                        @elseif($disposisi->arsip->status_arsip == 'palsu')
                                        <span class="badge bg-danger">{{ strtoupper($disposisi->arsip->status_arsip) }}</span>
                                        @elseif($disposisi->arsip->status_arsip == 'meragukan')
                                        <span class="badge bg-warning">{{ strtoupper($disposisi->arsip->status_arsip) }}</span>
                                        @elseif($disposisi->arsip->status_arsip == 'disposisi')
                                        <span class="badge bg-info">{{ strtoupper($disposisi->arsip->status_arsip) }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                                <!-- tabel arsip -->
                                @php $no = count($disposisis); @endphp
                                @foreach($arsipsMasuk->merge($arsipsKeluar) as $arsip)
                                @if($arsip->status_arsip != 'disposisi')
                                @php $no++; @endphp
                                <tr>
                                    <th scope="row">{{ $no }}</th>
                                    <td>{{ $arsip->nomor_surat }}</td>
                                    <!-- Untuk Arsip Keluar, tampilkan Kepada terlebih dahulu -->
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

                                    <td class="text-center">-</td>
                                    <td class="text-center">
                                        -
                                    </td>

                                    <td class="text-center">
                                        @if($arsip->jenis_arsip == 'masuk')
                                        <span class="badge bg-success">{{ strtoupper($arsip->jenis_arsip) }}</span>
                                        @elseif($arsip->jenis_arsip == 'keluar')
                                        <span class="badge bg-danger">{{ strtoupper($arsip->jenis_arsip) }}</span>
                                        @endif
                                    </td>
                                    <td>{{$arsip->keamanan_arsip }}</td>
                                    <td class="text-center">
                                        @if ($arsip->lampiran)
                                        @php
                                        $extension = pathinfo($arsip->lampiran, PATHINFO_EXTENSION);
                                        $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx'];
                                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png']);
                                        @endphp

                                        @if ($isImage)
                                        <!-- Jika berkas adalah gambar, tampilkan dengan elemen <img> -->
                                        <a href="{{ asset('storage/lampiran/' . basename($arsip->lampiran)) }}" target="_blank" class="thumbnail-link">
                                            <img src="{{ asset('storage/lampiran/' . $arsip->lampiran) }}" alt="lampiran Arsip" width="100" class="img-thumbnail">
                                            @else
                                            <!-- Jika bukan gambar, berikan tautan ke berkas dengan target="_blank" -->
                                            <a href="javascript:void(0);" onclick="window.open('{{ asset('storage/lampiran/' . $arsip->lampiran) }}')">Lihat Lampiran</a>

                                            @endif
                                            @else
                                            <!-- Jika tidak ada lampiran -->
                                            -
                                            @endif
                                    </td>

                                    <td>{{$arsip->keterangan }}</td>
                                    <td>{{$arsip->tanggal_arsip ? \Carbon\Carbon::parse($arsip->tanggal_arsip)->format('d F Y') : '-' }}</td>
                                    <td>{{$arsip->klasifikasi->nomor_klasifikasi }} - {{$arsip->klasifikasi->daftarArsip->nama_daftar }}</td>
                                    <td class="text-center">{{$arsip->lemari->lemari }}</td> <!-- Kolom Lemari -->
                                    <td class="text-center">{{$arsip->rak->rak }}</td> <!-- Kolom Rak -->
                                    <td class="text-center">{{$arsip->folder->folder }}</td> <!-- Kolom Folder -->
                                    <td class="text-center">
                                        @if($arsip->status_arsip == 'diproses')
                                        <span class="badge bg-primary">{{ strtoupper($arsip->status_arsip) }}</span>
                                        @elseif($arsip->status_arsip == 'selesai')
                                        <span class="badge bg-success">{{ strtoupper($arsip->status_arsip) }}</span>
                                        @elseif($arsip->status_arsip == 'palsu')
                                        <span class="badge bg-danger">{{ strtoupper($arsip->status_arsip) }}</span>
                                        @elseif($arsip->status_arsip == 'meragukan')
                                        <span class="badge bg-warning">{{ strtoupper($arsip->status_arsip) }}</span>
                                        @elseif($arsip->status_arsip == 'disposisi')
                                        <span class="badge bg-info">{{ strtoupper($arsip->status_arsip) }}</span>
                                        @endif
                                    </td>
                                    @endif
                                    @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm p-3">
                <div class="card-body">
                    <h4 class="card-title filter-label font-weight-bold text-primary mb-4"><i class="bi bi-info-square-fill"></i> Laporan Akumulasi Arsip</h4>
                    <form id="laporanForm">
                        <div class="row g-3">
                            <!-- Dropdown untuk memilih user -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="user_id" class="form-label"><i class="bi bi-person-lines-fill"></i> Pilih Users</label>
                                    <select class="form-select" id="user_id" name="user_id">
                                        @foreach ($users as $index => $user)
                                        <option value="{{ $user->id }}"> {{ $index +1 }}. {{ $user->nama }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <!-- Input untuk tanggal awal -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tanggal_awal" class="form-label"><i class="bi bi-calendar-day"></i> Tanggal Awal</label>
                                    <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" required>
                                </div>
                            </div>

                            <!-- Input untuk tanggal akhir -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tanggal_akhir" class="form-label"><i class="bi bi-calendar2-day"></i> Tanggal Akhir</label>
                                    <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol untuk submit form -->
                        <div class="text-center mt-3 d-flex justify-content-end">
                            <button type="submit" id="cekLaporanButton" class="btn btn-primary">
                                <i class="bi bi-search"></i> Cek Laporan
                            </button>
                            <button type="reset" id="resetButton" class="btn btn-secondary ml-2">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset
                            </button>

                        </div>
                    </form>

                    <!-- Tempat menampilkan hasil laporan -->
                    <div class="laporan-section mt-4 row">
                        <!-- Kolom untuk jumlah arsip masuk -->
                        <div class="col-md-4">
                            <div class="card text-center bg-light mb-3 p-4"> <!-- Tambahkan p-3 untuk padding -->
                                <div class="card-body">
                                    <h5><i class="bi bi-inbox-fill"></i> Jumlah Arsip Masuk</h5>
                                    <p class="card-text"><span id="jumlahSuratMasuk" class="font-weight-bold">0</span></p>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom untuk jumlah arsip keluar -->
                        <div class="col-md-4">
                            <div class="card text-center bg-light mb-3 p-4"> <!-- Tambahkan p-3 untuk padding -->
                                <div class="card-body">
                                    <h5><i class="bi bi-box-arrow-up-right"></i>Jumlah Arsip Keluar</h5>
                                    <p class="card-text"><span id="jumlahSuratKeluar" class="font-weight-bold">0</span></p>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom untuk jumlah seluruh arsip -->
                        <div class="col-md-4">
                            <div class="card text-center bg-light mb-3 p-4"> <!-- Tambahkan p-3 untuk padding -->
                                <div class="card-body">
                                    <h5><i class="bi bi-archive-fill"></i>Jumlah Seluruh Arsip</h5>
                                    <p class="card-text"><span id="totalArsip" class="font-weight-bold">0</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>

<script type="text/javascript">
    var routePrefix = "{{ getCurrentRoutePrefix() }}"; // Mendapatkan prefix rute
</script>

<script>
    function getLaporan() {
        var userId = document.getElementById('user_id').value;
        var tanggalAwal = document.getElementById('tanggal_awal').value;
        var tanggalAkhir = document.getElementById('tanggal_akhir').value;
        var url = `/${routePrefix}/get-laporan-arsip?user_id=${userId}&tanggal_awal=${tanggalAwal}&tanggal_akhir=${tanggalAkhir}`;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('jumlahSuratMasuk').textContent = data.jumlahMasuk;
                document.getElementById('jumlahSuratKeluar').textContent = data.jumlahKeluar;
                document.getElementById('totalArsip').textContent = data.total;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Fungsi untuk reset form dan output
    function resetFormAndOutput(form) {
        form.reset();
        document.getElementById('jumlahSuratMasuk').textContent = '0';
        document.getElementById('jumlahSuratKeluar').textContent = '0';
        document.getElementById('totalArsip').textContent = '0';
        form.classList.remove('was-validated');
    }

    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('laporanForm');
        var resetButton = document.getElementById('resetButton');

        if (form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                if (!this.checkValidity()) {
                    event.stopPropagation();
                    this.classList.add('was-validated');
                } else {
                    getLaporan();
                }
            });
        }

        if (resetButton) {
            resetButton.addEventListener('click', function() {
                resetFormAndOutput(form);
            });
        }
    });


    // Fungsi untuk update link cetak
    function updateCetakLink() {
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        var status = $('#status_filter').val();
        var url = "{{ route($currentRoutePrefix . '.laporan.cetak') }}" + "?start_date=" + startDate + "&end_date=" + endDate + "&jenis_arsip=" + status;
        $('#cetak_laporan').attr('href', url);
    }

    $(document).ready(function() {
        var table = $('#datatable-table-laporan').DataTable();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // Januari adalah 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById('end_date').value = today;

        // Fungsi kustom untuk memfilter berdasarkan tanggal
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var startDate = new Date($('#start_date').val());
                var endDate = new Date($('#end_date').val());

                // Gantikan 8 dengan indeks kolom tanggal yang sesuai dalam tabel Anda
                var dateColumn = new Date(data[10]);

                if ((isNaN(startDate.getTime()) && isNaN(endDate.getTime())) ||
                    (isNaN(startDate.getTime()) && dateColumn <= endDate) ||
                    (startDate <= dateColumn && isNaN(endDate.getTime())) ||
                    (startDate <= dateColumn && dateColumn <= endDate)) {
                    return true;
                }
                return false;
            }
        );

        // Fungsi untuk filter status
        $('#status_filter').on('change', function() {
            var status = $(this).val();
            table.column(6).search(status).draw();
        });

        // Panggil fungsi updateCetakLink setiap kali filter berubah
        $('#start_date, #end_date, #status_filter').on('change', function() {
            updateCetakLink();
            table.draw();
        });
        updateCetakLink();
    }); // Fungsi untuk filter status $('#status_filter').on('change', function() { var status=$(this).val(); table.column(6).search(status).draw(); }); // Panggil fungsi updateCetakLink setiap kali filter berubah $('#start_date, #end_date, #status_filter').on('change', function() { updateCetakLink(); table.draw(); }); updateCetakLink(); });
</script>


@endsection