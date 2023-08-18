@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="text-center">
                    <img src="{{ asset('assets/images/success.svg') }}" class="img-fluid w-50 h-50" alt="">
                    <div class="description text-center">
                        <h1 class="text-success">Pembayaran Berhasil</h1>
                        <p class="card-text">Terima kasih telah melakukan pembayaran. Silahkan tunggu konfirmasi dari admin.</p>
                        <a href="{{ route('transaksi-customer.index') }}" class="btn btn-primary">Lihat Transaksi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

