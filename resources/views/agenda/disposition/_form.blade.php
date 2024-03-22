<div class="pl-lg-4">
    <div class="form-group{{ $errors->has('position') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input-position">Posisi</label>
        <input type="text" name="position" id="input-position" class="form-control form-control-alternative{{ $errors->has('position') ? ' is-invalid' : '' }}" value="{{ $data->position ?? old('position') }}" required autofocus>

        @if ($errors->has('position'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('position') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input-name">Nama <small class="text-muted">(opsional)</small></label>
        <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $data->name ?? old('name') }}">

        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <button type="submit" class="btn btn-success mt-2 mb-4">
        <i class="fa fa-check"></i> Simpan Data
    </button>
</div>
