@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')

<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="form-group">
                            <label for="nama">Nama Pemesan</label>
                            <input type="text" class="form-control" value="{{ $item->user->name }}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-lg-12">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Acara</label>
                            <input type="text" class="form-control" value="{{ $item->tanggal_acara }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-12">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" rows="3" readonly>{{ $item->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="col-12 col-lg-12">
                        <div class="form-group">
                            <img src="{{ Storage::url($item->bukti_pembayaran) }}" class="img-fluid w-100" alt="Bukti Pembayaran">
                        </div>
                    </div>
                    <div class="d-grid gap-1">
                        <a href="{{ route('transaksi-mua.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('after-script')
<script>
    $('#tb_transaksi').DataTable({
        processing: true,
        serverSide: true,
        ordering: [[1, 'asc']],
        ajax: {
            url: "{!! url()->current() !!}",
        },
        columns: [
            { data: 'DT_RowIndex', name: 'id' },
            { data: 'users_id', name: 'users_id' },
            { data: 'status_pembayaran', name: 'status_pembayaran' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });
</script>
@endpush