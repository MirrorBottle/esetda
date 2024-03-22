<table class="table table-striped table-bordered">
    <tr>
        <td style="width: 150px;"><b>No Surat</b></td>
        <td><span class="detail-no-surat mb-0"></span></td>
    </tr>
    @if (request()->segment(1) != 'surat-keluar')
    <tr>
        <td><b>No Agenda</b></td>
        <td><span class="detail-no-agenda mb-0"></span></td>
    </tr>
    @endif
    <tr>
        <td><b>Judul</b></td>
        <td><span class="detail-title mb-0"></span></td>
    </tr>
    @if (request()->segment(1) != 'surat-keluar')
    <tr>
        <td><b>Pengirim</b></td>
        <td><span class="detail-sender mb-0"></span></td>
    </tr>
    @endif
    <tr>
        <td><b>Tujuan Surat</b></td>
        <td><span class="detail-receiver mb-0"></span></td>
    </tr>
    @if (request()->segment(1) != 'surat-keluar')
    <tr>
        <td><b>Sifat</b></td>
        <td><span class="detail-sifat mb-0"></span></td>
    </tr>
    @endif
    <tr>
        <td><b>Kategori Surat</b></td>
        <td><span class="detail-category mb-0"></span></td>
    </tr>
    <tr>
        <td><b>Tanggal Surat</b></td>
        <td><span class="detail-date mb-0"></span></td>
    </tr>
    <tr>
        <td><b>Keterangan</b></td>
        <td><span class="detail-description mb-0"></span></td>
    </tr>
    <tr>
        <td>
            <b>File Lampiran</b>
            <a class="btn btn-sm btn-icon btn-3 btn-success mt-2 view-attachment" href="#" target="_blank"><span class="btn-inner--icon"><i class="fa fa-link"></i></span><span class="btn-inner--text">Lihat Semua</span></a>
        </td>
        <td><div class="attachment-area"></div></td>
    </tr>
    <tr>
        <td><b>Keterangan Terusan</b></td>
        <td><div class="detail-forward"></div></td>
    </tr>
    <tr>
        <td>
            <b>Status Surat</b>
            <a class="btn btn-sm btn-icon btn-3 btn-info mt-2 view-all-disposition" href="#" target="_blank"><span class="btn-inner--icon"><i class="fa fa-link"></i></span><span class="btn-inner--text">Lihat Semua</span></a>
        </td>
        <td><div class="detail-status"></div></td>
    </tr>
</table>
