<div class="card bg-secondary shadow mb-3">
    <div class="card-header bg-white border-0">
        <div class="row align-items-center">
            <h3 class="col-12 mb-0"><i class="fa fa-file-alt mr-1 text-success"></i> Ubah Password Disposisi</h3>
        </div>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('profile.password_disposition') }}" autocomplete="off">
            @csrf
            @method('put')

            <div class="form-area">
                <div class="form-group{{ $errors->has('old_disposition_password') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-current-password">Password Disposisi Saat Ini</label>
                    <input type="password" minlength="6" name="old_disposition_password" id="input-disposition-current-password" class="form-control form-control-alternative{{ $errors->has('old_disposition_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Disposition Password') }}" value="" required>

                    @if ($errors->has('old_disposition_password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('old_disposition_password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('disposition_password') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-disposition-password">Password Disposisi Baru</label>
                    <input type="password" minlength="6" name="disposition_password" id="input-disposition-password" class="form-control form-control-alternative{{ $errors->has('disposition_password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Disposition Password') }}" value="" required>

                    @if ($errors->has('disposition_password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('disposition_password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="input-disposition-password-confirmation">Konfirmasi Password Disposisi Baru</label>
                    <input type="password" minlength="6" name="disposition_password_confirmation" id="input-disposition-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm New Disposition Password') }}" value="" required>

                    @if ($errors->has('disposition_password_confirmation'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('disposition_password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-success mt-1">Ubah Password Disposisi</button>
            </div>
        </form>
    </div>
</div>
