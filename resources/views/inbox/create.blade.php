@extends('layouts.app', ['page_title' => 'Surat Masuk'])

@section('content')
    @include('users.partials.header', ['title' => 'Surat Masuk'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Tambah Surat Masuk Baru</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/surat-masuk') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/surat-masuk') }}" enctype="multipart/form-data" data-status="{{ $errors->any() ? 'edit' : 'add' }}" id="form-input">
                            @csrf
                            @include('inbox._form')
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
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
    @include('inbox._js')
@endpush
