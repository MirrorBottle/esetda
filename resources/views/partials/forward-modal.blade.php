<!-- Modal -->
<div class="modal fade" id="forward-modal" tabindex="-1" role="dialog" aria-labelledby="forward-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ url('surat-terusan') }}" method="POST" id="form-forward">
                <div class="modal-header bg-secondary">
                    <h3 class="modal-title" id="detail-modal-label">Teruskan Surat</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" value="POST" id="forward-method">
                    <input type="hidden" name="save_type" id="forward-save-type">
                    <input type="hidden" name="inbox_id" id="forward-inbox-id">
                    <input type="hidden" name="outbox_id" id="forward-outbox-id">
                    <div class="form-group">
                        <label class="form-control-label" for="forward-receiver">
                            Biro Tujuan <span class="text-danger">*</span>
                        </label>
                        <div>
                            <select name="biro_id[]" id="forward-receiver" class="form-control select2-multiple form-control-alternative" multiple required>
                                @foreach ($biros as $id => $biro)
                                    <option value="{{ $id }}">{{ $biro }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="forward-note">Keterangan</label>
                        <textarea class="form-control form-control-alternative" name="note" id="forward-note"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-secondary">
                    <button type="button" class="btn btn-danger" id="forward-cancel">Batalkan</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
