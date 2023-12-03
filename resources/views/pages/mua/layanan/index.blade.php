@extends('layouts.app')

@section('title', 'Layanan mua')

@section('content')

<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('layanan-mua.create') }}" class="btn btn-primary">Tambah Layanan</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tb_layanan" class="table table-hover scroll-horizontal-vertical w-100">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Layanan</th>
                                <th>Harga</th>
                                <th>Gambar</th>
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
    $('#tb_layanan').DataTable({
        processing: true,
        serverSide: true,
        ordering: [[1, 'asc']],
        ajax: {
            url: "{!! url()->current() !!}",
        },
        columns: [
            { data: 'DT_RowIndex', name: 'id_layanan' },
            { data: 'nama_layanan', name: 'nama_layanan' },
            { data: 'harga', name: 'harga' },
            { data: 'thumbnail', name: 'thumbnail' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });
</script>
@endpush