@extends('layouts.admin', ['title' => 'Bentuk Ikatan'])

@section('content')
    <div class="card">
        <div class="card-header">
            <i class="fa fa-file-text"></i> Pengaturan Banner Web
        </div>

        <div class="card-body">
            <div class="row">
                @foreach ($banners as $banner)
                    <div class="col-md-12">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('images/sliders/' . $banner->file_name) }}" alt="{{ $banner->file_name }}" style="max-height: 400px;">
                            <div class="card-body">
                                <h3 class="mb-3">Slide #{{ $loop->iteration }}</h3>
                                {{-- <p class="card-text">{{ $banner->caption ?? '-' }}</p> --}}
                                <form action="{{ route('admin.settings.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="display-area row">
                                        <div class="col-md-6 pr-1">
                                            <label class="btn btn-block btn-primary btn-file">
                                                <i class="fa fa-image"></i> Ganti Foto
                                                <input type="file" name="banner" style="display: none;" accept="image/*">
                                                <input type="hidden" name="status" class="hidden-status">
                                            </label>
                                        </div>
                                        <div class="col-md-6 pl-1">
                                            @if ($banner->is_active == '0')
                                                <a href="#" class="btn btn-block btn-danger btn-status" data-status="0" data-toggle="tooltip" title="Klik untuk mengaktifkan">
                                                    <i class="fa fa-times"></i> Non Aktif
                                                </a>
                                            @else
                                                <a href="#" class="btn btn-block btn-success btn-status" data-status="1" data-toggle="tooltip" title="Klik untuk menonaktifkan">
                                                    <i class="fa fa-check"></i> Aktif
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="update-area row d-none">
                                        <div class="col-md-6 pr-1">
                                            <button type="submit" class="btn btn-block btn-success">
                                                <i class="fa fa-check"></i> Simpan Foto
                                            </button>
                                        </div>
                                        <div class="col-md-6 pl-1">
                                            <button type="button" class="btn btn-block btn-danger btn-cancel">
                                                <i class="fa fa-times"></i> Batal
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }
        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }
    </style>
@endpush

@push('js')
    <script>
        $(function() {
            $('.btn-file input').on('change', function() {
                const $parentArea = $(this).closest('.display-area');
                const $preview = $parentArea.closest('.card').find('img');
                $parentArea.hide();
                $parentArea.next().removeClass('d-none');

                previewImage(this, $preview);
            });

            $('.btn-cancel').on('click', function() {
                location.reload();
            });

            $('.btn-status').on('click', function(e) {
                e.preventDefault();

                const status = $(this).data('status');
                $('.hidden-status').val( status == '1' ? '0' : '1' );
                $(this).closest('form').submit();
            });

        });

        function previewImage(input, $preview) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $preview.attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
