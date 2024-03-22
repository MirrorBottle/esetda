@extends('layouts.app', ['page_title' => 'Lampiran Agenda'])

@section('content')
    <div class="header pt-lg-6 d-flex align-items-center" style="background-image: url({{ asset('images/cover.jpg') }}); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center text-center header-area">
            <div class="row w-100 m-0">
                <div class="col-12">
                    <h1 class="display-2 text-white">Daftar Lampiran</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid text-center mb-3 lampiran-area">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-3">LAMPIRAN AGENDA</h2>
                @if ($agenda->is_attachment)
                    <a href="{{ url('storage/'. $agenda->attachment->name) }}" class="btn btn-lg btn-block btn-success" target="_blank">
                        {{ $agenda->attachment->title }}
                    </a>
                @else
                    <p class="text-muted">Tidak ada lampiran</p>
                @endif

                @if ($agenda->inbox !== null)
                    <h2 class="referensi-text mb-3">LAMPIRAN REFERENSI SURAT</h2>
                    @if ($agenda->inbox->is_attachment)
                        @foreach ($agenda->inbox->attachments as $attachment)
                            <a href="{{ url('storage/'. $attachment->name) }}" class="btn btn-lg btn-block btn-{{ $loop->iteration % 2 === 0 ? 'primary' : 'info' }} mb-3" target="_blank">
                                {{ $attachment->title }}
                            </a>
                        @endforeach
                    @else
                        <p class="text-muted">Tidak ada lampiran</p>
                    @endif
                @endif
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
            margin-top: 3rem;
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

            @auth
                .header-area {
                    padding-bottom: .5rem;
                }
            @else
                .header-area {
                    padding-top: 5.7rem !important;
                }
            @endauth

            .header-area h1 {
                font-size: 2rem;
            }

            .lampiran-area {
                margin-top: 2rem;
            }

            .referensi-text {
                margin-top: 2.5rem !important;
            }
        }
    </style>
@endpush
