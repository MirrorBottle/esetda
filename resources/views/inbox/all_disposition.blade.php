@extends('layouts.app', ['page_title' => 'Lihat Disposisi'])

@section('content')
    @include('users.partials.header', ['title' => 'Lihat Data Disposisi'])

    <div class="container-fluid mt--7">
        {{-- info card --}}
        <div class="card shadow">
            <div class="card-header bg-secondary border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Informasi Surat</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <td style="width: 130px;"><b>No Surat</b></td>
                        <td style="width: 20px;">:</td>
                        <td>{{ $inbox->no ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><b>Judul</b></td>
                        <td>:</td>
                        <td>{{ $inbox->title }}</td>
                    </tr>
                    <tr>
                        <td><b>Pengirim</b></td>
                        <td>:</td>
                        <td>{{ $inbox->sender }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- disposition card --}}
        <div class="card shadow mt-3">
            <div class="card-header bg-secondary border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Riwayat Disposisi</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Disposisi</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach ($inbox->disposition_admin as $disposition)
                        <tr>
                            <td>
                                <span class="badge badge-{{ $loop->iteration % 2 == 0 ? 'info' : 'success' }} mt-1">{{ $disposition->user->receiver->name }}</span>
                                <span class="text-muted mx-1"><i class="fa fa-angle-double-right"></i></span>
                                <span class="badge badge-{{ $loop->iteration % 2 == 0 ? 'warning' : 'info' }}">{{ $disposition->receiver->name }}</span>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-success" target="_blank" href="{{ url('disposisi-admin/print/'. $inbox->id .'?user_id='. $disposition->user_id) }}">
                                    <i class="fa fa-print"></i>
                                    Lihat / Cetak
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
@endsection
