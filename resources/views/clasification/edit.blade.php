@extends('layouts.app', ['page_title' => 'Master Klasifikasi'])

@section('content')
    @include('users.partials.header', ['title' => 'Klasifikasi'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Ubah Klasifikasi</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/arsip/klasifikasi') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/arsip/klasifikasi/'. $clasification->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="pl-lg-4">
                                <input type="hidden" name="id" value="{{ $clasification->id }}">
                                @include('clasification._form', ['data' => $clasification])
                                <div>
                                    <button type="submit" class="btn btn-info mt-4">
                                        <i class="fa fa-check"></i> Simpan Perubahan
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
