@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')

<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('kategori.update', $data->id) }}" method="POST" enctype="multipart/form-data"
                    id="form-kategori">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="nama">Nama Kategori</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    value="{{ $data->nama }}">
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-flex">
                        <a href="{{ route('kategori.index') }}" class="btn btn-danger col">Batal</a>
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

    $('#form-kategori').on('submit', function() {
        $('#btnSave').attr('disabled', 'disabled');
        $('#btnSave').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...');
    });

</script>
@endpush