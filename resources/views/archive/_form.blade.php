<input type="hidden" name="type" value="{{ $type }}">

<div class="pl-lg-4">
    <p><small class="text-danger">* (wajib diisi)</small></p>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="form-control-label" for="input-biro">Unit Pengolah <small class="text-danger">*</small></label>
                {{-- @if ( auth()->user()->isAdmin() )
                    <select name="biro_id" id="input_biro_id" class="form-control select2 form-control-alternative{{ $errors->has('biro_id') ? ' is-invalid' : '' }}" data-type="{{ $type }}" required>
                        <option value="" disabled selected>Pilih biro:</option>
                        @foreach ($biros as $biro)
                            @php $biro_id = $data->biro_id ?? old('biro_id') @endphp
                            @php $selected_biro = $biro_id == $biro->id ? 'selected' : ''; @endphp
                            <option value="{{ $biro->id }}" {{ $selected_biro }}>{{ $biro->name }}</option>
                        @endforeach
                    </select>
                @else --}}
                <input type="hidden" name="biro_id" value="{{ $biro_id }}">
                <input type="text" class="form-control form-control-alternative" value="{{ $biro }}" readonly>
                {{-- @endif --}}
            </div>
        </div>

        <div class="col-6">
            <div class="form-group{{ $errors->has('surat_id') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_surat_id">Surat {{ ucfirst($type) }} <small class="text-danger">*</small></label>
                @isset($data)
                    <input type="hidden" name="surat_id" value="{{ $surat_id }}">
                    <input type="text" class="form-control form-control-alternative" value="{{ $surat_title }}" readonly>
                @else
                    <select name="surat_id" id="input_surat_id" class="form-control select2 form-control-alternative{{ $errors->has('surat_id') ? ' is-invalid' : '' }}" data-type="{{ $type }}" {{ isset($data) ? 'disabled' : 'required' }}>
                        @isset($data)
                            <option value="{{ $surat_id }}">{{ $surat_title }}</option>
                        @else
                            <option value="" disabled selected>Pilih Surat:</option>
                            @foreach ($surats as $surat)
                                @php $surat_id = $data->archivable_id ?? old('surat_id', $surat_id) @endphp
                                @php $selected_surat = $surat_id == $surat->id ? 'selected' : ''; @endphp
                                <option value="{{ $surat->id }}" {{ $selected_surat }}>{{ $surat->no }}</option>
                            @endforeach
                        @endisset
                    </select>
                @endif

                @if ($errors->has('surat_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('surat_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-12">
            <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-description">
                    Uraian <small class="text-danger">*</small>
                </label>
                <textarea class="form-control form-control-alternative {{ $errors->has('description') ? ' is-invalid' : '' }}" rows="2" placeholder="..." name="description" id="description" readonly required>{{ $data->archivable->title ?? old('description', $surat_title) }}</textarea>

                @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-12">
            <div class="form-group{{ $errors->has('clasification_id') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_clasification_id">Klasifikasi <small class="text-danger">*</small></label>
                <select name="clasification_id" id="input_clasification_id" class="form-control select2 form-control-alternative{{ $errors->has('clasification_id') ? ' is-invalid' : '' }}" required>
                    <option value="" disabled selected>Pilih Klasifikasi:</option>
                    @foreach ($clasifications as $clasification)
                        @php $clasification_id = $data->clasification_id ?? old('clasification_id', $clasification->id) @endphp
                        @php $selected_clasification = $clasification_id == $clasification->id ? 'selected' : ''; @endphp
                        <option value="{{ $clasification->id }}" {{ $selected_clasification }}>({{ $clasification->code_formatted }}) {{ $clasification->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('clasification_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('clasification_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_date">
                    Tanggal Arsip <small class="text-danger">*</small>
                </label>
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="form-control datepicker-id {{ $errors->has('date') ? ' is-invalid' : '' }}" id="input_date" placeholder="Pilih tanggal" name="date_indo" type="text" value="{{ $data->date_indo ?? old('date_indo', $date) }}" autocomplete="off" required>
                    <input type="hidden" id="hidden_date" name="date" value="{{ $data->date ?? old('date', date('Y-m-d')) }}">
                </div>

                @if ($errors->has('date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-3">
            <div class="form-group{{ $errors->has('year') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_year">
                    Tahun <small class="text-danger">*</small>
                </label>
                <select name="year" id="input_year" class="form-control select2 form-control-alternative{{ $errors->has('year') ? ' is-invalid' : '' }}" required>
                    <option value="" disabled selected>Pilih Tahun:</option>
                    @foreach (range(date('Y'), 2010) as $year)
                        @php $selected_place = ($data->year ?? old('year', date('Y'))) == $year ? 'selected' : ''; @endphp
                        <option value="{{ $year }}" {{ $selected_place }}>{{ $year }}</option>
                    @endforeach
                </select>

                @if ($errors->has('year'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('year') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-3">
            <div class="form-group{{ $errors->has('qty') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-qty">
                    Jumlah <small class="text-danger">*</small>
                </label>
                <input type="number" class="form-control form-control-alternative {{ $errors->has('qty') ? ' is-invalid' : '' }}" name="qty" value="{{ $data->qty ?? old('qty', 1) }}">

                @if ($errors->has('qty'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('qty') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="form-control-label" for="input_type">
                    TK. PRK <small class="text-danger">*</small>
                </label>
                @php $tk_prk = $data->tk_prk ?? '1'; @endphp
                <div class="switch-button-tk-prk">
                    <a href="#" class="btn btn-{{ $tk_prk == '1' ? 'primary' : 'secondary' }}  copy">
                        {!! $tk_prk == '1' ? '<i class="fa fa-check"></i>' : '' !!}
                        Copy
                    </a>
                    <a href="#" class="btn btn-{{ $tk_prk == '0' ? 'primary' : 'secondary' }}  non-copy">
                        {!! $tk_prk == '0' ? '<i class="fa fa-check"></i>' : '' !!}
                        Asli
                    </a>
                </div>
                <input type="hidden" name="tk_prk" id="tk_prk" value="{{ $tk_prk }}">
            </div>
        </div>
        @if ( auth()->user()->isAdmin() )
            <div class="col-3">
                <div class="form-group{{ $errors->has('no_box') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-no-box">
                        Nomor Box <small class="text-danger">*</small>
                    </label>
                    <input type="number" class="form-control form-control-alternative {{ $errors->has('no_box') ? ' is-invalid' : '' }}" name="no_box" value="{{ $data->no_box ?? old('no_box', 1) }}">

                    @if ($errors->has('no_box'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('no_box') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-3">
                <div class="form-group{{ $errors->has('no_folder') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-no-folder">
                        Nomor Folder <small class="text-danger">*</small>
                    </label>
                    <input type="number" class="form-control form-control-alternative {{ $errors->has('no_folder') ? ' is-invalid' : '' }}" name="no_folder" value="{{ $data->no_folder ?? old('no_folder', 1) }}">

                    @if ($errors->has('no_folder'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('no_folder') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        @endif
        <div class="col-6">
            <div class="form-group">
                <label class="form-control-label" for="input_type">
                    Kondisi Arsip <small class="text-danger">*</small>
                </label>
                @php $condition = $data->condition ?? '1'; @endphp
                <div class="switch-button-condition">
                    <a href="#" class="btn btn-{{ $condition == '1' ? 'primary' : 'secondary' }} good">
                        {!! $condition == '1' ? '<i class="fa fa-check"></i>' : '' !!}
                        Baik
                    </a>
                    <a href="#" class="btn btn-{{ $condition == '0' ? 'primary' : 'secondary' }} bad">
                        {!! $condition == '0' ? '<i class="fa fa-check"></i>' : '' !!}
                        Tidak Baik
                    </a>
                </div>
                <input type="hidden" name="condition" id="condition" value="{{ $condition }}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group{{ $errors->has('attachment') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_attachment">File Lampiran <small class="text-muted">(*maksimal 10mb)</small></label>
                <label class="btn btn-block btn-info btn-file">
                    @php $file = $data->attachment ?? null; @endphp
                    @if ($file !== null)
                        <span><i class="fa fa-check"></i> {{ str_limit($file->title ?? 'Lampiran') }}</span>
                        <input type="hidden" name="uploaded_file" value="current">
                    @else
                        <span>{{ 'Pilih Lampiran Berkas' }}</span>
                    @endif
                    <input type="file" style="display: none;" accept="application/pdf, image/*" name="attachment" id="attachment" data-status="{{ $file !== null ? 'edited' : 'new' }}">
                </label>

                @if ($file ?? null !== null)
                    <div>
                        <a href="{{ url('storage/'. $file->name) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat Lampiran</a>
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
    </div>

    <div class="form-group{{ $errors->has('note') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input-note">Keterangan</label>
        <textarea class="form-control form-control-alternative {{ $errors->has('note') ? ' is-invalid' : '' }}" rows="3" placeholder="..." name="note">{{ $data->note ?? old('note') }}</textarea>

        @if ($errors->has('note'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('note') }}</strong>
            </span>
        @endif
    </div>

    <div>
        <input type="hidden" name="back_url" value="{{ request()->back_url }}">
        <button type="submit" class="btn btn-lg btn-primary mt-3">
            <i class="fa fa-check"></i> Simpan {{ isset($data) ? 'Perubahan' : 'Data' }}
        </button>
        <a href="#" class="btn btn-lg btn-default mt-3" id="reload">
            <i class="fa fa-sync"></i> Muat Ulang
        </a>
    </div>
</div>
