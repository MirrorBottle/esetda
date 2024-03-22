@extends('layouts.app', ['page_title' => 'PANDUAN'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="card shadow mb-4">
            <div class="card-header bg-secondary border-0">
                <h3 class="mb-0">Panduan Disposisi</h3>
            </div>
            <div class="card-body">
                <img src="{{ url('images/print-disposisi.png') }}" alt="panduan cetak disposisi" class="img-thumbnail">
                <div class="mt-5">
                    <h2>Catatan</h2>
                    <p>Ukuran Kertas : B5</p>
                    <p>Margin : Custom (Kanan : 0.63)</p>
                    <p>Scale / Skala : 100 (menyesuaikan)</p>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
