@extends('layouts.app', ['page_title' => 'Surat Tamu'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3 class="mb-0">{{ isset($filter) ? 'Pencarian' : 'Daftar' }} Surat Tamu</h3>
                            </div>
                            <div class="col-6 text-right">
                                &nbsp;
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-flush datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No</th>
                                    <th scope="col">No Surat</th>
                                    {{-- <th scope="col">Judul</th> --}}
                                    <th scope="col">Pengirim</th>
                                    <th scope="col">Asal</th>
                                    <th scope="col">Tujuan Surat</th>
                                    <th scope="col">Tgl Entry</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('visitor._table')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
    @include('visitor._detail_modal')
    @include('visitor._forward_modal')
    @include('visitor._invalid_modal')
    @include('partials.remove-modal')
@endsection

@push('css')
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    {{-- custom --}}
    @include('inbox._css_index')
    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border-radius: 4px;
            transition: box-shadow .15s ease;
            border: 0;
            box-shadow: 0 1px 3px rgba(50, 50, 93, .15), 0 1px 0 rgba(0, 0, 0, .02);
            height: 45px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #9aa7b7;
            line-height: 46px;
            font-size: .9rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 46px;
        }
    </style>
@endpush

@push('js')
    {{-- select2 --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>
    {{-- datatable --}}
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    {{-- custom --}}
    @include('visitor._js_index')
@endpush
