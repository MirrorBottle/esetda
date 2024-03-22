<!-- Modal -->
<div class="modal fade" id="keterangan-modal" tabindex="-1" role="dialog" aria-labelledby="keterangan-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="#" method="POST" id="form-keterangan">
                <div class="modal-header bg-secondary">
                    <h3 class="modal-title" id="detail-modal-label">Form Keterangan</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="type" id="keterangan-type">
                    <div class="form-group">
                        <label class="form-control-label" for="input-description">Keterangan</label>
                        <textarea class="form-control form-control-alternative " rows="6" placeholder="..." name="description" id="keterangan-text"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-secondary">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
