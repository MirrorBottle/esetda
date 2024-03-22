@php $is_not_surat_keluar = request()->segment(1) !== 'surat-keluar'; @endphp
<div class="pl-lg-4">
    <div class="row">
        @if (!$is_not_surat_keluar)
            <div class="col-{{ $is_not_surat_keluar ? 6 : 4 }}">
                <div class="form-group{{ $errors->has('no_register') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input_no_register">Nomor Register</label>
                    <input type="text" name="no_register" id="input_no_register"
                        class="form-control form-control-alternative{{ $errors->has('no_register') ? ' is-invalid' : '' }}"
                        value="{{ $data->no_register ?? old('no_register') }}" autocomplete="off">

                    @if ($errors->has('no_register'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('no_register') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        @endif
        <div class="col-{{ $is_not_surat_keluar ? 6 : 4 }}">
            <div class="form-group{{ $errors->has('no') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_no">Nomor Surat</label>
                <input type="text" name="no" id="input_no"
                    class="form-control form-control-alternative{{ $errors->has('no') ? ' is-invalid' : '' }}"
                    value="{{ $data->no ?? old('no') }}" required autofocus>

                @if ($errors->has('no'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('no') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-{{ $is_not_surat_keluar ? 6 : 4 }}">
            <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_date">Tanggal Surat</label>
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="form-control datepicker-id {{ $errors->has('date') ? ' is-invalid' : '' }}"
                        id="input_date" placeholder="Pilih tanggal" name="date_indo" type="text"
                        value="{{ $data->date_indo ?? old('date_indo') }}" autocomplete="off">
                    <input type="hidden" id="hidden_date" name="date"
                        value="{{ $data->date ?? old('date', date('Y-m-d')) }}">
                </div>

                @if ($errors->has('date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-12">
            <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_title">Judul</label>
                <textarea name="title" id="input_title"
                    class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" required>{{ $data->title ?? old('title') }}</textarea>

                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        @if ($is_not_surat_keluar)
            <div class="col-6">
                <div class="form-group{{ $errors->has('sender') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input_sender">Pengirim</label>
                    <input type="text" name="sender" id="input_sender"
                        class="form-control form-control-alternative{{ $errors->has('sender') ? ' is-invalid' : '' }}"
                        value="{{ $data->sender ?? old('sender') }}" required>

                    @if ($errors->has('sender'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('sender') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        @endif
        <div class="col-{{ $is_not_surat_keluar ? '6' : '12' }}">
            <div class="form-group{{ $errors->has('category_id') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_category_id">Kategori Surat</label>
                <select name="category_id" id="input_category_id"
                    class="form-control form-control-alternative{{ $errors->has('category_id') ? ' is-invalid' : '' }}"
                    required>
                    <option value="" disabled selected>Pilih Kategori:</option>
                    @foreach ($categories as $category)
                        @php $selected_category = ($data->category_id ?? old('category_id', 0)) == $category->id ? 'selected' : ''; @endphp
                        <option value="{{ $category->id }}" {{ $selected_category }}>{{ $category->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('category_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('category_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        {{-- surat keluar form --}}
        <div class="col-6 {{ $is_not_surat_keluar ? 'd-none' : '' }}">
            <div class="form-group">
                <label class="form-control-label" for="input_id_detail_type">Tipe Tujuan</label>
                <div class="switch-button" data-active="{{ $data->receiver->type ?? old('receiver_type', 1) }}">
                    @if ($data->receiver->type ?? old('receiver_type', 1) == 1)
                        <div class="row">
                            <div class="col-6">
                                <a href="#" class="btn btn-block btn-success lingkup">
                                    <i class="fa fa-check"></i>
                                    Lingkup Setda
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-block btn-secondary luar">
                                    Luar Setda
                                </a>
                            </div>
                        </div>
                        <input type="hidden" class="receiver_type" name="receiver_type" value="1">
                    @else
                        <div class="row">
                            <div class="col-6">
                                <a href="#" class="btn btn-block btn-secondary lingkup">
                                    Lingkup Setda
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-block btn-success luar">
                                    <i class="fa fa-check"></i>
                                    Luar Setda
                                </a>
                            </div>
                        </div>
                        <input type="hidden" class="receiver_type" name="receiver_type" value="0">
                    @endif
                </div>
            </div>
        </div>

        <div class="col-{{ !$is_not_surat_keluar ? '6' : '12' }}">
            {{-- hidden receiver type --}}
            @php $is_tupim = auth()->user()->biro->name == 'Biro Umum (TU. Pimpinan)'; @endphp

            @if (!$is_tupim && $is_not_surat_keluar)
                <input type="hidden" name="receiver_id" value="{{ $receivers->id }}">
            @else
                <div class="form-group{{ $errors->has('receiver_id') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input_receiver_id">
                        Tujuan Surat
                        <small class="text-danger ml-2 null-tujuan">* tidak ada data</small>
                    </label>
                    @php $receiver_id = $data->receiver_id ?? null @endphp
                    @php $is_not_multiple = $receiver_id !== null @endphp
                    {{-- jika tupim surat masuk maka tujuan surat tetap single --}}
                    @if ($is_tupim && $is_not_surat_keluar)
                        @php $is_not_multiple = true @endphp
                    @endif

                    {{-- saat create jadikan select multiple --}}
                    <select name="receiver_id{{ $is_not_multiple ? '' : '[]' }}" id="input_receiver_id"
                        class="form-control form-control-alternative{{ $errors->has('receiver_id') ? ' is-invalid' : '' }}"
                        data-selected="{{ $receiver_id }}" {{ $is_not_multiple ? '' : 'multiple' }} required>
                        {{-- <option value="">Pilih Tujuan Surat:</option> --}}
                        @foreach ($receivers as $receiver)
                            @php $selected_receiver = ($data->receiver_id ?? old('receiver_id', 0)) == $receiver->id ? 'selected' : ''; @endphp
                            <option value="{{ $receiver->id }}" data-type="{{ $receiver->type }}"
                                {{ $selected_receiver }}>{{ $receiver->name }}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('receiver_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('receiver_id') }}</strong>
                        </span>
                    @endif
                </div>
            @endif
        </div>
        <div class="col-12">
            <div class="form-group{{ $errors->has('attachment') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_attachment">File Lampiran <small
                        class="text-muted">(*maksimal 10mb)</small></label>
                @include('inbox._form_attachments')

                @if ($errors->has('attachment'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('attachment') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        @if (auth()->user()->username == 'tu_pimpinan' && $is_not_surat_keluar)
            <div class="col-12">
                <div class="form-group{{ $errors->has('is_spt') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="spt_check">Surat Tugas <small
                            class="text-muted">(opsional)</small></label>
                    <div>
                        <input type="checkbox" name="is_spt" class="checkbox" id="spt_check" value="1"
                            {{ ($data->is_spt ?? null) !== null ? 'checked' : '' }}>
                        <label for="spt_check"
                            style="font-size: .9rem;
                        margin-left: 4px; cursor: pointer;">Buat
                            Surat Tugas (SPT)</label>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-12">
            <div class="form-group{{ $errors->has('is_disposition') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="disposisi-check">Disposisi <small
                        class="text-muted">(opsional)</small></label>
                <div>
                    <input type="checkbox" name="is_disposition" class="checkbox" id="disposisi-check"
                        value="1" {{ ($data->is_disposition ?? null) !== null ? 'checked' : '' }}>
                    <label for="disposisi-check"
                        style="font-size: .9rem;
                    margin-left: 4px; cursor: pointer;">Tambah No
                        Agenda dan Sifat</label>
                </div>
            </div>
        </div>

        {{-- data disposisi baru --}}
        <div class="col-6 disposisi-input-area"
            style="{{ ($data->is_disposition ?? null) === null ? 'display: none;' : '' }}">
            <div class="form-group{{ $errors->has('no_agenda') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="disposisi-no-agenda">
                    No Agenda
                </label>
                <input type="text" name="no_agenda" class="form-control" id="disposisi-no-agenda"
                    data-status="{{ ($data->no_agenda ?? null) === null ? 'new' : 'edit' }}"
                    data-biro="{{ auth()->user()->biro_id }}" disabled readonly>

                @if ($errors->has('no_agenda'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('no_agenda') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-6 disposisi-input-area"
            style="{{ ($data->is_disposition ?? null) === null ? 'display: none;' : '' }}">
            <div class="form-group{{ $errors->has('property') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="disposisi-property">
                    Sifat
                </label>
                <select name="property" id="disposisi-property" class="form-control" disabled required>
                    <option value="1">Segera</option>
                    <option value="2">Rahasia</option>
                    <option value="3">Sangat Segera</option>
                </select>

                @if ($errors->has('property'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('property') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    {{-- hidden unique key --}}
    <input type="hidden" name="unique_key" value="{{ $data->unique_key ?? unique_key() }}">

    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input-description">Keterangan <small
                class="text-muted">(opsional)</small></label>
        <textarea class="form-control form-control-alternative {{ $errors->has('description') ? ' is-invalid' : '' }}"
            rows="3" placeholder="..." name="description">{{ $data->description ?? old('description') }}</textarea>

        @if ($errors->has('description'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>

    <div>
        <button type="submit" class="btn btn-lg btn-success mt-3">
            <i class="fa fa-check"></i> Simpan {{ isset($data) ? 'Perubahan' : 'Data' }}
        </button>
        <a href="#" class="btn btn-lg btn-secondary mt-3" id="reload">
            <i class="fa fa-sync"></i> Muat Ulang
        </a>
    </div>
</div>
