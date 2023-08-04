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
            <a href="index.html" class="nav-item nav-link active">Beranda</a>
            <a href="about.html" class="nav-item nav-link">Tentang</a>
            <a href="classes.html" class="nav-item nav-link">Layanan</a>
            <a href="contact.html" class="nav-item nav-link">Kontak</a>
        </div>
        <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-3 d-none d-lg-block">Daftar Sekarang<i
                class="fa fa-arrow-right ms-3"></i></a>
    </div>
</nav>
<!-- Navbar End -->