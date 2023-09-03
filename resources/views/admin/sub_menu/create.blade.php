@extends('layouts.mastertabel')
@section('title','Tambah Sub Menu')
@section('content')

<style>
    .custom-border {
        border: 0.5px solid #dfe3e8 !important;

    }
</style>

<div class="pagetitle">
    <h1>Form Tambah Sub Menu</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route(auth()->user()->role->role . '.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Sub Menu</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Sub Menu</h5>

                    <form action="{{ route('admin.sub_menu.store') }}" method="POST">
                        @csrf

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

                        <div class="row">
                            <!-- Kolom pertama -->
                            <div class="col-6">
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">Nama Sub Menu</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="nama_submenu">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">URL</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="url">
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom kedua -->
                            <div class="col-6">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Icon</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker form-control custom-border" name="icon" aria-label="Pilih Icon Sub Menu">
                                            <option value="">Pilih Icon</option>
                                            <option data-content="<i class='bi bi-file-earmark-text'></i> File" value="bi-file-earmark-text">File</option>
                                            <option data-content="<i class='bi bi-funnel'></i> Filter" value="bi bi-funnel">Filter</option>
                                            <option data-content="<i class='bi bi-archive'></i> Archive" value="bi bi-archive">Archive</option>
                                            <option data-content="<i class='bi bi-house-door'></i> Home" value="bi bi-house-door">Home</option>
                                            <option data-content="<i class='bi bi-gear'></i> Settings" value="bi bi-gear">Settings</option>
                                            <option data-content="<i class='bi bi-bell'></i> Notifications" value="bi bi-bell">Notifications</option>
                                            <option data-content="<i class='bi bi-chat-dots'></i> Chat" value="bi bi-chat-dots">Chat</option>
                                            <option data-content="<i class='bi bi-folder'></i> Folder" value="bi bi-folder">Folder</option>
                                            <option data-content="<i class='bi bi-envelope'></i> Envelope" value="bi bi-envelope">Envelope</option>
                                            <option data-content="<i class='bi bi-search'></i> Search" value="bi bi-search">Search</option>
                                            <option data-content="<i class='bi bi-trash'></i> Trash" value="bi bi-trash">Trash</option>
                                            <option data-content="<i class='bi bi-pencil'></i> Edit" value="bi bi-pencil">Edit</option>
                                            <option data-content="<i class='bi bi-lock'></i> Lock" value="bi bi-lock">Lock</option>
                                            <option data-content="<i class='bi bi-check'></i> Verify" value="bi bi-check">Verify</option>
                                            <option data-content="<i class='bi bi-clock'></i> Time" value="bi bi-clock">Time</option>
                                            <option data-content="<i class='bi bi-person'></i> Person" value="bi bi-person">Person</option>
                                            <option data-content="<i class='bi bi-box'></i> Box" value="bi bi-box">Box</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">Status</label>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_active" value="1" checked>
                                            <label class="form-check-label">
                                                Aktif
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_active" value="0">
                                            <label class="form-check-label">
                                                Tidak Aktif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 mb-3-start" style="margin-top: 30px!important;">
                            <div class="col-md-12 d-flex justify-content-start">
                                <a href="{{ route('admin.sub_menu.index') }}" class="btn btn-secondary me-2">Kembali</a>
                                <button type="submit" class="btn btn-primary">Tambah Sub Menu</button>
                            </div>
                        </div>


                    </form>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection