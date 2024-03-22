@extends('layouts.app', ['page_title' => 'Arsip Surat '. ucfirst($type)])

@section('content')
    @include('users.partials.header', ['title' => 'Form Arsip'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Tambah Arsip {{ ucfirst($type) }} Baru</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/arsip/'.$type) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/arsip/'.$type) }}" data-status="{{ $errors->any() ? 'edit' : 'add' }}" id="form-input" enctype="multipart/form-data">
                            @csrf
                            @include('archive._form')
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
    @include('inbox._css')
@endpush

@push('js')
    {{-- datepicker --}}
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.id.min.js') }}"></script>
    {{-- select2 --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>
    {{-- moment --}}
    <script src="{{ asset('js/moment.min.js') }}"></script>
    {{-- custom --}}
    @include('archive._js')
@endpush
