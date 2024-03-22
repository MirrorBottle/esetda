<!-- Modal -->
<div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="detail-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h3 class="modal-title" id="detail-modal-label">Detail Jadwal Kegiatan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered">
                    <h2>DATA AGENDA</h2>
                    <tr>
                        <td style="width: 140px;"><b>Referensi Surat</b></td>
                        <td><span class="agenda-reference mb-0"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 140px;"><b>Tanggal</b></td>
                        <td><span class="agenda-date mb-0"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 140px;"><b>Jam Kegiatan</b></td>
                        <td><span class="agenda-time mb-0"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 140px;"><b>Nama Kegiatan</b></td>
                        <td><span class="agenda-event mb-0"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 140px;"><b>Status</b></td>
                        <td><span class="agenda-status mb-0"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 140px;"><b>Tempat</b></td>
                        <td><span class="agenda-place mb-0"></span></td>
                    </tr>
                    <tr>
                        <td><b>Pakaian</b></td>
                        <td><span class="agenda-apparel mb-0"></span></td>
                    </tr>
                    <tr>
                        <td><b>Pendamping</b></td>
                        <td><span class="agenda-partners mb-0"></span></td>
                    </tr>
                    <tr>
                        <td><b>Disposisi</b></td>
                        <td><span class="agenda-disposition mb-0"></span></td>
                    </tr>
                    <tr>
                        <td><b>Yang Menghadiri</b></td>
                        <td><span class="agenda-receiver mb-0"></span></td>
                    </tr>
                    <tr>
                        <td><b>Keterangan</b></td>
                        <td><span class="agenda-description mb-0"></span></td>
                    </tr>
                    <tr>
                        <td><b>Lampiran File</b></td>
                        <td><a href="#" class=" btn btn-sm btn-primary agenda-attachment"></a></td>
                    </tr>
                </table>

                <div class="referensi-area mt-4">
                    <h2>DATA SURAT</h2>
                     @include('partials.detail-table')
                </div>
            </div>
            <div class="modal-footer bg-secondary">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
