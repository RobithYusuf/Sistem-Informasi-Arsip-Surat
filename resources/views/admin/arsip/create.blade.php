@extends('layouts.mastertabel')
@section('title','Tambah Arsip')
@section('content')


<div class="pagetitle">
    <h1>Form Tambah Arsip</h1>
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


                    <h5 class="card-title">Tambah Arsip</h5>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <form action="{{ route($currentRoutePrefix . '.arsip.store')  }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="users_id" value="{{ auth()->id() }}">

                        <div class="row mb-3">
                            <label for="nomor_berkas" class="col-sm-3 col-form-label">Nomor Berkas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nomor_berkas" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="uraian_berkas" class="col-sm-3 col-form-label">Uraian Berkas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="uraian_berkas" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="jumlah" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Keamanan Arsip</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="keamanan_arsip" aria-label="Default select example">
                                    <option selected>-- Pilih Keamanan Arsip --</option>
                                    <option value="asli">Asli</option>
                                    <option value="tidak asli">Tidak Asli</option>

                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="uraian_arsip" class="col-sm-3 col-form-label">Uraian Arsip</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="uraian_arsip" required>
                            </div>
                        </div>
                        <!-- ... Anda bisa menambahkan form untuk atribut lainnya di sini ... -->

                        <div class="row mb-3">
                            <label for="gambar" class="col-sm-3 col-form-label">Gambar</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="gambar" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" style="height: 100px" name="keterangan" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tanggal" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="status_arsip" class="col-sm-3 col-form-label">Status Arsip</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status_arsip" id="status_arsip" required>
                                    <option value="">-- Pilih Status Arsip --</option>
                                    <option value="masuk">Masuk</option>
                                    <option value="keluar">Keluar</option>
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
                                <option value="{{ $lemari->id_lemari }}">{{ $lemari->lemari }}</option>
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
                                <option value="{{ $rak->id_rak }}">{{ $rak->rak }}</option>
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
                                <option value="{{ $folder->id_folder }}">{{ $folder->folder }}</option>
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
                                @foreach($klasifikasiArsips as $arsip)
                                <option value="{{ $arsip->id_klasifikasi_arsip }}">{{ $arsip->nomor_klasifikasi }} - {{ $arsip->nama_klasifikasi }}</option>
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
                    <a href="{{ route($currentRoutePrefix . '.arsip.index')  }}" class="btn btn-secondary me-2 ">Kembali</a>
                    <button type="submit" class="btn btn-primary">Tambah Arsip</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</section>

@endsection
