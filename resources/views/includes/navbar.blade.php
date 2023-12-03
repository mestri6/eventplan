<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
    <a href="index.html" class="navbar-brand">
        <h1 class="m-0 text-primary"><i class="fa fa-book-reader me-3"></i>Event Planner</h1>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto">
            <a href="/" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="/" class="nav-item nav-link">Tentang</a>
            <a href="/" class="nav-item nav-link">Layanan</a>
            <a href="/" class="nav-item nav-link">Kontak</a>
            @auth
            @php
                $countCart = \App\Models\Cart::where('id_user', Auth::user()->id)->count();
            @endphp
                <a href="{{ route('cart') }}" class="nav-item nav-link {{ request()->is('cart') ? 'active' : '' }}">
                    <i class="fa fa-shopping-cart active"></i>
                    @if ($countCart > 0)
                        <span class="badge bg-danger rounded-pill">{{ $countCart }}</span>
                    @endif
                </a>
            @endauth
        </div>
        @guest
            <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-3 d-none d-lg-block">Daftar Sekarang<i
                    class="fa fa-arrow-right ms-3"></i></a>
        @endguest

        @auth
            @if (Auth::user()->role == 'Admin')
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary rounded-pill px-3 d-none d-lg-block">Dashboard<i
                        class="fa fa-arrow-right ms-3"></i></a>
            @elseif (Auth::user()->role == 'Wo')
                <a href="{{ route('wo.dashboard') }}" class="btn btn-primary rounded-pill px-3 d-none d-lg-block">Dashboard<i
                        class="fa fa-arrow-right ms-3"></i></a>
            @elseif (Auth::user()->role == 'Mua')
                <a href="{{ route('mua.dashboard') }}" class="btn btn-primary rounded-pill px-3 d-none d-lg-block">Dashboard<i
                        class="fa fa-arrow-right ms-3"></i></a>
            @else
            <a href="{{ route('customer.dashboard') }}" class="btn btn-primary rounded-pill px-3 d-none d-lg-block">Dashboard<i
                    class="fa fa-arrow-right ms-3"></i></a>
            @endif
        @endauth
    </div>
</nav>
<!-- Navbar End -->