<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}" href="{{ url('/') }}">
            <i class="fa fa-home text-primary"></i> Beranda
        </a>
    </li>
    @if (auth()->user()->isAdmin())
        @php
            $is_schedule_menu = request()->segment(2) == 'jadwal' || request()->segment(2) == 'jadwal-gub' || request()->segment(2) == 'jadwal-wagub' || request()->segment(2) == 'jadwal-sekda' || request()->segment(2) == 'jadwal-asis1' || request()->segment(2) == 'jadwal-asis2' || request()->segment(2) == 'jadwal-asis3';
        @endphp
        <li class="nav-item">
            <a class="nav-link {{ $is_schedule_menu ? 'active' : '' }}" href="#schedule-list" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="schedule-list">
                <i class="fa fa-calendar text-primary"></i>
                <span class="nav-link-text">Jadwal Kegiatan</span>
            </a>

            <div class="collapse {{ $is_schedule_menu ? 'show' : '' }}" id="schedule-list">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(2) == 'jadwal' ? 'active' : '' }}" href="{{ url('agenda/jadwal') }}">
                            Semua
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(2) == 'jadwal-gub' ? 'active' : '' }}" href="{{ url('agenda/jadwal-gub') }}">
                            Gubernur
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(2) == 'jadwal-wagub' ? 'active' : '' }}" href="{{ url('agenda/jadwal-wagub') }}">
                            Wakil Gubernur
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(2) == 'jadwal-sekda' ? 'active' : '' }}" href="{{ url('agenda/jadwal-sekda') }}">
                            Sekretaris Daerah
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(2) == 'jadwal-asis1' ? 'active' : '' }}" href="{{ url('agenda/jadwal-asis1') }}">
                            Asisten I
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(2) == 'jadwal-asis2' ? 'active' : '' }}" href="{{ url('agenda/jadwal-asis2') }}">
                            Asisten II
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(2) == 'jadwal-asis3' ? 'active' : '' }}" href="{{ url('agenda/jadwal-asis3') }}">
                            Asisten III
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    @else
        @php $code = str_replace("agenda_", "", auth()->user()->username) @endphp
        <li class="nav-item">
            <a class="nav-link {{ request()->segment(2) == 'jadwal-'.$code ? 'active' : '' }}" href="{{ url('agenda/jadwal-'.$code) }}">
                <i class="fa fa-calendar text-primary"></i> Jadwal Kegiatan
            </a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link {{ request()->segment(2) == 'laporan' ? 'active' : '' }}" href="{{ url('agenda/laporan') }}">
            <i class="fa fa-file-alt text-primary"></i> Laporan Jadwal
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->segment(2) == 'pencarian' ? 'active' : '' }}" href="{{ url('agenda/pencarian') }}">
            <i class="fa fa-search text-primary"></i> Pencarian Jadwal
        </a>
    </li>
    @if (auth()->user()->isAdmin())
        @php
            $is_master_menu = request()->segment(2) == 'tujuan' || request()->segment(2) == 'tempat' || request()->segment(2) == 'pakaian' || request()->segment(2) == 'pendamping' || request()->segment(2) == 'disposisi' || request()->segment(2) == 'petugas';
        @endphp
        <li class="nav-item">
            <a class="nav-link {{ $is_master_menu ? 'active' : '' }}" href="#master-list" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="master-list">
                <i class="fa fa-box text-primary"></i>
                <span class="nav-link-text">Master</span>
            </a>

            <div class="collapse {{ $is_master_menu ? 'show' : '' }}" id="master-list">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(2) == 'tujuan' ? 'active' : '' }}" href="{{ url('agenda/tujuan') }}">
                            Tujuan Agenda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(2) == 'disposisi' ? 'active' : '' }}" href="{{ url('agenda/disposisi') }}">
                            Disposisi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(2) == 'petugas' ? 'active' : '' }}" href="{{ url('agenda/petugas') }}">
                            Petugas TTD
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(2) == 'pendamping' ? 'active' : '' }}" href="{{ url('agenda/pendamping') }}">
                            Pendamping
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(2) == 'tempat' ? 'active' : '' }}" href="{{ url('agenda/tempat') }}">
                            Tempat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(2) == 'pakaian' ? 'active' : '' }}" href="{{ url('agenda/pakaian') }}">
                            Pakaian
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    @endif
</ul>
