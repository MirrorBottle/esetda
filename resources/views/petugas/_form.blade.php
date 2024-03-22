<div class="pl-lg-4">
    <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input_title">
            Jabatan <small class="text-danger">*</small>
        </label>
        <input type="text"
            class="form-control form-control-alternative {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
            id="input_title" value="{{ $data->title ?? old('title') }}" required>

        @if ($errors->has('title'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input_title">
            Nama <small class="text-danger">*</small>
        </label>
        <input type="text" class="form-control form-control-alternative {{ $errors->has('name') ? ' is-invalid' : '' }}"
            name="name" id="input_title" value="{{ $data->name ?? old('name') }}" required>

        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('sub_title') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input_sub_title">
            Pangkat
        </label>
        <input type="text"
            class="form-control form-control-alternative {{ $errors->has('sub_title') ? ' is-invalid' : '' }}" name="sub_title"
            id="input_sub_title" value="{{ $data->sub_title ?? old('sub_title') }}" required>

        @if ($errors->has('sub_title'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('sub_title') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('nip') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input_nip">
            NIP
        </label>
        <input type="text" class="form-control form-control-alternative {{ $errors->has('nip') ? ' is-invalid' : '' }}"
        name="nip" id="input_nip" value="{{ $data->nip ?? old('nip') }}" placeholder="(optional)">

        @if ($errors->has('nip'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('nip') }}</strong>
            </span>
        @endif
    </div>
    <div>
        <button type="submit" class="btn btn-lg btn-info mt-3">
            <i class="fa fa-check"></i> Simpan Perubahan
        </button>
    </div>
</div>
