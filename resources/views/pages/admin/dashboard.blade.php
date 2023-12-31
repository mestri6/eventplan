@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="row">
  <div class="col-md-4 stretch-card grid-margin">
    <div class="card bg-gradient-danger card-img-holder text-white">
      <div class="card-body">
        <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
        <h4 class="font-weight-normal mb-3">
          Transaksi
          <i class="mdi mdi-chart-line mdi-24px float-right"></i>
        </h4>
        <h2 class="mb-5">{{ $transaksi }}</h2>
      </div>
    </div>
  </div>
  <div class="col-md-4 stretch-card grid-margin">
    <div class="card bg-gradient-info card-img-holder text-white">
      <div class="card-body">
        <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
        <h4 class="font-weight-normal mb-3">
          Layanan
          <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
        </h4>
        <h2 class="mb-5">{{ $layanan }}</h2>
      </div>
    </div>
  </div>
  <div class="col-md-4 stretch-card grid-margin">
    <div class="card bg-gradient-success card-img-holder text-white">
      <div class="card-body">
        <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
        <h4 class="font-weight-normal mb-3">
          Pengguna
          <i class="mdi mdi-diamond mdi-24px float-right"></i>
        </h4>
        <h2 class="mb-5">
          {{ $pengguna }}
        </h2>
      </div>
    </div>
  </div>
</div>
</div>
</div>

@endsection