@extends('layouts.app', ['page_title' => 'Surat Lingkup Setda'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ isset($filter) ? 'Pencarian' : 'Daftar' }} Surat Lingkup Setda</h3>
                            </div>
                            <div class="col-4 text-right">
                                @isset($filter)
                                    <a href="{{ url('/pencarian-surat?'. $filter) }}" class="text-left btn btn-sm btn-secondary">
                                        <i class="fa fa-arrow-left"></i> Kembali
                                    </a>
                                @endisset
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
                        <table class="table table-striped table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No</th>
                                    <th scope="col">Tipe</th>
                                    <th scope="col">Pengirim</th>
                                    <th scope="col">No Surat</th>
                                    <th scope="col">Tgl Surat</th>
                                    <th scope="col">Tgl Entry</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('forward._table')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('forward._detail')
        @include('forward._lampiran_modal')
        @include('forward._keterangan_modal')
        @include('forward._duplikasi_modal')
        @include('inbox._disposisi_modal')
        @include('layouts.footers.auth')
    </div>
@endsection

@push('css')
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    {{-- custom --}}
    @include('inbox._css_index')
    <style>
        #form-lampiran label {
            overflow: auto;
        }
    </style>
@endpush

@push('js')
    {{-- datepicker --}}
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.id.min.js') }}"></script>
    {{-- datatable --}}
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    {{-- moment --}}
    <script src="{{ asset('js/moment.min.js') }}"></script>
    {{-- custom --}}
    @include('forward._script')
@endpush
