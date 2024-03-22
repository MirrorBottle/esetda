<div class="header bg-gradient-primary pt-7 pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-4 col-sm-12">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Surat Masuk</h5>
                                    <span class="h1 font-weight-bold mb-0">{{ $data['surat_masuk'] }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-success text-white rounded-circle shadow mt-1">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-12">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Surat Keluar</h5>
                                    <span class="h1 font-weight-bold mb-0">{{ $data['surat_keluar'] }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow mt-1">
                                        <i class="fa fa-envelope-open"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-12">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Surat Lingkup Setda</h5>
                                    <span class="h1 font-weight-bold mb-0">{{ $data['surat_terusan'] }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-orange text-white rounded-circle shadow mt-1">
                                        <i class="fa fa-envelope-open-text"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- chart --}}
        <div class="card bg-gradient-default shadow mt-4 border-0">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-light ls-1 mb-1">Bagan Statistik</h6>
                        <h2 class="text-white mb-0">Perkembangan Surat Tahun {{ date('Y') }}</h2>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <!-- Chart -->
                <div class="chart" data-label="{{ implode(",", $data['months']) }}" data-inbox="{{ implode(",", $data['charts']['inbox']) }}" data-outbox="{{ implode(",", $data['charts']['outbox']) }}" data-forward="{{ implode(",", $data['charts']['forward']) }}">
                    <!-- Chart wrapper -->
                    <canvas id="chart-surat" class="chart-canvas"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('css')
    <style>
        body {
            background-color: #0389a5;
        }

        .popover-body {
            padding: .2rem 1rem;
        }

        .popover-body-value {
            margin-left: 1rem;
            background: #eee;
            padding: 2px 4px;
            border-radius: 14px;
            font-size: .8rem;
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
