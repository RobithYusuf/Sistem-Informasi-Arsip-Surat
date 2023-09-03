@extends('layouts.mastertabel')
@section('title','Tabel Sub Menu')
@section('content')
<div class="pagetitle">
    <h1>Tabel Submenu</h1>
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
                    <h5 class="card-title">Datatables</h5>

                    <div class="mb-3 d-flex justify-content-start">
                        <a href="{{ route('admin.sub_menu.create') }}" class="btn btn-primary  btn-sm rounded-pill">Tambah Sub Menu</a>
                    </div>
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Menu</th>
                                <th scope="col">URL</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Aktif</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subMenus as $index => $submenu)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $submenu->nama_submenu }}</td>
                                <td>{{ $submenu->url }}</td>
                                <td>{{ $submenu->icon }}</td>
                                <td>
                                    @if($submenu->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                    @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Tombol Edit -->

                                    <!-- Tombol Delete -->
                                    <form action="{{ route('admin.sub_menu.destroy', ['sub_menu' => $submenu->id_submenu]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-pill" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</button>
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