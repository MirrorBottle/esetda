@extends('layouts.admin', ['title' => 'Bentuk Ikatan'])

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-file-text"></i> Pengaturan Aplikasi
                </div>

                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        @foreach ($settings as $setting)
                            <div class="form-group">
                                <label for="{{ $setting->name }}"><b>{{ $setting->title }}</b></label>
                                <input type="text" name="{{ $setting->name }}" id="{{ $setting->name }}" value="{{ $setting->value }}" class="form-control" required>
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-lg btn-block btn-success">
                            <i class="fa fa-refresh"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
