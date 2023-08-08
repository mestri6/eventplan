<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>
        @if (Auth::user()->role == 'Admin')
            @if (request()->is('admin/dashboard'))
            Dashboard
            @elseif (request()->is('admin/layanan'))
            Layanan
            @endif
            @elseif (Auth::user()->role == 'Wo')
            @if (request()->is('wo/dashboard'))
            Dashboard
            @elseif (request()->is('wo/layanan-wo'))
            Layanan
            @elseif (request()->is('wo/layanan-wo/*'))
            Layanan
            @elseif (request()->is('wo/akun-wo'))
            Akun
            @endif

            @elseif (Auth::user()->role == 'Mua')
            @if (request()->is('mua/dashboard'))
            Dashboard
            @elseif (request()->is('mua/layanan-mua'))
            Layanan
            @elseif (request()->is('mua/layanan-mua/*'))
            Layanan
            @elseif (request()->is('mua/akun-mua'))
            Akun
            @endif

        @endif
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                
                    @if (Auth::user()->role == 'Admin')
                        @if (request()->is('admin/dashboard'))
                        <a href="" style="text-decoration: none">
                            Dashboard
                        </a>
                        @elseif (request()->is('admin/layanan'))
                        <a href="" style="text-decoration: none">
                            Layanan
                        </a>
                        @endif

                        @elseif (Auth::user()->role == 'Wo')
                        @if (request()->is('wo/dashboard'))
                            <a href="{{ route('wo.dashboard') }}" style="text-decoration: none">
                                Dashboard
                            </a>
                        @endif
                        @if (request()->is('wo/layanan-wo/create'))
                            <a href="{{ route('layanan-wo.index') }}" style="text-decoration: none">
                                Layanan
                            </a>
                        @elseif (request()->is('wo/akun-wo'))
                            <a href="{{ route('akun-wo.index') }}" style="text-decoration: none">
                                Akun
                            </a>
                        @endif

                        @elseif (Auth::user()->role == 'Mua')
                        @if (request()->is('mua/dashboard'))
                            <a href="{{ route('mua.dashboard') }}" style="text-decoration: none">
                                Dashboard
                            </a>
                        @endif
                        @if (request()->is('mua/layanan-mua/create'))
                            <a href="{{ route('layanan-mua.index') }}" style="text-decoration: none">
                                Layanan
                            </a>
                        @elseif (request()->is('mua/akun-mua'))
                            <a href="{{ route('akun-mua.index') }}" style="text-decoration: none">
                                Akun
                            </a>
                        @endif
                    @endif
                
            </li>
            @if (Auth::user()->role == 'Admin')

            @elseif (Auth::user()->role == 'Wo')
                @if (request()->is('wo/layanan-wo/create'))
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>
                        Tambah Layanan
                    </li>
                @endif
            @elseif (Auth::user()->role == 'Mua')
                @if (request()->is('mua/layanan-mua/create'))
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>
                        Tambah Layanan
                    </li>
                @endif
            @endif
            
        </ul>
    </nav>
</div>