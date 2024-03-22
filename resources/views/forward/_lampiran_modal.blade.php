<!-- Modal -->
<div class="modal fade" id="lampiran-modal" tabindex="-1" role="dialog" aria-labelledby="lampiran-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="#" method="POST" id="form-lampiran" enctype="multipart/form-data">
                <div class="modal-header bg-secondary">
                    <h3 class="modal-title" id="detail-modal-label">Form Lampiran</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="type" id="lampiran-type">
                    <div class="lampiran-area"></div>
                    <p class="text-muted"><small>* Klik button untuk mengganti lampiran</small></p>
                    <p class="text-muted"><small>* Ukuran maksimal 10mb</small></p>
                </div>
                <div class="modal-footer bg-secondary">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
