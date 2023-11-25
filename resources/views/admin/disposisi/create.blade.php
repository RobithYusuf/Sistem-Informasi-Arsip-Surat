@extends('layouts.mastertabel')
@section('title','Tambah Disposisi')
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
    <h1>Form Tambah Disposisi</h1>
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">


                    <h5 class="card-title">Tambah Disposisi</h5>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(session('info'))
                    <div class="alert alert-info">
                        {{ session('info') }}
                    </div>
                    @endif


                    <form action="{{ route($currentRoutePrefix . '.disposisi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="arsip_id" class="col-sm-3 required col-form-label">Pilih Arsip</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="arsip_id" required>
                                    @foreach($arsips as $arsip)
                                    <option value="{{ $arsip->id_arsip }}">{{ ucfirst($arsip->nomor_surat) }} ({{ ucfirst($arsip->sifat) }})</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="hal" class="col-sm-3 required col-form-label">Hal</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="hal" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal_disposisi" class="col-sm-3 required col-form-label">Tanggal Disposisi</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tanggal_disposisi" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-3 required for="kepada_baru" >Kepada Baru</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="kepada_baru" name="kepada_baru[]" multiple>
                                    @foreach ($users as $index => $user)
                                    <option value="{{ $user->id }}">{{ $index + 1 }}. {{ $user->nama }}</option>
                                    @endforeach

                                </select>
                                <small class="form-text text-muted"> Tahan tombol <b>CTRL</b> untuk memilih lebih dari 1 [Multi Select].</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="isi" class="col-sm-3 required col-form-label">Isi</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="isi" required>
                                    <option value="">-- Pilih Isi Disposisi --</option>
                                    <option value="untuk diketahui/diperhatikan">Untuk Diketahui/Diperhatikan</option>
                                    <option value="ajukan pendapat/saran">Ajukan Pendapat/Saran</option>
                                    <option value="laksanakan dan laporkan">Laksanakan dan Laporkan</option>
                                    <option value="setuju/acc">Setuju/ACC</option>
                                    <option value="diproses sesuai ketentuan yang berlaku">Diproses Sesuai Ketentuan yang Berlaku</option>
                                    <option value="bicarakan dengan saya">Bicarakan Dengan Saya</option>
                                    <option value="siapkan jawaban/bahan">Siapkan Jawaban/Bahan</option>
                                    <option value="untuk diselesaikan">Untuk Diselesaikan</option>
                                    <option value="ditindaklanjuti">Ditindaklanjuti</option>
                                    <option value="bahas bersama">Bahas Bersama</option>
                                    <option value="adakan pengecekan">Adakan Pengecekan</option>
                                    <option value="acarakan">Acarakan</option>
                                    <option value="tentative">Tentative</option>
                                    <option value="agar mewakili">Agar Mewakili</option>
                                    <option value="ikuti disposisi dirjen">Ikuti Disposisi Dirjen</option>
                                    <option value="mohon dapat mendampingi">Mohon Dapat Mendampingi</option>
                                    <option value="koordinasikan dengan ...">Koordinasikan dengan ...</option>
                                    <option value="gandakan">Gandakan</option>
                                    <option value="edarkan">Edarkan</option>
                                    <option value="file">File</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="catatan" class="col-sm-3 col-form-label">Catatan</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="catatan"></textarea>
                            </div>
                        </div>



                        <div class="row mb-3">
                            <div class="col-sm-9 offset-sm-3">
                                <a href="{{ route($currentRoutePrefix . '.disposisi.index') }}" class="btn btn-secondary me-2 ">Kembali</a>
                                <button type="submit" class="btn btn-primary">Tambah Disposisi</button>
                            </div>
                        </div>

                    </form>

                </div>
</section>

@endsection
