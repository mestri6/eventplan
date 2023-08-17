@extends('layouts.detail')

@section('content')
<div class="container">
    <div class="row p-3">
        <div class="col-12 col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Detail Layanan
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row p-3">
        <div class="col-md-6 mb-5">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner rounded" style="max-height: 340px; background-size: cover">
                    @foreach ($item->galleries as $key => $gallery)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ Storage::url($gallery->thumbnail) }}" class="d-block w-100" alt="galeri" />
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-md-6 product_data">
            <div class="d-flex name-store">
                <div class="flex-grow-1 ms-3 py-1">
                    <h3>
                        Dekorasi Pernikahan
                    </h3>
                </div>
                <div class="flex-grow-1 ms-3 py-1 text-end">
                    <h3>
                        <a href="">
                            <i class="bi bi-cart-plus"></i>
                        </a>
                    </h3>
                </div>
            </div>
            <div class="price mb-1 ms-3">
                <h4>
                    Rp. 1.000.000
                </h4>
            </div>
            <div class="deskripsi ms-3">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, qui! Porro ea consequatur debitis
                    perspiciatis, necessitatibus velit asperiores rerum magnam. Quia eos rem iure facilis beatae ipsum
                    temporibus numquam nam omnis optio at dolor enim est eius ullam minima blanditiis.
                </p>
            </div>
            <div class="checkout ms-3 mt-5">
                <a href="{{ route('cart') }}" class="btn btn-checkout">Pesan Sekarang</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-style')
<style>
    .container {
        margin-top: 100px;
    }

    .btn-checkout {
        background-color: #FE5D37;
        color: #fff;
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
        font-size: 16px;
    }

    .btn-checkout:hover {
        background-color: #ff6846;
        color: #fff;
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
        font-size: 16px;
    }
</style>
@endpush