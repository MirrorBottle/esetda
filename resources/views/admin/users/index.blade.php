@extends('layouts.app', ['page_title' => 'Pengguna'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Daftar Pengguna</h3>
                            </div>
                            <div class="col-4 text-right">
                                {{-- <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Tambah Baru</a> --}}
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
                        <table class="table table-striped align-items-center table-flush" id="datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th width="20">No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Biro</th>
                                    <th>No WA</th>
                                    <th width="80">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                    <tr data-entry-id="{{ $user->id }}">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $user->name ?? '-' }}</td>
                                        <td>
                                            <a href="#" class="badge badge-primary" style="text-transform: none;">
                                                {{ $user->username ?? '-' }}
                                            </a>
                                        </td>
                                        <td>{{ $user->biro->name ?? '-' }}</td>
                                        <td>{{ $user->wa ?? '-' }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="{{ url('admin/reset-password-disposisi/'. $user->id) }}" data-id="{{ $user->id }}" data-toggle="tooltip" title="Reset Password Disposisi" onclick="return confirm('Yakin ingin mereset password disposisi akun ini?');">
                                                <i class="fa fa-sync-alt"></i>
                                            </a>
                                            <a class="btn btn-sm btn-default" href="{{ url('admin/reset-password/'. $user->id) }}" data-id="{{ $user->id }}" data-toggle="tooltip" title="Reset Password" onclick="return confirm('Yakin ingin mereset akun ini?');">
                                                <i class="fa fa-sync-alt"></i>
                                            </a>
                                            <a class="btn btn-sm btn-info" href="{{ route('admin.users.edit', $user->id) }}"  data-toggle="tooltip" title="Ubah Data">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?');" style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
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
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <style>
        .table-fix-head { overflow-y: auto; height: 100px; }
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
        })
    </script>
@endpush
