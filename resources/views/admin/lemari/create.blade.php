@extends('layouts.mastertabel')
@section('title','Tambah lemari')
@section('content')

<div class="pagetitle">
    <h1>Form Tambah lemari</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route(auth()->user()->role->role . '.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">lemari</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah lemari</h5>
                    <!-- ... -->

                    <form action="{{ route($currentRoutePrefix . '.data-lemari.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Nomor lemari</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="lemari">
                            </div>
                        </div>

                        <!-- Anda bisa menambahkan form untuk atribut lainnya di sini -->

                        <div class="row mb-3 mb-3-start" style="margin-top: 30px!important;">
                            <div class="col-md-12 d-flex justify-content-start">
                                <a href="{{ route($currentRoutePrefix . '.data-lemari.index') }}" class="btn btn-secondary me-2  btn-sm">Kembali</a>
                                <button type="submit" class="btn btn-primary  btn-sm">Tambah lemari</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection