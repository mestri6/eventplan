<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<ul class="nav">
		<li class="nav-item nav-profile">
			@if (Auth::user()->role == 'Wo')
			<a href="{{ route('akun-wo.index') }}" class="nav-link">
				<div class="nav-profile-image">
					@if (Auth::user()->foto_profile == null)
					<img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="image" />
					@else
					<img src="{{ Storage::url(Auth::user()->foto_profile) }}" alt="image" />
					<span class="login-status online"></span>
					@endif
				</div>
				<div class="nav-profile-text d-flex flex-column">
					<span class="font-weight-bold mb-2">{{ Auth::user()->name ?? '' }}</span>
					@if (Auth::user()->role == 'Wo')
					<span class="text-secondary text-small">
						@if (Auth::user()->isOpen == 0)
						<i class="mdi mdi-account-check text-success"></i> Buka
						@else
						<i class="mdi mdi-account-off text-danger"></i> Tutup
						@endif
					</span>
					@elseif (Auth::user()->role == 'Mua')
					<span class="text-secondary text-small">
						@if (Auth::user()->isOpen == 0)
						<i class="mdi mdi-account-check text-success"></i> Buka
						@else
						<i class="mdi mdi-account-off text-danger"></i> Tutup
						@endif
					</span>
					@endif
				</div>
				<i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
			</a>
			@endif

			@if (Auth::user()->role == 'Mua')
			<a href="{{ route('akun-mua.index') }}" class="nav-link">
				<div class="nav-profile-image">
					@if (Auth::user()->foto_profile == null)
					<img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="image" />
					@else
					<img src="{{ Storage::url(Auth::user()->foto_profile) }}" alt="image" />
					<span class="login-status online"></span>
					@endif
				</div>
				<div class="nav-profile-text d-flex flex-column">
					<span class="font-weight-bold mb-2">{{ Auth::user()->name ?? '' }}</span>
					@if (Auth::user()->role == 'Wo')
					<span class="text-secondary text-small">
						@if (Auth::user()->isOpen == 0)
						<i class="mdi mdi-account-check text-success"></i> Buka
						@else
						<i class="mdi mdi-account-off text-danger"></i> Tutup
						@endif
					</span>
					@elseif (Auth::user()->role == 'Mua')
					<span class="text-secondary text-small">
						@if (Auth::user()->isOpen == 0)
						<i class="mdi mdi-account-check text-success"></i> Buka
						@else
						<i class="mdi mdi-account-off text-danger"></i> Tutup
						@endif
					</span>
					@endif
				</div>
				<i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
			</a>
			@endif

			@if (Auth::user()->role == 'Customer' && Auth::user()->role == 'Admin')
			<a href="#" class="nav-link">
				<div class="nav-profile-image">
					@if (Auth::user()->foto_profile == null)
					<img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="image" />
					@else
					<img src="{{ Storage::url(Auth::user()->foto_profile) }}" alt="image" />
					<span class="login-status online"></span>
					@endif
				</div>
				<div class="nav-profile-text d-flex flex-column">
					<span class="font-weight-bold mb-2">{{ Auth::user()->name ?? '' }}</span>
					<span class="text-secondary text-small">
						{{ Auth::user()->role }}
					</span>
				</div>
				<i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
			</a>
			@endif
		</li>





		@if (Auth::user()->role == 'Admin')
		<li class="nav-item">
			<a class="nav-link {{ (request()->is('admin/dashboard') ? 'active' : '') }}"
				href="{{ route('admin.dashboard') }}">
				<span class="menu-title">Dashboard</span>
				<i class="mdi mdi-home menu-icon"></i>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ (request()->is('admin/verifikasi') ? 'active' : '') }}"
				href="{{ route('admin.table-pengguna') }}">
				<span class="menu-title">Verifikasi Pengguna</span>
				<i class="mdi mdi-account-check menu-icon"></i>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ (request()->is('admin/kategori') ? 'active' : '') }}"
				href="{{ route('kategori.index') }}">
				<span class="menu-title">Kategori Layanan</span>
				<i class="mdi mdi-home menu-icon"></i>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ (request()->is('admin/transaksi') ? 'active' : '') }}"
				href="{{ route('transaksi-admin.index') }}">
				<span class="menu-title">Transaksi</span>
				<i class="mdi mdi-credit-card-multiple menu-icon"></i>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link {{ (request()->is('admin/akun') ? 'active' : '') }}"
				href="{{ route('akun-admin.index') }}">
				<span class="menu-title">Akun</span>
				<i class="mdi mdi-face-profile menu-icon"></i>
			</a>
		</li>

		<li class="nav-item sidebar-actions">
			<span class="nav-link d-grid">
				<form action="{{ route('logout') }}" method="POST">
					@csrf
					<button type="submit" class="btn btn-block col btn-lg btn-gradient-primary mt-4">
						Keluar
					</button>
				</form>
			</span>
		</li>
		@endif





		@if (Auth::user()->role == 'Wo')
		<li class="nav-item">
			<a class="nav-link {{ (request()->is('wo/dashboard') ? 'active' : '') }}"
				href="{{ route('wo.dashboard') }}">
				<span class="menu-title">Dashboard</span>
				<i class="mdi mdi-home menu-icon"></i>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ (request()->is('wo/layanan-wo') ? 'active' : '') }}"
				href="{{ route('layanan-wo.index') }}">
				<span class="menu-title">Layanan</span>
				<i class="mdi mdi-file-image menu-icon"></i>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ (request()->is('wo/transaksi-wo') ? 'active' : '') }}"
				href="{{ route('transaksi-wo.index') }}">
				<span class="menu-title">Transaksi</span>
				<i class="mdi mdi-credit-card-multiple menu-icon"></i>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ (request()->is('wo/jadwal') ? 'active' : '') }}" href="{{ route('jadwal-wo.index') }}">
				<span class="menu-title">Jadwal</span>
				<i class="mdi mdi-calendar-clock menu-icon"></i>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ (request()->is('wo/akun') ? 'active' : '') }}" href="{{ route('akun-wo.index') }}">
				<span class="menu-title">Akun</span>
				<i class="mdi mdi-face-profile menu-icon"></i>
			</a>
		</li>
		<li class="nav-item sidebar-actions">
			<span class="nav-link d-grid">
				<form action="{{ route('logout') }}" method="POST">
					@csrf
					<button type="submit" class="btn btn-block col btn-lg btn-gradient-primary mt-4">
						Keluar
					</button>
				</form>
			</span>
		</li>





		@elseif (Auth::user()->role == 'Mua')
		<li class="nav-item">
			<a class="nav-link {{ (request()->is('mua/dashboard') ? 'active' : '') }}"
				href="{{ route('mua.dashboard') }}">
				<span class="menu-title">Dashboard</span>
				<i class="mdi mdi-home menu-icon"></i>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ (request()->is('mua/layanan-mua') ? 'active' : '') }}"
				href="{{ route('layanan-mua.index') }}">
				<span class="menu-title">Layanan</span>
				<i class="mdi mdi-file-image menu-icon"></i>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link {{ (request()->is('mua/transaksi-mua') ? 'active' : '') }}"
				href="{{ route('transaksi-mua.index') }}">
				<span class="menu-title">Transaksi</span>
				<i class="mdi mdi-credit-card-multiple menu-icon"></i>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link {{ (request()->is('mua/jadwal') ? 'active' : '') }}" href="{{ route('jadwal-mua.index') }}">
				<span class="menu-title">Jadwal</span>
				<i class="mdi mdi-calendar-clock menu-icon"></i>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link {{ (request()->is('mua/akun') ? 'active' : '') }}" href="{{ route('akun-mua.index') }}">
				<span class="menu-title">Akun</span>
				<i class="mdi mdi-face-profile menu-icon"></i>
			</a>
		</li>
		<li class="nav-item sidebar-actions">
			<span class="nav-link d-grid">
				<form action="{{ route('logout') }}" method="POST">
					@csrf
					<button type="submit" class="btn btn-block col btn-lg btn-gradient-primary mt-4">
						Keluar
					</button>
				</form>
			</span>
		</li>



		@elseif (Auth::user()->role == 'Customer')
		<li class="nav-item">
			<a class="nav-link {{ request()->is('customer/dashboard') ? 'active' : '' }}"
				href="{{ route('customer.dashboard') }}">
				<span class="menu-title">Dashboard</span>
				<i class="mdi mdi-home menu-icon"></i>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link {{ request()->is('customer/transaksi-customer/') ? 'active' : '' }}"
				href="{{ route('transaksi-customer.index') }}">
				<span class="menu-title">Transaksi</span>
				<i class="mdi mdi-credit-card-multiple menu-icon"></i>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link {{ (request()->is('customer/akun') ? 'active' : '') }}"
				href="{{ route('akun-customer.index') }}">
				<span class="menu-title">Akun</span>
				<i class="mdi mdi-face-profile menu-icon"></i>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link {{ (request()->is('customer/akun/upgrade') ? 'active' : '') }}"
				href="{{ route('customer.upgrade') }}">
				<span class="menu-title">Upgrade Akun</span>
				<i class="mdi mdi-account-check menu-icon"></i>
			</a>
		</li>

		<li class="nav-item sidebar-actions">
			<span class="nav-link d-grid text-center">
				<form action="{{ route('logout') }}" method="POST">
					@csrf
					<button type="submit" class="btn btn-block col btn-lg btn-gradient-primary mt-4">
						Keluar
					</button>
				</form>
			</span>
		</li>

		@endif

	</ul>
</nav>