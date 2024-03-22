@extends('layouts.app', ['page_title' => 'Master Pendamping'])

@section('content')
    @include('users.partials.header', ['title' => 'Pendamping'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Ubah Data Pendamping</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('agenda/pendamping') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('agenda/pendamping/'. $partner->id) }}">
                            @csrf
                            @method('PUT')
                            @include('agenda.partner._form', ['data' => $partner])
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
