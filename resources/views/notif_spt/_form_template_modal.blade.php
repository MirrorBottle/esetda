<div class="modal fade" id="template-modal" tabindex="-1" role="dialog" aria-labelledby="modal-template" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" action="#" id="form-template">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-notification">Form Template</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body bg-secondary">
                    @csrf
                    @method('PUT')
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="template-name">Nama Template</label>
                        <input type="text" name="name" id="template-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="template-content">Konten Pesan</label>
                        <p style="font-size: .85rem;" class="mb-1"><span class="badge badge-primary" style="text-transform: lowercase;">&lt;kepala_dinas&gt;</span> untuk field kepala dinas dari data penerima.</p>
                        <p style="font-size: .85rem;"><span class="badge badge-info" style="text-transform: lowercase;">&lt;institusi&gt;</span> untuk field institusi dari data penerima.</p>

                        <textarea name="content" id="template-content" class="form-control form-control-alternative{{ $errors->has('content') ? ' is-invalid' : '' }}" rows="16" required></textarea>
                        @if ($errors->has('content'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light ml-auto" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Simpan Template
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
