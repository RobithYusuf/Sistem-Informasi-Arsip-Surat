@extends('layouts.mastertabel')
@section('title','Tabel Klasifikasi Arsip')
@section('content')
<div class="pagetitle">
    <h1>Tabel Klasifikasi Arsip</h1>
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
                    <h5 class="card-title">Klasifikasi Arsip</h5>
                    <div class="mb-3 d-flex justify-content-start">
                        <a href="{{ route($currentRoutePrefix . '.klasifikasi-arsip.create') }}" class="btn btn-primary rounded-pill  btn-sm">Tambah Klasifikasi Arsip</a>
                    </div>
                    <!-- Table with stripped rows -->
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <table id="datatable-table" class=" table table-bordered table-striped custom-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nomor Klasifikasi</th>
                                <th scope="col">Nama Klasifikasi</th>
                                <th scope="col">Nama Daftar Arsip</th>
                                <th scope="col">Aksi</th> <!-- Tambahkan kolom aksi -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($klasifikasiArsips as $index => $arsip)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $arsip->nomor_klasifikasi }}</td>
                                <td>{{ $arsip->nama_klasifikasi }}</td>
                                <td>{{ $arsip->daftarArsip->nama_daftar }}</td>

                                <td>
                                    <!-- Tombol Edit -->
                                    <a href="{{route($currentRoutePrefix . '.klasifikasi-arsip.edit', $arsip->id_klasifikasi_arsip) }}" class="btn btn-sm btn-primary">Edit</a>

                                    <!-- Tombol Delete -->
                                    <form action="{{route($currentRoutePrefix . '.klasifikasi-arsip.destroy', ['klasifikasi_arsip' => $arsip->id_klasifikasi_arsip]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
