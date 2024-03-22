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
                                <h3 class="mb-0">Ubah Data Penandatangan SPT</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/spt-ttd') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/spt-ttd/'. $spt_signer->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('label') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_label">Label <span class="text-danger">*</span></label>
                                    <input type="text" name="label" id="input_label" class="form-control form-control-alternative{{ $errors->has('label') ? ' is-invalid' : '' }}" value="{{ old('label', $spt_signer->label) }}" required autofocus>

                                    @if ($errors->has('label'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('label') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_title">Title <span class="text-danger">*</span></label>
                                    <textarea class="form-control form-control-alternative {{ $errors->has('title') ? ' is-invalid' : '' }}" rows="3" name="title" id="input_title" required>{{ old('title', $spt_signer->title) }}</textarea>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_name">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="input_name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $spt_signer->name) }}" required>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('nip') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_nip">NIP </label>
                                    <input type="text" name="nip" id="input_nip" class="form-control form-control-alternative{{ $errors->has('nip') ? ' is-invalid' : '' }}" value="{{ old('nip', $spt_signer->nip) }}">

                                    @if ($errors->has('nip'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nip') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('position') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_position">Posisi</label>
                                    <input type="text" name="position" id="input_position" class="form-control form-control-alternative{{ $errors->has('position') ? ' is-invalid' : '' }}" value="{{ old('position', $spt_signer->position) }}">

                                    @if ($errors->has('position'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('position') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-success mt-2">
                                        <i class="fa fa-check"></i> Simpan Perubahan
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
        .select2-container--default .select2-selection--multiple {
            transition: box-shadow .15s ease;
            border: 0;
            padding: .3rem;
            box-shadow: 0 1px 3px rgba(50, 50, 93, .15), 0 1px 0 rgba(0, 0, 0, .02);
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

    <script>
        $(function() {
            $('#input_categories').select2();

            $('.switch-button button').on('click', function(e) {
                if ($(this).hasClass('luar-setda')) {
                    $('.lingkup-setda').html('Lingkup Setda');
                    $('.lingkup-setda').addClass('btn-secondary').removeClass('btn-success');
                    $('.luar-setda').html('<i class="fa fa-check"></i> Luar Setda')
                    $('.luar-setda').removeClass('btn-secondary').addClass('btn-success');
                    $('#input_type').val('0');
                } else {
                    $('.luar-setda').html('Luar Setda');
                    $('.luar-setda').addClass('btn-secondary').removeClass('btn-success');
                    $('.lingkup-setda').html('<i class="fa fa-check"></i> Lingkup Setda')
                    $('.lingkup-setda').removeClass('btn-secondary').addClass('btn-success');
                    $('#input_type').val('1');
                }
            });
        });
    </script>
@endpush
