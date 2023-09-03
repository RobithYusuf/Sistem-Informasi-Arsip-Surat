@extends('layouts.mastertabel')
@section('title','Tambah Klasifikasi Arsip')
@section('content')

<div class="pagetitle">
    <h1>Form Tambah Klasifikasi Arsip</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Klasifikasi Arsip</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Klasifikasi Arsip</h5>
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

                    <form action="{{ route($currentRoutePrefix . '.klasifikasi-arsip.store')  }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="nomor_klasifikasi" class="col-sm-2 col-form-label">Nomor Klasifikasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nomor_klasifikasi" id="nomor_klasifikasi" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama_klasifikasi" class="col-sm-2 col-form-label">Nama Klasifikasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_klasifikasi" id="nama_klasifikasi" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="daftar_arsip_id" class="col-sm-2 col-form-label">Nama Daftar</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="daftar_arsip_id" id="daftar_arsip_id" required>
                                    <option value="">-- Pilih Daftar Arsip --</option>
                                    @foreach($daftarArsips as $arsip)
                                    <option value="{{ $arsip->id_daftar_arsip }}">{{ $arsip->nama_daftar }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="row mb-3 mb-3-start" style="margin-top: 45px!important;">
                            <div class="col-md-12 d-flex justify-content-start">
                                <a href="{{ route($currentRoutePrefix . '.klasifikasi-arsip.index')  }}" class="btn btn-secondary me-2 btn-sm">Kembali</a>
                                <button type="submit" class="btn btn-primary btn-sm">Tambah Klasifikasi Arsip</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection
