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
                            @guest
                                <a href="{{ route('register') }}" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">
                                    Daftar
                                </a>
                                <a href="{{ route('login') }}" class="btn btn-dark rounded-pill py-sm-3 px-sm-5 animated slideInRight">
                                    Masuk
                                </a>
                            @endguest

                            @auth
                                @if (Auth::user()->role == 'Admin')
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">
                                        Dashboard
                                    </a>
                                @elseif (Auth::user()->role == 'Wo')
                                    <a href="{{ route('wo.dashboard') }}" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">
                                        Dashboard
                                    </a>
                                @elseif (Auth::user()->role == 'Mua')
                                    <a href="{{ route('mua.dashboard') }}" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">
                                        Dashboard
                                    </a>    
                                @else
                                    <a href="{{ route('customer.dashboard') }}" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">
                                        Dashboard
                                    </a>
                                @endif
                            @endauth
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
                            @guest
                                <a href="{{ route('register') }}" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">
                                    Daftar
                                </a>
                                <a href="{{ route('login') }}" class="btn btn-dark rounded-pill py-sm-3 px-sm-5 animated slideInRight">
                                    Masuk
                                </a>
                            @endguest

                            @auth
                            @if (Auth::user()->role == 'Admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">
                                Dashboard
                            </a>
                            @elseif (Auth::user()->role == 'Wo')
                            <a href="{{ route('wo.dashboard') }}" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">
                                Dashboard
                            </a>
                            @elseif (Auth::user()->role == 'Mua')
                            <a href="{{ route('mua.dashboard') }}" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">
                                Dashboard
                            </a>
                            @else
                            <a href="{{ route('customer.dashboard') }}"
                                class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">
                                Dashboard
                            </a>
                            @endif
                            @endauth
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
                            @guest
                                <a href="{{ route('register') }}" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">
                                    Daftar
                                </a>
                                <a href="{{ route('login') }}" class="btn btn-dark rounded-pill py-sm-3 px-sm-5 animated slideInRight">
                                    Masuk
                                </a>
                            @endguest

                            @auth
                            @if (Auth::user()->role == 'Admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">
                                Dashboard
                            </a>
                            @elseif (Auth::user()->role == 'Wo')
                            <a href="{{ route('wo.dashboard') }}" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">
                                Dashboard
                            </a>
                            @elseif (Auth::user()->role == 'Mua')
                            <a href="{{ route('mua.dashboard') }}" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">
                                Dashboard
                            </a>
                            @else
                            <a href="{{ route('customer.dashboard') }}"
                                class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">
                                Dashboard
                            </a>
                            @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->

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
            @foreach ($layanan as $item)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="classes-item">
                        <div class="bg-light rounded-circle w-75 mx-auto p-3">
                            @if ($item->galleries->count())
                                <img class="img-fluid rounded-circle" src="{{ Storage::url($item->galleries->first()->thumbnail) }}" alt="">
                            @endif
                        </div>
                        <div class="bg-light rounded p-4 pt-5 mt-n5">
                            @foreach ($cekId as $cekLayanan)
                                @if ($item->id == $cekLayanan->layanan_id)
                                    <p class="d-block text-center h3 mt-3 mb-4" href="#">
                                        {{ $item->nama_paket }}
                                    </p>
                                    @else
                                    <a class="d-block text-center h3 mt-3 mb-4" href="{{ route('detail', $item->slug) }}">
                                        {{ $item->nama_paket }}
                                    </a>
                                @endif
                            @endforeach
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle flex-shrink-0" src="{{ asset('frontend/img/user.jpg') }}" alt=""
                                        style="width: 45px; height: 45px;">
                                    <div class="ms-3">
                                        <h6 class="text-primary mb-1">
                                            {{ $item->user->name }}
                                        </h6>
                                    </div>
                                </div>
                                
                                @foreach ($cekId as $cekLayanan)
                                    @if ($item->id == $cekLayanan->layanan_id)
                                        <span class="bg-danger text-white rounded-pill py-2 px-3" href="">
                                            Sold Out
                                        </span>
                                        @else
                                        <span class="bg-primary text-white rounded-pill py-2 px-3" href="">
                                            Rp.{{ number_format($item->harga) }}
                                        </span>
                                        @endif
                                    @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
