<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login Arsip Surat</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('layouts.linkstyle')
</head>

<body>
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="{{asset('assets/img/logo.png')}}" alt="">
                                    <span class="d-none d-lg-block" style="margin-left: 5px; margin-top: 5px;">Arsip Surat</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                                        <p class="text-center small">Isi username & password untuk login</p>
                                    </div>

                                    <form class="row g-3 needs-validation" novalidate action="{{ route('postLogin') }}" method="POST">
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="username" value="{{ old('username') }}" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" id="yourUsername" required>
                                                @if ($errors->has('username'))
                                                <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                                                @endif
                                                <div class="invalid-feedback">Masukan username dengan benar.</div>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="yourPassword" required>
                                            @if ($errors->has('password'))
                                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                            @endif
                                            <div class="invalid-feedback">Masukan password dengan benar!</div>
                                        </div>

                                        <!-- <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                            </div>
                                        </div> -->
                                        <div class="col-12 mt-4">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <a href="/" class="btn btn-secondary w-100">Homepage</a>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="credits">
                                Copyright 2023 - <a href="/">AKN Yogyakarta</a>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    @include('layouts.script')

</body>

</html>