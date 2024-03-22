@extends('layouts.app', ['page_title' => 'Master SKPD'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Data Master SKPD</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/skpd/create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama SKPD</th>
                                    <th scope="col">Beban Anggaran</th>
                                    <th scope="col">Kontak WA</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($skpds as $skpd)
                                    <tr data-id="{{ $skpd->id }}">
                                        <td style="width: 40px">{{ $loop->iteration }}</td>
                                        <td>{{ $skpd->name }}</td>
                                        <td>{{ $skpd->budget_expanse }}</td>
                                        <td>{{ $skpd->wa_number }}<br>{{ $skpd->contact }}</td>
                                        <td style="width: 80px">
                                            <a href="{{ url('/skpd/'. $skpd->id) .'/edit' }}" class="btn btn-sm btn-primary btn-edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-danger btn-delete">
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

        @include('layouts.footers.auth')
    </div>

    @include('partials.remove-modal')
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
        .badge-calendar {
            font-size: 80%;
            display: block;
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
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function() {
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                const id = $(this).closest('tr').data('id');
                const action = '{{ url("/skpd") }}' +'/'+ id;
                $('#modal-delete').modal('show');
                $('#modal-delete').find('form').attr('action', action);
            });


            // datatable
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
