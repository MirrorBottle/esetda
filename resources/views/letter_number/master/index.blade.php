@extends('layouts.app', ['page_title' => 'Master Nomor Surat'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Data Nomor Surat</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/arsip/nomor-surat/create') }}" class="text-left btn btn-sm btn-primary">
                                    <i class="fa fa-plus"></i> Tambah
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Bulan</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Nomor Awal</th>
                                    <th scope="col">Nomor Akhir</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($letter_numbers as $letter_number)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $letter_number->month }}</td>
                                        <td>{{ $letter_number->year }}</td>
                                        <td>{{ $letter_number->start }}</td>
                                        <td>{{ $letter_number->end }}</td>
                                        <td>
                                            <a href="{{ url('arsip/nomor-surat/'. $letter_number->id .'/edit') }}" class="btn btn-sm btn-edit btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-delete btn-danger" data-id="{{ $letter_number->id }}">
                                                <i class="fa fa-trash"></i>
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

        @include('partials.remove-modal')
        @include('layouts.footers.auth')
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <style>
        .table td, .table th {
            white-space: normal;
        }
        .table th {
            vertical-align: middle !important;
        }
        .table-fix-head          { overflow-y: auto; height: 100px; }
        .table-fix-head thead th { position: sticky; top: 0; }
        .dataTables_wrapper .row:first-child {
            padding: 0 1.5rem;
            font-size: 13px;
        }
        .dataTables_wrapper .row:last-child {
            padding: 2em;
            font-size: 13px;
        }
    </style>
@endpush

@push('js')
    {{-- datatable --}}
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function() {
            // edit button
            // $('.btn-edit').on('click', function(e) {
            //     const id = $(this).data('id');
            // });

            // remove button
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                const action = '{{ url("/arsip/nomor-surat") }}' +'/'+ id;
                $('#modal-delete').modal('show');
                $('#modal-delete').find('form').attr('action', action);
            });

            // init datatable with custom lang
            $('.table').DataTable({
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
