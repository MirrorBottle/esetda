<li class="nav-item">
    <a class="nav-link {{ request()->segment(1) == 'surat-masuk' ? 'active' : '' }}" href="{{ url('surat-masuk') }}">
        <i class="fa fa-envelope text-primary"></i> Surat Masuk
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->segment(1) == 'surat-diteruskan' ? 'active' : '' }}" href="{{ url('surat-diteruskan') }}">
        <i class="fa fa-envelope-open-text text-primary"></i> Surat Terusan
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
