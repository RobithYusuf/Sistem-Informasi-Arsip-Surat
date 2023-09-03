@extends('layouts.master')
@section('title','Dashboard Pimpinan')
@section('content')


<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Total Arsip Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Jumlah | {{ $arsipAllHariIni }} | Hari ini</a></li>
                                <li><a class="dropdown-item" href="#">Jumlah | {{ $arsipAllBulanIni }} | Bulan ini</a></li>
                                <li><a class="dropdown-item" href="#">Jumlah | {{ $arsipAllTahunIni }} | Tahun Ini</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Total Arsip</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-archive"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $totalArsip }}</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Total Arsip Card -->

                <!-- Arsip Masuk Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Jumlah | {{ $arsipMasukHariIni }} | Hari ini</a></li>
                                <li><a class="dropdown-item" href="#">Jumlah | {{ $arsipMasukBulanIni }} | Bulan ini</a></li>
                                <li><a class="dropdown-item" href="#">Jumlah | {{ $arsipMasukTahunIni }} | Tahun Ini</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Arsip Masuk</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-box-arrow-in-down"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $arsipMasuk }}</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Arsip Masuk Card -->

                <!-- Arsip Keluar Card -->
                <div class="col-xxl-4 col-xl-12">
                    <div class="card info-card">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Jumlah | {{ $arsipKeluarHariIni }} | Hari ini</a></li>
                                <li><a class="dropdown-item" href="#">Jumlah | {{ $arsipKeluarBulanIni }} | Bulan ini</a></li>
                                <li><a class="dropdown-item" href="#">Jumlah | {{ $arsipKeluarTahunIni }} | Tahun ini</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Arsip Keluar</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-box-arrow-in-up"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $arsipKeluar }}</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Arsip Keluar Card -->

            </div>
        </div><!-- End Left side columns -->

    </div>
</section>

@endsection
