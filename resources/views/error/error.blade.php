<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Pages / Not Found 404 - Arsip Surat</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('layouts.linkstyle')
</head>

<body>

    <main>
        <div class="container">

            <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center mt-5">
                <h1>404</h1>
                <br>
                <h2>Maaf, Halaman yang anda cari tidak ditemukan.</h2>
                <a class="btn" href="{{ auth()->check() ? route(auth()->user()->role->role . '.dashboard') : route('login') }}">Kembali ke Hompage</a>
                <img src="{{asset('assets/img/not-found.svg')}}" class="img-fluid py-5" alt="Page Not Found">
            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

   @include('layouts.script')

</body>

</html>
