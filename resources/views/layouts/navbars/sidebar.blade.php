<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('images/logo-'.$user_type.'.png') }}" class="navbar-brand-img" alt="logo eksperimen">
        </a>

        @if ($user_type !== 'eagenda')
            <h4 class="text-center btn btn-sm btn-block btn-primary">
                {{ strtoupper(auth()->user()->biro->alias ?? 'ADMIN') }}
            </h4>
        @else
            <h4 class="text-center btn btn-sm btn-block btn-primary">
                {{ str_replace("AGENDA", "", strtoupper(auth()->user()->name ?? 'ADMIN')) }}
            </h4>
        @endif

        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('images/avatar.png') }}">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Selamat Datang</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>Profil</span>
                    </a>
                    {{-- <a href="{{ url('admin/pengaturan') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>Pengaturan</span>
                    </a> --}}
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('images/logo-'. $user_type .'.png') }}" class="navbar-brand-img" alt="logo">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            @if (auth()->user()->isTupimDua())
                @include('layouts.navbars.sidebars._tupim')
            @else
                @include('layouts.navbars.sidebars._'. $user_type)
            @endif
        </div>
    </div>
</nav>
