@extends('layouts.app', ['page_title' => 'Pencarian Surat SPT'])

@section('content')
    @include('users.partials.header', ['title' => 'Pencarian Surat SPT'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-body">
                        <form method="get" action="{{ url('/spt') }}" autocomplete="off">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-12 col-md-8">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input_tgl_surat">Tanggal Surat</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                        </div>
                                                        <input class="form-control datepicker-id-start" placeholder="Awal" name="date_indo_start" type="text" value="{{ request()->date_indo_start ?? '' }}" autocomplete="off">
                                                        <input type="hidden" id="hidden_date_start" name="date_start" value="{{ request()->date_start ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                        </div>
                                                        <input class="form-control datepicker-id-end" placeholder="Akhir" name="date_indo_end" type="text" value="{{ request()->date_indo_end ?? '' }}" autocomplete="off">
                                                        <input type="hidden" id="hidden_date_end" name="date_end" value="{{ request()->date_end ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-control-label" for="input_letter_number">Nomor SPT</label>
                                            <input type="text" name="letter_number" id="input_letter_number" class="form-control form-control-alternative" value="{{ request()->letter_number ?? '' }}">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-control-label" for="input_no">Dasar Surat</label>
                                            <input type="text" name="no" id="input_no" class="form-control form-control-alternative" value="{{ request()->no ?? '' }}">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-control-label" for="input_signer_id">Status</label>
                                            <select name="status" id="input_status" class="form-control select2 form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}">
                                                <option value="">-- Semua --</option>
                                                <option value="P" {{ old('status', request()->status ?? '') == 'P' ? 'selected' : '' }}>Proses</option>
                                                <option value="S" {{ old('status', request()->status ?? '') == 'S' ? 'selected' : '' }}>Selesai</option>
                                                <option value="B" {{ old('status', request()->status ?? '') == 'B' ? 'selected' : '' }}>Batal</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success mt-2">
                                                <i class="fa fa-search"></i> Cari Data
                                            </button>
                                            <a href="{{ url('/spt') }}" class="btn btn-default mt-2">
                                                <i class="fa fa-sync"></i> Muat Ulang
                                            </a>
                                        </div>
                                    </div>
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
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    {{-- custom css --}}
    @include('search._css')
@endpush

@push('js')
    {{-- datepicker --}}
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.id.min.js') }}"></script>
    {{-- select2 --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>
    {{-- moment --}}
    <script src="{{ asset('js/moment.min.js') }}"></script>
    {{-- custom js --}}
    @include('search._js')
@endpush
