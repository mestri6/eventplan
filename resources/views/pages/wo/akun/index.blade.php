@extends('layouts.app')

@section('title', 'Akun')

@section('content')
<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Akun</h4>
                @if ($item->isOpen == 0)
                <button class="btn btn-danger" onclick="handleToko({{ $item->isOpen }})" id="btnTutupToko">
                    Tutup Toko
                </button>
                @else
                <button class="btn btn-success" onclick="handleToko({{ $item->isOpen }})" id="btnBukaToko">
                    Buka Toko
                </button>
                @endif
            </div>
            <form action="{{ route('akun-wo.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data"
                id="form-akun">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-12 text-center">
                            <div class="profile mb-5">
                                <img src="{{ Storage::url($item->foto_profile) }}" class="img-fluid w-25 h-25"
                                    alt="Foto Profil">
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
                                <input type="email" class="form-control" name="email" id="email"
                                    value="{{ $item->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="no_wa">Nomor WA (Aktif)</label>
                                <input type="number" class="form-control" name="no_wa" id="no_wa"
                                    value="{{ $item->no_wa }}">
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
                                <input type="text" class="form-control" name="alamat" id="alamat"
                                    value="{{ $item->alamat }}">
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-flex">
                        <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary col">Batal</a>
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

    function handleToko(isOpen) {
        let message = isOpen == 1 ? 'buka' : 'tutup';
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Toko ini akan di " + message + "!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, ' + message + '!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('wo.handle-toko') }}",
                    type: "PUT",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        window.location.reload();
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Gagal!',
                            'Toko gagal di tutup.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>
@endpush