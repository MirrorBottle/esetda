@extends('layouts.app', ['page_title' => 'Agenda'])

@section('content')
    @include('users.partials.header', ['title' => 'Laporan Jadwal'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-body">
                        <form method="post" action="" target="_blank">
                            @csrf
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input_receiver_id">
                                                @if (auth()->user()->isAdmin())
                                                    Yang Menghadiri <small class="text-primary">* (kosong = seluruh tujuan)</small>
                                                @else
                                                    Yang Menghadiri
                                                @endif
                                            </label>
                                            @if (auth()->user()->isAdmin())
                                                <select name="receiver_id[]" id="input_receiver_id" class="form-control select2 form-control-alternative" multiple>
                                                    @foreach ($receivers as $receiver)
                                                        @php $selected_receiver = ($data->receiver_id ?? old('receiver_id', 0)) == $receiver->id ? 'selected' : ''; @endphp
                                                        <option value="{{ $receiver->id }}" {{ $selected_receiver }}>{{ $receiver->name }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <input type="hidden" name="receiver_id[]" id="input_receiver_id" value="{{ $default->id }}">
                                                <input type="text" class="form-control" value="{{ $default->name }}" readonly>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-control-label" for="input_tgl_surat">Tanggal Acara</label>
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
                                    <button type="submit" class="btn btn-success mt-2">
                                        <i class="fa fa-print"></i> Cetak Laporan
                                    </button>
                                    <a href="{{ url('/agenda/laporan') }}" class="btn btn-default mt-2">
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
    @include('agenda.search._css')
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
    @include('agenda.search._js')
@endpush
