@extends('layouts.app', ['page_title' => 'Tanda Terima'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        {{-- filter card --}}
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card shadow">
                    <div class="card-header bg-white">
                        <h3 class="mb-0">Filter Tanggal Entri</h3>
                    </div>
                    <div class="card-body bg-secondary">
                        @include('receipt._filter_form')
                    </div>
                </div>
            </div>
        </div>

        {{-- search data card --}}
        <div class="row mt-3">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3 class="mb-0">Daftar Surat Masuk</h3>
                            </div>
                            <div class="col-6 text-right">
                                {{-- <a href="#" class="text-left btn btn-sm btn-primary btn-instruction">
                                    <i class="fa fa-print"></i> Simpan &amp; Cetak Tanda Terima
                                </a> --}}
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-striped table-flush datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No</th>
                                    <th scope="col">No Surat</th>
                                    <th scope="col">Pengirim</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Tanggal Surat</th>
                                    <th scope="col">Arahan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('receipt._table')
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        <a href="#" class="text-left btn btn-primary btn-instruction float-right">
                            <i class="fa fa-print"></i> Simpan &amp; Cetak Tanda Terima
                        </a>

                        <form action="" method="POST" id="form-instruction" target="_blank">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="hidden_item" name="item">
                            <input type="hidden" id="hidden_id" name="id">
                            <input type="hidden" id="hidden_instruction" name="instruction">
                            <input type="hidden" name="date_start" value="{{ $date_start }}">
                            <input type="hidden" name="date_end" value="{{ $date_end }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('css')
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    {{-- custom css --}}
    @include('receipt._css')
@endpush

@push('js')
    {{-- datepicker --}}
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.id.min.js') }}"></script>
    {{-- moment --}}
    <script src="{{ asset('js/moment.min.js') }}"></script>
    {{-- datatable --}}
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    {{-- custom js --}}
    @include('receipt._js')
@endpush
