@extends('layouts.mastertabel')
@section('title','Edit Rak')
@section('content')

<style>
    .custom-border {
        border: 0.5px solid #dfe3e8 !important;
    }
</style>
<div class="pagetitle">
    <h1>Form Edit Rak</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route(auth()->user()->role->role . '.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Rak</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Rak</h5>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route($currentRoutePrefix .'.data-rak.update', $data_rak)}}" method="POST">

                        @csrf
                        @method('PUT')


                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Nomor Rak</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="rak" value="{{ $data_rak->rak }}">
                            </div>
                        </div>

                        <div class="row mb-3 mb-3-start" style="margin-top: 30px!important;">
                            <div class="col-md-12 d-flex justify-content-start">
                                <a href="{{ route($currentRoutePrefix .'.data-rak.index') }}" class="btn btn-secondary me-2">Kembali</a>
                                <button type="submit" class="btn btn-primary">Update Rak</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
