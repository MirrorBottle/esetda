<div class="row">
    {{-- hidden letter number id --}}
    <input type="hidden" name="letter_number_id" id="hidden_letter_number_id" value="{{ $data->letter_number_id ?? '' }}">
    <div class="col-12 col-md-6">
        <div class="form-group{{ $errors->has('month') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="input_month">Bulan</label>
            <select id="input_month" class="form-control form-control-alternative{{ $errors->has('month') ? ' is-invalid' : '' }}" {{ isset($data) ? 'disabled' : '' }} required>
                <option value="">Pilih: </option>
                @foreach (range(1, 12) as $month)
                    <option value="{{ $month }}" {{ $month == (int) ($data->letter_number->month_number ?? null) ? 'selected=selected' : '' }}>{{ to_indo_month($month) }}</option>
                @endforeach
            </select>

            @if ($errors->has('month'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('month') }}</strong>
                </span>
            @endif

            {{-- show generate error --}}
            <p class="text-danger font-weight-bold mt-3 mb-0 d-none" id="generate-error-area">
                Nomor urut sudah tidak tersedia, silahkan pilih bulan lain atau ubah data master nomor
                <a class="text-info" href="{{ url('arsip/nomor-surat') }}">disini</a>
            </p>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group{{ $errors->has('year') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="input_year">Tahun</label>
            <select id="input_year" class="form-control form-control-alternative{{ $errors->has('year') ? ' is-invalid' : '' }}" {{ isset($data) ? 'disabled' : '' }} required>
                @foreach (range(date('Y') + 1, date('Y') - 4) as $year)
                    <option value="{{ $year }}" {{ (int) $year === (int) ($data->letter_number->year ?? date('Y')) ? 'selected=selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>

            @if ($errors->has('year'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('year') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group{{ $errors->has('order') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="input_order">Nomor Urut</label>
            <input type="text" name="order" id="input_order" class="form-control form-control-alternative{{ $errors->has('order') ? ' is-invalid' : '' }}" value="{{ $data->order ?? '' }}" readonly required>
        </div>
    </div>
    <div class="col-12 col-md-6 toggle-bottom-area">
        <div class="form-group{{ $errors->has('number') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="input_number">Nomor Surat</label>
            <input type="text" name="number" id="input_number" class="form-control form-control-alternative{{ $errors->has('number') ? ' is-invalid' : '' }}" value="{{ $data->number ?? old('number') }}" required>

            @if ($errors->has('number'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('number') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-12 col-md-6 toggle-bottom-area">
        <div class="form-group{{ $errors->has('sender') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="input_sender">Pengirim</label>
            <input type="text" name="sender" id="input_sender" class="form-control form-control-alternative{{ $errors->has('sender') ? ' is-invalid' : '' }}" value="{{ $data->sender ?? old('sender') }}" required>

            @if ($errors->has('sender'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('sender') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-12 col-md-6 toggle-bottom-area">
        <div class="form-group{{ $errors->has('attachment') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="input_attachment">File Lampiran <small class="text-muted">(*maksimal 10mb)</small></label>
            <label class="btn btn-block btn-info btn-file">
                @php $file = $data->attachment ?? null; @endphp
                @if ($file !== null)
                    <span><i class="fa fa-sync"></i> Ubah Lampiran</span>
                    <input type="hidden" name="uploaded_file" value="current">
                @else
                    <span>{{ 'Pilih Lampiran Berkas' }}</span>
                @endif
                <input type="file" style="display: none;" accept="application/pdf, image/*" name="attachment" id="attachment" data-status="{{ $file !== null ? 'edited' : 'new' }}">
            </label>

            @if ($file ?? null !== null)
                <div>
                    <a href="{{ url('storage/'. $file) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat Lampiran</a>
                    <a href="#" class="btn btn-sm btn-outline-danger float-right delete-attachment">Hapus</a>
                </div>
            @endif

            @if ($errors->has('attachment'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('attachment') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-12 col-md-6 toggle-bottom-area">
        <div class="form-group{{ $errors->has('note') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="input_note">Keterangan <small class="text-muted">(opsional)</small></label>
            <input type="text" name="note" id="input_note" class="form-control form-control-alternative{{ $errors->has('note') ? ' is-invalid' : '' }}" value="{{ $data->note ?? old('note') }}">

            @if ($errors->has('note'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('note') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
