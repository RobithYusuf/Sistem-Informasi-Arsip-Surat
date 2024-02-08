@extends('layouts.mastertabel')
@section('title','Edit Klasifikasi Arsip')
@section('content')

<style>
    .custom-border {
        border: 0.5px solid #dfe3e8 !important;
    }
</style>
<div class="pagetitle">
    <h1>Form Edit Klasifikasi Arsip</h1>
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
                    <h5 class="card-title">Edit Klasifikasi Arsip</h5>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route($currentRoutePrefix . '.klasifikasi-arsip.update', $klasifikasiArsip->id_klasifikasi_arsip) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="inputNext" class="col-sm-3 col-form-label">Nomor Klasifikasi </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="nomor_klasifikasi" value="{{ $klasifikasiArsip->nomor_klasifikasi }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Nama Klasifikasi </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama_klasifikasi" value="{{ $klasifikasiArsip->nama_klasifikasi }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="daftar_arsip_id" class="col-sm-3 col-form-label">Daftar Arsip</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="daftar_arsip_id" id="daftar_arsip_id" required>
                                    <option value="">-- Pilih Daftar Arsip --</option>
                                    @foreach($arsips as $arsip)
                                    <option value="{{ $arsip->id_daftar_arsip }}" {{ $selectedArsipId == $arsip->id_daftar_arsip ? 'selected' : '' }}>{{ $arsip->nama_daftar }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 mb-3-start" style="margin-top: 30px!important;">
                            <div class="col-md-12 d-flex justify-content-start">
                                <a href="{{ route($currentRoutePrefix . '.klasifikasi-arsip.index')  }}" class="btn btn-secondary me-2">Kembali</a>
                                <button type="submit" class="btn btn-primary">Update Daftar Arsip</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
