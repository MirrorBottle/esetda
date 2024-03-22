<div class="pl-lg-4">
    <h2>DATA DIRI</h2>
    <hr class="mt-3">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group{{ $errors->has('sender') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_sender">Nama Pengirim</label>
                <input type="text" name="sender" id="input_sender" class="form-control form-control-alternative{{ $errors->has('sender') ? ' is-invalid' : '' }}" value="{{ $data->sender ?? old('sender') }}" required autofocus>

                @if ($errors->has('sender'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('sender') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group{{ $errors->has('institution') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_institution">Asal Instansi / Organisasi / Perusahaan / Lainnya</label>
                <input type="text" name="institution" id="input_institution" class="form-control form-control-alternative{{ $errors->has('institution') ? ' is-invalid' : '' }}" value="{{ $data->institution ?? old('institution') }}" required autocus>

                @if ($errors->has('institution'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('institution') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group{{ $errors->has('whatsapp') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_whatsapp">Nomor WhatsApp</label>
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text input-group-text bg-success text-white mr-2" style="font-size: 14px;">62</span>
                    </div>
                    <input type="text" name="whatsapp" value="{{ $data->whatsapp ?? '' }}" class="form-control" id="input_whatsapp" maxlength="13" placeholder="812xxxxxxxx" required>
                </div>

                @if ($errors->has('whatsapp'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('whatsapp') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        {{-- <div class="col-12 col-md-6">
            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_email">Alamat Email <small class="text-muted">(opsional)</small></label>
                <input type="email" name="email" id="input_email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $data->email ?? old('email') }}">

                @if ($errors->has('email'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div> --}}
    </div>

    <h2 class="mt-3">DATA SURAT</h2>
    <hr class="mt-3">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group{{ $errors->has('letter_no') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_letter_no">No Surat <small class="text-muted">(opsional)</small></label>
                <input type="text" name="letter_no" id="input_letter_no" class="form-control form-control-alternative{{ $errors->has('letter_no') ? ' is-invalid' : '' }}" value="{{ $data->letter_no ?? old('letter_no') }}">

                @if ($errors->has('letter_no'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('letter_no') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group{{ $errors->has('letter_title') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_letter_title">Judul Surat</label>
                <input type="text" name="letter_title" id="input_letter_title" class="form-control form-control-alternative{{ $errors->has('letter_title') ? ' is-invalid' : '' }}" value="{{ $data->letter_title ?? old('letter_title') }}" required>

                @if ($errors->has('letter_title'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('letter_title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group{{ $errors->has('receiver_id') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_receiver_id">
                    Tujuan Surat
                </label>

                <select name="receiver_id" id="input_receiver_id" class="select2 form-control form-control-alternative{{ $errors->has('receiver_id') ? ' is-invalid' : '' }}" required>
                    <option value="">Pilih:</option>
                    @foreach ($receivers as $receiver)
                        <option value="{{ $receiver->id }}" {{ old('receiver_id') == $receiver->id ? 'selected' : '' }}>{{ $receiver->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('receiver_id'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('receiver_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group{{ $errors->has('attachment') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_attachment">Berkas Lampiran Surat <small class="text-muted">(*maksimal 10mb)</small></label>
                {{-- form upload --}}
                <label class="btn btn-block btn-primary btn-file" data-item="1">
                    <span><i class="fa fa-upload"></i> Upload File</span>
                    <input type="file" style="display: none;" accept="image/*, .doc, .docx, .pdf" name="attachment" id="attachment_1" data-status="new">
                </label>

                @if ($errors->has('attachment'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('attachment') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-12">
            <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-description">Keterangan <small class="text-muted">(opsional)</small></label>
                <textarea class="form-control form-control-alternative {{ $errors->has('description') ? ' is-invalid' : '' }}" rows="3" placeholder="..." name="description">{{ $data->description ?? old('description') }}</textarea>

                @if ($errors->has('description'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div>
        <button type="submit" class="btn btn-lg btn-success mt-3">
            <i class="fa fa-paper-plane"></i> Kirim Data
        </button>
        <a href="#" class="btn btn-lg btn-secondary mt-3" id="reload">
            <i class="fa fa-sync"></i> Muat Ulang
        </a>
    </div>
</div>
