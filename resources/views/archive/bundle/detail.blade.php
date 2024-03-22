@extends('layouts.app', ['page_title' => 'Arsip Surat '. ucfirst($type)])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <h3 class="mb-0">
                                    <a href="{{ url('arsip/bundle/'. $type) }}" class="btn btn-sm btn-default mr-2">
                                        <i class="fa fa-arrow-left"></i> Kembali
                                    </a>
                                    Detail Validasi Arsip Surat {{ ucfirst($type) }} #{{ $details[0]->id }}
                                </h3>
                            </div>
                            <div class="col-5 text-right">
                                <a href="#" class="text-left btn btn-sm btn-secondary check-all">
                                    <i class="fa fa-check-circle"></i> <span>Check All</span>
                                </a>

                                <a href="{{ url('/arsip/confirm') }}" class="text-left btn btn-sm btn-default btn-confirm" style="display: none;" data-toggle="modal" data-target="#confirm-modal">
                                    <i class="fa fa-check"></i> Validasi Arsip
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-flush" id="datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No</th>
                                    <th scope="col">Biro</th>
                                    <th scope="col">Tanggal Masuk</th>
                                    <th scope="col">No Surat</th>
                                    <th scope="col">Uraian</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Kondisi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('archive.bundle._table')
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <a href="#" class="text-left btn btn-sm btn-secondary check-all">
                                            <i class="fa fa-check-circle"></i> <span>Check All</span>
                                        </a>
                                        <a href="#" class="text-left btn btn-sm btn-default btn-confirm" style="display: none;" data-toggle="modal" data-target="#confirm-modal">
                                            <i class="fa fa-check"></i> Validasi Arsip
                                        </a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('archive._detail_modal')
        @include('archive._confirm_modal')
        @include('partials.remove-modal')
        @include('layouts.footers.auth')
    </div>
@endsection

@push('css')
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    {{-- custom --}}
    @include('inbox._css_index')
    <style>
        #datatable tbody tr { cursor: pointer; }
        .custom-toggle {
            width: 53px;
        }
        .custom-toggle-slider:before {
            left: 4px;
        }
        .custom-toggle input:checked+.custom-toggle-slider:after {
            right: auto;
            left: 0;
            content: attr(data-label-on);
            color: #4c7273;
        }
        .custom-toggle-slider:after {
            font-family: inherit;
            font-size: .75rem;
            font-weight: 600;
            line-height: 24px;
            position: absolute;
            top: 0;
            right: 0;
            display: block;
            overflow: hidden;
            min-width: 1.66667rem;
            margin: 0 .21667rem;
            content: attr(data-label-off);
            transition: all .15s ease;
            text-align: center;
            color: #ced4da;
        }
    </style>
@endpush

@push('js')
    {{-- select2 --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>
    {{-- datepicker --}}
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.id.min.js') }}"></script>
    {{-- datatable --}}
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    {{-- moment --}}
    <script src="{{ asset('js/moment.min.js') }}"></script>
    {{-- custom --}}
    @include('archive._js_index')
@endpush
