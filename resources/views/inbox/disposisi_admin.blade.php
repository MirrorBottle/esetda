@extends('layouts.app', ['page_title' => 'Disposisi Surat'])

@section('content')
    @include('users.partials.header', ['title' => 'Disposisi Surat'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Form Disposisi {{ $disposition_status['type'] === 'edit' ? ' - Ubah Data' : '' }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" id="disposition-form" action="{{ url('/disposisi-admin/'. $inbox->id) }}" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="inbox_id" value="{{ $inbox->id }}">
                            <input type="hidden" name="unique_key" value="{{ $inbox->unique_key }}">
                            <input type="hidden" name="signature_image" value="{{ $disposition_status['signature'] }}" class="signature_image">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group{{ $errors->has('receiver_id') ? ' has-dange≈r' : '' }}">
                                        <label class="form-control-label" for="input_receiver_id">Diterusken ke <span class="text-danger">*</span></label>
                                        {{-- saat create jadikan select multiple --}}
                                        <select name="receiver_id" id="input_receiver_id" class="select2 form-control form-control-alternative{{ $errors->has('receiver_id') ? ' is-invalid' : '' }}" required>
                                            <option value="">Pilih Tujuan:</option>
                                            @foreach ($receivers as $receiver)
                                                <option value="{{ $receiver->id }}" data-type="{{ $receiver->type }}" {{ $receiver->id == $disposition_status['receiver_id'] ? 'selected' : '' }} {{ $receiver->id == auth()->user()->receiver_id ? 'disabled' : '' }}>{{ $receiver->name }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('receiver_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('receiver_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 position-area" style="{{ $disposition_status['position'] !== null ? '' : 'display: none' }}">
                                    <div class="form-group{{ $errors->has('position') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input_position">Jabatan <span class="text-danger">*</span></label>
                                        <input type="text" name="position" id="input_position" class="form-control form-control-alternative {{ $disposition_status['position'] !== null ? '' : 'not-allowed-cursor' }}" value="{{ $disposition_status['position'] ?? '' }}" required {{ $disposition_status['position'] !== null ? '' : 'disabled' }}/>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group{{ $errors->has('letter_no') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input_letter_no">Nomor Surat</label>
                                        <input type="text" id="input_letter_no" class="form-control form-control-alternative not-allowed-cursor" value="{{ $inbox->no }}" readonly/>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input_letter_description">Isi Surat</label>
                                        <textarea id="input_letter_description" class="form-control form-control-alternative not-allowed-cursor" readonly>{{ $inbox->title }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group{{ $errors->has('sender') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input_sender">Pengirim</label>
                                        <input type="text" id="input_sender" class="form-control form-control-alternative not-allowed-cursor" value="{{ $inbox->sender }}" readonly/>
                                    </div>
                                </div>

                                {{-- hidden disposition admin id --}}
                                <input type="hidden" name="disposition_admin_id" value="{{ $disposition_status['id'] ?? '' }}">
                                {{-- hidden parent id --}}
                                <input type="hidden" name="parent_id" value="">

                                <div class="col-12 col-md-4">
                                    <div class="form-group{{ $errors->has('actions') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input_actions">Isi Disposisi <span class="text-danger">*</span></label>
                                        <div class="action-list-area">
                                            @foreach ($disposition_items as $index => $item)
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input type="checkbox" name="actions[{{ $index }}]" value="{{ $index }}" class="custom-control-input" id="actionCheck{{ $index }}" {{ in_array($index, ($disposition_status['actions'])) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="actionCheck{{ $index }}">{{ $item }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ($errors->has('actions'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('actions') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-5">
                                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input_description">Catatan</label>
                                        <textarea name="description" id="input_description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="7">{{ $disposition_status['description'] ?? '' }}</textarea>

                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input_description">Tanda Tangan Digital</label>
                                        <div class="ttd-area-radio mb-2">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadio1" name="signature_check"  value="1" class="custom-control-input" {{ $disposition_status['signature'] !== null ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="customRadio1">Ya</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadio2" name="signature_check"  value="0" class="custom-control-input" {{ $disposition_status['signature'] !== null ? '' : 'checked' }}>
                                                <label class="custom-control-label" for="customRadio2">Tidak</label>
                                            </div>

                                        </div>
                                        @if ($disposition_status['signature'] !== null)
                                            <div class="visible-print bg-white p-3 shadow d-inline-block">
                                                <img class="float-right signature-preview {{ $disposition_status['signature'] !== null ? '' : 'd-none' }}" src="{{ $disposition_status['signature'] !== null ? asset('storage/'. $disposition_status['signature']) : '#' }}" style="width: 100px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="#" class="btn btn-lg btn-success mt-3" id="save" data-toggle="modal" data-target="#confirm-modal">
                                        <i class="fa fa-check"></i> {{ $disposition_status['type'] === 'edit' ? ' Perbarui ' : 'Kirim' }} Disposisi
                                    </a>

                                    {{-- <a href="#" class="btn btn-lg btn-info mt-3" data-toggle="modal" data-target="#ttd-modal" id="ttd" data-status="{{ $disposition_status['type'] }}">
                                        <i class="fa fa-edit"></i>
                                        {{ $disposition_status['signature'] !== null ? 'Perbarui' : '' }} Tanda Tangan
                                    </a> --}}

                                    {{-- <img class="float-right signature-preview {{ $disposition_status['signature'] !== null ? '' : 'd-none' }}" src="{{ $disposition_status['signature'] !== null ? asset('storage/'. $disposition_status['signature']) : '#' }}" style="width: 128px;"> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- riwayat disposisi --}}
                @if ($dispositions !== null)
                    <div class="card bg-secondary shadow mt-4">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Riwayat Disposisi</h3>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                @forelse ($dispositions as $disposition)
                                    <div class="col-12 col-md-6 mb-4">
                                        <div class="card shadow h-100">
                                            <div class="card-body p-3">
                                                <small class="d-block">
                                                    <span class="mb-1 badge badge-{{ $loop->iteration % 2 == 0 ? 'info' : 'success' }}">{{ $disposition->user->receiver->name }}</span>
                                                    <span class="text-muted mx-1"><i class="fa fa-angle-double-right"></i></span>
                                                    @if ($disposition->receiver->name == 'ARSIP')
                                                    <span class="mb-1 badge badge-{{ $loop->iteration % 2 == 0 ? 'warning' : 'info' }}">ARSIP {{ $disposition->user->receiver->name }}</span>
                                                    @else
                                                        <span class="mb-1 badge badge-{{ $loop->iteration % 2 == 0 ? 'warning' : 'info' }}">{{ $disposition->receiver->name .' '. $disposition->position }}</span>
                                                    @endif
                                                </small>
                                                <h2 class="mb-1">{{ $disposition->description }}</h2>
                                                <div class="list-check">
                                                    @foreach ($disposition->actions as $action)
                                                        <p class="mb-0"><small><i class="fa fa-check text-blue"></i> {{ $disposition_items[$action] }}</small></p>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted my-0 ml-3">Belum ada riwayat disposisi.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @endif

                {{-- riwayat disposisi --}}
                <div class="card bg-secondary shadow mt-4">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Daftar Lampiran</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if ($inbox->is_attachment)
                            @foreach (range(1, 4) as $index)
                                @include('inbox._attachment_card', [
                                    'index' => $index,
                                    'attachments' => $inbox->attachments_order,
                                ])
                            @endforeach
                        @else
                            <p class="text-muted my-0">Tidak ada lampiran terkait.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- confirm modal --}}
        <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modal-title-notification">Konfirmasi Password</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body bg-secondary">
                        <div class="py-3 text-center">
                            <i class="fa fa-lock" style="font-size: 4rem;"></i>
                            <h3 class="mt-3 mb-3">Masukkan Password Disposisi</h3>
                            <div class="form-group mb-2">
                                <input type="password" name="password" id="input_password" class="form-control form-control-alternative text-center" required />
                            </div>
                            <small class="text-danger empty_password_error" style="display: none;">
                                Password tidak boleh kosong!
                            </small>
                            <small class="text-danger wrong_password_error" style="display: none;">
                                Password yang dimasukkan salah! <br>
                                Silahkan ulangi kembali.
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-send"><i class="fa fa-paper-plane"></i> Kirim Disposisi</button>
                        <button type="button" class="btn btn-light ml-auto" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('css')
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">

    <style>
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border-radius: 4px;
            transition: box-shadow .15s ease;
            border: 0;
            box-shadow: 0 1px 3px rgba(50, 50, 93, .15), 0 1px 0 rgba(0, 0, 0, .02);
            height: 45px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #9aa7b7;
            line-height: 46px;
            font-size: .9rem;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 46px;
        }

        .select2-container .select2-results__option.optInvisible {
            display: none;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid white;
            transition: box-shadow .15s ease;
            padding: .3rem;
            box-shadow: 0 1px 3px rgba(50, 50, 93, .15), 0 1px 0 rgba(0, 0, 0, .02);
        }
        .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
            font-size: .9rem;
        }

        .select2-container--default.select2-container--disabled .select2-selection--single {
            background-color: #fff;
        }

        .custom-control-label::before {
            top: .025rem;
        }

        .form-control:disabled, .form-control[readonly] {
            background-color: #fff;
        }

        .not-allowed-cursor,
        .select2-container--disabled .selection .select2-selection {
            cursor: not-allowed
        }
    </style>
@endpush

@push('js')
    {{-- select2 --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>

    <script>
        $(function() {
            // init select2
            $('.select2').select2();

            // check disposition password
            $('.btn-send').on('click', function(e) {
                const csrfToken = '{{ csrf_token() }}';
                const passwordInput = $('#input_password').val();
                if (passwordInput == '' || passwordInput == 0 || passwordInput == null) {
                    $('.empty_password_error').show();
                } else {
                    $('.empty_password_error').hide();

                    const targetUrl = '{{ url("check-disposition-password") }}';
                    $.post(targetUrl, {
                        password: passwordInput,
                        _token: csrfToken,
                    }, function(res, status) {
                        if (res.status) {
                            $('.wrong_password_error').hide();
                            $('#disposition-form').submit();
                        } else {
                            $('.wrong_password_error').show();
                        }
                    });
                }
            });

            // check receiver input / type 2
            $('#input_receiver_id').on('change', function(e) {
                const selectedValue = $(this).val();
                const type = $('#input_receiver_id').find('option[value="'+ selectedValue +'"]').attr('data-type');
                if (type == 2) {
                    $('.position-area').show();
                    $('.position-area').find('input')
                        .removeClass('not-allowed-cursor')
                        .prop('disabled', false);
                } else {
                    $('.position-area').hide();
                    $('.position-area').find('input').prop('disabled', true);
                }
            });
        });
    </script>
@endpush

