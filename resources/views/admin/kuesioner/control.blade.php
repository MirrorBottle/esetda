@extends('layouts.app', ['page_title' => 'KUESIONER - KENDALI DIRI'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Daftar Kuesioner Kendali Diri</h3>
                            </div>
                            <div class="col-4 text-right">
                                {{-- <a href="#" class="btn btn-sm btn-primary">Tambah Baru</a> --}}
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
                        <table class="table table-striped align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th width="20">No</th>
                                    <th>Nama</th>
                                    <th>Opsi 1</th>
                                    <th>Opsi 2</th>
                                    <th>Opsi 3</th>
                                    <th>Opsi 4</th>
                                    <th>Opsi 5</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($surveys as $survey)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="#" class="badge badge-primary">
                                            {{ $survey['name'] }}
                                        </a>
                                    </td>
                                    @if ($survey['presentase']['opsi_1'] == 0 && $survey['presentase']['opsi_2'] == 0 && $survey['presentase']['opsi_3'] == 0 && $survey['presentase']['opsi_4'] == 0 && $survey['presentase']['opsi_5'] == 0)
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @else
                                        <td>
                                            <span class="badge badge-success">
                                                {{ number_format($survey['presentase']['opsi_1'] * 100/36, 2) }}%
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ number_format($survey['presentase']['opsi_2'] * 100/36, 2) }}%
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-warning">
                                                {{ number_format($survey['presentase']['opsi_3'] * 100/36, 2) }}%
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-danger">
                                                {{ number_format($survey['presentase']['opsi_4'] * 100/36, 2) }}%
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">
                                                {{ number_format($survey['presentase']['opsi_5'] * 100/36, 2) }}%
                                            </span>
                                        </td>
                                    @endif
                                    <td>
                                        @if ($survey['status'])
                                            <a href="#" class="ml-1 detail btn btn-sm btn-primary">
                                                Detail
                                            </a>
                                        @else
                                            <span class="badge badge-light">Belum ada data</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{-- {{ $users->links() }} --}}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
