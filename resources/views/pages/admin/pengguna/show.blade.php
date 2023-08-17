@extends('layouts.app')

@section('title', 'Upgrade Akun')

@section('content')
<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="form-group">
                            <label>Nama Usaha</label>
                            <input type="text" class="form-control" value="{{ $item->nama_usaha }}" readonly />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="form-group">
                            <label>Nomor Wa (Aktif)</label>
                            <input type="number" class="form-control" value="{{ $item->no_wa }}" readonly />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="form-group">
                            <label>Kategori Akun</label>
                            <input type="text" class="form-control" value="{{ $item->kategori->nama }}" readonly />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label>Foto KTP</label>
                            <figure class="figure">
                                <img src="{{ Storage::url($item->foto_ktp) }}" class="img-fluid figure-img w-100"
                                    alt="Foto KTP">
                            </figure>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label>Foto Profile</label>
                            <figure class="figure">
                                <img src="{{ Storage::url($item->foto_profile) }}" class="img-fluid figure-img w-100"
                                    alt="Foto KTP">
                            </figure>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label>Foto Usaha</label>
                            <figure class="figure">
                                <img src="{{ Storage::url($item->foto_usaha) }}" class="img-fluid figure-img w-100"
                                    alt="Foto KTP">
                            </figure>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label>Surat RT / RW</label>
                            <figure class="figure">
                                <img src="{{ Storage::url($item->surat_rtrw) }}" class="img-fluid figure-img w-100"
                                    alt="Foto KTP">
                            </figure>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-3 d-flex">
                    <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary col">Batal</a>
                    <button type="button" class="btn btn-danger col"
                        onclick="tolakPengguna({{ $item->id }})">Tolak</button>
                    <form action="{{ route('admin.tolak-pengguna') }}" method="POST">
                        @csrf
                    </form>
                    <form action="{{ route('admin.verif-pengguna') }}" method="POST" id="form-verifikasi">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $item->id }}">
                        <button type="submit" class="btn btn-primary btn-block col w-full"
                            id="btnSave">Verifikasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk tolak pengguna -->
<div class="modal fade" id="tolakPenggunaModal" tabindex="-1" aria-labelledby="tolakPenggunaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tolakPenggunaModalLabel">Tolak Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.tolak-pengguna') }}" method="POST" id="form-tolak-pengguna">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $item->id }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="alasan_penolakan">Alasan Penolakan</label>
                                <textarea name="alasan_penolakan" id="alasan_penolakan" class="form-control"
                                    required>
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnTolak">Tolak Pengguna</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('after-script')

<script>
    function tolakPengguna(id){
        $('#tolakPenggunaModal').modal('show');
    }
</script>

<script>
    // digunakan untuk memberikan effect loading pada button simpan ketika akan di simpan datanya
    $('#form-verifikasi').on('submit', function() {
        $('#btnSave').attr('disabled', 'disabled');
        $('#btnSave').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...');
    });

    $('#form-tolak-pengguna').on('submit', function() {
        $('#btnTolak').attr('disabled', 'disabled');
        $('#btnTolak').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...');
    });
</script>
@endpush