<!-- Modal -->
<div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="detail-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h3 class="modal-title" id="detail-modal-label">Detail Data</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2>DATA ARSIP</h2>
                <table class="table table-striped table-bordered">
                    <tr>
                        <td style="width: 150px"><b>Kode Klasfikasi</b></td>
                        <td><span class="detail-code mb-0"></span></td>
                    </tr>
                    <tr>
                        <td><b>Nama Klasifikasi</b></td>
                        <td><span class="detail-clasification mb-0"></span></td>
                    </tr>
                    <tr>
                        <td><b>TK. Perkemb</b></td>
                        <td><span class="detail-tk-prk mb-0"></span></td>
                    </tr>
                    <tr>
                        <td><b>Jumlah</b></td>
                        <td><span class="detail-qty mb-0"></span></td>
                    </tr>
                    <tr>
                        <td><b>No Box</h5></td>
                        <td><span class="detail-no-box mb-0"></span></td>
                    </tr>
                    <tr>
                        <td><h5>No Folder</h5></td>
                        <td><span class="detail-no-folder mb-0"></span></td>
                    </tr>
                    <tr>
                        <td><h5>Lampiran File</h5></td>
                        <td><a href="#" class=" btn btn-sm btn-info detail-attachment"></a></td>
                    </tr>
                    <tr>
                        <td><h5>Keterangan</h5></td>
                        <td><span class="detail-note mb-0"></span></td>
                    </tr>
                </table>

                <h2 class="mt-4">DATA SURAT</h2>
                @include('partials.detail-table')
            </div>
            <div class="modal-footer bg-secondary">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
