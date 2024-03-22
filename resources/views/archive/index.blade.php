@extends('layouts.app', ['page_title' => 'Arsip Surat '. ucfirst($type)])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3 class="mb-0">
                                {{ isset($filter) ? 'Pencarian' : 'Daftar' }}
                                 Arsip Surat {{ ucfirst($type) }}</h3>
                            </div>
                            <div class="col-6 text-right">
                                @isset($filter)
                                    <a href="{{ url('/arsip/pencarian?surat='. $type .'&'. $filter) }}" class="text-left btn btn-sm btn-secondary">
                                        <i class="fa fa-arrow-left"></i> Kembali
                                    </a>
                                @endisset

                                <a href="#" class="text-left btn btn-sm btn-secondary check-all">
                                    <i class="fa fa-check-circle"></i> <span>Check All</span>
                                </a>

                                <a href="{{ url('/arsip/validasi') }}" class="text-left btn btn-sm btn-default btn-validate" style="display: none;" data-toggle="modal" data-target="#validate-modal">
                                    <i class="fa fa-check"></i> Kirim Data Arsip
                                </a>

                                @if (! auth()->user()->isAdmin())
                                    <a href="{{ url('/arsip/'. $type .'/create') }}" class="text-left btn btn-sm btn-primary">
                                        <i class="fa fa-plus"></i> Tambah Data
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-flush" id="datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No</th>
                                    @if (auth()->user()->isAdmin())
                                        <th scope="col">Biro</th>
                                    @endif
                                    <th scope="col">Tanggal Masuk</th>
                                    <th scope="col">No Surat</th>
                                    <th scope="col">Uraian</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Kondisi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('archive._table')
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <a href="#" class="text-left btn btn-sm btn-secondary check-all">
                                            <i class="fa fa-check-circle"></i> <span>Check All</span>
                                        </a>
                                        <a href="#" class="text-left btn btn-sm btn-default btn-validate" style="display: none;" data-toggle="modal" data-target="#validate-modal">
                                            <i class="fa fa-check"></i> Kirim Data Arsip
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
        @include('archive._validate_modal')
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
