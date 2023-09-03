<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pengarsipan Surat</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('landingpage/img/logo_akn.png')}}" rel="icon">
    <link href="{{asset('landingpage/img/logo_akn.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('landingpage/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('landingpage/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('landingpage/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('landingpage/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('landingpage/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('landingpage/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('landingpage/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('landingpage/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('landingpage/css/style.css')}}" rel="stylesheet">
    <style>
        .logo-container {
            display: flex;
            align-items: center;
            /* Pusatkan elemen secara vertikal */
        }

        .logo img {
            max-width: 100%;
            /* Membuat logo responsif */
            height: auto;
            /* Menjaga aspek rasio */
            margin-right: 10px;
            margin-top: -15px;
            /* Jarak antara logo dan teks */
        }

        .logo h1 {
            display: none;
            /* Sembunyikan teks di mode mobile */
        }

        /* Tampilkan teks saat di mode desktop */
        @media (min-width: 992px) {

            /* Anda bisa menyesuaikan nilai 992px sesuai kebutuhan */
            .logo h1 {
                display: block;
            }
        }


        .appointment-btn {
            padding: 10px 20px;
            /* Anda bisa menyesuaikan padding sesuai kebutuhan */
            display: inline-block;
            border-radius: 5px;
            /* Memberikan sudut bulat */

            /* Warna latar belakang tombol */
            color: #FFFFFF;
            /* Warna teks tombol */
            text-decoration: none;
            /* Menghilangkan garis bawah dari link */
            transition: background-color 0.3s;
            /* Efek transisi saat tombol ditekan */
        }

        .appointment-btn:hover {
            background-color: #53d6db;
            /* Warna latar belakang saat tombol ditekan */
        }
    </style>
</head>

<body>

    <!-- ======= Top Bar ======= -->
    <div id="topbar" class="d-flex align-items-center fixed-top">
        <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
            <div class="align-items-center d-none d-md-flex" id="current-datetime">
                <i class="bi bi-clock"></i>
            </div>


            <div class="d-flex align-items-center">
                <i class="bi bi-phone"></i> Telepon 0274 7742 89
            </div>
        </div>
    </div>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <div class="logo-container me-auto">
                <a href="/" class="logo"><img src="{{asset('landingpage/img/logo_akn.png')}}" alt="Logo"></a>
                <h1 class="logo"><a href="/">Arsip Surat</a></h1>
            </div>


            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto " href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">Tentang</a></li>

                    <li><a class="nav-link scrollto" href="#organization">Organisasi</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            <div class="scrollto">
                @if(Auth::check())
                <a href="{{ route(auth()->user()->role->role . '.dashboard') }}" class="appointment-btn scrollto">
                    <i class="bi bi-house-door"></i> <!-- Contoh ikon dari Bootstrap Icons -->
                    <span class="d-none d-md-inline">Dashboard</span>
                </a>
                @else
                <a href="/login" class="appointment-btn scrollto">
                    <i class="bi bi-box-arrow-in-right" style="margin-right: 5px;"></i> <!-- Contoh ikon dari Bootstrap Icons -->
                    <span class="d-none d-md-inline">Login</span>
                </a>
                @endif
            </div>


        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

            <div class="carousel-inner" role="listbox">

                <!-- Slide 1 -->
                <div class="carousel-item active" style="background-image: url(landingpage/img/slide/akn1.jpg)">
                    <div class="container">
                        <h2>Akademi Komunitas Negeri Seni & Budaya <span>Yogyakarta</span></h2>
                        <p>Akademi Komunitas Negeri Seni Dan Budaya Yogyakarta adalah sebuah lembaga Pendidikan tinggi seni budaya berstatus negeri yang memiliki kewenangan untuk menyelenggarakan pendidikan pada jenjang Diploma Satu (01) sampai Diploma Dua (D2), dengan berpedoman pada Perpres No 8 Tahun 2012 tentang Kerangka Kualifikasi Nasional Indonesia (KKNI).</p>
                        <a href="#about" class="btn-get-started scrollto">Baca Selengkapnya</a>
                    </div>
                </div>

                <!-- Slide 2 -->
                <!-- Slide 2 -->
                <div class="carousel-item" style="background-image: url(landingpage/img/slide/slide2.jpg)">
                    <div class="container">
                        <h2>Sejarah Akademi Komunitas Negeri Seni & Budaya Yogyakarta</h2>
                        <p>Akademi ini dibentuk berdasarkan gagasan dari Gubernur DIY, Sultan Hamengku Buwono X, pada tahun 2013. Setelah mendapatkan persetujuan dari Dirjen Dikti, lembaga ini mulai melaksanakan program pendidikannya pada tahun akademik 2014-2015. Saat ini, administrasi akademiknya masih berada di bawah pembinaan Institut Seni Indonesia Yogyakarta.</p>
                        <a href="#about" class="btn-get-started scrollto">Pelajari Lebih Lanjut</a>
                    </div>
                </div>


            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>
    </section><!-- End Hero -->

    <main id="main">


        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Tentang Kami</h2>
                    <p><strong>Akademi Komunitas Negeri Seni Dan Budaya Yogyakarta</strong> adalah institusi pendidikan tinggi seni budaya negeri yang menyelenggarakan pendidikan dari Diploma 1 hingga Diploma 2 berdasarkan Perpres No 8 Tahun 2012. Dibentuk berdasarkan inisiatif Gubernur DIY, Sultan Hamengku Buwono X, pada 2013, akademi ini mulai beroperasi pada tahun akademik 2014-2015 setelah mendapatkan persetujuan dari Dirjen Dikti. Saat ini, akademi ini berada di bawah tanggung jawab Dinas Pendidikan Pemuda dan Olah Raga DIY dan pembinaan Institut Seni Indonesia Yogyakarta.</p>
                </div>

                <div class="row">
                    <div class="col-lg-6" data-aos="fade-right">
                        <img src="{{asset('landingpage/img/depan.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
                        <h3>Misi & Visi Akademi Komunitas Negeri Seni Dan Budaya Yogyakarta</h3>
                        <p class="fst-italic">
                            Sebagai lembaga pendidikan tinggi seni budaya, kami berkomitmen untuk mengembangkan dan melestarikan seni dan budaya Indonesia melalui pendidikan berkualitas.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i> Menyediakan kurikulum pendidikan yang relevan dengan perkembangan seni dan budaya kontemporer.</li>
                            <li><i class="bi bi-check-circle"></i> Membina hubungan yang erat dengan komunitas seni dan budaya di Yogyakarta dan Indonesia.</li>
                            <li><i class="bi bi-check-circle"></i> Mendorong inovasi dan kreativitas dalam setiap aspek pendidikan dan penelitian.</li>
                        </ul>
                        <p>
                            Kami percaya bahwa dengan pendekatan yang holistik dan kolaboratif, kami dapat memberikan kontribusi signifikan bagi perkembangan seni dan budaya di Indonesia.
                        </p>
                    </div>
                </div>

            </div>
        </section>
        <!-- End About Us Section -->

        <!-- ======= Counts Section ======= -->
        <section id="programs" class="programs">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Program Studi</h2>
                    <p>Berikut adalah beberapa program studi yang ditawarkan oleh Akademi Komunitas Negeri Seni dan Budaya Yogyakarta:</p>
                </div>

                <div class="row">

                    <!-- Prodi Seni Tari -->
                    <div class="col-lg-4 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="card">
                            <img src="{{asset('landingpage/img/seni_tari.jpg')}}" class="card-img-top" alt="Seni Tari">
                            <div class="card-body">
                                <h5 class="card-title">Prodi Seni Tari</h5>
                                <p class="card-text">Pusat unggulan ketrampilan dan penggarapan seni tari yang selaras dengan konteks perubahan seni budaya.</p>
                                <!-- <a href="#" class="btn btn-primary">Baca Selengkapnya</a> -->
                            </div>
                        </div>
                    </div>

                    <!-- Prodi Seni Karawitan -->
                    <div class="col-lg-4 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="card">
                            <img src="{{asset('landingpage/img/seni_karawitan.jpg')}}" class="card-img-top" alt="Seni Karawitan">
                            <div class="card-body">
                                <h5 class="card-title">Prodi Seni Karawitan</h5>
                                <p class="card-text">Pusat unggulan ketrampilan dan penggarapan seni karawitan yang selaras dengan konteks perubahan seni budaya.</p>
                                <!-- <a href="#" class="btn btn-primary">Baca Selengkapnya</a> -->
                            </div>
                        </div>
                    </div>

                    <!-- Prodi Seni Kriya -->
                    <div class="col-lg-4 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="card">
                            <img src="{{asset('landingpage/img/seni_kriya.jpg')}}" class="card-img-top" alt="Seni Kriya">
                            <div class="card-body">
                                <h5 class="card-title">Prodi Seni Kriya (Konsentrasi Kriya Kulit)</h5>
                                <p class="card-text">Pusat unggulan pelaku profesional dalam bidang ketrampilan seni kriya kulit yang selaras dengan perkembangan zaman.</p>
                                <!-- <a href="#" class="btn btn-primary">Baca Selengkapnya</a> -->
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- End Counts Section -->

        <!-- ======= Features Section ======= -->
        <section id="organization" class="organization">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Struktur Organisasi</h2>
                    <p>Akademi Komunitas Negeri Seni Dan Budaya Yogyakarta</p>
                </div>

                <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right">
                        <h4>Direktur</h4>
                        <p>Drs. Supadma, M.Hum</p>

                        <h4>Koordinator Prodi</h4>
                        <ul>
                            <li>D1 Seni Tari: Dr. Sumaryono, MA</li>
                            <li>D1 Kriya Kulit: Drs. Andono, M.Sn</li>
                            <li>D1 Seni Karawitan: P. Suparto, S.Sn, MA</li>
                        </ul>

                        <h4>Staf Pengajar (Dosen)</h4>
                        <ul>
                            <li>Prof. Dr. Y. Sumandiyo Hadi, SST., SU</li>
                            <li>Prof. Dr. I Wayan Dana, SST., M. Hum</li>
                            <li>Dr. Sumaryono, MA</li>
                            <!-- ... dan lainnya -->
                        </ul>

                        <h4>Instruktur</h4>
                        <ul>
                            <li>Siti Sutiyah Sasminta Mardawa, S.Sn</li>
                            <li>Ali Nur Sotya Nugroho, S,Sn</li>
                            <li>Y. Adityanto Aji, S.Sn, M.Sn</li>
                            <!-- ... dan lainnya -->
                        </ul>
                    </div>

                    <div class="image col-lg-6 order-1 order-lg-2" style='background-image: url("{{asset('landingpage/img/1233.jpg')}}");' data-aos="zoom-in"></div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right">
                        <h4>Bagian Akademik</h4>
                        <ul>
                            <li>Reni Hediyani, SE</li>
                            <li>Rizka Deviana Pratiwi, SE</li>
                            <li>Aris Munandar, Amd.Par.</li>
                            <li>Feri Ardiyanto, S.Kom.</li>
                        </ul>
                    </div>
                </div>


            </div>
        </section>



        <!-- ======= Services Section ======= -->
        <!-- End Services Section -->

        <!-- ======= Appointment Section ======= -->
        <!-- <section id="appointment" class="appointment section-bg')}}">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Make an Appointment</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <form action="forms/appointment.php" method="post" role="form" class="php-email-form" data-aos="fade-up" data-aos-delay="100">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                        </div>
                        <div class="col-md-4 form-group mt-3 mt-md-0">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                        </div>
                        <div class="col-md-4 form-group mt-3 mt-md-0">
                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group mt-3">
                            <input type="datetime" name="date" class="form-control datepicker" id="date" placeholder="Appointment Date" required>
                        </div>
                        <div class="col-md-4 form-group mt-3">
                            <select name="department" id="department" class="form-select">
                                <option value="">Select Department</option>
                                <option value="Department 1">Department 1</option>
                                <option value="Department 2">Department 2</option>
                                <option value="Department 3">Department 3</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group mt-3">
                            <select name="doctor" id="doctor" class="form-select">
                                <option value="">Select Doctor</option>
                                <option value="Doctor 1">Doctor 1</option>
                                <option value="Doctor 2">Doctor 2</option>
                                <option value="Doctor 3">Doctor 3</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
                    </div>
                    <div class="my-3">
                        <div class="loading')}}">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
                    </div>
                    <div class="text-center"><button type="submit">Make an Appointment</button></div>
                </form>

            </div>
        </section> -->
        <!-- End Appointment Section -->

        <!-- ======= Departments Section ======= -->
        <!-- <section id="departments" class="departments">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Departments</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <ul class="nav nav-tabs flex-column">
                            <li class="nav-item">
                                <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-1">
                                    <h4>Cardiology</h4>
                                    <p>Quis excepturi porro totam sint earum quo nulla perspiciatis eius.</p>
                                </a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2">
                                    <h4>Neurology</h4>
                                    <p>Voluptas vel esse repudiandae quo excepturi.</p>
                                </a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-3">
                                    <h4>Hepatology</h4>
                                    <p>Velit veniam ipsa sit nihil blanditiis mollitia natus.</p>
                                </a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-4">
                                    <h4>Pediatrics</h4>
                                    <p>Ratione hic sapiente nostrum doloremque illum nulla praesentium id</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-8">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab-1">
                                <h3>Cardiology</h3>
                                <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                                <img src="{{asset('landingpage/img/departments-1.jpg')}}" alt="" class="img-fluid">
                                <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
                            </div>
                            <div class="tab-pane" id="tab-2">
                                <h3>Neurology</h3>
                                <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                                <img src="{{asset('landingpage/img/departments-2.jpg')}}" alt="" class="img-fluid">
                                <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
                            </div>
                            <div class="tab-pane" id="tab-3">
                                <h3>Hepatology</h3>
                                <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                                <img src="{{asset('landingpage/img/departments-3.jpg')}}" alt="" class="img-fluid">
                                <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
                            </div>
                            <div class="tab-pane" id="tab-4">
                                <h3>Pediatrics</h3>
                                <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                                <img src="{{asset('landingpage/img/departments-4.jpg')}}" alt="" class="img-fluid">
                                <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section> -->
        <!-- End Departments Section -->



        <!-- ======= Gallery Section ======= -->
        <section id="gallery" class="gallery">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Gallery</h2>
                    <p>Galeri kegiatan sarana prasarana Akademi Komunitas Negeri Seni Dan Budaya Yogyakarta.</p>
                </div>

                <div class="gallery-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><a class="gallery-lightbox" href="{{asset('landingpage/img/gallery/gallery-1.jpg')}}"><img src="{{asset('landingpage/img/gallery/gallery-1.jpg')}}" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="gallery-lightbox" href="{{asset('landingpage/img/gallery/gallery-2.jpg')}}"><img src="{{asset('landingpage/img/gallery/gallery-2.jpg')}}" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="gallery-lightbox" href="{{asset('landingpage/img/gallery/gallery-3.jpg')}}"><img src="{{asset('landingpage/img/gallery/gallery-3.jpg')}}" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="gallery-lightbox" href="{{asset('landingpage/img/gallery/gallery-4.jpg')}}"><img src="{{asset('landingpage/img/gallery/gallery-4.jpg')}}" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="gallery-lightbox" href="{{asset('landingpage/img/gallery/gallery-5.jpg')}}"><img src="{{asset('landingpage/img/gallery/gallery-5.jpg')}}" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="gallery-lightbox" href="{{asset('landingpage/img/gallery/gallery-6.jpg')}}"><img src="{{asset('landingpage/img/gallery/gallery-6.jpg')}}" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="gallery-lightbox" href="{{asset('landingpage/img/gallery/gallery-7.jpg')}}"><img src="{{asset('landingpage/img/gallery/gallery-7.jpg')}}" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="gallery-lightbox" href="{{asset('landingpage/img/gallery/gallery-8.jpg')}}"><img src="{{asset('landingpage/img/gallery/gallery-8.jpg')}}" class="img-fluid" alt=""></a></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section><!-- End Gallery Section -->



        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                    <h2>Kontak Person</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

            </div>

            <div>
                <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15809.985869038517!2d110.3618805!3d-7.8429924!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a564ea4260f97%3A0x89a93db937c4021a!2sAkademi%20Komunitas%20Negeri%20Seni%20Dan%20Budaya%20Yogyakarta!5e0!3m2!1sid!2sid!4v1693217384699!5m2!1sid!2sid" frameborder="0" allowfullscreen></iframe>
            </div>

            <div class="container">

                <div class="row mt-5">

                    <div class="col-lg-12">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="info-box">
                                    <i class="bx bx-map"></i>
                                    <h3>Alamat</h3>
                                    <p>Jl. Parangtritis No.364, Pandes, Panggungharjo, Kec. Sewon, Bantul, Daerah Istimewa Yogyakarta 55188</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box mt-4">
                                    <i class="bx bx-envelope"></i>
                                    <h3>Email Us</h3>
                                    <p>info@aknsby.com</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box mt-4">
                                    <i class="bx bx-phone-call"></i>
                                    <h3>Call Us</h3>
                                    <p>0274774289<br></p>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-info">
                            <h3>AKN Seni & Budaya Yogyakarta</h3>
                            <p>
                                A108 Adam Street <br>
                                NY 535022, USA<br><br>
                                <strong>Phone:</strong> 0274774289<br>
                                <strong>Email:</strong> info@aknsby.com<br>
                            </p>
                            <div class="social-links mt-3">
                                <a href="https://www.instagram.com/aknsb.yogyakarta/?hl=id" class="twitter"><i class="bx bxl-instagram"></i></a>
                                <a href="https://www.aknyogya.ac.id/" class="facebook"><i class="bx bxl-youtube"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Tentang</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Prodi</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#programs">Prodi Seni Tari</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#programs">Prodi Seni Karawitan</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#programs">Prodi Seni Kriya (Konsentrasi Kriya Kulit)</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Informasi Update</h4>
                        <p>Silahkan kujungi website utama untuk mengetahui update informasi tentang AKN Seni Budaya Yogyakarta</p>
                        <p>Website utama :
                            <a href="https://www.aknyogya.ac.id/"> https://www.aknyogya.ac.id/</a>
                        </p>

                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>AKN Seni Dan Budaya Yogyakarta</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function updateCurrentDateTime() {
                const now = new Date();
                const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                const dayName = days[now.getDay()];
                const monthName = months[now.getMonth()];
                const date = now.getDate();
                const year = now.getFullYear();
                const hours = now.getHours().toString().padStart(2, '0');
                const minutes = now.getMinutes().toString().padStart(2, '0');

                const formattedDateTime = `${dayName}, ${date} ${monthName} ${year} - ${hours}:${minutes}`;
                document.getElementById('current-datetime').innerHTML = `<i class="bi bi-clock"></i> ${formattedDateTime}`;
            }

            updateCurrentDateTime();
            setInterval(updateCurrentDateTime, 60000); // Update setiap 60 detik
        });
    </script>


    <!-- Vendor JS Files -->
    <script src="{{asset('landingpage/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{asset('landingpage/vendor/aos/aos.js')}}"></script>
    <script src="{{asset('landingpage/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('landingpage/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('landingpage/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('landingpage/vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('landingpage/js/main.js')}}"></script>

</body>

</html>
