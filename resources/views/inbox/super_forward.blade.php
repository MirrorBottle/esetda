@extends('layouts.app', ['page_title' => 'Surat Terusan'])

@section('content')
    @include('layouts.headers.empty')
    {{-- check user type --}}
    @php $user_type = auth()->user()->type_formatted @endphp
    @php $is_super = strpos(auth()->user()->username, 'admin') !== false || strpos(auth()->user()->username, 'pj') !== false || strpos(auth()->user()->username, 'karo') !== false @endphp

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3 class="mb-0">Daftar Surat Terusan</h3>
                            </div>
                            <div class="col-6 text-right">
                                &nbsp;
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
                                    <th scope="col">Tujuan Disposisi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"><span class="badge badge-danger">Tgl Surat</span><br><span class="badge badge-primary">Tgl Entry</span></th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('inbox._table', ['is_super' => $is_super])
                            </tbody>
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
