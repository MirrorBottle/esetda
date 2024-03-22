<div class="row">
    <div class="col-12 col-md-4">
        <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="input-code">Kode</label>
            <input type="text" name="code" id="input-code" class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="" value="{{ $data->code ?? old('code') }}" required autofocus>

            @if ($errors->has('code'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('code') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div class="form-group{{ $errors->has('code_clasification') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="input-code_clasification">Kode Klasifikasi</label>
            <input type="text" name="code_clasification" id="input-code_clasification" class="form-control form-control-alternative{{ $errors->has('code_clasification') ? ' is-invalid' : '' }}" value="{{ $data->code_clasification ?? old('code_clasification') }}" placeholder="(optional)">

            @if ($errors->has('code_clasification'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('code_clasification') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
    <label class="form-control-label" for="input-name">Nama Klasifikasi</label>
    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="" value="{{ $data->name ?? old('name') }}" required autofocus>

    @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
    <label class="form-control-label" for="input-description">Keterangan</label>
    <textarea name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="(optional)" value="">{{ $data->description ?? old('description') }}</textarea>

    @if ($errors->has('description'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>
