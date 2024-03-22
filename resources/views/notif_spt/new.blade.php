@extends('layouts.app', ['page_title' => 'Notifikasi SPT Baru'])

@section('content')
    <div class="header pb-8 pt-5 pt-lg-6 d-flex align-items-center" style="background-image: url({{ asset('images/cover.jpg') }}); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="display-2 text-white">Notifikasi SPT Baru</h1>
                </div>
            </div>
        </div>
        @include('partials.alert')
    </div>

    <div class="container-fluid mt--7">
        <div class="card shadow mb-4">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Form Notifikasi</h3>
                    </div>
                </div>
            </div>
            <div class="card-body bg-secondary">
                <form method="post" action="{{ url('notif-spt-new') }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="template-content">Template Pesan</label>
                        <p style="font-size: .85rem;" class="mb-1"><span class="badge badge-primary" style="text-transform: lowercase;">&lt;pejabat&gt;</span> untuk field nama pejabat terkait.</p>
                        <p style="font-size: .85rem;" class="mb-1"><span class="badge badge-info" style="text-transform: lowercase;">&lt;skpd&gt;</span> untuk field skpd penanggung jawab.</p>
                        <p style="font-size: .85rem;" class="mb-1"><span class="badge badge-warning" style="text-transform: lowercase;">&lt;tanggal&gt;</span> untuk field tanggal berangkat s.d kembali.</p>
                        <p style="font-size: .85rem;" class="mb-1"><span class="badge badge-danger" style="text-transform: lowercase;">&lt;tujuan&gt;</span> untuk field tujuan keberangkatam.</p>
        
                        <textarea name="content" id="template-content" class="form-control form-control-alternative mt-3 {{ $errors->has('content') ? ' is-invalid' : '' }}" rows="16" required>{{ $template->content }}</textarea>
                        @if ($errors->has('content'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
                @include('layouts.footers.auth')
            </div>
        </div>
    </div>
@endsection

@push('css')
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    {{-- custom --}}
    @include('notif_spt._style')
@endpush

@push('js')
    {{-- datatable --}}
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    {{-- select2 --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>
    {{-- custom --}}
    @include('notif_spt._script')
@endpush

