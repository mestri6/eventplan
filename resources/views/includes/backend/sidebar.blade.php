<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="assets/images/faces/face1.jpg" alt="profile" />
          <span class="login-status online"></span>
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">{{ Auth::user()->name ?? '' }}</span>
          <span class="text-secondary text-small">{{ Auth::user()->role ?? '' }}</span>
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="index.html">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>
    @if (Auth::user()->role == 'Wo')
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('layanan.index') }}">
            <span class="menu-title">Layanan</span>
            <i class="mdi mdi-media menu-icon"></i>
          </a>
        </li>
        @elseif (Auth::user()->role == 'Mua')
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('layanan-mua.index') }}">
            <span class="menu-title">Layanan</span>
            <i class="mdi mdi-media menu-icon"></i>
          </a>
        </li>
    @endif

  </ul>
</nav>