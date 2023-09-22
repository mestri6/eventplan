@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')

<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tb_transaksi" class="table table-hover scroll-horizontal-vertical w-100">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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