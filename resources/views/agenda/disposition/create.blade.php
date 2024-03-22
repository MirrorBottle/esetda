@extends('layouts.app', ['page_title' => 'Master Disposisi'])

@section('content')
    @include('users.partials.header', ['title' => 'Disposisi'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Tambah Disposisi Baru</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('agenda/disposisi') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('agenda/disposisi') }}">
                            @csrf
                            @include('agenda.disposition._form')
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
