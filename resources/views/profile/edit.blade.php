@extends('layouts.app', ['page_title' => __('User Profile')])

@section('content')
    <div class="header pb-8 pt-5 pt-lg-6 d-flex align-items-center" style="background-image: url({{ asset('images/cover.jpg') }}); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <h1 class="display-2 text-white">{{ auth()->user()->name }}</h1>
                </div>
            </div>
        </div>
        @include('partials.alert')
    </div>


    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="{{ asset('images/avatar.png') }}" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-9">
                        <div class="text-center">
                            <h3>{{ auth()->user()->name }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                {{-- profile data form --}}
                @include('profile._profil_area')

                {{-- login password form --}}
                @include('profile._password_area')

                {{-- disposition password form --}}
                @include('profile._disposition_password_area')
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
