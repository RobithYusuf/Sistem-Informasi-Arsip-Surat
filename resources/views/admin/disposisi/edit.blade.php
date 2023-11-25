@extends('layouts.mastertabel')
@section('title','Edit Disposisi')
@section('content')

<div class="pagetitle">
    <h1>Form Edit Disposisi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route(auth()->user()->role->role . '.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Disposisi</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Disposisi</h5>

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
                            <label for="nomor_surat" class="col-sm-3 col-form-label">Nomor Surat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nomor_surat" value="{{ $arsip->nomor_surat }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="jumlah" value="{{ $arsip->jumlah }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="dari" class="col-sm-3 col-form-label">Dari</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="dari" value="{{ $arsip->dari }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Kepada</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="kepada" aria-label="Default select example">
                                    <option value="" disabled>-- Pilih Penerima --</option>
                                    <option value="Kep. Subbagian Tata Usaha" {{ $arsip->kepada == 'Kep. Subbagian Tata Usaha' ? 'selected' : '' }}>Kep. Subbagian Tata Usaha</option>
                                    <option value="Kep. Pusat Penelitian, Pengabdian & Penjamin Mutu" {{ $arsip->kepada == 'Kep. Pusat Penelitian, Pengabdian & Penjamin Mutu' ? 'selected' : '' }}>Kep. Pusat Penelitian, Pengabdian & Penjamin Mutu</option>
                                    <option value="Kor. Prodi Karawitan" {{ $arsip->kepada == 'Kor. Prodi Karawitan' ? 'selected' : '' }}>Kor. Prodi Karawitan</option>
                                    <option value="Kor. Prodi Seni Kriya" {{ $arsip->kepada == 'Kor. Prodi Seni Kriya' ? 'selected' : '' }}>Kor. Prodi Seni Kriya</option>
                                    <option value="Kor. Prodi Seni Tari" {{ $arsip->kepada == 'Kor. Prodi Seni Tari' ? 'selected' : '' }}>Kor. Prodi Seni Tari</option>
                                    <option value="Staff AKN Seni & Budaya Yogyakarta" {{ $arsip->kepada == 'Staff AKN Seni & Budaya Yogyakarta' ? 'selected' : '' }}>Staff AKN Seni dan Budaya Yogyakarta</option>
                                    <!-- Tambahkan opsi lain yang relevan -->
                                </select>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Sifat Disposisi</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="sifat" aria-label="Default select example">
                                    <option value="" disabled>-- Pilih Sifat Disposisi --</option>
                                    <option value="rahasia" {{ (old('sifat', $arsip->sifat) == 'rahasia') ? 'selected' : '' }}>Rahasia</option>
                                    <option value="biasa" {{ (old('sifat', $arsip->sifat) == 'biasa') ? 'selected' : '' }}>Biasa</option>
                                    <option value="segera" {{ (old('sifat', $arsip->sifat) == 'segera') ? 'selected' : '' }}>Segera</option>
                                    <option value="sangat segera" {{ (old('sifat', $arsip->sifat) == 'sangat segera') ? 'selected' : '' }}>Sangat Segera</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jenis_arsip" class="col-sm-3 col-form-label">Jenis Disposisi</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="jenis_arsip" id="jenis_arsip">
                                    @php
                                    $jenisDisposisiOptions = ['masuk', 'keluar'];
                                    @endphp

                                    @foreach($jenisDisposisiOptions as $jenis)
                                    <option value="{{ $jenis }}" {{ $arsip->jenis_arsip == $jenis ? 'selected' : '' }}>{{ ucfirst($jenis) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Keamanan Disposisi</label>
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
                            <label for="tanggal_arsip" class="col-sm-3 col-form-label">Tanggal Disposisi</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tanggal_arsip" value="{{ $arsip->tanggal_arsip }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status_arsip" class="col-sm-3 col-form-label">Status Disposisi</label>
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
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lokasi Disposisi</h5>

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
                        <label for="rak_id" class="col-sm-4 col-form-label">Rak Disposisi</label>
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
                        <label for="folder_id" class="col-sm-4 col-form-label">Folder Disposisi</label>
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
                    <h5 class="card-title">Klasifikasi Disposisi</h5>

                    <div class="row mb-3">
                        <label for="klasifikasi_id" class="col-sm-4 col-form-label">Klasifikasi Disposisi</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="klasifikasi_id" id="klasifikasi_id" required>
                                <option value="">-- Pilih Klasifikasi Disposisi --</option>
                                @foreach($klasifikasiDisposisis as $klasifikasi)
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
                    <button type="submit" class="btn btn-primary">Update Disposisi</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</section>

@endsection
