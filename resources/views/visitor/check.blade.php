@extends('layouts.app', ['page_title' => 'Cek Status Surat'])

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
        <div class="col-12 col-md-10 offset-md-1 order-xl-1">
            <div class="card bg-secondary shadow mb-5">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-8">
                            <h2 class="mb-0">CEK STATUS SURAT TAMU &dash; KANTOR GUBERNUR KALTIM</h2>
                        </div>
                        <div class="col-12 col-md-4 card-action-buttons">
                            <a href="{{ url('/tamu') }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-file-alt"></i> Form Tamu
                            </a>
                            <a href="https://api.whatsapp.com/send?phone=6285349894245&text=Halo, saya ingin bertanya terkait pengisisan form tamu kantor gubernur kaltim."
                                target="_blank" class="btn btn-sm btn-success">
                                <i class="fa fa-info-circle"></i> Informasi
                            </a>
                        </div>
                    </div>
                </div>

                @php $code_is_wrong = Session::get('code_wrong'); @endphp

                <div class="card-body">
                    <form method="GET" action="{{ url('/cek-surat') }}" id="form-input" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label" for="input_kode">
                                Kode Resi
                                <small>(contoh: XYUI-BGAS-210109)</small>
                            </label>
                            <input type="text" name="kode" id="input_kode" class="form-control form-control-alternative" value="{{ $kode }}" required autofocus>

                            @if ($code_is_wrong)
                                <span class="invalid-feedback d-block my-2" role="alert">
                                    <strong>{{ $code_is_wrong }}</strong>
                                </span>
                            @endif
                        </div>
                        <div>
                            <button type="submit" class="btn btn-lg btn-success mb-3">
                                <i class="fa fa-paper-plane"></i> Cek Status Surat
                            </button>
                            <a href="#" class="btn btn-lg btn-secondary mb-3" id="reload">
                                <i class="fa fa-sync"></i> Muat Ulang
                            </a>
                        </div>

                        @isset($disposisi)
                            <div class="status-area mt-5">
                                <div class="timeline">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="timeline-container">
                                                    <div class="timeline-end">
                                                        <p>SELESAI</p>
                                                    </div>
                                                    <div class="timeline-continue">
                                                        <div class="row timeline-left">
                                                            <div class="col-md-6 d-md-none d-block">
                                                                <p class="timeline-date">
                                                                    30 Mar 2021 14:10
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="timeline-box">
                                                                    <div class="timeline-icon d-md-none d-block">
                                                                        <i class="fa fa-business-time"></i>
                                                                    </div>
                                                                    <div class="timeline-text">
                                                                        <h3>Biro Umum</h3>
                                                                        <p>Surat diteruskan ke Kasubag Keuangan
                                                                        </p>
                                                                    </div>
                                                                    <div class="timeline-icon d-md-block d-none">
                                                                        <i class="fa fa-business-time"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 d-md-block d-none">
                                                                <p class="timeline-date">
                                                                    30 Mar 2021
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="row timeline-right">
                                                            <div class="col-md-6">
                                                                <p class="timeline-date">
                                                                    30 Mar 2021 14:00
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="timeline-box">
                                                                    <div class="timeline-icon">
                                                                        <i class="fa fa-gift"></i>
                                                                    </div>
                                                                    <div class="timeline-text">
                                                                        <h3>Asisten Administrasi Umum</h3>
                                                                        <p>Surat diteruksan ke Biro Umum
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row timeline-left">
                                                            <div class="col-md-6 d-md-none d-block">
                                                                <p class="timeline-date">
                                                                    30 Mar 2021 13:40
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="timeline-box">
                                                                    <div class="timeline-icon d-md-none d-block">
                                                                        <i class="fa fa-business-time"></i>
                                                                    </div>
                                                                    <div class="timeline-text">
                                                                        <h3>Tata Usaha</h3>
                                                                        <p>Surat diteruskan ke Asisten Administrasi Umum
                                                                        </p>
                                                                    </div>
                                                                    <div class="timeline-icon d-md-block d-none">
                                                                        <i class="fa fa-business-time"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 d-md-block d-none">
                                                                <p class="timeline-date">
                                                                    30 Mar 2021
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="row timeline-right">
                                                            <div class="col-md-6">
                                                                <p class="timeline-date">
                                                                    30 Mar 2021 13:30
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="timeline-box">
                                                                    <div class="timeline-icon">
                                                                        <i class="fa fa-sync"></i>
                                                                    </div>
                                                                    <div class="timeline-text">
                                                                        <h3>Tata Usaha</h3>
                                                                        <p>Surat diteruskan ke Gubernur
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row timeline-left">
                                                            <div class="col-md-6 d-md-none d-block">
                                                                <p class="timeline-date">
                                                                    30 Mar 2021 13:30
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="timeline-box">
                                                                    <div class="timeline-icon d-md-none d-block">
                                                                        <i class="fa fa-envelope"></i>
                                                                    </div>
                                                                    <div class="timeline-text">
                                                                        <h3>Tata Usaha</h3>
                                                                        <p>Menunggu validasi dari Tata Usaha</p>
                                                                    </div>
                                                                    <div class="timeline-icon d-md-block d-none">
                                                                        <i class="fa fa-envelope"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 d-md-block d-none">
                                                                <p class="timeline-date">
                                                                    30 Mar 2021 13:00
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-start">
                                                        <p style="line-height: 1.2; padding: 25px 0;">Surat Dikirim</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endisset
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
    @include('visitor._css')
@endpush

@push('js')
    <script>
        $(function() {
            // reload page
            $('#reload').on('click', function(e) {
                e.preventDefault();
                location.reload();
            });
        });
    </script>
@endpush

