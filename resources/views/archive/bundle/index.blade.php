@extends('layouts.app', ['page_title' => 'Arsip Surat '. ucfirst($type)])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <h3 class="mb-0">
                                 Validasi Arsip Surat {{ ucfirst($type) }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-flush" id="datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal Masuk</th>
                                    <th scope="col">Biro Pengirim</th>
                                    <th scope="col">Pengirim</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bundles as $bundle)
                                    <tr data-checked="false" data-id="{{ $bundle->id }}">
                                        <td>
                                            {{ $loop->iteration }}
                                            @if ($bundle->status == 'p')
                                                <i class="fa fa-sync text-info" data-toggle="tooltip" title="Sedang Proses"></i>
                                            @elseif ($bundle->status == 'a')
                                                <i class="fa fa-check-circle text-green" data-toggle="tooltip" title="Tervalidasi"></i>
                                            @elseif ($bundle->status == 'r')
                                                <i class="fa fa-times-circle text-danger" data-toggle="tooltip" title="Ditolak"></i>
                                            @endif
                                        </td>
                                        <td>{{ $bundle->date_time_indo }}</td>
                                        <td>{{ $bundle->biro->alias }}</td>
                                        <td>{{ $bundle->sender->name }}</td>
                                        <td>{{ $bundle->total }} arsip</td>
                                        <td>
                                            <a href="{{ url('arsip/validasi/'. $type .'/'. $bundle->id) }}" class="text-left btn btn-sm btn-info btn-block btn-detail mb-1">
                                                <i class="fa fa-external-link-alt"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
    {{-- custom --}}
    @include('inbox._css_index')
@endpush

@push('js')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    {{-- custom --}}
    <script>
        $(function() {
            // datatable
            $('#datatable').DataTable({
                "language": {
                    "sProcessing": "Sedang proses...",
                    "sLengthMenu": "Tampilan _MENU_ entri",
                    "sZeroRecords": "Tidak ditemukan data yang sesuai",
                    "sInfo": "Tampilan _START_ sampai _END_ dari _TOTAL_ entri",
                    "sInfoEmpty": "Tampilan 0 hingga 0 dari 0 entri",
                    "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                    "sInfoPostFix": "",
                    "sSearch": "Cari:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "«",
                        "sPrevious": "<",
                        "sNext": ">",
                        "sLast": "»"
                }
                }
            });
        });
    </script>
@endpush
