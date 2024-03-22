<div class="sidebar">
    <img src="{{ asset('images/content/kaltim-logo.png')  }}" alt="logo kaltim" class="logo-sidebar">

    <nav class="sidebar-nav ps ps--active-y">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ url("/") }}" class="nav-link {{ request()->is('') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home">

                    </i>
                    Beranda
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url("list") }}" class="nav-link {{ request()->is('list') ? 'active' : '' }}">
                    <i class="fas fa-file-text nav-icon"></i>
                    Daftar Kerjasama
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url("statistics") }}" class="nav-link {{ request()->is('statistics') ? 'active' : '' }}">
                    <i class="fas fa-bar-chart nav-icon"></i>
                    Statistik Kerjasama
                </a>
            </li>
            @auth
                <li class="nav-item">
                    <a href="{{ url("admin.home") }}" class="nav-link bg-secondary">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        Dashboard
                    </a>
                </li>
            @endauth
            <li class="nav-item">
                @auth
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        Logout
                    </a>
                    <form id="logoutform" action="{{ url('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @else
                    <a href="{{ url("admin.home") }}" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        Login
                    </a>
                @endauth
            </li>
        </ul>

        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 869px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 415px;"></div>
        </div>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button">
        <span>Sembunyikan Menu</span>
    </button>
</div>
