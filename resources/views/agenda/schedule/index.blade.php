@extends('layouts.app', ['page_title' => 'Jadwal Kegiatan'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ isset($filter) ? 'Pencarian' : 'Daftar' }} Jadwal Kegiatan {{ $receiver ?? '' }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                @isset($filter)
                                    <a href="{{ url('/agenda/pencarian?'. $filter) }}" class="text-left btn btn-sm btn-secondary">
                                        <i class="fa fa-arrow-left"></i> Kembali
                                    </a>
                                @endisset
                                @php $link_menu = request()->segment(2); @endphp
                                <a href="{{ url('/agenda/jadwal/create?link='.$link_menu) }}" class="text-left btn btn-sm btn-primary">
                                    <i class="fa fa-plus"></i> Tambah Data
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    @if (request()->segment(2) == 'jadwal')
                                        <th scope="col">Yang Menghadiri</th>
                                    @endif
                                    <th scope="col">Tanggal &amp; Waktu</th>
                                    <th scope="col">Nama Kegiatan</th>
                                    <th scope="col">Tempat</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agendas as $agenda)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @if (request()->segment(2) == 'jadwal')
                                            <td style="max-width: 150px;">{{ $agenda->receiver->name }}</td>
                                        @endif
                                        <td>
                                            <span>{{ $agenda->date_formatted }}</span><br>
                                            <span>{{ $agenda->time_start == null ? '' : '('. $agenda->time_start .' s/d ' . $agenda->time_end .')' }}</span>
                                        </td>
                                        <td>{{ $agenda->event }}</td>
                                        <td>{{ $agenda->place->name ?? '-' }}</td>
                                        <td>
                                            <span class="badge badge-{{ $agenda->status == 0 ? 'danger' : 'success' }}">
                                                {{ $agenda->status_formatted }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-secondary btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow p-2">
                                                    <a href="#" class="text-left btn btn-sm btn-info btn-block btn-detail mb-1" data-toggle="modal" data-target="#detail-modal" data-id="{{ $agenda->id }}">
                                                        <i class="fa fa-check"></i> Detail jadwal
                                                    </a>
                                                    @if ($agenda->is_attachment)
                                                        <a href="{{ url('linktree/agenda/'. $agenda->id) }}" class="text-left btn btn-sm btn-success btn-block mb-1" target="_blank">
                                                            <i class="fa fa-file"></i> Daftar lampiran
                                                        </a>
                                                    @endif
                                                    <a href="{{ url('/agenda/jadwal/'. $agenda->id) .'/edit?link='.$link_menu }}" class="btn-block text-left btn btn-sm btn-primary btn-edit mb-1">
                                                        <i class="fa fa-edit"></i> Ubah jadwal
                                                    </a>
                                                    <a href="#" class="text-left btn btn-sm btn-danger btn-block btn-delete mb-1" data-id="{{ $agenda->id }}">
                                                        <i class="fa fa-times"></i> Hapus jadwal
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('agenda.schedule._detail_modal')
        @include('partials.remove-modal')
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
    {{-- datepicker --}}
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.id.min.js') }}"></script>
    {{-- datatable --}}
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    {{-- moment --}}
    <script src="{{ asset('js/moment.min.js') }}"></script>
    {{-- custom --}}
    @include('agenda.schedule._js_index')
@endpush
