@extends('layouts.mastertabel')
@section('title','Tabel Disposisi')
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


    .card-body {
        padding: 0 20px 0px 20px;
    }

    .card {
        position: relative;
    }

    .card-title {
        font-size: 1.65rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 1rem;
        color: #3457A7;
    }

    .jumlah-arsip {
        color: #3457A7;
        position: absolute;
        top: 50px;
        right: 55px;
        font-size: 2.3rem;
        font-weight: bold;
    }

    .card-title-top {
        padding: 20px 0 15px 0;
        font-size: 18px;
        font-weight: 500;
        color: #012970;
        font-family: "Poppins", sans-serif;
    }
</style>


<div class="pagetitle">
    <h1>Tabel Disposisi</h1>
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
            <div class="row">
                <div class="col-lg-12 d-flex align-items-center">
                    <div class="card text-white position-relative">
                        <div class="card-body">
                            <h3 class="card-title mb-1">Informasi Disposisi</h3>
                            <p class="card-text">Arsip Perlu Didisposisikan:</p>
                            <div class="jumlah-arsip position-absolute">{{ $jumlahDisposisi }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title-top">Data Disposisi</h5>

                    <div class="mb-3 d-flex justify-content-start">
                        <a href="{{ route($currentRoutePrefix . '.disposisi.create') }}" class="btn btn-primary  btn-xl">Tambah Disposisi</a>
                    </div>
                    <!-- Table with stripped rows -->
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('info'))
                    <div class="alert alert-info">
                        {{ session('info') }}
                    </div>
                    @endif


                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="table-responsive">
                                <table class="table datatable table-bordered table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nomor Surat</th>
                                            <th>Sifat Arsip</th>
                                            <th>Hal</th>
                                            <th>Kepada </th>
                                            <th>Isi</th>
                                            <th>Catatan</th>
                                            <th>Tanggal Disposisi</th>
                                            <th class="text-center">Status Disposisi</th> <!-- Ini perbaikannya -->
                                            <th class="text-center">Aksi</th> <!-- Ini perbaikannya -->
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @forelse($disposisis as $index => $disposisi)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $disposisi->arsip->nomor_surat }}</td>
                                            <td>{{ $disposisi->arsip->sifat }}</td>
                                            <td>{{ $disposisi->hal }}</td>
                                            <td>
                                                @foreach ($disposisi->users as $user)
                                                {{ $user->nama }}<br>
                                                <!-- @if (!$loop->last),@endif -->
                                                @endforeach
                                            </td>
                                            <td>{{ $disposisi->isi }}</td>
                                            <td>{{ $disposisi->catatan }}</td>
                                            <td>{{ $disposisi->tanggal_disposisi ? \Carbon\Carbon::parse($disposisi->tanggal_disposisi)->format('d F Y') : '-' }}</td>

                                            <td class="text-center">
                                                @if($disposisi->status_disposisi == 'diterima')
                                                <span class="badge bg-success">{{ strtoupper($disposisi->status_disposisi) }}</span>
                                                @elseif($disposisi->status_disposisi == 'berhalangan')
                                                <span class="badge bg-danger">{{ strtoupper($disposisi->status_disposisi) }}</span>
                                                @elseif($disposisi->status_disposisi == 'perlu konfirmasi')
                                                <span class="badge bg-secondary">{{ strtoupper($disposisi->status_disposisi) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Tombol Edit -->
                                                <a href="{{ route($currentRoutePrefix . '.disposisi.edit', $disposisi->id_disposisi) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <!-- Tombol Delete -->
                                                <form action="{{ route($currentRoutePrefix . '.disposisi.destroy', $disposisi->id_disposisi) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</button>
                                                </form>
                                            </td>

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center">Data Kosong</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- masuk -->

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>



@endsection
