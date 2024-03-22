@extends('layouts.app', ['page_title' => 'Master Tujuan Agenda'])

@section('content')
    @include('users.partials.header', ['title' => 'Tujuan Agenda'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Tambah Tujuan Agenda Baru</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('agenda/tujuan') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                        <form method="post" action="{{ url('agenda/tujuan/'. $receiver->id) }}">
                            @csrf
                            @method('PUT')
                            @include('agenda.receiver._form', ['data' => $receiver])
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
