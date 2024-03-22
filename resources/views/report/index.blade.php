@extends('layouts.app', ['page_title' => 'Laporan Surat'])

@section('content')
    @include('users.partials.header', ['title' => 'Laporan Surat'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('laporan/cetak') }}" target="_blank">
                            @csrf

                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input_type">Tipe Surat</label>
                                    <div class="switch-button">
                                        @if (auth()->user()->isTupimDua())
                                            <a href="#" class="btn btn-primary keluar">
                                                <i class="fa fa-check"></i>
                                                Surat Keluar
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-primary masuk">
                                                <i class="fa fa-check"></i>
                                                Surat Masuk
                                            </a>
                                            @if (auth()->user()->type_formatted !== 'super')
                                                <a href="#" class="btn btn-secondary keluar">
                                                    Surat Keluar
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                    <input type="hidden" name="type" id="type" value="{{ auth()->user()->isTupimDua() ? 'keluar' : 'masuk' }}">
                                </div>

                                <div class="form-group" id="tipe-file">
                                    <label class="form-control-label" for="input_file_type">Tipe File</label>
                                    <div class="switch-file" data-active="">
                                        <div>
                                            <a href="#" class="btn btn-primary pdf">
                                                <i class="fa fa-check"></i>
                                                PDF
                                            </a>
                                            <a href="#" class="btn btn-secondary excel">
                                                Excel
                                            </a>
                                        </div>
                                        <input type="hidden" class="file_type" name="file_type" id="file_type" value="pdf">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="input_tgl_surat">Tanggal Entry</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control datepicker-id-start" placeholder="Awal" name="date_indo_start" autocomplete="off" type="text">
                                                <input type="hidden" id="hidden-date-start" name="date_start">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control datepicker-id-end" placeholder="Akhir" name="date_indo_end" type="text" value="{{ $date }}" autocomplete="off">
                                                <input type="hidden" id="hidden-date-end" name="date_end" value="{{ date('Y-m-d') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" style="display: none;" id="tipe-area">
                                    <label class="form-control-label" for="input_id_detail_type">Tipe Tujuan</label>
                                    <div class="switch-tipe" data-active="">
                                        <div>
                                            <a href="#" class="btn btn-secondary lingkup">
                                                Lingkup Setda
                                            </a>
                                            <a href="#" class="btn btn-secondary luar">
                                                Luar Setda
                                            </a>
                                            <a href="#" class="btn btn-secondary keduanya">
                                                Semua
                                            </a>
                                        </div>
                                        <input type="hidden" class="receiver_type" name="receiver_type">
                                    </div>
                                </div>

                                <div class="form-group" id="receiver-area" style="{{ auth()->user()->biro_id !== 1 ? 'display: none;' : '' }}">
                                    <label class="form-control-label" for="input_multi_receiver_id">Tujuan Surat</label>
                                    <select name="multi_receiver_id[]" id="input_multi_receiver_id" class="form-control" multiple>
                                        @foreach ($receivers as $receiver)
                                            <option value="{{ $receiver->id }}" data-type="{{ $receiver->type }}">{{ $receiver->name }}</option>
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

        .select2-container {
            width: 100% !important;
        }
        .select2-container--default .select2-selection--multiple {
            border: solid #d4d4d4 1px;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
            font-size: .9rem;
        }

        .select2-container .select2-results__option.optInvisible {
            display: none;
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
    @include('report._js')
@endpush
