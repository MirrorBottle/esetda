@extends('layouts.app', ['page_title' => 'Master Nomor'])

@section('content')
    @include('users.partials.header', ['title' => 'Nomor'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Tambah Nomor Baru</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/arsip/nomor-surat') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/arsip/nomor-surat') }}">
                            @csrf
                            <div class="pl-lg-4">
                                @include('letter_number.master._form')
                                <div>
                                    <button type="submit" class="btn btn-primary mt-4 mb-2">
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
