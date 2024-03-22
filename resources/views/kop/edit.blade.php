@extends('layouts.app', ['page_title' => 'Kop Surat'])

@section('content')
    @include('users.partials.header', ['title' => 'Kop Surat'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Ubah Kop Surat</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/kop') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/kop/'. $kop->id) }}" enctype="multipart/form-data" data-status="edit" id="form-input">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="type" value="{{ $kop->type }}">
                            <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input_title">Tipe Kop</label>
                                <input type="text" name="title" id="input_title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ $kop->title }}" readonly>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input_content">Konten</label>
                                <textarea name="content" id="input_content" class="form-control form-control-alternative{{ $errors->has('content') ? ' is-invalid' : '' }}" required autofocus>{!! $kop->content ?? old('content') !!}</textarea>

                                @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div>
                                <button type="submit" class="btn btn-lg btn-success mt-2">
                                    <i class="fa fa-check"></i> Simpan Perubahan
                                </button>
                                <a href="#" class="btn btn-lg btn-secondary mt-2" id="reload">
                                    <i class="fa fa-sync"></i> Muat Ulang
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('css')
    {{-- summernote --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
    <style>

    </style>
@endpush

@push('js')
    {{-- summernote --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#input_content').summernote({
                tabsize: 2,
                height: 250
            });

            $('#reload').on('click', function(e) {
                e.preventDefault();
                location.reload();
            });
        });
    </script>
@endpush
