@extends('layouts.app')

@section('title', 'Verifikasi Pengguna')

@section('content')

<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">
               <div class="table-responsive">
                    <table id="tb_pengguna" class="table table-hover scroll-horizontal-vertical w-100">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pemilik</th>
                                <th>Nama Usaha</th>
                                <th>Tanggal Pengajuan</th>
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
    $('#tb_pengguna').DataTable({
        processing: true,
        serverSide: true,
        ordering: [[1, 'asc']],
        ajax: {
            url: "{!! url()->current() !!}",
        },
        columns: [
            { data: 'DT_RowIndex', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'nama_usaha', name: 'nama_usaha' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });
</script>
@endpush