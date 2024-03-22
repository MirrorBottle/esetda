@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Tambah Data
    </div>

    <div class="card-body">
        <form action="{{ route("admin.permissions.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">Nama*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($permission) ? $permission->title : '') }}">
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="Simpan">
            </div>
        </form>
    </div>
</div>

@endsection
