@extends('layouts.app')

@section('title', 'Layanan')

@section('content')

<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('layanan-wo.store') }}" method="POST" enctype="multipart/form-data"
                    id="form-layanan">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="nama_paket">Nama Layanan</label>
                                <input type="text" name="nama_paket" id="nama_paket" class="form-control"
                                    placeholder="Masukkan Nama Paket" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input name="harga" id="harga" class="form-control" placeholder="Masukan harga" required />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-lg-3">
                            <div class="w-100 img-fluid" id="preview-thumbnail"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail</label>
                                <input type="file" name="thumbnail[]" max="4" id="thumbnail" class="form-control" multiple required> 
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-flex">
                        <a href="{{ route('layanan-wo.index') }}" class="btn btn-danger col">Batal</a>
                        <button type="submit" class="btn btn-primary col" id="btnSave">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('after-script')
<script>
    // digunakan untuk memberikan effect loading pada button simpan ketika akan di simpan datanya
    $('#form-layanan').on('submit', function() {
        $('#btnSave').attr('disabled', 'disabled');
        $('#btnSave').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...');
    });

    $('#tb_layanan').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        dom: 'lBfrtip',
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: [
            {
            extend: 'copy',
            text: 'Copy',
            className: 'btn btn-primary',
            exportOptions: {
            columns: [1, 2, 3, 4]
            }
            },
            {
            extend: 'csv',
            text: 'CSV',
            className: 'btn btn-primary',
            exportOptions: {
            columns: [1, 2, 3, 4]
            }
            },
            {
            extend: 'excel',
            text: 'Excel',
            className: 'btn btn-primary',
            exportOptions: {
            columns: [1, 2, 3, 4]
            }
            },
            {
            extend: 'pdf',
            text: 'PDF',
            className: 'btn btn-primary',
            exportOptions: {
            columns: [1, 2, 3, 4]
            }
            },
            {
            extend: 'print',
            text: 'Print',
            className: 'btn btn-primary',
            exportOptions: {
            columns: [1, 2, 3, 4]
            }
            }
        ],
        ordering: [[1, 'asc']],
        ajax: {
            url: "{!! url()->current() !!}",
        },
        columns: [
            { data: 'DT_RowIndex', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });

    // script untuk menampilkan preview thumbnail
    if ($('#thumbnail').length > 0) {
        $('#thumbnail').change(function () {
            var total_file = document.getElementById("thumbnail").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#preview-thumbnail').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "' class='img-thumbnail' style='max-height: 200px' />");
            }
        });
    }

    // untuk menampilkan preview thumbnail

    // if ($('#thumbnail').length > 0) {
    //     $('#thumbnail').change(function () {
    //         var file = $(this)[0].files[0];
    //         if (file) {
    //             var reader = new FileReader();
    //             reader.onload = function (e) {
    //                 $('#preview-thumbnail').html(
    //                     '<img src="' + e.target.result + '" class="img-thumbnail" style="max-height: 200px" />'
    //                 );
    //             }
    //             reader.readAsDataURL(file);
    //         }
    //     });
    // }

    // untuk mengubah harga menjadi rupiah cth: Rp. 15.000.000
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   		= number_string.split(','),
            sisa     		= split[0].length % 3,
            rupiah     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
        
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    var rupiah = document.getElementById('harga');
    rupiah.addEventListener('keyup', function(e){
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
</script>
@endpush