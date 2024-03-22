@extends('layouts.app', ['class' => 'bg-login'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--6 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card card-bg shadow border-0" s>
                    <div class="card-body px-lg-5 py-lg-5">
                        <h3 class="mb-3">Login Form</h3>
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group{{ $errors->has('username') ? ' has-danger' : '' }} mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="{{ __('username') }} atau email" type="text" name="username" required autofocus>
                                </div>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password" type="password" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" name="remember" id="customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customCheckLogin">
                                    <span class="text-muted">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success my-4" style="background: #184850!important; border-color: #184850!important">Login</button>
                                <a href="http://e-setda.kaltimprov.go.id" class="btn btn-secondary my-4">Kembali ke Portal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .copyright, .copyright a {
            color: #fff;
        }
        .bg-login {
            background: linear-gradient(0deg, rgba(24, 72, 80, 0.6), rgba(24, 72, 80, 0.6)), url("images/bg_kagub.jpg");
            background-size: cover;
        }

        .card-bg {
            background: rgba(255, 255, 255, 0.8) !important;
        }
    </style>
@endpush
