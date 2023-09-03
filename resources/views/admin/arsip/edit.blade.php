@extends('layouts.mastertabel')
@section('title','Edit Arsip')
@section('content')

<div class="pagetitle">
    <h1>Form Edit Arsip</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route(auth()->user()->role->role . '.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Arsip</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Arsip</h5>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route($currentRoutePrefix . '.arsip.update', $arsip->id_arsip)  }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="users_id" value="{{ auth()->id() }}">

                        <div class="row mb-3">
                            <label for="nomor_berkas" class="col-sm-3 col-form-label">Nomor Berkas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nomor_berkas" value="{{ $arsip->nomor_berkas }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="uraian_berkas" class="col-sm-3 col-form-label">Uraian Berkas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="uraian_berkas" value="{{ $arsip->uraian_berkas }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="jumlah" value="{{ $arsip->jumlah }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Keamanan Arsip</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="keamanan_arsip" aria-label="Default select example">
                                    <option value="asli" {{ $arsip->keamanan_arsip == 'asli' ? 'selected' : '' }}>Asli</option>
                                    <option value="tidak asli" {{ $arsip->keamanan_arsip == 'tidak asli' ? 'selected' : '' }}>Tidak Asli</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="uraian_arsip" class="col-sm-3 col-form-label">Uraian Arsip</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="uraian_arsip" value="{{ $arsip->uraian_arsip }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gambar" class="col-sm-3 col-form-label">Gambar</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="gambar">
                                <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" style="height: 100px" name="keterangan" required>{{ $arsip->keterangan }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tanggal" value="{{ $arsip->tanggal }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status_arsip" class="col-sm-3 col-form-label">Status Arsip</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status_arsip" id="status_arsip" required>
                                    <option value="masuk" {{ $arsip->status_arsip == 'masuk' ? 'selected' : '' }}>Masuk</option>
                                    <option value="keluar" {{ $arsip->status_arsip == 'keluar' ? 'selected' : '' }}>Keluar</option>
                                </select>
                            </div>
                        </div>

                </div>
            </div>
        </div>

        <!-- Ini adalah bagian col-4 untuk form lokasi -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lokasi Arsip</h5>

                    <div class="row mb-3">
                        <label for="lemari_id" class="col-sm-4 col-form-label">Lemari</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="lemari_id" id="lemari_id" required>
                                <option value="">-- Pilih Lemari --</option>
                                @foreach($lemaris as $lemari)
                                <option value="{{ $lemari->id_lemari }}" {{ $arsip->lemari_id == $lemari->id_lemari ? 'selected' : '' }}>{{ $lemari->lemari }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="rak_id" class="col-sm-4 col-form-label">Rak Arsip</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="rak_id" id="rak_id" required>
                                <option value="">-- Pilih Rak --</option>
                                @foreach($raks as $rak)
                                <option value="{{ $rak->id_rak }}" {{ $arsip->rak_id == $rak->id_rak ? 'selected' : '' }}>{{ $rak->rak }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="folder_id" class="col-sm-4 col-form-label">Folder Arsip</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="folder_id" id="folder_id" required>
                                <option value="">-- Pilih Folder --</option>
                                @foreach($folders as $folder)
                                <option value="{{ $folder->id_folder }}" {{ $arsip->folder_id == $folder->id_folder ? 'selected' : '' }}>{{ $folder->folder }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Klasifikasi Arsip</h5>

                    <div class="row mb-3">
                        <label for="klasifikasi_id" class="col-sm-4 col-form-label">Klasifikasi Arsip</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="klasifikasi_id" id="klasifikasi_id" required>
                                <option value="">-- Pilih Klasifikasi Arsip --</option>
                                @foreach($klasifikasiArsips as $klasifikasi)
                                <option value="{{ $klasifikasi->id_klasifikasi_arsip }}" {{ $arsip->klasifikasi_id == $klasifikasi->id_klasifikasi_arsip ? 'selected' : '' }}>{{ $klasifikasi->nomor_klasifikasi }} - {{ $klasifikasi->nama_klasifikasi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-lg-12">
            <div class="row mb-3 mb-3-start">
                <div class="col-md-12 d-flex justify-content-start">
                    <a href="{{ route($currentRoutePrefix . '.arsip.index')  }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update Arsip</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</section>

@endsection
