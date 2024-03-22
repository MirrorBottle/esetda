@extends('layouts.app', ['page_title' => 'Surat Masuk'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                @foreach ($kops as $kop)
                    <div class="card shadow mb-4">
                        <div class="card-header bg-secondary border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ $kop->title }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    {{-- <a href="{{ url('/kop/edit/'. $kop->id) }}" class="text-left btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i> Ubah Data
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            {!! $kop->content !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('css')
    <style>
        .card-body {
            font-size: 10px;
            color: #000;
        }
        .card-body table {
            font-size: 11px;
        }
        .card-body tr th, tr td, .rekap p {
            border-color: #000 !important;
            line-height: 1.4;
        }
        .card-body .header-wrapper {
            margin: 0 auto;
        }
        .card-body .table-bordered, .table-bordered td, .table-bordered th, .table thead th {
            border-color: #000 !important;
        }
        .card-body .img-header {
            width: 68px;
            margin-top: 20px;
            margin-left: 24px;
            position: absolute;
        }
        .card-body th {
            text-align: center;
        }
        .card-body td {
            vertical-align: top;
        }
        .card-body h1, h2, h3, h4, h5, h6, p {
            margin: 0;
        }
        .card-body hr {
            border-color: #000;
        }
        .card-body .box {
            height: 8px;
            width: 8px;
            padding: 3px 20px;
            margin-right: 6px;
            border: 1px solid #000;
        }
        .card-body ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .card-body ul > li {
            margin-bottom: 8px;
        }

        .card-body img:nth-child(1) {
            width: 70px !important;
            margin-top: 20px !important;
            margin-left: 0px !important;
        }
    </style>
@endpush
