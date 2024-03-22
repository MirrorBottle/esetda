@extends('layouts.app', ['page_title' => 'Surat Masuk'])

@section('content')
    @include('layouts.headers.empty')
    {{-- check user type --}}
    @php $user_type = auth()->user()->type_formatted @endphp
    @php $is_super = strpos(auth()->user()->username, 'admin') !== false || strpos(auth()->user()->username, 'pj') !== false || strpos(auth()->user()->username, 'karo') !== false @endphp
    @php $biro_label = auth()->user()->username == 'fahmi' && request()->biro_id != "" ? " - " . $biros[request()->biro_id] : ''; @endphp

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3 class="mb-0">{{ isset($filter) ? 'Pencarian' : 'Daftar' }} Surat Masuk {{ $biro_label }}</h3>
                            </div>
                            <div class="col-6 text-right">
                                @isset($filter)
                                    <a href="{{ url('/pencarian-surat?'. $filter) }}" class="text-left btn btn-sm btn-secondary">
                                        <i class="fa fa-arrow-left"></i> Kembali
                                    </a>
                                @endisset

                                @if (!$is_super)
                                    <a href="#" class="text-left btn btn-sm btn-secondary check-all">
                                        <i class="fa fa-check-circle"></i> <span>Check All</span>
                                    </a>

                                    <a href="{{ url('/arsip/validasi') }}" class="text-left btn btn-sm btn-success btn-validate" style="display: none;" data-toggle="modal" data-target="#validate-modal">
                                        <i class="fa fa-check"></i> Jadikan Arsip
                                    </a>

                                    <a href="{{ url('/surat-masuk/create') }}" class="text-left btn btn-sm btn-primary">
                                        <i class="fa fa-plus"></i> Tambah Data
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-flush datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No</th>
                                    <th scope="col">No Surat</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Pengirim</th>
                                    @if (auth()->user()->biro_id == 1)
                                        <th scope="col">Tujuan Surat</th>
                                    @endif
                                    <th scope="col">Tujuan Disposisi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"><span class="badge badge-danger">Tgl Surat</span><br><span class="badge badge-primary">Tgl Entry</span></th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('inbox._table', ['is_super' => $is_super])
                            </tbody>
                            @if (!$is_super)
                                <tfoot>
                                    <tr>
                                        <td colspan="{{ auth()->user()->biro_id == 1 ? '8' : '7' }}">
                                            <a href="#" class="text-left btn btn-sm btn-secondary check-all">
                                                <i class="fa fa-check-circle"></i> <span>Check All</span>
                                            </a>
                                            <a href="#" class="text-left btn btn-sm btn-default btn-validate" style="display: none;" data-toggle="modal" data-target="#validate-modal">
                                                <i class="fa fa-check"></i> Jadikan Arsip
                                            </a>
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
        @include('archive._validate_modal', ['type' => 'masuk'])
        @include('partials.detail-modal')
        @include('partials.remove-modal')
        @include('partials.forward-modal')
        @include('partials.receipt-modal')
        @include('inbox._archive_modal')
        @include('inbox._disposisi_modal')
    </div>
@endsection

@push('css')
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    {{-- custom --}}
    @include('inbox._css_index')
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
    @include('inbox._js_index')
@endpush
