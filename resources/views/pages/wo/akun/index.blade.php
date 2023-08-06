@extends('layouts.app')

@section('title', 'Akun Wo')

@section('content')

<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                
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
            { data: 'DT_RowIndex', name: 'id' },
            { data: 'nama_paket', name: 'nama_paket' },
            { data: 'harga', name: 'harga' },
            { data: 'thumbnail', name: 'thumbnail' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });
</script>
@endpush