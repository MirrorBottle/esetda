<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}" href="{{ url('/') }}">
            <i class="fa fa-home text-primary"></i> Beranda
        </a>
    </li>
    @if (strpos(auth()->user()->username, 'karo') !== false)
        @include('layouts.navbars.sidebars._tujuan')
    @else
        <li class="nav-item">
            <a class="nav-link {{ request()->segment(1) == 'surat-masuk' ? 'active' : '' }}" href="{{ url('surat-masuk') }}">
                <i class="fa fa-envelope text-primary"></i> Surat Masuk
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->segment(1) == 'surat-keluar' ? 'active' : '' }}" href="{{ url('surat-keluar') }}">
                <i class="fa fa-envelope-open text-primary"></i> Surat Keluar
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->segment(1) == 'surat-terusan' ? 'active' : '' }}" href="{{ url('surat-terusan') }}">
                <i class="fa fa-envelope-open-text text-primary"></i> Surat Lingkup Setda
                <span class="badge badge-circle badge-floating badge-danger border-white p-0" style="width: 1.2rem; height: 1.2rem; margin-left: 7px; font-size: .75rem; display: none;" id="badge-lingkup-setda" data-toggle="tooltip" data-placement="top" title="Belum diterima">0</span>
            </a>
        </li>
        @if (auth()->user()->username == 'tu_pimpinan')
        <li class="nav-item">
            <a class="nav-link {{ request()->segment(1) == 'surat-tamu' ? 'active' : '' }}" href="{{ url('surat-tamu') }}">
                <i class="fa fa-hand-pointer text-primary"></i> Surat Tamu
                <span class="badge badge-circle badge-floating badge-danger border-white p-0" style="width: 1.2rem; height: 1.2rem; margin-left: 7px; font-size: .75rem; display: none;" id="badge-tamu-setda" data-toggle="tooltip" data-placement="top" title="Belum diteruskan">0</span>
            </a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link {{ request()->segment(1) == 'laporan' ? 'active' : '' }}" href="{{ url('laporan') }}">
                <i class="fa fa-file-alt text-primary"></i> Laporan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->segment(1) == 'tanda-terima' ? 'active' : '' }}" href="{{ url('tanda-terima') }}">
                <i class="fa fa-file-signature text-primary"></i> Tanda Terima
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->segment(1) == 'pencarian-surat' ? 'active' : '' }}" href="{{ url('pencarian-surat') }}">
                <i class="fa fa-search text-primary"></i> Pencarian Surat
            </a>
        </li>
        @if (auth()->user()->username == 'tu_pimpinan')
        @php $is_spt_list = request()->segment(1) == 'skpd' || request()->segment(1) == 'skpd-pejabat' || request()->segment(1) == 'spt' || request()->segment(1) == 'spt-laporan' || request()->segment(1) == 'spt-ttd' || request()->segment(1) == 'spt-cari'; @endphp
        <li class="nav-item">
            <a class="nav-link {{ $is_spt_list ? 'active' : '' }}" href="#spt-list" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="spt-list">
                <i class="fa fa-file text-primary"></i>
                <span class="nav-link-text">Surat Tugas</span>
            </a>

            <div class="collapse {{ $is_spt_list ? 'show' : '' }}" id="spt-list">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(1) == 'spt' ? 'active' : '' }}" href="{{ url('spt') }}">
                            Data SPT
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(1) == 'spt-cari' ? 'active' : '' }}" href="{{ url('spt-cari') }}">
                            Cari SPT
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(1) == 'spt-laporan' ? 'active' : '' }}" href="{{ url('spt-laporan') }}">
                            Laporan SPT
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(1) == 'skpd-pejabat' ? 'active' : '' }}" href="{{ url('skpd-pejabat') }}">
                            Pejabat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(1) == 'skpd' ? 'active' : '' }}" href="{{ url('skpd') }}">
                            SKPD
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(1) == 'spt-ttd' ? 'active' : '' }}" href="{{ url('spt-ttd') }}">
                            Penandatangan
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @endif
        @php $is_master_list = request()->segment(1) == 'tujuan' || request()->segment(1) == 'kategori' || request()->segment(1) == 'kop' || request()->segment(1) == 'pejabat' || request()->segment(1) == 'petugas'; @endphp
        <li class="nav-item">
            <a class="nav-link {{ $is_master_list ? 'active' : '' }}" href="#master-list" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="master-list">
                <i class="fa fa-box text-primary"></i>
                <span class="nav-link-text">Master</span>
            </a>

            <div class="collapse {{ $is_master_list ? 'show' : '' }}" id="master-list">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(1) == 'pejabat' ? 'active' : '' }}" href="{{ url('pejabat') }}">
                            Pejabat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(1) == 'petugas' ? 'active' : '' }}" href="{{ url('petugas') }}">
                            Petugas TTD
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(1) == 'tujuan' ? 'active' : '' }}" href="{{ url('tujuan') }}">
                            Tujuan
                        </a>
                    </li>
                    @if (auth()->user()->username === 'fahmi' || auth()->user()->username === 'tu_pimpinan')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->segment(1) == 'kategori' ? 'active' : '' }}" href="{{ url('kategori') }}">
                                Kategori
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
    </ul>

{{-- @if (strpos(auth()->user()->username, 'karo') === false)
    <hr class="my-3">
    <h6 class="navbar-heading p-0 text-muted">
        <span class="docs-normal">Panduan</span>
    </h6>
    <ul class="navbar-nav mb-md-3">
        <li class="nav-item">
        <a class="nav-link {{ request()->segment(1) == 'panduan' && request()->segment(2) == 'esurat' ? 'active' : '' }}" href="{{ url('panduan/esurat') }}" target="_blank">
            <i class="fa fa-info-circle"></i>
            <span class="nav-link-text">Penggunaan E-Surat</span>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link {{ request()->segment(1) == 'panduan' && request()->segment(2) == 'disposisi' ? 'active' : '' }}" href="{{ url('panduan/disposisi') }}" target="_blank">
            <i class="fa fa-print"></i>
            <span class="nav-link-text">Print Disposisi</span>
        </a>
        </li>
    </ul>
@endif --}}
