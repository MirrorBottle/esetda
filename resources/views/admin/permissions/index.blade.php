@extends('layouts.admin', ['title' => 'Perizinan'])

@section('content')
    @can('permission_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.permissions.create") }}">
                    Tambah Data
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            Daftar Perizinan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th width="20">No</th>
                            <th>Nama</th>
                            <th width="80">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $key => $permission)
                            <tr data-entry-id="{{ $permission->id }}">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    {{ $permission->title ?? '' }}
                                </td>
                                <td class="text-center">
                                    {{-- @can('permission_show')
                                        <a class="btn btn-sm btn-secondary" href="{{ route('admin.permissions.show', $permission->id) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    @endcan --}}
                                    @can('permission_edit')
                                        <a class="btn btn-sm btn-info" href="{{ route('admin.permissions.edit', $permission->id) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('permission_delete')
                                        <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
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
@endpush
