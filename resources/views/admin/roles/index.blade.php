@extends('layouts.admin', ['title' => 'Hak Akses'])

@section('content')
    @can('role_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.roles.create") }}">
                    Tambah Data
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            Daftar Hak Akses
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th width="20">No</th>
                            <th width="120">Nama Hak Akses</th>
                            <th>Perizinan</th>
                            <th width="80">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $key => $role)
                            <tr data-entry-id="{{ $role->id }}">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    {{ $role->title ?? '' }}
                                </td>
                                <td>
                                    @foreach($role->permissions as $key => $item)
                                        <span class="badge badge-info">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    {{-- @can('role_show')
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.roles.show', $role->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan --}}
                                    @can('role_edit')
                                        <a class="btn btn-sm btn-info" href="{{ route('admin.roles.edit', $role->id) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('role_delete')
                                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data?');" style="display: inline-block;">
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

@push('css')
    <style>
        table.dataTable tbody td.select-checkbox:before, table.dataTable tbody th.select-checkbox:before {
            display: block;
            margin-left: 10px;
            vertical-align: middle;
            position: static
        }
    </style>
@endpush
