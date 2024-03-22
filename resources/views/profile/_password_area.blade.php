<div class="card bg-secondary shadow mb-3">
    <div class="card-header bg-white border-0">
        <div class="row align-items-center">
            <h3 class="col-12 mb-0"><i class="fa fa-lock mr-1 text-success"></i> Ubah Password Login</h3>
        </div>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
            @csrf
            @method('put')

            <div class="form-area">
                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-current-password">Password Saat Ini</label>
                    <input type="password" minlength="6" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>

                    @if ($errors->has('old_password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('old_password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-password">Password Baru</label>
                    <input type="password" minlength="6" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="input-password-confirmation">Konfirmasi Password Baru</label>
                    <input type="password" minlength="6" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm New Password') }}" value="" required>

                    @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-success mt-1">Ubah Password</button>
            </div>
        </form>
    </div>
</div>
