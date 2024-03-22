@extends('layouts.app', ['page_title' => 'Master Petugas TTD'])

@section('content')
    @include('users.partials.header', ['title' => 'Form Petugas'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Data Petugas Penandatangan</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/arsip/petugas') }}" data-status="{{ $errors->any() ? 'edit' : 'add' }}" id="form-input">
                            @csrf
                            @method('PUT')
                            @include('archive._form_petugas_ttd', ['data' => $petugas_ttd])
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('css')
    {{-- custom --}}
    @include('inbox._css')
@endpush
