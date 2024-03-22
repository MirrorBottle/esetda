<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}" href="{{ url('/') }}">
            <i class="fa fa-home text-primary"></i> Beranda
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->segment(1) == 'surat-keluar' ? 'active' : '' }}" href="{{ url('surat-keluar') }}">
            <i class="fa fa-envelope-open text-primary"></i> Surat Keluar
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->segment(1) == 'laporan' ? 'active' : '' }}" href="{{ url('laporan') }}">
            <i class="fa fa-file-alt text-primary"></i> Laporan
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->segment(1) == 'pencarian-surat' ? 'active' : '' }}" href="{{ url('pencarian-surat') }}">
            <i class="fa fa-search text-primary"></i> Pencarian Surat
        </a>
    </li>
</ul>
