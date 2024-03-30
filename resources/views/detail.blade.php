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
                        {{ $item->nama_layanan }}
                    </h3>
                </div>
                <div class="flex-grow-1 ms-3 py-1 text-end">
                    <h3>
                        <form action="{{ route('cart-add', $item->id_layanan) }}" method="POST">
                            @csrf
                            @auth
                            @if ($item->user->id == Auth::user()->id)
                            <button class="btn btn-checkout" disabled>
                                <i class="bi bi-cart-plus"></i>
                            </button>
                            @else
                            @if ($item->user->isOpen == 1)
                            <span>
                                <span class="badge bg-danger">Toko sedang tutup</span>
                            </span>
                            @else
                            <button type="submit" class="btn btn-checkout">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                            @endif
                            @endif
                            @endauth
                            @guest
                            <a href="{{ route('login') }}" class="btn btn-checkout">
                                <i class="bi bi-cart-plus"></i>
                            </a>
                            @endguest
                        </form>
                    </h3>
                </div>
            </div>
            <div class="price mb-1 ms-3">
                <h4>
                    Rp. {{ number_format($item->harga) }}
                </h4>
            </div>
            <div class="deskripsi ms-3">
                <p>
                    {!! $item->deskripsi !!}
                </p>
            </div>
            <div class="checkout ms-3 mt-5">
                <form action="{{ route('cart-add', $item->id_layanan) }}" method="POST">
                    @csrf
                    @auth
                    @if ($item->user->id == Auth::user()->id)
                    <button class="btn btn-checkout" disabled>
                        Pesan Sekarang
                    </button>
                    @else
                    @if ($item->user->isOpen == 1)
                    <span>
                    </span>
                    @else
                    <button type="submit" class="btn btn-checkout">
                        Pesan Sekarang
                    </button>
                    @endif
                    @endif
                    @endauth
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-checkout">
                        Pesan Sekarang
                    </a>
                    @endguest
                </form>
            </div>
        </div>
    </div>
    <div class="row p-3 mt-5">
        <div class="col-12 col-lg-12">
            <div class="title mb-4">
                <h3>Detail Booking</h3>
            </div>
        </div>
        <div class="col-12 col-lg-12">
            <div class="table-responsive">
                <table id="tb_list_pesanan" class="table table-hover scroll-horizontal-vertical w-100">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Nama Item</th>
                            <th>Harga</th>
                            <th>Tanggal Booking</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-script')
<script>
    $('#tb_list_pesanan').DataTable({
        processing: true,
        serverSide: true,
        ordering: [[1, 'asc']],
        ajax: {
            url: "{!! url()->current() !!}",
        },
        columns: [
            { data: 'DT_RowIndex', name: 'id_keranjang' },
            { data: 'id_user', name: 'id_user' },
            { data: 'id_layanan', name: 'id_layanan' },
            { data: 'total_harga', name: 'total_harga' },
            { data: 'tanggal_acara', name: 'tanggal_acara' },
        ],
    });
</script>
@endpush

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