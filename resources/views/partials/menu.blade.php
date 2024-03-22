<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt">

                    </i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("admin.kerjasama.index") }}" class="nav-link {{ request()->is('admin/kerjasama') || request()->is('admin/kerjasama/*') ? 'active' : '' }}">
                    <i class="fas fa-file-text nav-icon">

                    </i>
                    Data Kerjasama
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("admin.kerjasama.recap") }}" class="nav-link {{ request()->is('admin/rekap') || request()->is('admin/rekap/*') ? 'active' : '' }}">
                    <i class="fas fa-file-text nav-icon">

                    </i>
                    Rekap Kerjasama
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("admin.kerjasama.chart") }}" class="nav-link {{ request()->is('admin/statistik') || request()->is('admin/statistik/*') ? 'active' : '' }}">
                    <i class="fas fa-bar-chart nav-icon">

                    </i>
                    Statistik Kerjasama
                </a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle">
                    <i class="fas fa-list-alt nav-icon">

                    </i>
                    Data Master
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a href="{{ route("admin.kategori.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                            <i class="fas fa-tags nav-icon">

                            </i>
                            Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.tipe.index") }}" class="nav-link {{ request()->is('admin/tipe') || request()->is('admin/tipe/*') ? 'active' : '' }}">
                            <i class="fas fa-bookmark nav-icon">

                            </i>
                            Tipe Kerjasama
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.mitra.index") }}" class="nav-link {{ request()->is('admin/mitra') || request()->is('admin/mitra/*') ? 'active' : '' }}">
                            <i class="fas fa-handshake-o nav-icon">

                            </i>
                            Mitra
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.ikatan.index") }}" class="nav-link {{ request()->is('admin/ikatan') || request()->is('admin/ikatan/*') ? 'active' : '' }}">
                            <i class="fas fa-podcast nav-icon">

                            </i>
                            Bentuk Ikatan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.pihak.index") }}" class="nav-link {{ request()->is('admin/pihak') || request()->is('admin/pihak/*') ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon">

                            </i>
                            Pihak-pihak
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.instansi.index") }}" class="nav-link {{ request()->is('admin/instansi') || request()->is('admin/instansi/*') ? 'active' : '' }}">
                            <i class="fas fa-building nav-icon">

                            </i>
                            Instansi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.negara.index") }}" class="nav-link {{ request()->is('admin/negara') || request()->is('admin/negara/*') ? 'active' : '' }}">
                            <i class="fas fa-flag nav-icon">

                            </i>
                            Negara
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle">
                    <i class="fas fa-cogs nav-icon">

                    </i>
                    Pengaturan
                </a>
                <ul class="nav-dropdown-items">
                    {{-- <li class="nav-item">
                        <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                            <i class="fas fa-unlock-alt nav-icon">

                            </i>
                            Perizinan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                            <i class="fas fa-briefcase nav-icon">

                            </i>
                            Hak Akses
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                            <i class="fas fa-user nav-icon">

                            </i>
                            Pengguna
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.settings.banner") }}" class="nav-link {{ request()->is('admin/settings/banner') || request()->is('admin/settings/banner/*') ? 'active' : '' }}">
                            <i class="fas fa-picture-o nav-icon">

                            </i>
                            Banner
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.settings.aplikasi") }}" class="nav-link {{ request()->is('admin/settings/aplikasi') || request()->is('admin/settings/aplikasi/*') ? 'active' : '' }}">
                            <i class="fas fa-wrench nav-icon">

                            </i>
                            Aplikasi
                        </a>
                    </li>
                </ul>
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
