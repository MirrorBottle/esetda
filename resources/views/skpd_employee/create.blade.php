@extends('layouts.app', ['page_title' => 'Master Pejabat SKPD'])

@section('content')
    @include('users.partials.header', ['title' => 'Pejabat SKPD'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Tambah Pejabat SKPD</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/skpd-pejabat') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/skpd-pejabat') }}">
                            @csrf

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('skpd_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_skpd_id">Nama SKPD <span class="text-danger">*</span></label>
                                    <select name="skpd_id" id="input_skpd_id" class="form-control select2 form-control-alternative{{ $errors->has('skpd_id') ? ' is-invalid' : '' }}" required>
                                        <option value="" disabled selected>Pilih SKPD:</option>
                                        @foreach ($skpds as $skpd)
                                            @php $selected_skpd = old('skpd_id') == $skpd->id ? 'selected' : ''; @endphp
                                            <option value="{{ $skpd->id }}" {{ $selected_skpd }}>{{ $skpd->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('skpd_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('skpd_id') }}</strong>
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
                                    <label class="form-control-label" for="input_position">Jabatan <span class="text-danger">*</span></label>
                                    <input type="text" name="position" id="input_position" class="form-control form-control-alternative{{ $errors->has('position') ? ' is-invalid' : '' }}" value="{{ old('position') }}" required>

                                    @if ($errors->has('position'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('position') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('group') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_group">Golongan</label>
                                    <input type="text" name="group" id="input_group" class="form-control form-control-alternative{{ $errors->has('group') ? ' is-invalid' : '' }}" value="{{ old('group') }}">

                                    @if ($errors->has('group'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('group') }}</strong>
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


@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container {
            width: 100% !important;
        }
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border-radius: 4px;
            transition: box-shadow .15s ease;
            border: 0;
            box-shadow: 0 1px 3px rgba(50, 50, 93, .15), 0 1px 0 rgba(0, 0, 0, .02);
            height: 45px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #9aa7b7;
            line-height: 46px;
            font-size: .9rem;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 46px;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

    <script>
        $(function() {
            $('#input_skpd_id').select2();
        });
    </script>
@endpush
