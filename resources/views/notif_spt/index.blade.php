@extends('layouts.app', ['page_title' => 'Notifikasi SPT'])

@section('content')
    <div class="header pb-8 pt-5 pt-lg-6 d-flex align-items-center" style="background-image: url({{ asset('images/cover.jpg') }}); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="display-2 text-white">Notifikasi SPT</h1>
                </div>
            </div>
        </div>
        @include('partials.alert')
    </div>


    <div class="container-fluid mt--7">
        @include('notif_spt._notif_card')
        @include('notif_spt._phone_card')

        @include('notif_spt._form_modal')
        @include('notif_spt._form_template_modal')
        @include('partials.remove-modal')
        @include('layouts.footers.auth')
    </div>
@endsection

@push('css')
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    {{-- custom --}}
    @include('notif_spt._style')
@endpush

@push('js')
    {{-- datatable --}}
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    {{-- select2 --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>
    {{-- custom --}}
    @include('notif_spt._script')
@endpush

