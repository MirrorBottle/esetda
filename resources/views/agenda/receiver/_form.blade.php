<div class="pl-lg-4">
    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input-name">Nama Yang Menghadiri</label>
        <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $data->name ?? old('name') }}" required autofocus>

        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input-code">Kode</label>
        <input type="text" name="code" id="input-code" class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}" value="{{ $data->code ?? old('code') }}" required>

        @if ($errors->has('code'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('code') }}</strong>
            </span>
        @endif
    </div>

    <button type="submit" class="btn btn-success mt-2 mb-4">
        <i class="fa fa-check"></i> Simpan Data
    </button>
</div>
