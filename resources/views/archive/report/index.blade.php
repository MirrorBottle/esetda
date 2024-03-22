@extends('layouts.app', ['page_title' => 'Arsip Surat'])

@section('content')
    @include('users.partials.header', ['title' => 'Laporan Arsip'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-body">
                        <form method="post" action="" target="_blank">
                            @csrf
                            <div class="pl-lg-4">
                                <div class="row">
                                    @if ( auth()->user()->isAdmin() )
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-biro">Unit Pengolah <small class="text-primary">* (kosong = semua biro)</small></label>
                                                <select name="biro_id[]" id="input_biro_id" class="form-control select2 form-control-alternative" multiple>
                                                    @foreach ($biros as $biro)
                                                        <option value="{{ $biro->id }}">{{ $biro->alias }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input_type">Tipe Arsip</label>
                                            <div class="switch-button">
                                                <a href="#" class="btn btn-primary masuk">
                                                    <i class="fa fa-check"></i>
                                                    Surat Masuk
                                                </a>
                                                <a href="#" class="btn btn-secondary keluar">
                                                    Surat Keluar
                                                </a>
                                            </div>
                                            <input type="hidden" name="type" id="type" value="masuk">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input_year">Tahun</label>
                                            <select name="year" id="input_year" class="form-control select2 form-control-alternative">
                                                <option value="" disabled selected>Pilih Tahun:</option>
                                                @foreach (range(date('Y'), 2010) as $year)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-control-label" for="input_date">Tanggal Arsip</label>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control datepicker-id-start" placeholder="Awal" name="date_indo_start" type="text" value="{{ request()->date_indo_start ?? '' }}" autocomplete="off" required>
                                                <input type="hidden" id="hidden_date_start" name="date_start" value="{{ request()->date_start ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control datepicker-id-end" placeholder="Akhir" name="date_indo_end" type="text" value="{{ request()->date_indo_end ?? '' }}" autocomplete="off" required>
                                                <input type="hidden" id="hidden_date_end" name="date_end" value="{{ request()->date_end ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-7">
                                    <button type="submit" class="btn btn-info mt-2">
                                        <i class="fa fa-print"></i> Cetak Laporan
                                    </button>
                                    <a href="{{ url('/arsip/laporan') }}" class="btn btn-default mt-2">
                                        <i class="fa fa-sync"></i> Muat Ulang
                                    </a>
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
    {{-- custom --}}
    @include('archive.search._css')
@endpush

@push('js')
    {{-- select2 --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>
    {{-- datepicker --}}
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.id.min.js') }}"></script>
    {{-- moment --}}
    <script src="{{ asset('js/moment.min.js') }}"></script>
    {{-- custom --}}
    @include('archive.report._js')
@endpush
