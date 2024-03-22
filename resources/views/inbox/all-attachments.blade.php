@extends('layouts.app', ['page_title' => 'Lihat Lampiran'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        @foreach (range(1, 4) as $index)
            @include('inbox._attachment_card', compact('attachments', 'index'))
        @endforeach
    </div>

    @include('layouts.footers.auth')
@endsection
