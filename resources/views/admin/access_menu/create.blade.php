@extends('layouts.mastertabel')
@section('title','Tambah Akses Menu')
@section('content')

<div class="pagetitle">
    <h1>Form Tambah Akses Menu</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route(auth()->user()->role->role . '.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Akses Menu</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Akses Menu</h5>
                    <form action="{{ route('admin.access_menu.store') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="role_id">
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id_role }}">{{ $role->role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Menu</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="menu_id">
                                    @foreach($menus as $menu)
                                    <option value="{{ $menu->id_user_menu }}">{{ $menu->menu }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Anda bisa menambahkan form untuk submenu dan atribut lainnya di sini -->

                        <div class="row mb-3 mb-3-start" style="margin-top: 30px!important;">
                            <div class="col-md-12 d-flex justify-content-start">
                                <a href="{{ route('admin.access_menu.index') }}" class="btn btn-secondary me-2">Kembali</a>
                                <button type="submit" class="btn btn-primary">Tambah Akses Menu</button>
                            </div>
                        </div>

                    </form><!-- End General Form Elements -->

                </div>
            </div>

        </div>
    </div>
</section>

@endsection
