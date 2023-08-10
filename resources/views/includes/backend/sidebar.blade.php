<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="{{ asset('assets/logo-eventplan.png') }}" alt="profile" />
          <span class="login-status online"></span>
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">{{ Auth::user()->name ?? '' }}</span>
          <span class="text-secondary text-small">{{ Auth::user()->role ?? '' }}</span>
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
      </a>
    </li>
    @if (Auth::user()->role == 'Wo')
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('wo/dashboard') ? 'active' : '') }}" href="{{ route('wo.dashboard') }}">
            <span class="menu-title">Dashboard</span>
            <i class="mdi mdi-home menu-icon"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('wo/layanan-wo') ? 'active' : '') }}" href="{{ route('layanan-wo.index') }}">
            <span class="menu-title">Layanan</span>
            <i class="mdi mdi-file-image menu-icon"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('wo/transaksi-wo') ? 'active' : '') }}" href="#">
            <span class="menu-title">Transaksi</span>
            <i class="mdi mdi-file-image menu-icon"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('wo/akun') ? 'active' : '') }}" href="{{ route('akun-wo.index') }}">
            <span class="menu-title">Akun</span>
            <i class="mdi mdi-face-profile menu-icon"></i>
          </a>
        </li>
        @elseif (Auth::user()->role == 'Mua')
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('mua/dashboard') ? 'active' : '') }}" href="{{ route('mua.dashboard') }}">
            <span class="menu-title">Dashboard</span>
            <i class="mdi mdi-home menu-icon"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('mua/layanan-mua') ? 'active' : '') }}" href="{{ route('layanan-mua.index') }}">
            <span class="menu-title">Layanan</span>
            <i class="mdi mdi-file-image menu-icon"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('mua/akun') ? 'active' : '') }}" href="{{ route('akun-mua.index') }}">
            <span class="menu-title">Akun</span>
            <i class="mdi mdi-face-profile menu-icon"></i>
          </a>
        </li>
    @endif

  </ul>
</nav>