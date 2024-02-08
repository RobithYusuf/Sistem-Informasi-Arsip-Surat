@extends('layouts.mastertabel')
@section('title','Tabel Disposisi')
@section('content')
<style>
    .custom-table th {
        font-size: 0.8rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 180px;
        text-align: center !important;

    }

    .custom-table td {
        font-size: 0.8rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 250px;

    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info {
        font-size: 0.8rem;
        margin-bottom: 20px;

    }

    .dataTables_wrapper .fa {
        font-size: 0.8rem;

    }

    .dataTables_wrapper .dataTables_paginate {
        font-size: 0.7rem;

    }

    .dataTables_wrapper .table {
        border-top: 1px solid #4f5152;
    }


    .card-body {
        padding: 0 20px 0px 20px;
    }

    .card {
        position: relative;
    }

    .card-title {
        font-size: 1.65rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 1rem;
        color: #3457A7;
        margin-left: 5px;
        margin-top: -5px;
    }

    .card-text-ident {
        font-size: 0.8rem !important;
        color: #3457A7;
        margin-top: -1.2rem;
        font-weight: normal !important;
    }

    .jumlah-arsip {
        color: #3457A7;
        position: absolute;
        top: 48px;
        right: 75px;
        font-size: 2.3rem;
        font-weight: bold;
    }

    .card-title-top {
        padding: 20px 0 15px 0;
        font-size: 18px;
        font-weight: 500;
        color: #012970;
        font-family: "Poppins", sans-serif;
    }

    .card-text-user {
        color: #3457A7;
        font-size: 2.3rem;
        font-weight: bold;
        margin-top: -1rem;
    }
</style>


<div class="pagetitle">
    <h1>Tabel Disposisi</h1>
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
            @if(!auth()->user()->hasRole('user'))
            <div class="row">
                <div class="col-lg-12 d-flex align-items-center">
                    <div class="card text-white position-relative">
                        <div class="card-body">
                            <h3 class="card-title mb-1">Perlu Disposisi  </h3>
                            <p class="card-text">jumlah arsip:</p>
                            <div class="jumlah-arsip position-absolute">{{ $jumlahDisposisi }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(auth()->user()->hasRole('user'))
            <div class="row">
                <div class="col-lg-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Perlu Konfirmasi</h5>
                            <p class="card-text-ident">Total Data</p>
                            <p class="card-text-user">{{ $jumlahPerluKonfirmasi }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Diterima</h5>
                            <p class="card-text-ident">Total Data</p>
                            <p class="card-text-user">{{ $jumlahDiterima }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Disposisi</h5>
                            <p class="card-text-ident">Total Data</p>
                            <p class="card-text-user">{{ $jumlahDisposisi }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <!-- <h5 class="card-title-top">Data Disposisi</h5> -->

                    @if(!auth()->user()->hasRole('user'))
                    <div class="mb-3 d-flex justify-content-start">
                        <a href="{{ route($currentRoutePrefix . '.disposisi.create') }}" class="btn btn-primary btn-xl" style="margin-top: 30px;">Tambah Disposisi</a>
                    </div>
                    @endif

                    <!-- Table with stripped rows -->
                    @if (session('success') || session('info') || session('error'))
                    <div class="alert
                            {{ session('success') ? 'alert-success' : '' }}
                            {{ session('info') ? 'alert-info' : '' }}
                            {{ session('error') ? 'alert-danger' : '' }}">
                        {{ session('success') ?? session('info') ?? session('error') }}
                    </div>
                    @endif

                    <div class="tab-content">
                        <div class="table-responsive">
                            <table id="datatable-table" class="table table-bordered table-striped custom-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nomor Surat</th>
                                        <th>Sifat Arsip</th>
                                        <th>Kepada </th>
                                        <th>Lampiran </th>
                                        <th>Isi</th>
                                        <th>Catatan</th>
                                        <th>Tanggal Disposisi</th>
                                        <th>Keterangan Disposisi</th>
                                        <th class="text-center">Status Disposisi</th>
                                        <th class="text-center-ok">Aksi</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @forelse($disposisis as $index => $disposisi)
                                    @php
                                    $isEmpty = $disposisi->users->every(fn($u) => is_null($u->pivot->disposisi_keterangan));
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $disposisi->arsip->nomor_surat }}</td>
                                        <td>{{ $disposisi->arsip->sifat }}</td>

                                        @if(auth()->user()->hasRole('user'))
                                        <td>
                                            @foreach ($disposisi->users as $user)
                                            {{ $user->nama }}<br>
                                            <!-- @if (!$loop->last),@endif -->
                                            @endforeach
                                        </td>
                                        @endif

                                        @if(!auth()->user()->hasRole('user'))
                                        <td>
                                            @foreach ($disposisi->users as $user)
                                            {{ $user->nama }}<br>
                                            @endforeach
                                        </td>
                                        @endif

                                        <td>
                                            @if ($disposisi->arsip->lampiran)
                                            @php
                                            $extension = pathinfo($disposisi->arsip->lampiran, PATHINFO_EXTENSION);
                                            $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx'];
                                            $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png']);
                                            @endphp

                                            @if ($isImage)
                                            <!-- Jika berkas adalah gambar, tampilkan dengan elemen <img> -->
                                            <img src="{{ asset('storage/lampiran/' . $disposisi->arsip->lampiran) }}" alt="Lampiran" style="max-width: 100px;">
                                            @else
                                            <!-- Jika bukan gambar, berikan tautan ke berkas dengan target="_blank" -->
                                            <a href="javascript:void(0);" onclick="window.open('{{ asset('storage/lampiran/' . $disposisi->arsip->lampiran) }}')">Lihat Lampiran</a>

                                            @endif
                                            @else
                                            <!-- Jika tidak ada lampiran -->
                                            -
                                            @endif
                                        </td>
                                        <td>{{ $disposisi->isi }}</td>
                                        <td>{{ $disposisi->catatan ?? '-' }}</td>
                                        <td>{{ $disposisi->tanggal_disposisi ? \Carbon\Carbon::parse($disposisi->tanggal_disposisi)->format('d F Y') : '-' }}</td>
                                        <td class="{{ $isEmpty ? 'text-center' : '' }}">
                                            @if (!$isEmpty)
                                            @foreach ($disposisi->users as $user)
                                            @if ($user->pivot->disposisi_keterangan)
                                            <span class="text-truncate" style="max-width: 120px; display: inline-block;">
                                                {{ $user->pivot->disposisi_keterangan }}
                                            </span>
                                            @endif
                                            @endforeach

                                            <a href="#" class="view-detail" data-toggle="modal" data-target="#detailModal" data-keterangan="{{ json_encode($disposisi->users->map(fn($u) => ['keterangan' => $u->pivot->disposisi_keterangan, 'nama' => $u->nama])) }}">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @else
                                            <span>-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(auth()->user()->hasRole('user'))
                                            @foreach ($disposisi->users as $user)
                                            @if($user->id == auth()->id())
                                            <span class="badge {{ $user->pivot->status == 'diterima' ? 'bg-success' : ($user->pivot->status == 'disposisi' ? 'bg-danger' : 'bg-secondary') }}">
                                                {{ strtoupper($user->pivot->status) }}
                                            </span>
                                            @endif
                                            @endforeach
                                            @else
                                            @foreach ($disposisi->users as $user)
                                            <span class="badge {{ $user->pivot->status == 'diterima' ? 'bg-success' : ($user->pivot->status == 'disposisi' ? 'bg-danger' : 'bg-secondary') }}">
                                                {{ strtoupper($user->pivot->status) }}
                                            </span><br>
                                            @endforeach
                                            @endif
                                        </td>


                                        <td>
                                            @if(auth()->user()->hasRole('user'))
                                            <!-- Tombol Terima -->
                                            <button type="button" class="btn btn-sm btn-success" onclick="confirmStatusChange('{{ route($currentRoutePrefix . '.disposisi.accept', $disposisi->id_disposisi) }}', 'terima')">Terima</button>

                                            <!-- Tombol Disposisi -->
                                            <button type="button" class="btn btn-sm btn-warning disposisi-btn" data-url="{{ route($currentRoutePrefix . '.disposisi.decline', $disposisi->id_disposisi) }}">Disposisi</button>


                                            @else

                                            <!-- Tombol Edit -->
                                            <a href="{{ route($currentRoutePrefix . '.disposisi.edit', $disposisi->id_disposisi) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <!-- Tombol Delete -->
                                            <form action="{{ route($currentRoutePrefix . '.disposisi.destroy', $disposisi->id_disposisi) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</button>
                                            </form>
                                            @endif
                                        </td>

                                    </tr>
                                    @empty

                                    <tr>
                                        <td colspan="11" class="text-center">Data Disposisi Kosong.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


@if(auth()->user()->hasRole('user'))
<!-- Modal untuk Disposisi dengan Keterangan -->
<div class="modal fade" id="keteranganDisposisiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Keterangan Disposisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <form method="POST" action="">
                @csrf
                <div class="modal-body">
                    <textarea name="keterangan_disposisi" class="form-control" placeholder="Masukkan keterangan disini..." required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Kirim Disposisi</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endif

<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Keterangan Disposisi</h5>
                <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Isi detail akan dimuat di sini -->
            </div>
        </div>
    </div>
</div>


<script>

    // modal
    $(document).ready(function() {
        $('.view-detail').click(function() {
            var items = $(this).data('keterangan');
            var modalBody = '';

            if (items.length) {
                items.forEach(function(item) {
                    if (item.keterangan) {
                        modalBody += '<p>' + '<b>' + item.nama + '</b>: ' + item.keterangan + '</p>';
                    } else {
                        modalBody += '<p>Informasi tidak tersedia atau kosong</p>';
                    }
                });
            } else {
                modalBody = '<p>Tidak ada keterangan tambahan.</p>';
            }

            $('#detailModal .modal-body').html(modalBody);
        });
    });


    function confirmStatusChange(url, status) {
        if (confirm('Apakah Anda yakin ingin mengubah status menjadi ' + status + '?')) {
            window.location.href = url;
        }
    }

    //modal keterangan disposisi
    document.addEventListener('DOMContentLoaded', function() {
        var disposisiButtons = document.querySelectorAll('.disposisi-btn');

        disposisiButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var url = this.getAttribute('data-url');

                if (confirm('Disposisi kembali arsip ini?')) {
                    $('#keteranganDisposisiModal form').attr('action', url);
                    $('#keteranganDisposisiModal').modal('show');
                }
            });
        });
    });
</script>

@endsection
