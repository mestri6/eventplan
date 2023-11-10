@extends('layouts.app')

@section('title', 'Dashboard Customer')

@section('content')

<div class="row">
	<div class="col-12 col-md-6 stretch-card grid-margin">
		<div class="card bg-gradient-danger card-img-holder text-white">
			<div class="card-body">
				<img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
					alt="circle-image" />
				<h4 class="font-weight-normal mb-3">
					Total Transaksi
					<i class="mdi mdi-chart-line mdi-24px float-right"></i>
				</h4>
				<h2 class="mb-5">
					Rp. {{ number_format($totalTransaksi, 0, ',', '.') }}
				</h2>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-6 stretch-card grid-margin">
		<div class="card bg-gradient-info card-img-holder text-white">
			<div class="card-body">
				<img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
					alt="circle-image" />
				<h4 class="font-weight-normal mb-3">
					Total Order
					<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
				</h4>
				<h2 class="mb-5">
					{{ $totalOrder }}
				</h2>
			</div>
		</div>
	</div>
</div>

@endsection