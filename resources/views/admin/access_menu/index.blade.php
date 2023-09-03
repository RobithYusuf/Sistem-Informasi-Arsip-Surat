@extends('layouts.mastertabel')
@section('title','Tabel Akses Menu')
@section('content')
<style>
    .submenu-list {
        padding-left: 20px;
        margin-bottom: 0;
    }

    .submenu-list li {
        font-size: 0.9em;
    }

    .badge-light-success {
        color: #155724;
        background-color: rgba(40, 167, 69, 0.2);
        /* Warna latar belakang dengan opasitas 20% untuk badge success */
    }

    .badge-light-danger {
        color: #721c24;
        background-color: rgba(220, 53, 69, 0.2);
        /* Warna latar belakang dengan opasitas 20% untuk badge danger */
    }

    .badge-light-secondary {
        color: #383d41;
        /* Warna teks untuk secondary biasanya */
        background-color: rgba(108, 117, 125, 0.3);
        /* Warna latar belakang dengan opasitas 20% untuk badge secondary */
    }

    .badge-light-info {
        color: #0c5460;
        /* Warna teks biru yang lebih gelap */
        background-color: rgba(23, 162, 184, 0.3);
        /* Warna latar belakang biru dengan opasitas 20% */
    }

    .badge-light-orange {
        color: #8c4600;
        /* Warna teks oranye yang lebih gelap */
        background-color: rgba(255, 165, 0, 0.3);
        /* Warna latar belakang oranye dengan opasitas 20% */
    }

    .badge-light-violet {
        color: #4b0082;
        /* Warna teks ungu yang lebih gelap */
        background-color: rgba(138, 43, 226, 0.3);
        /* Warna latar belakang ungu dengan opasitas 20% */
    }
</style>
<div class="pagetitle">
    <h1>Tabel Akses Menu</h1>
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
                    <h5 class="card-title">Data Tabel Akses Menu</h5>
                    <!-- <p>Tabel pengelolaan akses menu</p> -->

                    <div class="mb-3 d-flex justify-content-start">
                        <a href="{{ route('admin.access_menu.create') }}" class="btn btn-primary  btn-sm rounded-pill">Tambah Akses Menu</a>
                    </div>
                    <!-- Table with stripped rows -->
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table  datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Sub Menu</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($accessMenus as $index => $accessMenu)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>
                                        @if ($accessMenu->role->role == 'admin')
                                        <span class="badge badge-light-info">{{ strtoupper($accessMenu->role->role) }}</span>
                                        @elseif ($accessMenu->role->role == 'arsiparis')
                                        <span class="badge badge-light-orange">{{ strtoupper($accessMenu->role->role) }}</span>
                                        @elseif ($accessMenu->role->role == 'pimpinan')
                                        <span class="badge badge-light-violet">{{ strtoupper($accessMenu->role->role) }}</span>
                                        @endif
                                    </td>

                                    <td>{{ $accessMenu->menu->menu }}</td>
                                    <td>
                                        <ul class="submenu-list">
                                            @foreach($accessMenu->menu->submenus as $submenu)
                                            <li>{{ $submenu->nama_submenu }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled">
                                            @foreach($accessMenu->menu->submenus as $submenu)
                                            <li>
                                                <span class="badge {{ $submenu->is_active ? 'badge-light-success' : 'badge-light-danger' }} d-inline-flex align-items-center justify-content-center rounded-lg px-2 py-1 text-sm">
                                                    {{ $submenu->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                                </span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('admin.access_menu.edit', $accessMenu) }}" class="btn btn-sm btn-primary rounded-pill">Edit</a>
                                        <!-- Tombol Delete -->
                                        <form action="{{ route('admin.access_menu.destroy', ['access_menu' => $accessMenu->id_user_access_menu]) }}" method="POST" class="d-inline">
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
    </div>
</section>
@endsection
