@extends('layouts.mastertabel')
@section('title','Tambah Arsip')
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
        <div class="col-lg-7">
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
                        <div class="row mb-3">
                            <label for="nomor_surat" class="col-sm-3 required col-form-label">Nomor Surat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nomor_surat" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="hal" class="col-sm-3 required col-form-label">Hal</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="hal" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jumlah" class="col-sm-3 required col-form-label">Jumlah</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="jumlah" required>
                            </div>
                        </div>

                        <!-- hidden jenis arsip -->
                        <input type="hidden" name="jenis_arsip" value="{{ $jenis_arsip }}">

                        <!-- Form Dari -->
                        <div id="formElementsWrapper">
                            <div class="row mb-3" id="formDariElement">
                                <label for="formDari" class="col-sm-3 required col-form-label">Dari</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="formDari" name="dari" required>
                                </div>
                            </div>

                            <!-- Form Kepada -->
                            <div class="row mb-4" id="formKepadaElement">
                                <label for="formKepada" class="col-sm-3 required col-form-label">Kepada</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="formKepada" name="kepada[]" multiple>
                                    @foreach ($users as $index => $user)
                                    <option value="{{ $user->id }}">{{ $index + 1 }}. {{ $user->nama }}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">Tahan tombol <b>CTRL</b> untuk memilih lebih dari 1 [Multi Select].</small>
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-3 required col-form-label">Sifat Arsip</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="sifat" aria-label="Default select example">
                                    <option disabled selected>-- Pilih Sifat Arsip --</option>
                                    <option value="rahasia">Rahasia</option>
                                    <option value="biasa">Biasa</option>
                                    <option value="segera">Segera</option>
                                    <option value="sangat segera">Sangat Segera</option>
                                </select>
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label class="col-sm-3 required col-form-label">Keamanan Arsip</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="keamanan_arsip" aria-label="Default select example">
                                    <option disabled selected>-- Pilih Keamanan Arsip --</option>
                                    <option value="asli">Asli</option>
                                    <option value="fotocopy">Fotocopy</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lampiran" class="col-sm-3 required col-form-label">Lampiran</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="lampiran" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" style="height: 100px" name="keterangan"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal_arsip" class="col-sm-3 required col-form-label">Tanggal Arsip</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tanggal_arsip" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status_arsip" class="col-sm-3 required col-form-label">Status Arsip</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="status_arsip" id="status_arsip" required>
                                    <option disabled selected value="">-- Pilih Status Arsip --</option>
                                    <option value="diproses">Diproses</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="palsu">Palsu</option>
                                    <option value="meragukan">Meragukan</option>
                                    <option value="disposisi">Disposisi</option>
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
                                <option disabled selected value="">-- Pilih Lemari --</option>
                                @foreach($lemaris as $lemari)
                                <option value="{{ $lemari->id_lemari }}">{{ $lemari->lemari }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="rak_id" class="col-sm-4 required col-form-label">Rak Arsip</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="rak_id" id="rak_id" required>
                                <option disabled selected value="">-- Pilih Rak --</option>
                                @foreach($raks as $rak)
                                <option value="{{ $rak->id_rak }}">{{ $rak->rak }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="folder_id" class="col-sm-4 required col-form-label">Folder Arsip</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="folder_id" id="folder_id" required>
                                <option disabled selected value="">-- Pilih Folder --</option>
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
                        <label for="klasifikasi_id" class="col-sm-4 required col-form-label">Klasifikasi Arsip</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="klasifikasi_id" id="klasifikasi_id" required>
                                <option disabled selected value="">-- Pilih Klasifikasi Arsip --</option>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    var jenisArsip = "{{ $jenis_arsip }}"; // Ambil jenis arsip dari server

    if (jenisArsip === 'keluar') {
        // Ubah label
        document.querySelector('label[for="formDari"]').textContent = 'Kepada';
        document.querySelector('label[for="formKepada"]').textContent = 'Dari';

        // Tukar name attributes
        var formDari = document.getElementById('formDari');
        var formKepada = document.getElementById('formKepada');

        formDari.name = 'kepada'; // Tetap sebagai string
        formKepada.name = 'dari[]'; // Sebagai array

        // Pindahkan form 'Dari' ke bawah form 'Kepada'
        var formWrapper = document.getElementById('formElementsWrapper');
        formWrapper.appendChild(document.getElementById('formDariElement'));
    }
});

</script>




@endsection
