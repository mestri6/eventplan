@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="text-center">
                    <img src="{{ asset('assets/images/success.svg') }}" class="img-fluid w-50 h-50" alt="">
                    <div class="description text-center">
                        <h2 class="text-success">Pembayaran Berhasil</h2>
                        <p class="card-text">
                            Terima kasih telah melakukan pembayaran. <br />
                            Silahkan upload bukti pembayaran pada detail menu transaksi, <br /> agar pembayaran dapat diverifikasi oleh admin.
                        </p>
                        <a href="{{ route('transaksi-customer.index') }}" class="btn btn-primary">Lihat Transaksi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

