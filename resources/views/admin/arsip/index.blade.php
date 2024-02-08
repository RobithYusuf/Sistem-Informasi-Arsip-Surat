@extends('layouts.mastertabel')
@section('title','Tabel Arsip')
@section('content')
<style>
    .custom-table th {
        font-size: 0.8rem;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 160px;
    }

    .custom-table td {
        font-size: 0.8rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px;
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

    .custom-close {
        font-size: 1.5rem;
        color: #000;
        border: none;
        background: transparent;
        opacity: 1;
    }

    .custom-close:hover {
        color: #0056b3;
        background: transparent;
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

                    @if(getCurrentRoutePrefix() == 'direktur' || getCurrentRoutePrefix() == 'user')
                    <br>
                    @endif


                    @if(!auth()->user()->hasRole('direktur') && !auth()->user()->hasRole('user'))
                    <!-- Tombol untuk memicu modal -->
                    <div class="mb-3 d-flex justify-content-start">
                        <button type="button" class="btn btn-primary btn-xl" data-toggle="modal" data-target="#jenisArsipModal" style="margin-top: 25px;">
                            Tambah Arsip
                        </button>
                    </div>
                    @endif

                    <!-- Table with stripped rows -->
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
                    @if (session('success') || session('info') || session('error'))
                    <div class="alert
                            {{ session('success') ? 'alert-success' : '' }}
                            {{ session('info') ? 'alert-info' : '' }}
                            {{ session('error') ? 'alert-danger' : '' }}">
                        {{ session('success') ?? session('info') ?? session('error') }}
                    </div>
                    @endif

                    <div class="tab-content">
                        <div class="tab-pane active" id="semua">
                            <div class="table-responsive">
                                <table id="datatable-table-semua" class=" table table-bordered table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">#</th>
                                            <th rowspan="2">Nomor Surat</th>
                                            <th rowspan="2">Hal</th>
                                            <th rowspan="2">Dari</th>
                                            <th rowspan="2" class="kepada-column">Kepada</th>
                                            <th rowspan="2">Sifat</th>
                                            <th rowspan="2">Jumlah</th>
                                            <th rowspan="2" class="text-center">Jenis Arsip</th>
                                            <th rowspan="2">Keamanan Arsip</th>
                                            <th rowspan="2">Lampiran</th>
                                            <th rowspan="2">Keterangan</th>
                                            <th rowspan="2">Tanggal Arsip</th>
                                            <th rowspan="2">Klasifikasi</th>
                                            <th rowspan="2">Keterangan Disposisi</th>
                                            <th colspan="3" class="text-center">Lokasi</th>
                                            <th rowspan="2" class="text-center">Status Arsip</th>
                                            @if(getCurrentRoutePrefix() !== 'direktur')
                                            <th rowspan="2" class="text-center">Aksi</th>
                                            @endif

                                        </tr>
                                        <tr>
                                            <th>Lemari</th>
                                            <th>Rak</th>
                                            <th>Folder</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($arsips as $index => $arsip)
                                        @php
                                        $isEmpty = $arsip->users->every(fn($u) => is_null($u->pivot->disposisi_keterangan));
                                        @endphp
                                        <tr>
                                            <td>{{ $loop ->iteration }}</td>
                                            <td>{{ $arsip->nomor_surat }}</td>
                                            <td>{{ $arsip->hal ?? "-" }} </td>

                                            <!-- dibalik apabila jenis arsip = keluar -->
                                            @if($arsip->jenis_arsip == 'keluar')
                                            <td>
                                                @foreach ($arsip->users as $user)
                                                {{ $user->nama }}<br>
                                                @endforeach
                                            </td>
                                            <td>{{ $arsip->dari }}</td>
                                            @else
                                            <td>{{ $arsip->dari }}</td>
                                            <td>
                                                @foreach ($arsip->users as $user)
                                                {{ $user->nama }}<br>
                                                @endforeach
                                            </td>
                                            @endif

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
                                            <td>{{ $arsip->keterangan ?? "-" }}</td>
                                            <td>{{ $arsip->tanggal_arsip }}</td>
                                            <td>{{ $arsip->klasifikasi->nomor_klasifikasi }} - {{ $arsip->klasifikasi->daftarArsip->nama_daftar }}</td>
                                            <td class="{{ $isEmpty ? 'text-center' : '' }}">
                                                @if (!$isEmpty)
                                                @foreach ($arsip->users as $user)
                                                @if ($user->pivot->disposisi_keterangan)
                                                <span class="text-truncate" style="max-width: 130px; display: inline-block;">
                                                    {{ $user->pivot->disposisi_keterangan }}
                                                </span>
                                                @endif
                                                @endforeach

                                                <a href="#" class="view-detail" data-toggle="modal" data-target="#detailModal" data-keterangan="{{ json_encode($arsip->users->map(fn($u) => ['keterangan' => $u->pivot->disposisi_keterangan, 'nama' => $u->nama])) }}">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                @else
                                                <span>-</span>
                                                @endif
                                            </td>

                                            <td class="text-center">{{ $arsip->lemari->lemari }}</td> <!-- Kolom Lemari -->
                                            <td class="text-center">{{ $arsip->rak->rak }}</td> <!-- Kolom Rak -->
                                            <td class="text-center">{{ $arsip->folder->folder }}</td> <!-- Kolom Folder -->
                                            <!-- <td>{{ $arsip->updated_at }}</td> -->
                                            <td class="text-center">
                                                @if(auth()->user()->hasRole('user'))
                                                @foreach ($arsip->users as $user)
                                                @if($user->id == auth()->id())
                                                <span class="badge {{ $user->pivot->status == 'diterima' ? 'bg-success' : ($user->pivot->status == 'disposisi' ? 'bg-danger' : 'bg-secondary') }}">
                                                    {{ strtoupper($user->pivot->status) }}
                                                </span>
                                                @endif
                                                @endforeach
                                                @else
                                                @switch($arsip->status_arsip)
                                                @case('diproses')
                                                <span class="badge bg-primary">{{ strtoupper($arsip->status_arsip) }}</span>
                                                @break
                                                @case('selesai')
                                                <span class="badge bg-success">{{ strtoupper($arsip->status_arsip) }}</span>
                                                @break
                                                @case('palsu')
                                                <span class="badge bg-danger">{{ strtoupper($arsip->status_arsip) }}</span>
                                                @break
                                                @case('meragukan')
                                                <span class="badge bg-warning">{{ strtoupper($arsip->status_arsip) }}</span>
                                                @break
                                                @case('disposisi')
                                                <span class="badge bg-info">{{ strtoupper($arsip->status_arsip) }}</span>
                                                @break
                                                @endswitch
                                                @endif
                                            </td>

                                            @if(!auth()->user()->hasRole('direktur'))
                                            <td>
                                                @if(auth()->user()->hasRole('user'))
                                                <!-- Tombol Terima untuk Role User -->
                                                <a href="{{ route($currentRoutePrefix . '.arsip.accept', $arsip->id_arsip) }}" class="btn btn-sm btn-success" onclick="return confirm('Konfirmasi untuk menerima arsip ini?')">Terima</a>

                                                <!-- Tombol Disposisi untuk Role User -->
                                                <a href="{{ route($currentRoutePrefix . '.arsip.decline', $arsip->id_arsip) }}" class="btn btn-sm btn-warning disposisi-btn">Disposisi</a>

                                                @else
                                                <!-- Tombol Edit untuk Non-User dan Non-Direktur -->
                                                <a href="{{ route($currentRoutePrefix . '.arsip.edit', $arsip->id_arsip) }}" class="btn btn-sm btn-primary">Edit</a>

                                                <!-- Tombol Delete untuk Non-User dan Non-Direktur -->
                                                <form action="{{ route($currentRoutePrefix . '.arsip.destroy', $arsip->id_arsip) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</button>
                                                </form>
                                                @endif
                                            </td>
                                            @endif

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="19" class="text-center">Data Kosong</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- masuk -->

                        <div class="tab-pane" id="masuk">
                            <div class="table-responsive">
                                <table id="datatable-table-masuk" class="table table-bordered table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">#</th>
                                            <th rowspan="2">Nomor Surat</th>
                                            <th rowspan="2">Hal</th>
                                            <th rowspan="2">Dari</th>
                                            <th rowspan="2">Kepada</th>
                                            <th rowspan="2">Sifat</th>
                                            <th rowspan="2">Jumlah</th>
                                            <th rowspan="2" class="text-center">Jenis Arsip</th>
                                            <th rowspan="2">Keamanan Arsip</th>
                                            <th rowspan="2">Lampiran</th>
                                            <th rowspan="2">Keterangan</th>
                                            <th rowspan="2">Tanggal Arsip</th>
                                            <th rowspan="2">Klasifikasi</th>
                                            <th rowspan="2">Keterangan Disposisi</th>
                                            <th colspan="3" class="text-center">Lokasi</th>
                                            <th rowspan="2" class="text-center">Status Arsip</th>
                                            @if(getCurrentRoutePrefix() !== 'direktur')
                                            <th rowspan="2" class="text-center">Aksi</th>
                                            @endif

                                        </tr>
                                        <tr>
                                            <th>Lemari</th>
                                            <th>Rak</th>
                                            <th>Folder</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($arsipsMasuk as $index => $arsip)
                                        @php
                                        $isEmpty = $arsip->users->every(fn($u) => is_null($u->pivot->disposisi_keterangan));
                                        @endphp
                                        <tr>
                                            <td>{{ $loop ->iteration }}</td>
                                            <td>{{ $arsip->nomor_surat }}</td>
                                            <td>{{ $arsip->hal ?? "-" }} </td>
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
                                            <td>{{ $arsip->keterangan ?? "-" }}</td>
                                            <td>{{ $arsip->tanggal_arsip }}</td>
                                            <td>{{ $arsip->klasifikasi->nomor_klasifikasi }} - {{ $arsip->klasifikasi->daftarArsip->nama_daftar }}</td>
                                            <td class="{{ $isEmpty ? 'text-center' : '' }}">
                                                @if (!$isEmpty)
                                                @foreach ($arsip->users as $user)
                                                @if ($user->pivot->disposisi_keterangan)
                                                <span class="text-truncate" style="max-width: 130px; display: inline-block;">
                                                    {{ $user->pivot->disposisi_keterangan }}
                                                </span>
                                                @endif
                                                @endforeach

                                                <a href="#" class="view-detail" data-toggle="modal" data-target="#detailModal" data-keterangan="{{ json_encode($arsip->users->map(fn($u) => ['keterangan' => $u->pivot->disposisi_keterangan, 'nama' => $u->nama])) }}">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                @else
                                                <span>-</span>
                                                @endif
                                            </td>

                                            <td class="text-center">{{ $arsip->lemari->lemari }}</td> <!-- Kolom Lemari -->
                                            <td class="text-center">{{ $arsip->rak->rak }}</td> <!-- Kolom Rak -->
                                            <td class="text-center">{{ $arsip->folder->folder }}</td> <!-- Kolom Folder -->
                                            <td class="text-center">
                                                @if(auth()->user()->hasRole('user'))
                                                @foreach ($arsip->users as $user)
                                                @if($user->id == auth()->id())
                                                <span class="badge {{ $user->pivot->status == 'diterima' ? 'bg-success' : ($user->pivot->status == 'disposisi' ? 'bg-danger' : 'bg-secondary') }}">
                                                    {{ strtoupper($user->pivot->status) }}
                                                </span>
                                                @endif
                                                @endforeach
                                                @else
                                                @switch($arsip->status_arsip)
                                                @case('diproses')
                                                <span class="badge bg-primary">{{ strtoupper($arsip->status_arsip) }}</span>
                                                @break
                                                @case('selesai')
                                                <span class="badge bg-success">{{ strtoupper($arsip->status_arsip) }}</span>
                                                @break
                                                @case('palsu')
                                                <span class="badge bg-danger">{{ strtoupper($arsip->status_arsip) }}</span>
                                                @break
                                                @case('meragukan')
                                                <span class="badge bg-warning">{{ strtoupper($arsip->status_arsip) }}</span>
                                                @break
                                                @case('disposisi')
                                                <span class="badge bg-info">{{ strtoupper($arsip->status_arsip) }}</span>
                                                @break
                                                @endswitch
                                                @endif
                                            </td>

                                            @if(!auth()->user()->hasRole('direktur'))
                                            <td>@if(auth()->user()->hasRole('user'))
                                                <!-- Tombol Terima untuk Role User -->
                                                <a href="{{ route($currentRoutePrefix . '.arsip.accept', $arsip->id_arsip) }}" class="btn btn-sm btn-success" onclick="return confirm('Konfirmasi untuk menerima arsip ini?')">Terima</a>

                                                <!-- Tombol Disposisi untuk Role User -->
                                                <a href="{{ route($currentRoutePrefix . '.arsip.decline', $arsip->id_arsip) }}" class="btn btn-sm btn-warning disposisi-btn">Disposisi</a>

                                                @else
                                                <!-- Tombol Edit untuk Non-User dan Non-Direktur -->
                                                <a href="{{ route($currentRoutePrefix . '.arsip.edit', $arsip->id_arsip) }}" class="btn btn-sm btn-primary">Edit</a>

                                                <!-- Tombol Delete untuk Non-User dan Non-Direktur -->
                                                <form action="{{ route($currentRoutePrefix . '.arsip.destroy', $arsip->id_arsip) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</button>
                                                </form>
                                                @endif
                                            </td>@endif
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="19" class="text-center">Data Kosong</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Arsip Keluar -->
                        <div class="tab-pane" id="keluar">
                            <div class="table-responsive">
                                <table id="datatable-table-keluar" class="table table-bordered table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">#</th>
                                            <th rowspan="2">Nomor Surat</th>
                                            <th rowspan="2">Hal</th>
                                            <th rowspan="2">Dari</th>
                                            <th rowspan="2">Kepada</th>
                                            <th rowspan="2">Sifat</th>
                                            <th rowspan="2">Jumlah</th>
                                            <th rowspan="2" class="text-center">Jenis Arsip</th>
                                            <th rowspan="2">Keamanan Arsip</th>
                                            <th rowspan="2">Lampiran</th>
                                            <th rowspan="2">Keterangan</th>
                                            <th rowspan="2">Tanggal Arsip</th>
                                            <th rowspan="2">Klasifikasi</th>
                                            <th rowspan="2">Keterangan Disposisi</th>
                                            <th colspan="3" class="text-center">Lokasi</th>
                                            <th rowspan="2" class="text-center">Status Arsip</th>
                                            @if(getCurrentRoutePrefix() !== 'direktur')
                                            <th rowspan="2" class="text-center">Aksi</th>
                                            @endif

                                        </tr>
                                        <tr>
                                            <th>Lemari</th>
                                            <th>Rak</th>
                                            <th>Folder</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($arsipsKeluar as $index => $arsip)
                                        @php
                                        $isEmpty = $arsip->users->every(fn($u) => is_null($u->pivot->disposisi_keterangan));
                                        @endphp
                                        <tr>
                                            <td>{{ $loop ->iteration }}</td>
                                            <td>{{ $arsip->nomor_surat }}</td>
                                            <td>{{ $arsip->hal ?? "-" }} </td>
                                            <!-- dibalik apabila jenisarsip = keluar -->
                                            <td>
                                                @foreach ($arsip->users as $user)
                                                {{ $user->nama }}<br>
                                                @endforeach
                                            </td>
                                            <td>{{ $arsip->dari }}</td>
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
                                            <td>{{ $arsip->keterangan  ?? "-" }}</td>
                                            <td>{{ $arsip->tanggal_arsip }}</td>
                                            <td>{{ $arsip->klasifikasi->nomor_klasifikasi }} - {{ $arsip->klasifikasi->daftarArsip->nama_daftar }}</td>
                                            <td class="{{ $isEmpty ? 'text-center' : '' }}">
                                                @if (!$isEmpty)
                                                @foreach ($arsip->users as $user)
                                                @if ($user->pivot->disposisi_keterangan)
                                                <span class="text-truncate" style="max-width: 130px; display: inline-block;">
                                                    {{ $user->pivot->disposisi_keterangan }}
                                                </span>
                                                @endif
                                                @endforeach

                                                <a href="#" class="view-detail" data-toggle="modal" data-target="#detailModal" data-keterangan="{{ json_encode($arsip->users->map(fn($u) => ['keterangan' => $u->pivot->disposisi_keterangan, 'nama' => $u->nama])) }}">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                @else
                                                <span>-</span>
                                                @endif
                                            </td>

                                            <td class="text-center">{{ $arsip->lemari->lemari }}</td> <!-- Kolom Lemari -->
                                            <td class="text-center">{{ $arsip->rak->rak }}</td> <!-- Kolom Rak -->
                                            <td class="text-center">{{ $arsip->folder->folder }}</td> <!-- Kolom Folder -->
                                            <!-- <td>{{ $arsip->updated_at }}</td> -->
                                            <td class="text-center">
                                                @if(auth()->user()->hasRole('user'))
                                                @foreach ($arsip->users as $user)
                                                @if($user->id == auth()->id())
                                                <span class="badge {{ $user->pivot->status == 'diterima' ? 'bg-success' : ($user->pivot->status == 'disposisi' ? 'bg-danger' : 'bg-secondary') }}">
                                                    {{ strtoupper($user->pivot->status) }}
                                                </span>
                                                @endif
                                                @endforeach
                                                @else
                                                @switch($arsip->status_arsip)
                                                @case('diproses')
                                                <span class="badge bg-primary">{{ strtoupper($arsip->status_arsip) }}</span>
                                                @break
                                                @case('selesai')
                                                <span class="badge bg-success">{{ strtoupper($arsip->status_arsip) }}</span>
                                                @break
                                                @case('palsu')
                                                <span class="badge bg-danger">{{ strtoupper($arsip->status_arsip) }}</span>
                                                @break
                                                @case('meragukan')
                                                <span class="badge bg-warning">{{ strtoupper($arsip->status_arsip) }}</span>
                                                @break
                                                @case('disposisi')
                                                <span class="badge bg-info">{{ strtoupper($arsip->status_arsip) }}</span>
                                                @break
                                                @endswitch
                                                @endif
                                            </td>

                                            @if(!auth()->user()->hasRole('direktur'))
                                            <td>
                                                @if(auth()->user()->hasRole('user'))
                                                <!-- Tombol Terima untuk Role User -->
                                                <a href="{{ route($currentRoutePrefix . '.arsip.accept', $arsip->id_arsip) }}" class="btn btn-sm btn-success" onclick="return confirm('Konfirmasi untuk menerima arsip ini?')">Terima</a>

                                                <!-- Tombol Disposisi untuk Role User -->
                                                <a href="{{ route($currentRoutePrefix . '.arsip.decline', $arsip->id_arsip) }}" class="btn btn-sm btn-warning disposisi-btn">Disposisi</a>

                                                @else
                                                <!-- Tombol Edit untuk Non-User dan Non-Direktur -->
                                                <a href="{{ route($currentRoutePrefix . '.arsip.edit', $arsip->id_arsip) }}" class="btn btn-sm btn-primary">Edit</a>

                                                <!-- Tombol Delete untuk Non-User dan Non-Direktur -->
                                                <form action="{{ route($currentRoutePrefix . '.arsip.destroy', $arsip->id_arsip) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</button>
                                                </form>
                                                @endif
                                            </td>
                                            @endif
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="19" class="text-center">Data Kosong</td>
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

<!-- Modal Pemilihan Jenis Arsip -->
<div class="modal fade" id="jenisArsipModal" tabindex="-1" role="dialog" aria-labelledby="jenisArsipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="jenisArsipModalLabel">Pilih Jenis Arsip</h5>
                <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <p class="text-center">Silakan pilih Jenis Arsip yang ingin ditambahkan:</p>
                <div class="d-flex justify-content-around">

                    <a href="{{ route($currentRoutePrefix . '.arsip.create', ['jenis_arsip' => 'masuk']) }}" class="btn btn-success">Arsip Masuk</a>
                    <a href="{{ route($currentRoutePrefix . '.arsip.create', ['jenis_arsip' => 'keluar']) }}" class="btn btn-danger">Arsip Keluar</a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>

            </div>
        </div>
    </div>
</div>


<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Keterangan Disposisi</h5>
                <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Isi detail akan dimuat di sini -->
            </div>
        </div>
    </div>
</div>


@if(auth()->user()->hasRole('user'))
<!-- Modal untuk Input Keterangan Disposisi -->
<div class="modal fade" id="keteranganDisposisiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Keterangan Disposisi</h5>
                <!-- Tombol close dihapus untuk mencegah penutupan modal -->
            </div>
            <form action="{{ route($currentRoutePrefix . '.arsip.decline', $arsip->id_arsip) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <textarea name="keterangan_disposisi" class="form-control" placeholder="Masukkan keterangan disini..." required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Disposisi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif


<script>
    $(document).ready(function() {
        $('#datatable-table-semua').DataTable({
            responsive: true,
            debug: true,
        });
    });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        var target = $(e.target).attr("href"); // ID tab yang diaktifkan

        if (target === '#masuk') {
            if ($.fn.DataTable.isDataTable('#datatable-table-masuk')) {
                $('#datatable-table-masuk').DataTable().destroy();
            }
            $('#datatable-table-masuk').DataTable({
                responsive: true,
                debug: true,
                // Opsi lain...
            });
        }
        if (target === '#keluar') {
            if ($.fn.DataTable.isDataTable('#datatable-table-keluar')) {
                $('#datatable-table-keluar').DataTable().destroy();
            }
            $('#datatable-table-keluar').DataTable({
                responsive: true,
                debug: true,
                // Opsi lain...
            });
        }
    });

    // melihat alasan disposisi (informasi keterangan dari user ketika berhalangan)
    $(document).ready(function() {
        $('.view-detail').click(function() {
            var items = $(this).data('keterangan');
            var modalBody = '';

            if (items.length) {
                items.forEach(function(item) {
                    if (item.keterangan) {
                        modalBody += '<p>' + '<b>' + item.nama + '</b>: ' + item.keterangan + '</p>';
                    } else {
                        modalBody += '<p>Informasi tidak tersedia atau kosong</p>';
                    }
                });
            } else {
                modalBody = '<p>Tidak ada keterangan tambahan.</p>';
            }

            $('#detailModal .modal-body').html(modalBody);
        });
    });


    //modal decline konfirmasi
    document.addEventListener('DOMContentLoaded', function() {
        var disposisiButtons = document.querySelectorAll('.disposisi-btn');
        disposisiButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var url = this.getAttribute('href');

                if (confirm('Disposisi kembali arsip ini?')) {
                    $('#keteranganDisposisiModal form').attr('action', url);
                    $('#keteranganDisposisiModal').modal('show');
                }
            });
        });
    });
</script>


@endsection
