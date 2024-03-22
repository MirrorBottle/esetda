@extends('layouts.app', ['page_title' => 'Eksperimen'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Daftar Eksperimen</h3>
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
                                    <th>Benar</th>
                                    <th>Salah</th>
                                    <th>Tidak Terjawab</th>
                                    <th width="80">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($eksperiments as $eksperiment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="#" class="badge badge-primary">
                                                {{ $eksperiment['name'] }}
                                            </a>
                                        </td>
                                        @if ($eksperiment['true'] == 0 && $eksperiment['false'] == 0 && $eksperiment['null'] == 0)
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        @else
                                            <td>
                                                <span class="badge badge-success">
                                                    {{ $eksperiment['true'] }} Akun
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-danger">
                                                    {{ $eksperiment['false'] }} Akun
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-warning">
                                                    {{ $eksperiment['null'] }} Akun
                                                </span>
                                            </td>
                                        @endif
                                        <td>
                                            @if ($eksperiment['true'] == 0 && $eksperiment['false'] == 0 && $eksperiment['null'] == 0)
                                                <a href="#" class="detail btn btn-sm btn-light disabled">
                                                    Belum Ada Data
                                                </a>
                                            @else
                                                <a href="#" class="detail btn btn-sm btn-primary">
                                                    Detail
                                                </a>
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
