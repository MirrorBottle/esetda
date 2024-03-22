@extends('layouts.app', ['page_title' => 'Tamu'])

@section('content')
    <div class="header d-flex align-items-center" style="background-image: url({{ asset('images/cover.jpg') }});">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center text-center header-area">
            <div class="row w-100 m-0">
                <div class="col-12">
                    {{-- <h1 class="display-2 text-white">Form Tamu</h1> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            @if ($message = Session::get('custom_message'))
                <div class="col-12 col-md-10 offset-md-1 mb-3">
                    <div class="card bg-secondary shadow">
                        <div class="card-body text-center">
                            <i class="fa fa-check-circle text-success mb-3" style="font-size: 4rem;"></i>
                            <h1>Berhasil mengirim data ke SISDA KALTIM</h1>
                            <p>Harap simpan kode berikut untuk melakukan pelacakan status surat secara online</p>
                            <h1 class="text-danger">
                                <span class="unique-code">{{ $message }}</span>
                                <a href="#" class="ml-1 btn btn-sm btn-info" id="copy">
                                    <i class="fa fa-copy mr-1"></i> copy
                                </a>
                            </h1>
                            {{-- <p class="mt-4">Panduan pelacakan surat melalui website atau Whatsapp SISDA dapa dilihat pada infografis dibawah ini.</p> --}}
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-12 col-md-10 offset-md-1 order-xl-1">
                <div class="card bg-secondary shadow mb-5">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-8">
                                <h2 class="mb-0">FORM TAMU KANTOR GUBERNUR KALTIM</h2>
                            </div>
                            <div class="col-12 col-md-4 card-action-buttons">
                                <a href="{{ url('/cek-surat') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-check-circle"></i> Cek Status Surat
                                </a>
                                <a href="https://api.whatsapp.com/send?phone=6285349894245&text=Halo, saya ingin bertanya terkait pengisisan form tamu kantor gubernur kaltim." target="_blank" class="btn btn-sm btn-success">
                                    <i class="fa fa-info-circle"></i> Informasi
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/tamu') }}" enctype="multipart/form-data" id="form-input" autocomplete="off">
                            @csrf
                            @include('visitor._form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">

    @include('visitor._css')
@endpush

@push('js')
    {{-- select2 --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>

    @include('visitor._js')
@endpush
