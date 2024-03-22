<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}" href="{{ url('/dashboard') }}">
            <i class="fa fa-home text-primary"></i> Beranda
        </a>
    </li>
    @if (strpos(auth()->user()->username, 'admin') !== false || strpos(auth()->user()->username, 'pj') !== false)
        @include('layouts.navbars.sidebars._tujuan')
    @else
        <li class="nav-item">
            <a class="nav-link {{ request()->segment(2) == 'users' ? 'active' : '' }}" href="{{ url('admin/users') }}">
                <i class="fa fa-user text-primary"></i> Pengguna
            </a>
        </li>
        @if (auth()->user()->username == 'fahmi')
            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1) == 'recycle' ? 'active' : '' }}" href="{{ url('recycle') }}">
                    <i class="fa fa-trash text-primary"></i> Recycle Bin
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1) == 'notif-spt' ? 'active' : '' }}" href="{{ url('notif-spt') }}">
                    <i class="fa fa-comment text-primary"></i> Notifikasi SPT
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1) == 'notif-spt-new'  ? 'active' : '' }}" href="{{ url('notif-spt-new') }}">
                    <i class="fa fa-comment-dots text-primary"></i> Notifikasi SPT Baru
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) == 'penomoran' ? 'active' : '' }}" href="{{ url('arsip/penomoran') }}">
                    <i class="fa fa-envelope-open-text text-primary"></i> Penomoran Surat
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1) == 'pencarian-surat' ? 'active' : '' }}" href="{{ url('pencarian-surat') }}">
                    <i class="fa fa-search text-primary"></i> Pencarian Surat
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1) == 'backup' ? 'active' : '' }}" href="{{ url('backup') }}">
                    <i class="fa fa-cloud-download-alt text-primary"></i> Backup Data
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1) == 'logs' ? 'active' : '' }}" href="{{ url('logs') }}">
                    <i class="fa fa-clipboard-list text-primary"></i> Logs
                </a>
            </li>
            @php $is_master_list = request()->segment(1) == 'tujuan' || request()->segment(1) == 'kategori' || request()->segment(1) == 'kop' || request()->segment(1) == 'pejabat' | request()->segment(1) == 'petugas'; @endphp
            <li class="nav-item">
                <a class="nav-link {{ $is_master_list ? 'active' : '' }}" href="#master-list" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="master-list">
                    <i class="fa fa-box text-primary"></i>
                    <span class="nav-link-text">Master</span>
                </a>

                <div class="collapse {{ $is_master_list ? 'show' : '' }}" id="master-list">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->segment(1) == 'kop' ? 'active' : '' }}" href="{{ url('kop') }}">
                                Kop Surat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->segment(1) == 'pejabat' ? 'active' : '' }}" href="{{ url('pejabat') }}">
                                Pejabat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->segment(1) == 'tujuan' ? 'active' : '' }}" href="{{ url('tujuan') }}">
                                Tujuan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->segment(1) == 'kategori' ? 'active' : '' }}" href="{{ url('kategori') }}">
                                Kategori
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
    @endif
</ul>
