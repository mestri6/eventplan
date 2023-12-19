@extends('layouts.app')
@section('title', 'Edit Layanan')

@section('content')

<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('layanan-mua.update', $item->id_layanan) }}" method="POST"
                    enctype="multipart/form-data" id="form-layanan">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="nama_layanan">Nama Layanan</label>
                                <input type="text" name="nama_layanan" id="nama_layanan" class="form-control"
                                    value="{{ $item->nama_layanan }}">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input name="harga" id="harga" class="form-control" value="{{ $item->harga }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3" id="gambarLama">
                        @forelse ($gallery as $item)
                        <div class="col-6 col-md-3 mb-3">
                            <figure class="figure gallery-container mb-3">
                                <img src="{{ Storage::url($item->thumbnail) }}"
                                    class="w-100 img-fluid figure-img img-thumbnail" alt="" />
                                <a href="javascript:void(0)" onclick="hapusGambar({{ $item->id_galeri_layanan }});"
                                    class="delete-gallery">
                                    <img src="{{ asset('assets/images/ic_delete.svg') }}" class="img-fluid w-75 h-75"
                                        alt="icon-delete" />
                                </a>
                            </figure>
                        </div>
                        @empty
                        <div class="col-md-12 mb-3">
                            <div class="text-center">
                                <p>
                                    Anda belum memiliki gambar untuk layanan ini.
                                </p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-lg-3">
                            <div class="w-100 img-fluid" id="preview-thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail</label>
                                <input type="file" name="thumbnail[]" id="thumbnail" class="form-control" multiple>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="deskripsi">Isi Deskripsi Layanan</label>
                                <textarea name="deskripsi" class="ckeditor form-control">
                                    {{ $item->deskripsi }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-flex">
                        <a href="{{ route('layanan-mua.index') }}" class="btn btn-danger col">Batal</a>
                        <button type="submit" class="btn btn-primary col" id="btnSave">Update</button>
                    </div>
                </form>
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

    $('#harga').val(formatRupiah($('#harga').val(), 'Rp. '));

    $('#form-layanan').on('submit', function() {
        $('#btnSave').attr('disabled', 'disabled');
        $('#btnSave').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...');
    });

    // untuk menampilkan thumbnail
    if ($('#thumbnail').length > 0) {
        $('#thumbnail').change(function () {
            var total_file = document.getElementById("thumbnail").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#preview-thumbnail').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "' class='img-thumbnail' style='max-height: 200px' />");
            }
        });
    }

    // script ini digunakan untuk menghapus preview thumbnail
    if ($('#preview-thumbnail').length > 0) {
        $('#preview-thumbnail').on('click', '.img-thumbnail', function () {
            $(this).remove();
            $('#thumbnail').val('');
        });
    }

    function hapusGambar(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Gambar yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus gambar!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('/mua/layanan-mua/delete-gallery') }}/" + id,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: "DELETE",
                    },
                    success: function (response) {
                        Swal.fire(
                            'Terhapus!',
                            'Gambar berhasil dihapus.',
                            'success'
                        );
                        $('#gambarLama').load(document.URL + ' #gambarLama');
                    }
                });
            }
        });
    }

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

@push('after-style')
<style>
    .gallery-container {
        position: relative;
    }

    .gallery-container .delete-gallery {
        position: absolute;
        top: 0;
        right: 0;
        z-index: 1;
        transform: translate(25%, -25%);
    }
</style>
@endpush