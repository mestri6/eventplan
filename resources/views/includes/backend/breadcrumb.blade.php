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
                        
                        @if (request()->is('wo/layanan-wo/create'))
                            <a href="{{ route('layanan-wo.index') }}" style="text-decoration: none">
                                Layanan
                            </a>
                        @elseif (request()->is('wo/akun-wo'))
                            <a href="{{ route('akun-wo.index') }}" style="text-decoration: none">
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
            @endif
            
        </ul>
    </nav>
</div>