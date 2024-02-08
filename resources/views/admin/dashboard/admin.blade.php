@extends('layouts.master')
@section('title','Dashboard Admin')
@section('content')

<style>
    .card-text {
        font-size: 0.8rem !important;
        color: #3457A7;
        margin-top: -1.2rem;
        font-weight: normal !important;
    }
</style>
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card">
                        <div class="card-body">
                            <h5 class="card-title">Total Pengguna</h5>
                             <p class="card-text">Jumlah keseluruhan users</p>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $totalUsers }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card">
                        <div class="card-body">
                            <h5 class="card-title">Pengguna dengan Role 'User'</h5>
                            <p class="card-text">Jumlah keseluruhan role 'User'</p>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-person-check"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $totalUsersWithUserRole }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Total Users Card -->

            </div>
        </div><!-- End Left side columns -->

    </div>
</section>

@endsection
