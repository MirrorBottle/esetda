@extends('layouts.app', ['page_title' => 'Lampiran Agenda'])

@section('content')
    <div class="header pt-lg-6 d-flex align-items-center" style="background-image: url({{ asset('images/cover.jpg') }}); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center text-center header-area">
            <div class="row w-100 m-0">
                <div class="col-12">
                    <h1 class="display-2 text-white">Penomoran Surat</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid text-center mb-3 lampiran-area">
        <div class="row">
            <div class="col-12">
                <p class="mb-3">Link: <a href="#" class="btn btn-sm btn-danger btn-copy" data-toggle="tooltip" title="Berhasil menyalin tautan" data-url="{{ $bundle->link }}"><i class="fa fa-copy"></i> {{ $bundle->link }}</a></p>

                @foreach ($data as $item)
                    <div class="card card-shadow text-left mb-3">
                        <div class="card-header py-3 bg-secondary">
                            Data #{{ $loop->iteration }}
                        </div>
                        <div class="card-body py-3 border-0">
                            <p class="mb-1">Nomor Urut: <b>{{ $item->order }}</b></p>
                            <p class="mb-1">Nomor Surat: <b>{{ $item->number }}</b></p>
                            <p class="mb-1">Lampiran:
                                @if ($item->attachment !== null)
                                    <a href="{{ url('storage/'. $item->attachment) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-file"></i> {{ $item->attachment }}</a>
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .header {
            padding-bottom: 1rem !important;
            padding-top: 12.5rem !important;
        }

        .lampiran-area {
            margin-top: 1rem;
        }

        .lampiran-area p {
            font-size: .9rem;
        }

        .referensi-text {
            margin-top: 2.8rem;
        }

        @media (max-width: 480px) {
            .navbar {
                margin-top: .25rem !important;
            }
            .navbar-brand img:first-child {
                height: 50px !important;
            }

            .navbar-brand img:last-child {
                height: 22px !important;
            }

            .header {
                padding-bottom: .25rem !important;
                padding-top: 1.5rem !important;
            }

            .header-area {
                padding-top: 5.7rem !important;
            }

            .header-area h1 {
                font-size: 2rem;
            }

            .lampiran-area {
                margin-top: 1rem;
            }

            .referensi-text {
                margin-top: 2.5rem !important;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        $(function() {
            // copy to clipboard
            $('.btn-copy').on('click', function(e) {
                e.preventDefault();

                // ambil link dan buat fake elemen
                const textLink = $(this).attr('data-url');
                var textArea = document.createElement("textarea");
                textArea.value = textLink;

                // hindari scroll ke bawah
                textArea.style.top = "0";
                textArea.style.left = "0";
                textArea.style.position = "fixed";

                // tambahkan elemen dan seleksi teks-nya
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();

                try {
                    var successful = document.execCommand('copy');
                    var msg = successful ? 'successful' : 'unsuccessful';
                } catch (err) {
                    alert('Oops, gagal menyalin tautan, silahkan di salin manual');
                }

                // hapus elemen yg di buat dan kembalikan tooltip
                document.body.removeChild(textArea);
            });
        });
    </script>
@endpush
