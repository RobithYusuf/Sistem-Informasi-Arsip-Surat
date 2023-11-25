@extends('layouts.mastertabel')
@section('title','Tabel Arsip')
@section('content')
<style>
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
</style>

<div class="pagetitle">
    <h1>Tabel Arsip</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route(auth()->user()->role->role . '.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active">Data</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Datatables</h5>
                    <div class="mb-3 d-flex justify-content-start">
                        <a href="{{ route($currentRoutePrefix . '.arsip.create') }}" class="btn btn-primary  btn-xl">Tambah Arsip</a>
                    </div>
                    <!-- Table with stripped rows -->
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif


                    <ul class="nav nav-tabs mb-4">
                        <li class="nav-item">
                            <a class="nav-link active" href="#semua" data-toggle="tab">Semua ({{ $arsips->count() }})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#masuk" data-toggle="tab">Masuk ({{ $arsipsMasuk->count() }})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#keluar" data-toggle="tab">Keluar ({{ $arsipsKeluar->count() }})</a>
                        </li>
                    </ul>
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif


                    <div class="tab-content">
                        <div class="tab-pane active" id="semua">
                            <div class="table-responsive">
                                <table class="table datatable table-bordered table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">#</th>
                                            <th rowspan="2">Nomor Surat</th>
                                            <th rowspan="2">Dari</th>
                                            <th rowspan="2" class="kepada-column">Kepada</th>
                                            <th rowspan="2">Sifat</th>
                                            <th rowspan="2">Jumlah</th>
                                            <th rowspan="2" class="text-center">Jenis Arsip</th> <!-- Ini perbaikannya -->
                                            <th rowspan="2">Keamanan Arsip</th>
                                            <th rowspan="2">Lampiran</th>
                                            <th rowspan="2">Keterangan</th>
                                            <th rowspan="2">Tanggal Arsip</th>
                                            <th rowspan="2">Klasifikasi</th>
                                            <th colspan="3" class="text-center">Lokasi</th>
                                            <th rowspan="2" class="text-center">Status Arsip</th> <!-- Ini perbaikannya -->
                                            <th rowspan="2" class="text-center">Aksi</th> <!-- Ini perbaikannya -->
                                        </tr>
                                        <tr>
                                            <th>Lemari</th>
                                            <th>Rak</th>
                                            <th>Folder</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($arsips as $index => $arsip)
                                        <tr>
                                            <td>{{ $arsip->id_arsip }}</td>
                                            <td>{{ $arsip->nomor_surat }}</td>
                                            <td>{{ $arsip->dari }}</td>
                                            <td>
                                                @foreach ($arsip->users as $user)
                                                {{ $user->nama }}<br>
                                                <!-- @if (!$loop->last),@endif -->
                                                @endforeach
                                            </td>

                                            <td>{{ $arsip->sifat }}</td>
                                            <td>{{ $arsip->jumlah }}</td>
                                            <td class="text-center">
                                                @if($arsip->jenis_arsip == 'masuk')
                                                <span class="badge bg-success">{{ strtoupper($arsip->jenis_arsip) }}</span>
                                                @elseif($arsip->jenis_arsip == 'keluar')
                                                <span class="badge bg-danger">{{ strtoupper($arsip->jenis_arsip) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $arsip->keamanan_arsip }}</td>
                                            <td class="text-center">
                                                <a href="{{ asset('storage/lampiran/' . basename($arsip->lampiran)) }}" target="_blank" class="thumbnail-link">
                                                    <img src="{{ asset('storage/lampiran/' . $arsip->lampiran) }}" alt="lampiran Arsip" width="100" class="img-thumbnail"> <!-- Anda bisa mengatur width sesuai kebutuhan -->
                                            </td>
                                            <td>{{ $arsip->keterangan }}</td>
                                            <td>{{ $arsip->tanggal_arsip }}</td>
                                            <td>{{ $arsip->klasifikasi->nomor_klasifikasi }} - {{ $arsip->klasifikasi->daftarArsip->nama_daftar }}</td>
                                            <td class="text-center">{{ $arsip->lemari->lemari }}</td> <!-- Kolom Lemari -->
                                            <td class="text-center">{{ $arsip->rak->rak }}</td> <!-- Kolom Rak -->
                                            <td class="text-center">{{ $arsip->folder->folder }}</td> <!-- Kolom Folder -->
                                            <!-- <td>{{ $arsip->updated_at }}</td> -->
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

                                            <td>
                                                <!-- Tombol Edit -->
                                                <a href="{{ route($currentRoutePrefix . '.arsip.edit', $arsip->id_arsip)  }}" class="btn btn-sm btn-primary">Edit</a>
                                                <!-- Tombol Delete -->
                                                <form action="{{ route($currentRoutePrefix . '.arsip.destroy', $arsip->id_arsip)  }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="17" class="text-center">Data Kosong</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- masuk -->
                        <div class="tab-pane" id="masuk">
                            <div class="table-responsive">
                                <table class="table datatable table-bordered table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">#</th>
                                            <th rowspan="2">Nomor Surat</th>
                                            <th rowspan="2">Dari</th>
                                            <th rowspan="2">Kepada</th>
                                            <th rowspan="2">Sifat</th>
                                            <th rowspan="2">Jumlah</th>
                                            <th rowspan="2" class="text-center">Jenis Arsip</th> <!-- Ini perbaikannya -->
                                            <th rowspan="2">Keamanan Arsip</th>
                                            <th rowspan="2">Lampiran</th>
                                            <th rowspan="2">Keterangan</th>
                                            <th rowspan="2">Tanggal Arsip</th>
                                            <th rowspan="2">Klasifikasi</th>
                                            <th colspan="3" class="text-center">Lokasi</th>
                                            <th rowspan="2" class="text-center">Status Arsip</th> <!-- Ini perbaikannya -->
                                            <th rowspan="2" class="text-center">Aksi</th> <!-- Ini perbaikannya -->
                                        </tr>
                                        <tr>
                                            <th>Lemari</th>
                                            <th>Rak</th>
                                            <th>Folder</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($arsipsMasuk as $index => $arsip)
                                        <tr>
                                            <td>{{ $arsip->id_arsip }}</td>
                                            <td>{{ $arsip->nomor_surat }}</td>
                                            <td>{{ $arsip->dari }}</td>
                                            <td>
                                                @foreach ($arsip->users as $user)
                                                {{ $user->nama }}<br>
                                                <!-- @if (!$loop->last),@endif -->
                                                @endforeach
                                            </td>

                                            <td>{{ $arsip->sifat }}</td>
                                            <td>{{ $arsip->jumlah }}</td>
                                            <td class="text-center">
                                                @if($arsip->jenis_arsip == 'masuk')
                                                <span class="badge bg-success">{{ strtoupper($arsip->jenis_arsip) }}</span>
                                                @elseif($arsip->jenis_arsip == 'keluar')
                                                <span class="badge bg-danger">{{ strtoupper($arsip->jenis_arsip) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $arsip->keamanan_arsip }}</td>
                                            <td class="text-center">
                                                <a href="{{ asset('storage/lampiran/' . basename($arsip->lampiran)) }}" target="_blank" class="thumbnail-link">
                                                    <img src="{{ asset('storage/lampiran/' . $arsip->lampiran) }}" alt="lampiran Arsip" width="100" class="img-thumbnail"> <!-- Anda bisa mengatur width sesuai kebutuhan -->
                                            </td>
                                            <td>{{ $arsip->keterangan }}</td>
                                            <td>{{ $arsip->tanggal_arsip }}</td>
                                            <td>{{ $arsip->klasifikasi->nomor_klasifikasi }} - {{ $arsip->klasifikasi->daftarArsip->nama_daftar }}</td>
                                            <td class="text-center">{{ $arsip->lemari->lemari }}</td> <!-- Kolom Lemari -->
                                            <td class="text-center">{{ $arsip->rak->rak }}</td> <!-- Kolom Rak -->
                                            <td class="text-center">{{ $arsip->folder->folder }}</td> <!-- Kolom Folder -->
                                            <!-- <td>{{ $arsip->updated_at }}</td> -->
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

                                            <td>
                                                <!-- Tombol Edit -->
                                                <a href="{{ route($currentRoutePrefix . '.arsip.edit', $arsip->id_arsip)  }}" class="btn btn-sm btn-primary">Edit</a>
                                                <!-- Tombol Delete -->
                                                <form action="{{ route($currentRoutePrefix . '.arsip.destroy', $arsip->id_arsip)  }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="17" class="text-center">Data Kosong</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Arsip Keluar -->
                        <div class="tab-pane" id="keluar">
                            <div class="table-responsive">
                                <table class="table datatable table-bordered table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">#</th>
                                            <th rowspan="2">Nomor Surat</th>
                                            <th rowspan="2">Dari</th>
                                            <th rowspan="2">Kepada</th>
                                            <th rowspan="2">Sifat</th>
                                            <th rowspan="2">Jumlah</th>
                                            <th rowspan="2" class="text-center">Jenis Arsip</th> <!-- Ini perbaikannya -->
                                            <th rowspan="2">Keamanan Arsip</th>
                                            <th rowspan="2">Lampiran</th>
                                            <th rowspan="2">Keterangan</th>
                                            <th rowspan="2">Tanggal Arsip</th>
                                            <th rowspan="2">Klasifikasi</th>
                                            <th colspan="3" class="text-center">Lokasi</th>
                                            <th rowspan="2" class="text-center">Status Arsip</th> <!-- Ini perbaikannya -->
                                            <th rowspan="2" class="text-center">Aksi</th> <!-- Ini perbaikannya -->
                                        </tr>
                                        <tr>
                                            <th>Lemari</th>
                                            <th>Rak</th>
                                            <th>Folder</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($arsipsKeluar as $index => $arsip)
                                        <tr>
                                            <td>{{ $arsip->id_arsip }}</td>
                                            <td>{{ $arsip->nomor_surat }}</td>
                                            <td>{{ $arsip->dari }}</td>
                                            <td>
                                                @foreach ($arsip->users as $user)
                                                {{ $user->nama }}<br>
                                                <!-- @if (!$loop->last),@endif -->
                                                @endforeach
                                            </td>
                                            <td>{{ $arsip->sifat }}</td>
                                            <td>{{ $arsip->jumlah }}</td>
                                            <td class="text-center">
                                                @if($arsip->jenis_arsip == 'masuk')
                                                <span class="badge bg-success">{{ strtoupper($arsip->jenis_arsip) }}</span>
                                                @elseif($arsip->jenis_arsip == 'keluar')
                                                <span class="badge bg-danger">{{ strtoupper($arsip->jenis_arsip) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $arsip->keamanan_arsip }}</td>
                                            <td class="text-center">
                                                <a href="{{ asset('storage/lampiran/' . basename($arsip->lampiran)) }}" target="_blank" class="thumbnail-link">
                                                    <img src="{{ asset('storage/lampiran/' . $arsip->lampiran) }}" alt="lampiran Arsip" width="100" class="img-thumbnail"> <!-- Anda bisa mengatur width sesuai kebutuhan -->
                                            </td>
                                            <td>{{ $arsip->keterangan }}</td>
                                            <td>{{ $arsip->tanggal_arsip }}</td>
                                            <td>{{ $arsip->klasifikasi->nomor_klasifikasi }} - {{ $arsip->klasifikasi->daftarArsip->nama_daftar }}</td>
                                            <td class="text-center">{{ $arsip->lemari->lemari }}</td> <!-- Kolom Lemari -->
                                            <td class="text-center">{{ $arsip->rak->rak }}</td> <!-- Kolom Rak -->
                                            <td class="text-center">{{ $arsip->folder->folder }}</td> <!-- Kolom Folder -->
                                            <!-- <td>{{ $arsip->updated_at }}</td> -->
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

                                            <td>
                                                <!-- Tombol Edit -->
                                                <a href="{{ route($currentRoutePrefix . '.arsip.edit', $arsip->id_arsip)  }}" class="btn btn-sm btn-primary">Edit</a>
                                                <!-- Tombol Delete -->
                                                <form action="{{ route($currentRoutePrefix . '.arsip.destroy', $arsip->id_arsip)  }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="17" class="text-center">Data Kosong</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
</script>


@endsection