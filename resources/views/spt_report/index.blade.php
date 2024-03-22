@extends('layouts.app', ['page_title' => 'Laporan SPT'])

@section('content')
    @include('users.partials.header', ['title' => 'Laporan SPT'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Form Laporan SPT</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('spt-laporan') }}" target="_blank" autocomplete="off">
                            @csrf

                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input_type">Tipe Filter</label>
                                    <div class="switch-button">
                                        <a href="#" class="btn btn-primary periode">
                                            <i class="fa fa-check"></i>
                                            Periode
                                        </a>
                                        <a href="#" class="btn btn-secondary tahunan">
                                            Tahunan
                                        </a>
                                    </div>
                                    <input type="hidden" name="type" id="type" value="periode">
                                </div>

                                <div class="form-group" id="periode-area">
                                    <label class="form-control-label" for="input_tgl_surat">Rentang Tanggal </label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control datepicker-id-start" placeholder="Dari" name="date_indo_start" autocomplete="off" type="text">
                                                <input type="hidden" id="hidden-date-start" name="date_start">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control datepicker-id-end" placeholder="Sampai" name="date_indo_end" type="text" autocomplete="off">
                                                <input type="hidden" id="hidden-date-end" name="date_end">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" id="tahunan-area" style="display: none;">
                                    <label class="form-control-label" for="input_tgl_surat">Rentang Tahun </label>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control" placeholder="Dari" name="year_start" type="number" value="{{ date('Y') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control" placeholder="Sampai" name="year_end" type="number" value="">
                                            </div>
                                        </div>
                                    </div>  
                                </div>

                                <div class="form-group" id="employee-area">
                                    <label class="form-control-label" for="input_skpd_employee_id">Daftar Pejabat <small>(pilihan kosong = semua)</small></label>
                                    <select name="skpd_employee_id[]" id="input_skpd_employee_id" class="form-control select2-multiple" multiple>
                                        @foreach ($skpd_employees as $employee)
                                            <option value="{{ $employee->id }}" data-type="{{ $employee->type }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-success mt-2">
                                        <i class="fa fa-print"></i> Cetak Laporan
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
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">

    <style>
        .datepicker-id-start, .datepicker-id-end {
            border-top-right-radius: .375rem !important;
            border-bottom-right-radius: .375rem !important;
        }

        .select2-container .select2-results__option.optInvisible {
            display: none;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid white;
            transition: box-shadow .15s ease;
            padding: .3rem;
            box-shadow: 0 1px 3px rgba(50, 50, 93, .15), 0 1px 0 rgba(0, 0, 0, .02);
        }
        .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
            font-size: .9rem;
        }

        .null-tujuan {
            display: none;
        }
    </style>
@endpush

@push('js')
    {{-- select2 --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>
    {{-- datepicker --}}
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.id.min.js') }}"></script>
    {{-- moment --}}
    <script src="{{ asset('js/moment.min.js') }}"></script>
    {{-- custom js --}}
    @include('spt_report._js')
@endpush
