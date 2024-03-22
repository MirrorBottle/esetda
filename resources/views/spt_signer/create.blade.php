@extends('layouts.app', ['page_title' => 'Master Penandatangan SPT'])

@section('content')
    @include('users.partials.header', ['title' => 'Penandatangan SPT'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Tambah Penandatangan SPT</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/spt-ttd') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/spt-ttd') }}">
                            @csrf

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('label') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_label">Label <span class="text-danger">*</span></label>
                                    <input type="text" name="label" id="input_label" class="form-control form-control-alternative{{ $errors->has('label') ? ' is-invalid' : '' }}" value="{{ old('label') }}" required autofocus>

                                    @if ($errors->has('label'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('label') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_title">Title <span class="text-danger">*</span></label>
                                    <textarea class="form-control form-control-alternative {{ $errors->has('title') ? ' is-invalid' : '' }}" rows="3" name="title" id="input_title" required>{{ old('title') }}</textarea>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_name">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="input_name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('nip') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_nip">NIP</label>
                                    <input type="text" name="nip" id="input_nip" class="form-control form-control-alternative{{ $errors->has('nip') ? ' is-invalid' : '' }}" value="{{ old('nip') }}">

                                    @if ($errors->has('nip'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nip') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('position') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_position">Posisi</label>
                                    <input type="text" name="position" id="input_position" class="form-control form-control-alternative{{ $errors->has('position') ? ' is-invalid' : '' }}" value="{{ old('position') }}">

                                    @if ($errors->has('position'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('position') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-success mt-2">
                                        <i class="fa fa-check"></i> Simpan Data
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
