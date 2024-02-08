@extends('layouts.mastertabel')
@section('title','Tabel Lemari')
@section('content')
<div class="pagetitle">
    <h1>Tabel Lemari</h1>
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
                        <a href="{{  route($currentRoutePrefix . '.data-lemari.create') }}" class="btn btn-primary rounded-pill  btn-sm">Tambah Data lemari</a>
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
                                <th scope="col">lemari</th>
                                <th scope="col">Aksi</th> <!-- Tambahkan kolom aksi -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lemaris as $index => $lemari)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $lemari->lemari }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <a href="{{ route($currentRoutePrefix . '.data-lemari.edit', $lemari->id_lemari) }}" class="btn btn-sm btn-primary">Edit</a>

                                    <!-- Tombol Delete -->
                                    <form action="{{ route($currentRoutePrefix . '.data-lemari.destroy', ['data_lemari' => $lemari->id_lemari]) }}" method="POST" class="d-inline">
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
