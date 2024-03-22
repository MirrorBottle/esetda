@extends('layouts.app', ['page_title' => 'Penomoran Surat'])

@section('content')
    @include('users.partials.header', ['title' => 'Penomoran Surat'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Tambah Penomoran Baru</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/arsip/penomoran') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/arsip/penomoran') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="pl-lg-4">
                                @include('letter_number.used._form')
                                <div class="toggle-bottom-area">
                                    <button type="submit" class="btn btn-primary mt-1 mb-2">
                                        <i class="fa fa-check"></i> Simpan Data
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    @include('letter_number.used._js')
@endpush
