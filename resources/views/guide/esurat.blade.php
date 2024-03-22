@extends('layouts.app', ['page_title' => 'PANDUAN'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="card shadow mb-4">
            <div class="card-header bg-secondary border-0">
                <h3 class="mb-0">Panduan E-Surat</h3>
            </div>
            <div class="card-body text-center">
                Coming Soon
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
