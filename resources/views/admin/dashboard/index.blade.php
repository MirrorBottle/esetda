@extends('layouts.app', ['page_title' => 'Beranda'])

@section('content')
    @if ($user_type == 'esetda')
        @include('admin.dashboard._esetda')
    @elseif ($user_type == 'eagenda')
        @include('admin.dashboard._eagenda')
    @elseif ($user_type == 'earsip')
        @include('admin.dashboard._earsip')
    @elseif ($user_type == 'super')
        @include('admin.dashboard._super')
    @endif
@endsection
