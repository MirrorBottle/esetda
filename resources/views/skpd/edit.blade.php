@extends('layouts.app', ['page_title' => 'Master SKPD'])

@section('content')
    @include('users.partials.header', ['title' => 'SKPD'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Ubah Data SKPD</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/skpd') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/skpd/'. $skpd->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_name">Nama SKPD <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="input_name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $skpd->name) }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('budget_expanse') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_budget_expanse">Beban Anggaran</label>
                                    <textarea class="form-control form-control-alternative {{ $errors->has('budget_expanse') ? ' is-invalid' : '' }}" rows="3" name="budget_expanse" id="input_budget_expanse" required>{{ old('budget_expanse', $skpd->budget_expanse) }}</textarea>
                    
                                    @if ($errors->has('budget_expanse'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('budget_expanse') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('wa_number') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_wa_number">Nomor Whatsapp <span class="text-danger">*</span> <small>(untuk keperluan notifikasi)</small></label>
                                    <input type="text" name="wa_number" id="input_wa_number" class="form-control form-control-alternative{{ $errors->has('wa_number') ? ' is-invalid' : '' }}" value="{{ old('wa_number', $skpd->wa_number) ?? '62' }}" required>

                                    @if ($errors->has('wa_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('wa_number') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('contact') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input_contact">Nama Kontak Penerima <span class="text-danger">*</span> <small>(untuk keperluan notifikasi)</small></label>
                                    <input type="text" name="contact" id="input_contact" class="form-control form-control-alternative{{ $errors->has('contact') ? ' is-invalid' : '' }}" value="{{ old('contact', $skpd->contact) }}" required>

                                    @if ($errors->has('contact'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('contact') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-success mt-2">
                                        <i class="fa fa-check"></i> Simpan Perubahan
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
