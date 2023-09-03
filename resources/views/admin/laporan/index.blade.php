@extends('layouts.mastertabel')
@section('title','Tabel Arsip')
@section('content')
<style>
    #status_filter {
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 7px;
        width: 200px;
        font-size: 14px;
        margin-left: 10px;
        background-color: #f8f9fa;
        color: #343a40;
    }

    label.filter-label {
        color: #343a40;
        margin-left: 15px;
        margin-right: 10px;
    }

    label.filter-label.custom {
        color: #343a40;

    }

    .date-filter {
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 5px;
        width: 150px;
        font-size: 14px;
        margin-left: 10px;
        margin-right: 10px;
    }

    .custom-btn {
        padding: 6px 15px;
        font-size: 14px;
        margin-left: 10px;
    }


    /* Responsif untuk layar yang lebih kecil */
    @media (max-width: 768px) {
        #status_filter {
            width: 100%;


            /* Hapus margin kiri untuk layar kecil */
        }

        .date-filter {
            width: 100%;
            margin-bottom: 5px;
        }

        .custom-btn {
            width: 100%;
            margin-top: 10px;
        }
    }

    .custom-table th {
        font-size: 0.8rem;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }

    .custom-table td {
        font-size: 0.8rem;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
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
                    <h5 class="card-title">Laporan Arsip</h5>


                    <div class="card-header py-3 d-flex justify-content-between align-items-center ">
                        <div class="filter-container">
                            <h6 class="filter-label font-weight-bold text-primary" for="status_filter">Filter Cetak Laporan :</h6>
                            <div class="filter-section">

                                <label class="filter-label" for="start_date">Dari Tanggal:</label>
                                <input type="date" id="start_date" name="start_date" class="date-filter">
                                <label class="filter-label custom" for="end_date">s/d</label>
                                <input type="date" id="end_date" name="end_date" class="date-filter">

                                <label class="filter-label custom">Status Arsip:</label>
                                <select id="status_filter">
                                    <option value="">Semua</option>
                                    <option value="masuk">Masuk</option>
                                    <option value="keluar">Keluar</option>
                                </select>
                                <a href="#" id="cetak_laporan" class="btn btn-primary custom-btn">Cetak Laporan</a>
                            </div>
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
                        <table class="table datatable table-bordered table-striped custom-table">
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
                                @foreach($arsips as $index => $arsip)
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
                                        <span class="badge bg-success">{{ strtoupper($arsip->status_arsip) }}</span>
                                        @elseif($arsip->status_arsip == 'keluar')
                                        <span class="badge bg-danger">{{ strtoupper($arsip->status_arsip) }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('.datatable').DataTable({
            responsive: true,
            language: {
                url: 'http://pengarsipan-surat.test/js/dataTables.indonesian.json' // Sesuaikan dengan path Anda
            }
        });
    });
    // Fungsi untuk update link cetak
    function updateCetakLink() {
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        var status = $('#status_filter').val();
        var url = "{{ route($currentRoutePrefix . '.laporan.cetak') }}" + "?start_date=" + startDate + "&end_date=" + endDate + "&status_arsip=" + status;
        $('#cetak_laporan').attr('href', url);
    }

    $(document).ready(function() {
        var table = $('.dataTable').DataTable();
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
                var dateColumn = new Date(data[8]);

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
            table.column(14).search(status).draw();
        });



        // Panggil fungsi updateCetakLink setiap kali filter berubah
        $('#start_date, #end_date, #status_filter').on('change', function() {
            updateCetakLink();
            table.draw();
        });
        updateCetakLink();
    });
</script>


@endsection