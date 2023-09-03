@extends('layouts.mastertabel')
@section('title','Tambah Daftar Arsip')
@section('content')

<div class="pagetitle">
    <h1>Form Tambah Daftar Arsip</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Daftar Arsip</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Daftar Arsip</h5>
                    <!-- ... -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route($currentRoutePrefix . '.daftar-arsip.store')  }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Nama Daftar</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_daftar">
                            </div>
                        </div>

                        <div class="row mb-3 mb-3-start" style="margin-top: 30px!important;">
                            <div class="col-md-12 d-flex justify-content-start">
                                <a href="{{ route($currentRoutePrefix . '.daftar-arsip.index')  }}" class="btn btn-secondary me-2  btn-sm">Kembali</a>
                                <button type="submit" class="btn btn-primary  btn-sm">Tambah Daftar Arsip</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
