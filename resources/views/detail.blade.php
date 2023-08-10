@extends('layouts.detail')

@section('content')
<div class="container">
    <div class="row">
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
    <div class="row">
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
                <div class="flex-shrink-0">
                    <img src="{{ url('/images/ic_store.svg') }}" class="img-fluid" alt="" />
                </div>
                <div class="flex-grow-1 ms-3 py-1">
                    <h3>
                        Dekorasi Pernikahan
                    </h3>
                </div>
            </div>
            <div class="rating-product mb-1 ms-3">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <div class="deskripsi ms-3">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, qui! Porro ea consequatur debitis
                    perspiciatis, necessitatibus velit asperiores rerum magnam. Quia eos rem iure facilis beatae ipsum
                    temporibus numquam nam omnis optio at dolor enim est eius ullam minima blanditiis, quo esse cumque
                    suscipit? Quasi itaque ipsa esse? Officia, vero atque. Commodi nisi voluptatum sit nihil blanditiis
                    quam, dolore eaque nobis aperiam ipsam recusandae dignissimos placeat. Deleniti veniam fuga adipisci
                    maiores, magnam temporibus amet nemo consequatur ducimus officiis doloremque nulla.
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12">
            <h3></h3>
        </div>
    </div>
</div>
@endsection

@push('after-style')
<style>
    .container {
        margin-top: 100px;
    }
</style>
@endpush