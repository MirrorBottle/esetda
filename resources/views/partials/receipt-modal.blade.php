<!-- Modal -->
<div class="modal fade" id="receipt-modal" tabindex="-1" role="dialog" aria-labelledby="receipt-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ url('tanda-terima/upload') }}" method="POST" enctype="multipart/form-data" id="form-receipt">
                <div class="modal-header bg-secondary">
                    <h3 class="modal-title" id="detail-modal-label">Tanda Terima</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="receipt-id">
                    <input type="hidden" name="type" id="receipt-type">
                    <input type="hidden" name="action" id="receipt-action">

                    <div class="form-group{{ $errors->has('attachment') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="receipt-attachment">File Lampiran <small class="text-muted">(*maksimal 10mb)</small></label>
                        <label class="btn btn-block btn-info btn-file">
                            <span id="receipt-title">x</span>
                            <input type="hidden" name="uploaded_file" id="receipt-uploaded" value="current">
                            <input type="file" style="display: none;" accept="application/pdf, image/*" name="attachment" id="receipt-attachment" data-status="new">
                        </label>

                        <div id="receipt-attachment-action">
                            <a href="#" target="_blank" id="receipt-attachment-url" class="btn btn-sm btn-outline-primary">Lihat Lampiran</a>
                            <a href="#" class="btn btn-sm btn-outline-danger float-right delete-attachment">Hapus</a>
                        </div>

                        @if ($errors->has('attachment'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('attachment') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('note') ? ' has-danger' : '' }} mb-0">
                        <label class="form-control-label" for="receipt-note">Keterangan <small class="text-muted">(opsional)</small></label>
                        <textarea name="note" id="receipt-note" class="form-control form-control-alternative{{ $errors->has('note') ? ' is-invalid' : '' }}"></textarea>

                        @if ($errors->has('note'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('note') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer bg-secondary">
                    <button type="button" class="btn btn-secondary ml-auto" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
