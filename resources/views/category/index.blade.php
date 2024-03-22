@extends('layouts.app', ['page_title' => 'Master Kategori'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Data Master Kategori</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/kategori/create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
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
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Kategori</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr data-id="{{ $category->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <a href="{{ url('/kategori/'. $category->id) .'/edit' }}" class="btn btn-sm btn-primary btn-edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-danger btn-delete">
                                                <i class="fa fa-times"></i>
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

@push('js')
    <script>
        $(function() {
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                const id = $(this).closest('tr').data('id');
                const action = '{{ url("/kategori") }}' +'/'+ id;
                $('#modal-delete').modal('show');
                $('#modal-delete').find('form').attr('action', action);
            });
        });
    </script>
@endpush
