@extends('layouts.app', ['page_title' => 'Master Pakaian'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Data Master Pakaian</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/agenda/pakaian/create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Pakaian</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apparels as $apparel)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $apparel->name }}</td>
                                        <td>
                                            <a href="{{ url('/agenda/pakaian/'. $apparel->id) .'/edit' }}" class="btn btn-sm btn-info btn-edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $apparel->id }}">
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
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endpush

@push('js')
    {{-- datatable --}}
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(function() {
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                const action = '{{ url("/agenda/pakaian") }}' +'/'+ id;
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
