@extends('layouts.mastertabel')
@section('title','Edit Disposisi')
@section('content')

<style>
    .required::after {
        content: '*';
        color: red;
        padding-left: 5px;
        /* Atur sesuai kebutuhan */
    }


    .card-text {
        font-size: 1rem;
        color: #3457A7;
        margin-top: -1rem;
    }
</style>
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Disposisi</h5>
                    <p class="card-text mb-4">Harap hati-hati, Ubah data sesuai kebutuhan!</p>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route($currentRoutePrefix . '.disposisi.update', $disposisi->id_disposisi) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="nomor_surat" class="col-sm-3 required col-form-label">Nomor Surat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nomor_surat" value="{{ $disposisi->arsip->nomor_surat }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal_disposisi" class="col-sm-3 required col-form-label">Tanggal Disposisi</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tanggal_disposisi" value="{{ old('tanggal_disposisi', date('Y-m-d', strtotime($disposisi->tanggal_disposisi))) }}" required>

                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-3 required col-form-label" for="kepada_baru">Kepada Baru</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="kepada_baru" name="kepada_baru[]" multiple>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ in_array($user->id, $disposisi->users->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $user->nama }}</option>
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
                                    @php
                                    $isiDisposisi = old('isi', $disposisi->isi); // Mengambil nilai lama atau nilai dari database
                                    @endphp
                                    <option value="untuk diketahui/diperhatikan" {{ $isiDisposisi == 'untuk diketahui/diperhatikan' ? 'selected' : '' }}>Untuk Diketahui/Diperhatikan</option>
                                    <option value="ajukan pendapat/saran" {{ $isiDisposisi == 'ajukan pendapat/saran' ? 'selected' : '' }}>Ajukan Pendapat/Saran</option>
                                    <option value="laksanakan dan laporkan" {{ $isiDisposisi == 'laksanakan dan laporkan' ? 'selected' : '' }}>Laksanakan dan Laporkan</option>
                                    <option value="setuju/acc" {{ $isiDisposisi == 'setuju/acc' ? 'selected' : '' }}>Setuju/ACC</option>
                                    <option value="diproses sesuai ketentuan yang berlaku" {{ $isiDisposisi == 'diproses sesuai ketentuan yang berlaku' ? 'selected' : '' }}>Diproses Sesuai Ketentuan yang Berlaku</option>
                                    <option value="bicarakan dengan saya" {{ $isiDisposisi == 'bicarakan dengan saya' ? 'selected' : '' }}>Bicarakan Dengan Saya</option>
                                    <option value="siapkan jawaban/bahan" {{ $isiDisposisi == 'siapkan jawaban/bahan' ? 'selected' : '' }}>Siapkan Jawaban/Bahan</option>
                                    <option value="untuk diselesaikan" {{ $isiDisposisi == 'untuk diselesaikan' ? 'selected' : '' }}>Untuk Diselesaikan</option>
                                    <option value="ditindaklanjuti" {{ $isiDisposisi == 'ditindaklanjuti' ? 'selected' : '' }}>Ditindaklanjuti</option>
                                    <option value="bahas bersama" {{ $isiDisposisi == 'bahas bersama' ? 'selected' : '' }}>Bahas Bersama</option>
                                    <option value="adakan pengecekan" {{ $isiDisposisi == 'adakan pengecekan' ? 'selected' : '' }}>Adakan Pengecekan</option>
                                    <option value="acarakan" {{ $isiDisposisi == 'acarakan' ? 'selected' : '' }}>Acarakan</option>
                                    <option value="tentative" {{ $isiDisposisi == 'tentative' ? 'selected' : '' }}>Tentative</option>
                                    <option value="agar mewakili" {{ $isiDisposisi == 'agar mewakili' ? 'selected' : '' }}>Agar Mewakili</option>
                                    <option value="ikuti disposisi dirjen" {{ $isiDisposisi == 'ikuti disposisi dirjen' ? 'selected' : '' }}>Ikuti Disposisi Dirjen</option>
                                    <option value="mohon dapat mendampingi" {{ $isiDisposisi == 'mohon dapat mendampingi' ? 'selected' : '' }}>Mohon Dapat Mendampingi</option>
                                    <option value="koordinasikan dengan ..." {{ $isiDisposisi == 'koordinasikan dengan ...' ? 'selected' : '' }}>Koordinasikan dengan ...</option>
                                    <option value="gandakan" {{ $isiDisposisi == 'gandakan' ? 'selected' : '' }}>Gandakan</option>
                                    <option value="edarkan" {{ $isiDisposisi == 'edarkan' ? 'selected' : '' }}>Edarkan</option>
                                    <option value="file" {{ $isiDisposisi == 'file' ? 'selected' : '' }}>File</option>
                                    <option value="lainya" {{ $isiDisposisi == 'lainya' ? 'selected' : '' }}>Lainya</option>
                                </select>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="catatan" class="col-sm-3 col-form-label">Catatan</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="catatan">{{ $disposisi->catatan }}</textarea>
                            </div>
                        </div>

                        @foreach ($disposisi->users as $user)
                        <div class="row mb-3">
                            <label class="col-sm-3 required col-form-label">Status Disposisi untuk : <br>{{ $user->nama }}</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="status_{{ $user->id }}">
                                    <option value="diterima" {{ $user->pivot->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                    <option value="disposisi" {{ $user->pivot->status == 'disposisi' ? 'selected' : '' }}>Disposisi</option>
                                    <option value="perlu konfirmasi" {{ $user->pivot->status == 'perlu konfirmasi' ? 'selected' : '' }}>Perlu Konfirmasi</option>
                                </select>
                            </div>
                        </div>
                        @endforeach



                        <div class="row mb-3">
                            <div class="col-sm-9 offset-sm-3">
                                <a href="{{ route($currentRoutePrefix . '.disposisi.index') }}" class="btn btn-secondary me-2 ">Kembali</a>
                                <button type="submit" class="btn btn-primary">Update Disposisi</button>
                            </div>
                        </div>
                    </form>

                </div>
</section>

@endsection
