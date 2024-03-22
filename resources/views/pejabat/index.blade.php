@extends('layouts.app', ['page_title' => 'Master Pejabat'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        @if (auth()->user()->biro_id == 1 || auth()->user()->biro_id == 6)
            <div class="row mb-3">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header bg-secondary border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Pengaturan Disposisi</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('pejabat-disposisi') }}" method="POST" id="form-disposisi">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <input type="radio" name="status" value="1" id="disposisi-status-active" {{ $status_disposisi == 1 ? 'checked' : '' }}>
                                        <label class="form-control-label" for="disposisi-status-active">
                                            Munculkan Area TTD
                                        </label>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <input type="radio" name="status" value="0" id="disposisi-status-unactive" {{ $status_disposisi == 0 ? 'checked' : '' }}>
                                        <label class="form-control-label" for="disposisi-status-unactive">
                                            Kosongkan Area TTD
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Data Pejabat</h3>
                            </div>
                            <div class="col-4 text-right">
                                @if (auth()->user()->username === 'fahmi' || auth()->user()->username === 'tu_pimpinan')
                                    <a href="{{ url('/pejabat/create') }}" class="text-left btn btn-sm btn-primary">
                                        <i class="fa fa-plus"></i> Tambah
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Judul Inputan</th>
                                    <th scope="col">Jabatan TTD</th>
                                    <th scope="col">Nama TTD</th>
                                    <th scope="col" style="min-width: 80px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pejabats as $pejabat)
                                    @php $is_active = $pejabat->is_active == 1; @endphp
                                    <tr class="{{ $pejabat->is_active == 0 ? 'bg-light' : '' }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-{{ $pejabat->type == 1 ? 'danger' : 'info' }}"></i> {{ $pejabat->title }}
                                            </span>
                                        </td>
                                        <td>{{ $pejabat->position }}</td>
                                        <td>{{ $pejabat->name }}</td>
                                        <td>
                                            <a href="{{ url('pejabat/'. $pejabat->id .'/edit') }}" class="btn btn-sm btn-edit btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-delete btn-danger" data-id="{{ $pejabat->id }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            {{-- <a href="{{ url('pejabat-status?id='. $pejabat->id .'&status='. $pejabat->is_active) }}" class="btn btn-sm btn-{{ $is_active ? 'success' : 'default' }} btn-status" data-status="{{ $pejabat->is_active }}" data-id="{{ $pejabat->id }}"  data-toggle="tooltip" data-placement="top" title="{{ $is_active == 1 ? 'Klik Menonaktifkan' : 'Klik Mengaktifkan' }}">
                                                <i class="fa fa-power-off"></i>
                                            </a> --}}
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
            $('.btn-edit').on('click', function(e) {
                const id = $(this).data('id');

            });

            // remove button
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                const action = '{{ url("/pejabat") }}' +'/'+ id;
                $('#modal-delete').modal('show');
                $('#modal-delete').find('form').attr('action', action);
            });

            // set disposisi ttd area status
            $('input[type=radio][name=status]').change(function() {
                $('#form-disposisi').submit();
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
