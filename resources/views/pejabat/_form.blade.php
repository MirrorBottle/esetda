<div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
    <label class="form-control-label" for="input_type">Tipe</label>
    <input type="hidden" name="type" id="input_type" value="{{ $data->type ?? 0 }}" required>
    <div>
        <div class="btn-group switch-button" role="group" aria-label="Type group">
            <button type="button" class="btn btn-{{ ($data->type ?? 0) === 0 ? 'success' : 'secondary' }} sekda" data-value="{{ $data->type ?? '0' }}">
                {!! ($data->type ?? 0) === 0 ? '<i class="fa fa-check"></i>' : '' !!} Sekda
            </button>
            <button type="button" class="btn btn-{{ ($data->type ?? 0) === 1 ? 'success' : 'secondary' }} non-sekda" data-value="{{ $data->type ?? '1' }}">
                {!! ($data->type ?? 0) === 1 ? '<i class="fa fa-check"></i>' : '' !!} Non Sekda
            </button>
        </div>
    </div>

    @if ($errors->has('type'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('type') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
    <label class="form-control-label" for="input-title">Judul Inputan</label>
    <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="" value="{{ $data->title ?? old('title') }}" required autofocus>

    @if ($errors->has('title'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('position') ? ' has-danger' : '' }}">
    <label class="form-control-label" for="input-position">Jabatan TTD</label>
    <input type="text" name="position" id="input-position" class="form-control form-control-alternative{{ $errors->has('position') ? ' is-invalid' : '' }}" placeholder="" value="{{ $data->position ?? old('position') }}" required autofocus>

    @if ($errors->has('position'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('position') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
    <label class="form-control-label" for="input-name">Nama TTD</label>
    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $data->name ?? old('name') }}" required autofocus>

    @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>
