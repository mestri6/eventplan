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
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
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
                        <form action="{{ route('customer.upload-pembayaran') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <div class="form-group">
                                <label for="alamat">Upload Bukti Pembayaran</label>
                                <input type="file" class="form-control" name="bukti_pembayaran">
                            </div>
                            <div class="d-grid gap-1 mt-5">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
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