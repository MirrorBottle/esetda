@extends('layouts.admin', ['title' => 'Kategori'])

@section('content')
    {{-- @can('kategori_create') --}}
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success btn-add" href="#">
                    <i class="fa fa-plus"></i> Tambah Data
                </a>
            </div>
        </div>

        @include('admin.category._form_modal')
    {{-- @endcan --}}

    <div class="card">
        <div class="card-header">
            <i class="fa fa-file-text"></i> Daftar Kategori
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th class="text-center" width="30">No</th>
                            <th>Nama</th>
                            <th class="text-center" width="80">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-primary btn-edit" data-id="{{ $category->id }}" data-toggle="tooltip" title="Ubah data">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.kategori.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus data">
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
@endsection

@push('js')
    @include('partials.datatable')
    @include('admin.category._script')
@endpush
