@extends('layouts.mastertabel')
@section('title','Edit Users')
@section('content')

<style>
    .custom-border {
        border: 0.5px solid #dfe3e8 !important;
    }
</style>
<div class="pagetitle">
    <h1>Form Edit Users</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route(auth()->user()->role->role . '.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Users</h5>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route($currentRoutePrefix . '.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Metode HTTP untuk update -->

                        <div class="row">
                            <!-- Baris Pertama -->
                            <div class="col-md-6">
                                <!-- Kolom Kiri -->
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingNama" name="nama" placeholder="Masukan Nama" required value="{{ $user->nama }}">
                                        <label for="floatingNama">Nama</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingUsername" name="username" placeholder="Masukan Username" required value="{{ $user->username }}">
                                        <label for="floatingUsername">Username</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Kolom Kanan -->
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <!-- Password biasanya tidak diisi secara otomatis untuk alasan keamanan -->
                                        <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Masukan Password">
                                        <label for="floatingPassword">Password</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingRole" name="role_id" aria-label="Floating label select example" required>
                                            <option value="">-- Pilih Role --</option>
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id_role }}" {{ $user->role_id == $role->id_role ? 'selected' : '' }}>{{ $role->role }}</option>
                                            @endforeach
                                        </select>
                                        <label for="floatingRole">Role</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="row mb-3">
                            <div class="col-md-12 d-flex justify-content-end">
                                <a href="{{ route($currentRoutePrefix . '.users.index') }}" class="btn btn-secondary me-2 btn-xl">Kembali</a>
                                <button type="submit" class="btn btn-primary btn-sm">Update Users</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection