@extends('layouts.mastertabel')
@section('title','Edit Akses Menu')
@section('content')

<style>
    .custom-border {
        border: 0.5px solid #dfe3e8 !important;

    }
</style>
<div class="pagetitle">
    <h1>Form Edit Akses Menu</h1>
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
                    <h5 class="card-title">Akses Menu</h5>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="role" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" value="{{ $access_menu->role->role }}" disabled>

                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="menu" class="col-sm-2 col-form-label">Menu</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" value="{{ $access_menu->menu->menu }}" disabled>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h5 class="card-title" style="margin-bottom: 5;">Edit Sub Menu</h5>

                    <form action="{{ route('admin.access_menu.update', ['access_menu' => $access_menu->id_user_access_menu]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @foreach($access_menu->menu->submenus as $submenu)
                        <hr class="mt-4"> <!-- Pembatas antar submenu -->
                        <div class="row mb-3">
                            <!-- Sub Menu -->
                            <div class="col-md-6">
                                <label for="nama_submenu" class="col-form-label">Sub Menu</label>
                                <input type="text" name="submenus[{{ $submenu->id_submenu }}][nama_submenu]" class="form-control" value="{{ $submenu->nama_submenu }}">
                            </div>

                            <!-- URL -->
                            <div class="col-md-6">
                                <label for="url" class="col-form-label">URL</label>
                                <input type="text" name="submenus[{{ $submenu->id_submenu }}][url]" class="form-control" value="{{ $submenu->url }} " readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <!-- Pilih Icon Sub Menu -->
                            <div class="col-md-6">
                                <label class="col-form-label">Pilih Icon Sub Menu</label>
                                <div>
                                    <?php
                                    $selectedIcon = old('submenus.' . $submenu->id_submenu . '.icon') ?? $submenu->icon;
                                    ?>
                                    <select class="selectpicker form-control custom-border" name="submenus[{{ $submenu->id_submenu }}][icon]" aria-label="Pilih Icon Sub Menu">
                                        <option value="" {{ $selectedIcon == null ? 'selected' : '' }}>Pilih Icon</option>
                                        <option data-content="<i class='bi bi-file-earmark-text'></i> File" value="bi-file-earmark-text" {{ $selectedIcon == 'bi-file-earmark-text' ? 'selected' : '' }}>File</option>
                                        <option data-content="<i class='bi bi-funnel'></i> Filter" value="bi bi-funnel" {{ $selectedIcon == 'bi bi-funnel' ? 'selected' : '' }}>Filter</option>
                                        <option data-content="<i class='bi bi-archive'></i> Archive" value="bi bi-archive" {{ $selectedIcon == 'bi bi-archive' ? 'selected' : '' }}>Archive</option>
                                        <option data-content="<i class='bi bi-house-door'></i> Home" value="bi bi-house-door" {{ $selectedIcon == 'bi bi-house-door' ? 'selected' : '' }}>Home</option>
                                        <option data-content="<i class='bi bi-gear'></i> Settings" value="bi bi-gear" {{ $selectedIcon == 'bi bi-gear' ? 'selected' : '' }}>Settings</option>
                                        <option data-content="<i class='bi bi-bell'></i> Notifications" value="bi bi-bell" {{ $selectedIcon == 'bi bi-bell' ? 'selected' : '' }}>Notifications</option>
                                        <option data-content="<i class='bi bi-chat-dots'></i> Chat" value="bi bi-chat-dots" {{ $selectedIcon == 'bi bi-chat-dots' ? 'selected' : '' }}>Chat</option>
                                        <option data-content="<i class='bi bi-folder'></i> Folder" value="bi bi-folder" {{ $selectedIcon == 'bi bi-folder' ? 'selected' : '' }}>Folder</option>
                                        <option data-content="<i class='bi bi-envelope'></i> Envelope" value="bi bi-envelope" {{ $selectedIcon == 'bi bi-envelope' ? 'selected' : '' }}>Envelope</option>
                                        <option data-content="<i class='bi bi-search'></i> Search" value="bi bi-search" {{ $selectedIcon == 'bi bi-search' ? 'selected' : '' }}>Search</option>
                                        <option data-content="<i class='bi bi-trash'></i> Trash" value="bi bi-trash" {{ $selectedIcon == 'bi bi-trash' ? 'selected' : '' }}>Trash</option>
                                        <option data-content="<i class='bi bi-pencil'></i> Edit" value="bi bi-pencil" {{ $selectedIcon == 'bi bi-pencil' ? 'selected' : '' }}>Edit</option>
                                        <option data-content="<i class='bi bi-lock'></i> Lock" value="bi bi-lock" {{ $selectedIcon == 'bi bi-lock' ? 'selected' : '' }}>Lock</option>
                                        <option data-content="<i class='bi bi-check'></i> Verify" value="bi bi-check" {{ $selectedIcon == 'bi bi-check' ? 'selected' : '' }}>Verify</option>
                                        <option data-content="<i class='bi bi-clock'></i> Time" value="bi bi-clock" {{ $selectedIcon == 'bi bi-clock' ? 'selected' : '' }}>Time</option>
                                        <option data-content="<i class='bi bi-person'></i> Person" value="bi bi-person" {{ $selectedIcon == 'bi bi-person' ? 'selected' : '' }}>Person</option>
                                        <option data-content="<i class='bi bi-box'></i> Box" value="bi bi-box" {{ $selectedIcon == 'bi bi-box' ? 'selected' : '' }}>Box</option>
                                    </select>
                                </div>
                            </div>



                            <!-- Status Sub Menu -->
                            <div class="col-md-6">
                                <label class="col-form-label">Status Sub Menu</label>
                                <div class="mt-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="submenus[{{ $submenu->id_submenu }}][is_active]" value="1" {{ $submenu->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label"> Aktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="row mb-3 mb-3-start" style="margin-top: 30px!important;">
                            <div class="col-md-12 d-flex justify-content-start">
                                <a href="{{ route('admin.access_menu.index') }}" class="btn btn-secondary me-2">Kembali</a>
                                <button type="submit" class="btn btn-primary">Submit Form</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</section>


<script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
    });
</script>
@endsection