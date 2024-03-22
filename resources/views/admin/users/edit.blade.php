@extends('layouts.app', ['page_title' => 'User'])

@section('content')
    @include('users.partials.header', ['title' => 'Form Pengguna'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Ubah Data Pengguna</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('admin/users') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="row" action="{{ route("admin.users.update", [$user->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('name') ? 'has-danger' : '' }}">
                                    <label class="form-control-label" for="name">Nama</label>
                                    <input type="text" id="name" name="name" class="form-control form-control-alternative" value="{{ old('name', isset($user) ? $user->name : '') }}">
                                    @if($errors->has('name'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('email') ? 'has-danger' : '' }}">
                                    <label class="form-control-label" for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control form-control-alternative" value="{{ old('email', isset($user) ? $user->email : '') }}">
                                    @if($errors->has('email'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('username') ? 'has-danger' : '' }}">
                                    <label class="form-control-label" for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control form-control-alternative" value="{{ old('username', isset($user) ? $user->username : '') }}" readonly>
                                    @if($errors->has('username'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('username') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('roles') ? 'has-danger' : '' }}">
                                    <label class="form-control-label d-block" for="roles">Hak Akses
                                    <select name="roles[]" id="roles" class="form-control form-control-alternative mt-2">
                                        @foreach($roles as $id => $roles)
                                            <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>
                                                {{ $roles }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('roles'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('roles') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('username') ? 'has-danger' : '' }}">
                                    <label class="form-control-label" for="wa">No WhatsApp</label>
                                    <input type="text" id="wa" name="wa" class="form-control form-control-alternative" value="{{ old('wa', isset($user) ? $user->wa : '') }}">
                                    @if($errors->has('wa'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('wa') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('roles') ? 'has-danger' : '' }}">
                                    <label class="form-control-label d-block" for="biro">Biro
                                    <select name="biro_id" id="biro" class="form-control form-control-alternative mt-2">
                                        <option value="">-- tidak ada --</option>
                                        @foreach($biros as $id => $name)
                                            <option value="{{ $id }}" {{ $id == $user->biro_id ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('biro_id'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('biro_id') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('password') ? 'has-danger' : '' }}">
                                    <label class="form-control-label" for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control form-control-alternative">
                                    @if($errors->has('password'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </em>
                                    @endif
                                </div>
                            </div> --}}
                            <div class="col-12 col-md-12">
                                <div>
                                    <input class="btn btn-success" type="submit" value="Simpan Perubahan">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
