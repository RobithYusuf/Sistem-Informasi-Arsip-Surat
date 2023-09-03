@extends('layouts.mastertabel')
@section('title','Tambah Folder')
@section('content')

<div class="pagetitle">
    <h1>Form Tambah Folder</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route(auth()->user()->role->role . '.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Folder</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Folder</h5>
                    <!-- ... -->

                    <form action="{{ route($currentRoutePrefix . '.data-folder.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Nomor Folder</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="folder">
                            </div>
                        </div>

                        <!-- Anda bisa menambahkan form untuk atribut lainnya di sini -->

                        <div class="row mb-3 mb-3-start" style="margin-top: 30px!important;">
                            <div class="col-md-12 d-flex justify-content-start">
                                <a href="{{ route($currentRoutePrefix . '.data-folder.index') }}" class="btn btn-secondary me-2  btn-sm">Kembali</a>
                                <button type="submit" class="btn btn-primary  btn-sm">Tambah Folder</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection