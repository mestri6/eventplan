@extends('layouts.app')

@section('title', 'Akun')

@section('content')
<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Akun</h4>
            </div>
            <form action="{{ route('akun-admin.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data" id="form-akun">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-12 text-center">
                            <div class="profile mb-5">
                                <img src="{{ Storage::url($item->foto_profile) }}" class="img-fluid w-25 h-25" alt="Foto Profil">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="name" id="nama" value="{{ $item->name }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ $item->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="no_wa">Nomor WA (Aktif)</label>
                                <input type="number" class="form-control" name="no_wa" id="no_wa" value="{{ $item->no_wa }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="foto_profile">Foto Profile</label>
                                <input type="file" class="form-control" name="foto_profile" id="foto_profile">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" value="{{ $item->alamat }}">
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-flex">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary col">Batal</a>
                        <button type="submit" class="btn btn-gradient-primary col" id="btnSave">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('after-script')
<script>
    $('#form-akun').on('submit', function() {
        $('#btnSave').attr('disabled', 'disabled');
        $('#btnSave').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Menyimpan...');
    });
</script>
@endpush