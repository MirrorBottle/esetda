@extends('layouts.app', ['page_title' => 'Recycle Bin'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        {{-- filter card --}}
        @include('recycle._filter')

        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3 class="mb-0">Daftar Surat</h3>
                            </div>
                            @if (! $results->isEmpty())
                                <div class="col-6 text-right">
                                    <a href="#" class="text-left btn btn-sm btn-secondary check-all">
                                        <i class="fa fa-check-circle"></i> <span>Check All</span>
                                    </a>
                                    <a href="#" class="text-left btn btn-sm btn-danger btn-delete-all" style="display: none;">
                                        <i class="fa fa-trash"></i> Delete Checked
                                    </a>
                                    <a href="#" class="text-left btn btn-sm btn-success btn-restore-all" style="display: none;">
                                        <i class="fa fa-sync"></i> Restore Checked
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-flush datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No</th>
                                    @if (request()->biro_id === null)
                                        <th scope="col">Biro</th>
                                    @endif
                                    <th scope="col">No Surat</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Tujuan Surat</th>
                                    <th scope="col">Tgl Surat/<br>Tgl Entry</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)
                                    <tr>
                                        <td data-order="{{ $loop->iteration }}">
                                            @if ($result->is_archived === null && ! auth()->user()->isTupimDua())
                                                <input type="checkbox" class="checkbox" value="{{ $result->id }}">
                                            @elseif ($result->is_archived === 0)
                                                <i class="fa fa-sync text-info" data-toggle="tooltip" data-placement="top" title="Proses Arsip"></i>
                                            @elseif ($result->is_archived === 1)
                                                <i class="fa fa-check-circle text-success" data-toggle="tooltip" data-placement="top" title="Sudah Arsip"></i>
                                            @endif

                                            @if ($result->is_forwarded === 1)
                                                <i class="fa fa-share-square text-danger" data-toggle="tooltip" data-placement="top" title="Diteruskan"></i>
                                            @endif
                                        </td>
                                        <td>{{ $loop->iteration }}</p></td>
                                        @if (request()->biro_id === null)
                                            <td>{{ $result->biro->name ?? '-' }}</p></td>
                                        @endif
                                        <td style="max-width: 140px;">
                                            <span>{{ $result->no }}</span>
                                        </td>
                                        <td style="max-width: 200px;">{{ $result->title }}</td>
                                        <td>{{ $result->receiver->name ?? '-' }}</td>
                                        <td>
                                            <span class="badge badge-calendar badge-pill badge-info mb-1">
                                                <i class="fa fa-calendar"></i> {{ $result->date_formatted }}
                                            </span>
                                            <span class="badge badge-calendar badge-pill badge-success">
                                                <i class="fa fa-calendar-check"></i> {{ $result->date_entry_formatted }}
                                            </span>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-secondary btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow p-2">
                                                    <a href="#" class="text-left btn btn-sm btn-info btn-block btn-detail mb-1" data-toggle="modal" data-target="#detail-modal"  data-id="{{ $result->id }}" data-type="{{ $type }}">
                                                        <i class="fa fa-check"></i> Detail surat
                                                    </a>
                                                    <a href="#" class="text-left btn btn-sm btn-warning btn-block btn-destroy-detail mb-1" data-toggle="modal" data-target="#destroy-detail-modal" data-date="{{ to_indo_date($result->deleted_at->format('Y-m-d'), 1) }}" data-time="{{ $result->deleted_at->format('H:i') }} WITA" data-user="{{ $result->destroyer->name ?? '-' }}">
                                                        <i class="fa fa-paper-plane"></i> Detail hapus
                                                    </a>
                                                    <a href="#" class="text-left btn btn-sm btn-success btn-block btn-restore mb-1" data-id="{{ $result->id }}">
                                                        <i class="fa fa-sync"></i> Kembalikan data
                                                    </a>
                                                    <a href="#" class="text-left btn btn-sm btn-danger btn-block btn-delete mb-1" data-id="{{ $result->id }}">
                                                        <i class="fa fa-times"></i> Hapus permanen
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @if (! $results->isEmpty())
                                <tfoot>
                                    <tr>
                                        <td colspan="8">
                                            <a href="#" class="text-left btn btn-sm btn-secondary check-all">
                                                <i class="fa fa-check-circle"></i> <span>Check All</span>
                                            </a>
                                            <a href="#" class="text-left btn btn-sm btn-danger btn-delete-all" style="display: none;">
                                                <i class="fa fa-trash"></i> Delete Checked
                                            </a>
                                            <a href="#" class="text-left btn btn-sm btn-success btn-restore-all" style="display: none;">
                                                <i class="fa fa-sync"></i> Restore Checked
                                            </a>
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.detail-modal')
        @include('recycle._remove_modal')
        @include('recycle._restore_modal')
        @include('recycle._destroy_detail_modal')
        @include('layouts.footers.auth')
    </div>
@endsection

@push('css')
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    {{-- custom --}}
    @include('inbox._css_index')
@endpush

@push('js')
    {{-- datatable --}}
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    {{-- custom --}}
    @include('recycle._js')
@endpush
