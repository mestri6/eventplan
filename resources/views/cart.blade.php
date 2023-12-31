@extends('layouts.detail')

@section('content')
@include('includes.navbar')
<div class="container">
    <div class="row p-3">
        <div class="col-12 col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Keranjang
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row p-3">
        <div class="col-12 col-lg-12">
            <div class="table-responsive">
                <table id="tb_cart" class="table table-hover scroll-horizontal-vertical w-100">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Item</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <form action="{{ route('checkout') }}" id="form-checkout" method="POST">
        <div class="row mt-5">
            @csrf
            <div class="col-12 col-lg-12">
                <div class="title mb-4">
                    <h3>Detail Informasi</h3>
                </div>
            </div>
            <div class="col-12 col-lg-6 mb-3">
                <div class="form-group">
                    <label for="nama">Nama Pemesan</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Pemesan"
                        value="{{ Auth::user()->name }}" readonly>
                </div>
            </div>
            <div class="col-12 col-lg-6 mb-3">
                <div class="form-group">
                    <label for="nama">Tanggal Acara</label>
                    <input type="date" class="form-control" id="tanggal_acara" name="tanggal_acara"
                        placeholder="Masukkan Tanggal Acara">
                </div>
            </div>
            <div class="col-12 col-lg-12 mb-3">
                <div class="form-group">
                    <label for="nama">Detail Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3"
                        placeholder="Masukkan Detail Alamat"></textarea>
                </div>
            </div>
            <div class="col-12 col-lg-12 mb-3">
                <h4>
                    Total Pembayaran
                </h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Harga</th>
                            <td>Rp. {{ number_format($harga) }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Kode Unik</th>
                            <td>Rp. {{ $kodeUnik }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Nama Rekening</th>
                            <td>PT. Event Planner Bersama</td>
                        </tr>
                        <tr>
                            <th scope="row">Rekening Pembayaran</th>
                            <td>
                                1234567890 (BCA)
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Total Pembayaran</th>
                            <td><b class="text-success">Rp. {{ number_format($totalPembayaran) }}</b></td>
                        </tr>
                    </tbody>
                </table>
                <div class="notes">
                    <p>
                        <b>Catatan:</b> 
                        <br>
                        - Pembayaran dapat dilakukan melalui transfer ke rekening yang tertera di atas.
                        <br>
                        - Jika sudah melakukan pembayaran, silahkan upload bukti pembayaran pada halaman <a href="{{ route('transaksi-customer.index') }}">Riwayat Pemesanan</a>.
                        <br>
                        - Pembayaran akan diverifikasi oleh admin kami.
                    </p>
                </div>
            </div>
            <div class="d-grid mb-5 mt-5">
                <input type="hidden" name="total_pembayaran" value="{{ $totalPembayaran }}">
                <input type="hidden" name="kode_unik" value="{{ $kodeUnik }}">
                <button type="submit" class="btn btn-checkout" id="btnSubmit">Pesan Sekarang</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('after-script')

<script>
    function deleteCart(id){
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type:"DELETE",
                    url: "{{ url('hapus/cart') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id:id
                    },
                    beforeSend: function() {
                        $(".preloader").fadeIn();
                    },
                    success: function(res){
                        console.log(res);
                        $('#tb_cart').DataTable().ajax.reload();
                        Swal.fire(
                            'Terhapus!',
                            'Data berhasil dihapus.',
                            'success'
                        )
                    },
                    complete: function(){
                        $(".preloader").fadeOut();
                    }
                });
            }
        })
    }
</script>

<script>
    $('#tb_cart').DataTable({
        processing: true,
        serverSide: true,
        ordering: [[1, 'asc']],
        ajax: {
            url: "{!! url()->current() !!}",
        },
        columns: [
            { data: 'DT_RowIndex', name: 'id_keranjang' },
            { data: 'id_layanan', name: 'id_layanan' },
            { data: 'total_harga', name: 'total_harga' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });
</script>

{{-- <script>
        $('#form-checkout').submit(function(e){
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();
            $.ajax({
                type: method,
                url: url,
                data: data,
                beforeSend: function() {
                    $(".preloader").fadeIn();
                },
                success: function(res){
                    if(res.status == 'error'){
                        Swal.fire({
                            title: "Gagal!",
                            text: res.message,
                            icon: "error"
                        });
                    }else{
                        Swal.fire({
                            title: "Berhasil!",
                            text: res.message,
                            icon: "success"
                        }).then(function() {
                            window.location = "{{ route('transaksi-customer.index') }}";
                        });
                    }
                },
                complete: function(){
                    $(".preloader").fadeOut();
                }
            });
        });
</script> --}}

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