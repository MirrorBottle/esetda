@extends('layouts.app', ['page_title' => 'Surat Keluar'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            @php $biro_label = auth()->user()->username == 'fahmi' && request()->biro_id != "" ? " - " . $biros[request()->biro_id] : ''; @endphp
                            <div class="col-6">
                                <h3 class="mb-0">{{ isset($filter) ? 'Pencarian' : 'Daftar' }} Surat Keluar {{ $biro_label }}</h3>
                            </div>
                            <div class="col-6 text-right">
                                @isset($filter)
                                    <a href="{{ url('/pencarian-surat?'. $filter) }}" class="text-left btn btn-sm btn-secondary">
                                        <i class="fa fa-arrow-left"></i> Kembali
                                    </a>
                                @endisset

                                @if (! auth()->user()->isTupimDua())
                                    <a href="#" class="text-left btn btn-sm btn-secondary check-all">
                                        <i class="fa fa-check-circle"></i> <span>Check All</span>
                                    </a>
                                @endif

                                <a href="{{ url('/arsip/validasi') }}" class="text-left btn btn-sm btn-success btn-validate" style="display: none;" data-toggle="modal" data-target="#validate-modal">
                                    <i class="fa fa-check"></i> Jadikan Arsip
                                </a>

                                <a href="{{ url('/surat-keluar/create') }}" class="text-left btn btn-sm btn-primary">
                                    <i class="fa fa-plus"></i> Tambah Data
                                </a>
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
                        <table class="table table-striped table-flush datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No</th>
                                    <th scope="col">No Register</th>
                                    <th scope="col">No Surat</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Tujuan Surat</th>
                                    <th scope="col">Tgl Surat/<br>Tgl Entry</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($outboxes as $outbox)
                                    <tr>
                                        <td data-order="{{ $loop->iteration }}">
                                            @if ($outbox->is_archived === null && ! auth()->user()->isTupimDua())
                                                <input type="checkbox" class="checkbox" value="{{ $outbox->id }}">
                                            @elseif ($outbox->is_archived === 0)
                                                <i class="fa fa-sync text-info" data-toggle="tooltip" data-placement="top" title="Proses Arsip"></i>
                                            @elseif ($outbox->is_archived === 1)
                                                <i class="fa fa-check-circle text-success" data-toggle="tooltip" data-placement="top" title="Sudah Arsip"></i>
                                            @endif

                                            @if ($outbox->is_forwarded === 1)
                                                <i class="fa fa-share-square text-danger" data-toggle="tooltip" data-placement="top" title="Diteruskan"></i>
                                            @endif
                                        </td>
                                        <td>{{ $loop->iteration }}</p></td>
                                        <td style="min-width: 80px;">
                                            <span>{{ $outbox->no_register ?? '-' }}</span>
                                        </td>
                                        <td style="max-width: 140px;">
                                            <span>{{ $outbox->no }}</span>
                                        </td>
                                        <td style="max-width: 200px;">{{ $outbox->title }}</td>
                                        <td>{{ $outbox->receiver->name }}</td>
                                        <td>
                                            <span class="badge badge-calendar badge-pill badge-info mb-1">
                                                <i class="fa fa-calendar"></i> {{ $outbox->date_formatted }}
                                            </span>
                                            <span class="badge badge-calendar badge-pill badge-success">
                                                <i class="fa fa-calendar-check"></i> {{ $outbox->date_entry_formatted }}
                                            </span>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-secondary btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow p-2">
                                                    <a href="#" class="text-left btn btn-sm btn-info btn-block btn-detail mb-1" data-toggle="modal" data-target="#detail-modal" data-id="{{ $outbox->id }}">
                                                        <i class="fa fa-check"></i> Detail surat
                                                    </a>
                                                    <a href="#" class="text-left btn btn-sm btn-default btn-block btn-forward mb-1" data-toggle="modal" data-target="#forward-modal" data-id="{{ $outbox->id }}" data-type="outbox">
                                                        <i class="fa fa-share"></i> Terusakan surat
                                                    </a>
                                                    <a href="{{ url('/surat-keluar/'. $outbox->id) .'/edit' }}" class="btn-block text-left btn btn-sm btn-primary btn-edit mb-1">
                                                        <i class="fa fa-edit"></i> Ubah surat
                                                    </a>
                                                    @if (auth()->user()->biro_id == 1)
                                                        <a href="#" data-toggle="modal" data-target="#receipt-modal" data-id="{{ $outbox->id }}" data-type="outbox" class="text-left btn btn-sm btn-dark btn-block btn-receipt mb-1">
                                                            <i class="fa fa-upload"></i> Upload Tanda Terima
                                                        </a>
                                                    @endif
                                                    <a href="#" class="text-left btn btn-sm btn-danger btn-block btn-delete mb-1" data-id="{{ $outbox->id }}">
                                                        <i class="fa fa-times"></i> Hapus surat
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        @if (! auth()->user()->isTupimDua())
                                            <a href="#" class="text-left btn btn-sm btn-secondary check-all">
                                                <i class="fa fa-check-circle"></i> <span>Check All</span>
                                            </a>
                                        @endif
                                        <a href="#" class="text-left btn btn-sm btn-default btn-validate" style="display: none;" data-toggle="modal" data-target="#validate-modal">
                                            <i class="fa fa-check"></i> Jadikan Arsip
                                        </a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('archive._validate_modal', ['type' => 'keluar'])
        @include('partials.detail-modal')
        @include('partials.remove-modal')
        @include('partials.forward-modal')
        @include('partials.receipt-modal')
        @include('inbox._archive_modal')
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
    {{-- select2 --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>
    {{-- datatable --}}
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    {{-- custom --}}
    @include('outbox._js_index')
@endpush
