<div class="modal fade" id="phone-modal" tabindex="-1" role="dialog" aria-labelledby="modal-phone" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="#" id="form-phone">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-notification">Form Penerima</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body bg-secondary">
                    @csrf
                    @method('PUT')
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-name">Nama Lengkap</label>
                        <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('institution') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-institution">Nama Institusi</label>
                        <input type="text" name="institution" id="input-institution" class="form-control form-control-alternative{{ $errors->has('institution') ? ' is-invalid' : '' }}" value="{{ old('institution') }}" required>

                        @if ($errors->has('institution'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('institution') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('institution_head') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-institution-head">Kepala Institusi</label>
                        <input type="text" name="institution_head" id="input-institution-head" class="form-control form-control-alternative{{ $errors->has('institution_head') ? ' is-invalid' : '' }}" value="{{ old('institution_head') }}" required>

                        @if ($errors->has('institution_head'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('institution_head') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('wa') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-wa">Nomor WA</label>
                        <input type="text" name="wa" id="input-wa" class="form-control form-control-alternative{{ $errors->has('wa') ? ' is-invalid' : '' }}" placeholder="{{ __('contoh: 62812xxx') }}" value="{{ old('wa') }}" required>

                        @if ($errors->has('wa'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('wa') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light ml-auto" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
