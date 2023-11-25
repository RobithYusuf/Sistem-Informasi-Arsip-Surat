@extends('layouts.mastertabel')
@section('title','Tambah Users')
@section('content')

<div class="pagetitle">
    <h1>Form Tambah Users</h1>
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
                    <h5 class="card-title">Tambah Users</h5>
                    <!-- ... -->

                    <form action="{{ route($currentRoutePrefix . '.users.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Baris Pertama -->
                            <div class="col-md-6">
                                <!-- Kolom Kiri -->
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingNama" name="nama" placeholder="Masukan Nama" required>
                                        <label for="floatingNama">Nama</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingUsername" name="username" placeholder="Masukan Username" required>
                                        <label for="floatingUsername">Username</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Kolom Kanan -->
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Masukan Password" required>
                                        <label for="floatingPassword">Password</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingRole" name="role_id" aria-label="Floating label select example" required>
                                            <option value="">-- Pilih Role --</option>
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id_role }}">{{ $role->role }}</option>
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
                                <button type="submit" class="btn btn-primary btn-sm">Tambah Users</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>

        </div>
    </div>
</section>

@endsection