@extends('layouts.mastertabel')
@section('title','Edit Arsip')
@section('content')
<style>
    .required::after {
        content: '*';
        color: red;
        padding-left: 5px;
        /* Atur sesuai kebutuhan */
    }
</style>
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
        <div class="col-lg-7">
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
                            <label for="nomor_surat" class="col-sm-3 required col-form-label">Nomor Surat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nomor_surat" value="{{ $arsip->nomor_surat }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="hal" class="col-sm-3 required col-form-label">Hal</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="hal" value="{{ $arsip->hal }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jumlah" class="col-sm-3 required col-form-label">Jumlah</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="jumlah" value="{{ $arsip->jumlah }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="dari" class="col-sm-3 required col-form-label">Dari</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="dari" value="{{ $arsip->dari }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="kepada" class="col-sm-3 required required col-form-label">Kepada</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="kepada" name="kepada[]" multiple>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ in_array($user->id, $selectedUsers) ? 'selected' : '' }}>{{ $user->nama }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted"> Tahan tombol <b>CTRL</b> untuk memilih lebih dari 1 [Multi Select].</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 required col-form-label">Sifat Arsip</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="sifat" aria-label="Default select example">
                                    <option value="" disabled>-- Pilih Sifat Arsip --</option>
                                    <option value="rahasia" {{ (old('sifat', $arsip->sifat) == 'rahasia') ? 'selected' : '' }}>Rahasia</option>
                                    <option value="biasa" {{ (old('sifat', $arsip->sifat) == 'biasa') ? 'selected' : '' }}>Biasa</option>
                                    <option value="segera" {{ (old('sifat', $arsip->sifat) == 'segera') ? 'selected' : '' }}>Segera</option>
                                    <option value="sangat segera" {{ (old('sifat', $arsip->sifat) == 'sangat segera') ? 'selected' : '' }}>Sangat Segera</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jenis_arsip" class="col-sm-3 required col-form-label">Jenis Arsip</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="jenis_arsip" id="jenis_arsip">
                                    @php
                                    $jenisArsipOptions = ['masuk', 'keluar'];
                                    @endphp

                                    @foreach($jenisArsipOptions as $jenis)
                                    <option value="{{ $jenis }}" {{ $arsip->jenis_arsip == $jenis ? 'selected' : '' }}>{{ ucfirst($jenis) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label class="col-sm-3 required col-form-label">Keamanan Arsip</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="keamanan_arsip">
                                    <option value="asli" {{ $arsip->keamanan_arsip == 'asli' ? 'selected' : '' }}>Asli</option>
                                    <option value="fotocopy" {{ $arsip->keamanan_arsip == 'fotocopy' ? 'selected' : '' }}>Fotocopy</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lampiran" class="col-sm-3 col-form-label">Lampiran</label>
                            <div class="col-sm-9">
                                @if($arsip->lampiran)
                                <p>Lampiran Saat ini: <a href="{{ asset('storage/lampiran/' . $arsip->lampiran) }}" target="_blank">Lihat lampiran</a></p>
                                @endif
                                <input type="file" class="form-control" name="lampiran">
                                <small class="text-muted">Kosongkan jika tidak ingin mengganti lampiran</small>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" style="height: 100px" name="keterangan" required>{{ $arsip->keterangan }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal_arsip" class="col-sm-3 required col-form-label">Tanggal Arsip</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tanggal_arsip" value="{{ $arsip->tanggal_arsip }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status_arsip" class="col-sm-3 required col-form-label">Status Arsip</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="status_arsip" id="status_arsip">
                                    @php
                                    $statusOptions = ['diproses', 'selesai', 'meragukan', 'palsu', 'disposisi'];
                                    @endphp

                                    @foreach($statusOptions as $status)
                                    <option value="{{ $status }}" {{ $arsip->status_arsip == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                </div>
            </div>
        </div>

        <!-- Ini adalah bagian col-4 untuk form lokasi -->
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lokasi Arsip</h5>

                    <div class="row mb-3">
                        <label for="lemari_id" class="col-sm-4 required col-form-label">Lemari</label>
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
                        <label for="rak_id" class="col-sm-4 required col-form-label">Rak Arsip</label>
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
                        <label for="folder_id" class="col-sm-4 required col-form-label">Folder Arsip</label>
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
                        <label for="klasifikasi_id" class="col-sm-4 required col-form-label">Klasifikasi Arsip</label>
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
