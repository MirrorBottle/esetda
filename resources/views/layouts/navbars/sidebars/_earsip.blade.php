<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}" href="{{ url('/') }}">
            <i class="fa fa-home text-primary"></i> Beranda
        </a>
    </li>
    @if (auth()->user()->isAdmin())
        <li class="nav-item">
            <a class="nav-link {{ request()->segment(2) == 'bundle-masuk' || request()->segment(2) == 'bundle-keluar' ? 'active' : '' }}" href="#bundle-list" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="bundle-list">
                <i class="fa fa-check-circle text-primary"></i>
                <span class="nav-link-text">Validasi Arsip</span>
            </a>

            <div class="collapse {{ request()->segment(2) == 'bundle' || request()->segment(2) == 'validasi' ? 'show' : '' }}" id="bundle-list">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->segment(2) == 'bundle' || request()->segment(2) == 'validasi') && request()->segment(3) == 'masuk' ? 'active' : '' }}" href="{{ url('arsip/bundle/masuk') }}">
                            Surat Masuk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->segment(2) == 'bundle' || request()->segment(2) == 'validasi') && request()->segment(3) == 'keluar' ? 'active' : '' }}" href="{{ url('arsip/bundle/keluar') }}">
                            Surat Keluar
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link {{ request()->segment(2) == 'masuk' || request()->segment(2) == 'keluar' ? 'active' : '' }}" href="#arsip-list" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="arsip-list">
            <i class="fa fa-box text-primary"></i>
            <span class="nav-link-text">{{ auth()->user()->isAdmin() ? 'Riwayat' : '' }} Arsip</span>
        </a>

        <div class="collapse {{ request()->segment(2) == 'masuk' || request()->segment(2) == 'keluar' ? 'show' : '' }}" id="arsip-list">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(2) == 'masuk' ? 'active' : '' }}" href="{{ url('arsip/masuk') }}">
                        Surat Masuk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(2) == 'keluar' ? 'active' : '' }}" href="{{ url('arsip/keluar') }}">
                        Surat Keluar
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->segment(2) == 'laporan' ? 'active' : '' }}" href="{{ url('arsip/laporan') }}">
            <i class="fa fa-file-alt text-primary"></i> Laporan
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->segment(2) == 'pencarian' ? 'active' : '' }}" href="{{ url('arsip/pencarian') }}">
            <i class="fa fa-search text-primary"></i> Pencarian
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->segment(2) == 'penomoran' ? 'active' : '' }}" href="{{ url('arsip/penomoran') }}">
            <i class="fa fa-envelope-open-text text-primary"></i> Penomoran Surat
        </a>
    </li>
    @if (auth()->user()->isAdmin())
        <li class="nav-item">
            <a class="nav-link {{ request()->segment(2) == 'klasifikasi' || request()->segment(2) == 'petugas' ? 'active' : '' }}" href="#master-list" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="master-list">
                <i class="fa fa-layer-group text-primary"></i>
                <span class="nav-link-text">Master</span>
            </a>

            <div class="collapse {{ request()->segment(2) == 'klasifikasi' || request()->segment(2) == 'petugas' || request()->segment(2) == 'nomor-surat'? 'show' : '' }}" id="master-list">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(2) == 'klasifikasi' ? 'active' : '' }}" href="{{ url('arsip/klasifikasi') }}">
                            Klasifikasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(2) == 'petugas' ? 'active' : '' }}" href="{{ url('arsip/petugas') }}">
                            Petugas TTD
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(2) == 'nomor-surat' ? 'active' : '' }}" href="{{ url('arsip/nomor-surat') }}">
                            Nomor
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    @endif
</ul>
