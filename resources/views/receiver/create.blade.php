@extends('layouts.app', ['page_title' => 'Master Tujuan'])

@section('content')
    @include('users.partials.header', ['title' => 'Tujuan'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Tambah Tujuan Baru</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/tujuan') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/tujuan') }}">
                            @csrf

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_name">Nama Tujuan</label>
                                    <input type="text" name="name" id="input_name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_type">Tipe</label>
                                    <input type="hidden" name="type" id="input_type" value="{{ old('type') ?? 0 }}" required>
                                    <div>
                                        <div class="btn-group switch-button" role="group" aria-label="Type group">
                                            <button type="button" class="btn btn-{{ old('type', '0') == '0' ? 'success' : 'secondary' }} luar-setda" data-value="0">
                                                {!! old('type', 0) == '0' ? '<i class="fa fa-check"></i>' : '' !!} Luar Setda
                                            </button>
                                            <button type="button" class="btn btn-{{ old('type') == '1' ? 'success' : 'secondary' }} lingkup-setda" data-value="1">
                                                {!! old('type') == '1' ? '<i class="fa fa-check"></i>' : '' !!} Lingkup Setda
                                            </button>
                                        </div>
                                    </div>

                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_description">Keterangan</label>
                                    <textarea class="form-control form-control-alternative {{ $errors->has('description') ? ' is-invalid' : '' }}" rows="3" placeholder="(opsional)" name="description" id="input_description">{{ old('description') }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">
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
