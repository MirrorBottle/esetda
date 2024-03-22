@extends('layouts.app', ['page_title' => 'Hadiah'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Daftar Hadiah Pengguna</h3>
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
                                    <th>Tipe Hadiah</th>
                                    <th>No Hp</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($preparations as $preparation)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="#" class="badge badge-primary">
                                                {{ $preparation->user->name }}
                                            </a>
                                        </td>
                                        <td>
                                            @if ($preparation->user->profile->prize == 0)
                                                <span href="#" class="badge badge-success">
                                                    GoPay
                                                </span>
                                            @else
                                                <span href="#" class="badge badge-info">
                                                    Pulsa
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $preparation->user->profile->contact }}
                                        </td>
                                        <td>
                                            <a href="#" class="detail btn btn-sm btn-primary">
                                                Ubah
                                            </a>
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
