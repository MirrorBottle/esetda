<!-- Modal -->
<div class="modal fade" id="invalid-modal" tabindex="-1" role="dialog" aria-labelledby="invalid-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ url('surat-tamu/tolak') }}" method="POST" id="form-invalid">
                <div class="modal-header bg-secondary">
                    <h3 class="modal-title" id="detail-modal-label">Tolak Surat Tamu</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="invalid_id">
                    <div class="form-group mb-3">
                        <label class="form-control-label">No Surat</label>
                        <input type="text" class="form-control" id="invalid_no_surat" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-control-label">Asal</label>
                        <input type="text" class="form-control" id="invalid_asal" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-control-label" for="invalid_note">Keterangan Penolakan</label>
                        <textarea class="form-control form-control-alternative" rows="4" name="invalid_note" id="invalid_note"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-secondary">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-paper-plane"></i> Kirim
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </form>
    </div>
</div>
