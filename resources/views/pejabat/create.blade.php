@extends('layouts.app', ['page_title' => 'Master Pejabat'])

@section('content')
    @include('users.partials.header', ['title' => 'Pejabat'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Tambah Pejabat Baru</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/pejabat') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/pejabat') }}">
                            @csrf
                            <div class="pl-lg-4">
                                @include('pejabat._form')
                                <div>
                                    <button type="submit" class="btn btn-primary mt-4">
                                        <i class="fa fa-check"></i> Simpan Data
                                    </button>
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

@push('js')
    <script>
        $(function() {
            $('.switch-button button').on('click', function(e) {
                if ($(this).hasClass('sekda')) {
                    $('.non-sekda').html('Non Sekda');
                    $('.non-sekda').addClass('btn-secondary').removeClass('btn-success');
                    $('.sekda').html('<i class="fa fa-check"></i> Sekda')
                    $('.sekda').removeClass('btn-secondary').addClass('btn-success');
                    $('#input_type').val('0');
                } else {
                    $('.sekda').html('Sekda');
                    $('.sekda').addClass('btn-secondary').removeClass('btn-success');
                    $('.non-sekda').html('<i class="fa fa-check"></i> Non Sekda')
                    $('.non-sekda').removeClass('btn-secondary').addClass('btn-success');
                    $('#input_type').val('1');
                }
            });
        });
    </script>
@endpush
