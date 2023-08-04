@extends('layouts.home')

@section('content')
<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5">
    <div class="owl-carousel header-carousel position-relative">
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="{{ asset('frontend/img/hero-1.jpg') }}" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                style="background: rgba(0, 0, 0, .2);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-10 col-lg-8">
                            <h1 class="display-2 text-white animated slideInDown mb-4">
                                Selamat Datang di Aplikasi <span class="fw-bold">Event</span> Planner
                            </h1>
                            <p class="fs-5 fw-medium text-white mb-4 pb-2">
                                Jadikan pernikahanmu lebih berkesan dengan aplikasi ini.
                            </p>
                            <a href="{{ route('register') }}" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">
                                Daftar
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-dark rounded-pill py-sm-3 px-sm-5 animated slideInRight">
                                Masuk
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="{{ asset('frontend/img/hero-2.jpg') }}" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                style="background: rgba(0, 0, 0, .2);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-10 col-lg-8">
                            <h1 class="display-2 text-white animated slideInDown mb-4">
                                Selamat Datang di Aplikasi <span class="fw-bold">Event</span> Planner
                            </h1>
                            <p class="fs-5 fw-medium text-white mb-4 pb-2">
                                Jadikan pernikahanmu lebih berkesan dengan aplikasi ini.
                            </p>
                            <a href=""
                                class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">Learn
                                More</a>
                            <a href="" class="btn btn-dark rounded-pill py-sm-3 px-sm-5 animated slideInRight">Our
                                Classes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="{{ asset('frontend/img/hero-3.jpg') }}" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                style="background: rgba(0, 0, 0, .2);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-10 col-lg-8">
                            <h1 class="display-2 text-white animated slideInDown mb-4">
                                Selamat Datang di Aplikasi <span class="fw-bold">Event</span> Planner
                            </h1>
                            <p class="fs-5 fw-medium text-white mb-4 pb-2">
                                Jadikan pernikahanmu lebih berkesan dengan aplikasi ini.
                            </p>
                            <a href=""
                                class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">Learn
                                More</a>
                            <a href="" class="btn btn-dark rounded-pill py-sm-3 px-sm-5 animated slideInRight">Our
                                Classes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->


<!-- Facilities Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">
                Fasilitas
            </h1>
            <p>
                Dapatkan fasilitas terbaik dari kami.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="facility-item">
                    <div class="facility-icon bg-primary">
                        <span class="bg-primary"></span>
                        <i class="fa fa-bus-alt fa-3x text-primary"></i>
                        <span class="bg-primary"></span>
                    </div>
                    <div class="facility-text bg-primary">
                        <h3 class="text-primary mb-3">
                            Wo
                        </h3>
                        <p class="mb-0">
                            Kami menyediakan wo terbaik untuk anda.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="facility-item">
                    <div class="facility-icon bg-success">
                        <span class="bg-success"></span>
                        <i class="fa fa-futbol fa-3x text-success"></i>
                        <span class="bg-success"></span>
                    </div>
                    <div class="facility-text bg-success">
                        <h3 class="text-success mb-3">
                            Mua
                        </h3>
                        <p class="mb-0">
                            Kami menyediakan MUA terbaik untuk anda.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="facility-item">
                    <div class="facility-icon bg-warning">
                        <span class="bg-warning"></span>
                        <i class="fa fa-home fa-3x text-warning"></i>
                        <span class="bg-warning"></span>
                    </div>
                    <div class="facility-text bg-warning">
                        <h3 class="text-warning mb-3">
                            Undangan Pernikahan
                        </h3>
                        <p class="mb-0">
                            Kami menyediakan undangan pernikahan terbaik untuk anda.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="facility-item">
                    <div class="facility-icon bg-info">
                        <span class="bg-info"></span>
                        <i class="fa fa-chalkboard-teacher fa-3x text-info"></i>
                        <span class="bg-info"></span>
                    </div>
                    <div class="facility-text bg-info">
                        <h3 class="text-info mb-3">
                            Dekorasi
                        </h3>
                        <p class="mb-0">
                            Kami menyediakan dekorasi terbaik untuk anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Facilities End -->


<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-4">
                    Tentang Kami
                </h1>
                <p>
                    Kami adalah aplikasi yang menyediakan fasilitas untuk mempermudah anda dalam merencanakan pernikahan anda.
                </p>
                <p class="mb-4">
                    Kami juga menyediakan berbagai macam fasilitas seperti, WO, MUA, Dekorasi, dan Undangan Pernikahan.
                </p>
                <div class="row g-4 align-items-center">
                    <div class="col-sm-6">
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="">Read More</a>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle flex-shrink-0" src="{{ asset('frontend/img/user.jpg') }}" alt=""
                                style="width: 45px; height: 45px;">
                            <div class="ms-3">
                                <h6 class="text-primary mb-1">Mestri Mayang Sari</h6>
                                <small>CEO & Founder</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 about-img wow fadeInUp" data-wow-delay="0.5s">
                <div class="row">
                    <div class="col-12 text-center">
                        <img class="img-fluid w-75 rounded-circle bg-light p-3" src="{{ asset('frontend/img/about-1-1.jpg') }}" alt="">
                    </div>
                    <div class="col-6 text-start" style="margin-top: -150px;">
                        <img class="img-fluid w-100 rounded-circle bg-light p-3" src="{{ asset('frontend/img/about-2-2.jpg') }}" alt="">
                    </div>
                    <div class="col-6 text-end" style="margin-top: -150px;">
                        <img class="img-fluid w-100 rounded-circle bg-light p-3" src="{{ asset('frontend/img/about-3-3.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Call To Action Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="bg-light rounded">
            <div class="row g-0">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded" src="{{ asset('frontend/img/call-to-action-1.jpg') }}"
                            style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="h-100 d-flex flex-column justify-content-center p-5">
                        <h1 class="mb-4">Become A Teacher</h1>
                        <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam
                            amet diam et eos.
                            Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore
                            erat amet
                        </p>
                        <a class="btn btn-primary py-3 px-5" href="">Get Started Now<i
                                class="fa fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Call To Action End -->


<!-- Classes Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">
                Layanan Kami
            </h1>
            <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit
                eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="classes-item">
                    <div class="bg-light rounded-circle w-75 mx-auto p-3">
                        <img class="img-fluid rounded-circle" src="{{ asset('frontend/img/layanan-1.jpg') }}" alt="">
                    </div>
                    <div class="bg-light rounded p-4 pt-5 mt-n5">
                        <a class="d-block text-center h3 mt-3 mb-4" href="">Art & Drawing</a>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset('frontend/img/user.jpg') }}" alt=""
                                    style="width: 45px; height: 45px;">
                                <div class="ms-3">
                                    <h6 class="text-primary mb-1">Jhon Doe</h6>
                                    <small>Teacher</small>
                                </div>
                            </div>
                            <span class="bg-primary text-white rounded-pill py-2 px-3" href="">$99</span>
                        </div>
                        <div class="row g-1">
                            <div class="col-4">
                                <div class="border-top border-3 border-primary pt-2">
                                    <h6 class="text-primary mb-1">Age:</h6>
                                    <small>3-5 Years</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-top border-3 border-success pt-2">
                                    <h6 class="text-success mb-1">Time:</h6>
                                    <small>9-10 AM</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-top border-3 border-warning pt-2">
                                    <h6 class="text-warning mb-1">Capacity:</h6>
                                    <small>30 Kids</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="classes-item">
                    <div class="bg-light rounded-circle w-75 mx-auto p-3">
                        <img class="img-fluid rounded-circle" src="{{ asset('frontend/img/layanan-2.jpg') }}" alt="">
                    </div>
                    <div class="bg-light rounded p-4 pt-5 mt-n5">
                        <a class="d-block text-center h3 mt-3 mb-4" href="">Color Management</a>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset('frontend/img/user.jpg') }}" alt=""
                                    style="width: 45px; height: 45px;">
                                <div class="ms-3">
                                    <h6 class="text-primary mb-1">Jhon Doe</h6>
                                    <small>Teacher</small>
                                </div>
                            </div>
                            <span class="bg-primary text-white rounded-pill py-2 px-3" href="">$99</span>
                        </div>
                        <div class="row g-1">
                            <div class="col-4">
                                <div class="border-top border-3 border-primary pt-2">
                                    <h6 class="text-primary mb-1">Age:</h6>
                                    <small>3-5 Years</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-top border-3 border-success pt-2">
                                    <h6 class="text-success mb-1">Time:</h6>
                                    <small>9-10 AM</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-top border-3 border-warning pt-2">
                                    <h6 class="text-warning mb-1">Capacity:</h6>
                                    <small>30 Kids</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="classes-item">
                    <div class="bg-light rounded-circle w-75 mx-auto p-3">
                        <img class="img-fluid rounded-circle" src="{{ asset('frontend/img/layanan-1.jpg') }}" alt="">
                    </div>
                    <div class="bg-light rounded p-4 pt-5 mt-n5">
                        <a class="d-block text-center h3 mt-3 mb-4" href="">Athletic & Dance</a>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset('frontend/img/user.jpg') }}" alt=""
                                    style="width: 45px; height: 45px;">
                                <div class="ms-3">
                                    <h6 class="text-primary mb-1">Jhon Doe</h6>
                                    <small>Teacher</small>
                                </div>
                            </div>
                            <span class="bg-primary text-white rounded-pill py-2 px-3" href="">$99</span>
                        </div>
                        <div class="row g-1">
                            <div class="col-4">
                                <div class="border-top border-3 border-primary pt-2">
                                    <h6 class="text-primary mb-1">Age:</h6>
                                    <small>3-5 Years</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-top border-3 border-success pt-2">
                                    <h6 class="text-success mb-1">Time:</h6>
                                    <small>9-10 AM</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-top border-3 border-warning pt-2">
                                    <h6 class="text-warning mb-1">Capacity:</h6>
                                    <small>30 Kids</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="classes-item">
                    <div class="bg-light rounded-circle w-75 mx-auto p-3">
                        <img class="img-fluid rounded-circle" src="{{ asset('frontend/img/layanan-2.jpg') }}" alt="">
                    </div>
                    <div class="bg-light rounded p-4 pt-5 mt-n5">
                        <a class="d-block text-center h3 mt-3 mb-4" href="">Language & Speaking</a>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset('frontend/img/user.jpg') }}" alt=""
                                    style="width: 45px; height: 45px;">
                                <div class="ms-3">
                                    <h6 class="text-primary mb-1">Jhon Doe</h6>
                                    <small>Teacher</small>
                                </div>
                            </div>
                            <span class="bg-primary text-white rounded-pill py-2 px-3" href="">$99</span>
                        </div>
                        <div class="row g-1">
                            <div class="col-4">
                                <div class="border-top border-3 border-primary pt-2">
                                    <h6 class="text-primary mb-1">Age:</h6>
                                    <small>3-5 Years</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-top border-3 border-success pt-2">
                                    <h6 class="text-success mb-1">Time:</h6>
                                    <small>9-10 AM</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-top border-3 border-warning pt-2">
                                    <h6 class="text-warning mb-1">Capacity:</h6>
                                    <small>30 Kids</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="classes-item">
                    <div class="bg-light rounded-circle w-75 mx-auto p-3">
                        <img class="img-fluid rounded-circle" src="{{ asset('frontend/img/layanan-1.jpg') }}" alt="">
                    </div>
                    <div class="bg-light rounded p-4 pt-5 mt-n5">
                        <a class="d-block text-center h3 mt-3 mb-4" href="">Religion & History</a>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset('frontend/img/user.jpg') }}" alt=""
                                    style="width: 45px; height: 45px;">
                                <div class="ms-3">
                                    <h6 class="text-primary mb-1">Jhon Doe</h6>
                                    <small>Teacher</small>
                                </div>
                            </div>
                            <span class="bg-primary text-white rounded-pill py-2 px-3" href="">$99</span>
                        </div>
                        <div class="row g-1">
                            <div class="col-4">
                                <div class="border-top border-3 border-primary pt-2">
                                    <h6 class="text-primary mb-1">Age:</h6>
                                    <small>3-5 Years</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-top border-3 border-success pt-2">
                                    <h6 class="text-success mb-1">Time:</h6>
                                    <small>9-10 AM</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-top border-3 border-warning pt-2">
                                    <h6 class="text-warning mb-1">Capacity:</h6>
                                    <small>30 Kids</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="classes-item">
                    <div class="bg-light rounded-circle w-75 mx-auto p-3">
                        <img class="img-fluid rounded-circle" src="{{ asset('frontend/img/layanan-2.jpg') }}" alt="">
                    </div>
                    <div class="bg-light rounded p-4 pt-5 mt-n5">
                        <a class="d-block text-center h3 mt-3 mb-4" href="">General Knowledge</a>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset('frontend/img/user.jpg') }}" alt=""
                                    style="width: 45px; height: 45px;">
                                <div class="ms-3">
                                    <h6 class="text-primary mb-1">Jhon Doe</h6>
                                    <small>Teacher</small>
                                </div>
                            </div>
                            <span class="bg-primary text-white rounded-pill py-2 px-3" href="">$99</span>
                        </div>
                        <div class="row g-1">
                            <div class="col-4">
                                <div class="border-top border-3 border-primary pt-2">
                                    <h6 class="text-primary mb-1">Age:</h6>
                                    <small>3-5 Years</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-top border-3 border-success pt-2">
                                    <h6 class="text-success mb-1">Time:</h6>
                                    <small>9-10 AM</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-top border-3 border-warning pt-2">
                                    <h6 class="text-warning mb-1">Capacity:</h6>
                                    <small>30 Kids</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Classes End -->

<!-- Testimonial Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">
                Testimonial
            </h1>
            <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit
                eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <div class="testimonial-item bg-light rounded p-5">
                <p class="fs-5">Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet
                    dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                <div class="d-flex align-items-center bg-white me-n5" style="border-radius: 50px 0 0 50px;">
                    <img class="img-fluid flex-shrink-0 rounded-circle" src="{{ asset('frontend/img/testimonial-1.jpg') }}"
                        style="width: 90px; height: 90px;">
                    <div class="ps-3">
                        <h3 class="mb-1">
                            Nama Kamu
                        </h3>
                        <span>Profession</span>
                    </div>
                    <i class="fa fa-quote-right fa-3x text-primary ms-auto d-none d-sm-flex"></i>
                </div>
            </div>
            <div class="testimonial-item bg-light rounded p-5">
                <p class="fs-5">Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet
                    dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                <div class="d-flex align-items-center bg-white me-n5" style="border-radius: 50px 0 0 50px;">
                    <img class="img-fluid flex-shrink-0 rounded-circle" src="{{ asset('frontend/img/testimonial-2.jpg') }}"
                        style="width: 90px; height: 90px;">
                    <div class="ps-3">
                        <h3 class="mb-1">
                            Nama Kamu
                        </h3>
                        <span>Profession</span>
                    </div>
                    <i class="fa fa-quote-right fa-3x text-primary ms-auto d-none d-sm-flex"></i>
                </div>
            </div>
            <div class="testimonial-item bg-light rounded p-5">
                <p class="fs-5">Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet
                    dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                <div class="d-flex align-items-center bg-white me-n5" style="border-radius: 50px 0 0 50px;">
                    <img class="img-fluid flex-shrink-0 rounded-circle" src="{{ asset('frontend/img/testimonial-3.jpg') }}"
                        style="width: 90px; height: 90px;">
                    <div class="ps-3">
                        <h3 class="mb-1">
                            Nama Kamu
                        </h3>
                        <span>Profession</span>
                    </div>
                    <i class="fa fa-quote-right fa-3x text-primary ms-auto d-none d-sm-flex"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->
@endsection
