@extends('layouts.app')

@section('title', 'MUA - Jadwal')

@section('content')

<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Jadwal</h4>
                <button class="btn btn-primary" onclick="tambahData()">
                    Tambah
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tb_jadwal" class="table table-hover scroll-horizontal-vertical w-100">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal Libur</th>
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

<div class="modal fade" id="jadwalModal" tabindex="-1" aria-labelledby="jadwalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jadwalModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control text-white" name="id" id="id" readonly>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="tanggal" class="form-label">Tanggal Libur</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal">
                                <div class="invalid-feedback" id="tanggal-feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="btnSave">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('after-script')
<script>
    function tambahData() {
        $('#jadwalModal').modal('show');
        $('#jadwalModalLabel').html('Tambah Jadwal');
        $('#tanggal').val('');
        $('#tanggal-feedback').html('');
        $('#btnSave').html('Simpan');
        $('#btnSave').attr('disabled', false);
        $('#id').val('');
    }

    function editData(id) {
        $('#jadwalModal').modal('show');
        $('#jadwalModalLabel').html('Edit Jadwal');
        $('#tanggal').val('');
        $('#tanggal-feedback').html('');
        $('#btnSave').html('Edit');
        $('#btnSave').attr('disabled', false);
        $('#id').val(id);

        $.ajax({
            url: "{{ route('jadwal-mua-show') }}",
            type: 'GET',
            data: {
                'id': id
            },
            success: function(response) {
                $('#tanggal').val(response.tanggal);
            }
        });
    }

    function hapusData(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('jadwal-mua-destroy') }}",
                    type: 'DELETE',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': id
                    },
                    success: function(response) {
                        Swal.fire(
                            'Terhapus!',
                            'Data berhasil dihapus.',
                            'success'
                        );
                        $('#tb_jadwal').DataTable().ajax.reload();
                    }
                });
            }
        });
    }

    $('#form-data').submit(function(e) {
        e.preventDefault();

        $('#tanggal-feedback').html('');

        $.ajax({
            url: "{{ route('jadwal-mua.store') }}",
            type: 'POST',
            data: $(this).serialize(),
            beforeSend: function() {
                $('#btnSave').attr('disabled', true);
                $('#btnSave').html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...');
            },
            success: function(response) {
                $('#tb_jadwal').DataTable().ajax.reload();
                $('#jadwalModal').modal('hide');
            },
            error: function(xhr) {
                var res = xhr.responseJSON;

                if ($.isEmptyObject(res) == false) {
                    $.each(res.errors, function(key, value) {
                        $('#' + key + '-feedback').html(value);
                    });
                }
            }
        });
    });
</script>
<script>
    $('#tb_jadwal').DataTable({
        processing: true,
        serverSide: true,
        ordering: [[1, 'asc']],
        ajax: {
            url: "{!! url()->current() !!}",
        },
        columns: [
            { data: 'DT_RowIndex', name: 'id' },
            { data: 'tanggal', name: 'tanggal' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });
</script>
@endpush