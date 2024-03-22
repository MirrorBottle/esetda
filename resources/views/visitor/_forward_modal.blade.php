<!-- Modal -->
<div class="modal fade" id="forward-modal" tabindex="-1" role="dialog" aria-labelledby="forward-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ url('surat-tamu/teruskan') }}" method="POST" id="form-forward">
                <div class="modal-header bg-secondary">
                    <h3 class="modal-title" id="detail-modal-label">Teruskan Surat</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="status" value="new">
                    <input type="hidden" name="visitor_id" id="forward_id">
                    <div class="form-group mb-3">
                        <label class="form-control-label">No Agenda</label>
                        <input type="text" name="no_agenda" class="form-control" id="disposisi-no-agenda" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-control-label" for="disposisi-property">
                            Sifat <span class="text-danger">*</span>
                        </label>
                        <select name="property" id="disposisi-property" class="form-control" required>
                            <option value="1">Segera</option>
                            <option value="2">Rahasia</option>
                            <option value="3">Sangat Segera</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-control-label">Tujuan</label>
                        <select name="receiver_id" class="form-control select2" id="forward_receiver">
                            @foreach ($receivers as $receiver)
                                <option value="{{ $receiver->id }}">{{ $receiver->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-control-label" for="forward_note">Keterangan <small class="text-muted">(opsional)</small></label>
                        <textarea class="form-control form-control-alternative" name="note" id="forward_note"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-secondary">
                    {{-- <button type="button" class="btn btn-danger" id="forward-cancel">Batalkan</button> --}}
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-paper-plane"></i> Kirim
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </form>
    </div>
</div>
