@extends('layouts.mastertabel')
@section('title','Tabel Menu')
@section('content')
<div class="pagetitle">
    <h1>Tabel Menu</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route(auth()->user()->role->role . '.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active">Data</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Menu</h5>


                    <div class="mb-3 d-flex justify-content-start">
                        <a href="{{ route('admin.menu.create') }}" class="btn btn-primary rounded-pill">Tambah Menu</a>
                    </div>
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <table id="datatable-table" class=" table table-bordered table-striped custom-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Menu</th>
                                <th scope="col">URL</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $index => $menu)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $menu->menu }}</td>
                                <td>{{ $menu->url ?: '-' }}</td>
                                <td>{{ $menu->icon }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('admin.menu.edit', $menu) }}" class="btn btn-sm btn-primary">Edit</a>

                                    <!-- Tombol Delete -->
                                    <form action="{{ route('admin.menu.destroy', $menu) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</button>
                                    </form>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
