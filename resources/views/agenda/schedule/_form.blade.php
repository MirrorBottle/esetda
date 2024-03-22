<div class="pl-lg-4">
    <p><small class="text-muted">Ket: tanda <span class="text-danger">*</span> wajib dilengkapi</small></p>
    <div class="row">
        <div class="col-4">
            <div class="form-group{{ $errors->has('inbox_id') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_inbox_id">Referensi Surat</label>
                <select name="inbox_id" id="input_inbox_id" class="form-control select2 form-control-alternative{{ $errors->has('inbox_id') ? ' is-invalid' : '' }}">
                @if (request()->segment(1) == 'surat-agenda')
                    <option value="{{ $inbox_id }}">{{ $inbox_no }}</option>
                @else
                    <option value="" selected>Pilih Surat:</option>
                    @foreach ($inboxes as $inbox)
                        @php $selected_inbox = ($data->inbox_id ?? old('inbox_id', 0)) == $inbox->id ? 'selected' : ''; @endphp
                        <option value="{{ $inbox->id }}" {{ $selected_inbox }}>{{ $inbox->no }}</option>
                    @endforeach
                @endif
                </select>

                @if ($errors->has('inbox_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('inbox_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-4">
            <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_date">Tanggal Kegiatan <small class="text-danger">*</small></label>
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
        <div class="col-2">
            <div class="form-group{{ $errors->has('time_start') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="time_start">Jam Mulai</label>
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-clock"></i>
                        </span>
                    </div>
                    <input class="form-control {{ $errors->has('time_start') ? ' is-invalid' : '' }}" id="time_start" name="time_start" type="text" value="{{ old('time_start', ($data->time_start ?? '')) }}" autocomplete="off">
                </div>

                @if ($errors->has('time_start'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('time_start') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-2">
            <div class="form-group{{ $errors->has('time_end') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="time_end">Jam Akhir</label>
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-clock"></i>
                        </span>
                    </div>
                    <input class="form-control {{ $errors->has('time_end') ? ' is-invalid' : '' }}" id="time_end" name="time_end" type="text" value="{{ old('time_start', ($data->time_end ?? '')) }}" autocomplete="off">
                </div>

                @if ($errors->has('time_end'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('time_end') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-12">
            <div class="form-group{{ $errors->has('event') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-event">Acara <small class="text-danger">*</small></label>
                <textarea class="form-control form-control-alternative {{ $errors->has('event') ? ' is-invalid' : '' }}" placeholder="..." name="event" rows="3" required>{{ $data->event ?? old('event', ($inbox_description ?? '')) }}</textarea>

                @if ($errors->has('event'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('event') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="form-group{{ $errors->has('place_id') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_place_id">Tempat</label>
                <select name="place_id" id="input_place_id" class="form-control select2-tag form-control-alternative{{ $errors->has('place_id') ? ' is-invalid' : '' }}">
                    <option value="" selected>Pilih atau Tambah Tempat:</option>
                    @foreach ($places as $place)
                        @php $selected_place = ($data->place_id ?? old('place_id', 0)) == $place->id ? 'selected' : ''; @endphp
                        <option value="{{ $place->id }}" {{ $selected_place }}>{{ $place->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('place_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('place_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="form-group{{ $errors->has('apparel_id') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_apparel_id">Pakaian</label>
                <select name="apparel_id" id="input_apparel_id" class="form-control select2-tag form-control-alternative{{ $errors->has('apparel_id') ? ' is-invalid' : '' }}">
                    <option value="" selected>Pilih atau Tambah Pakaian:</option>
                    @foreach ($apparels as $apparel)
                        @php $selected_apparel = ($data->apparel_id ?? old('apparel_id', 0)) == $apparel->id ? 'selected' : ''; @endphp
                        <option value="{{ $apparel->id }}" {{ $selected_apparel }}>{{ $apparel->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('apparel_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('apparel_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="form-group{{ $errors->has('receiver_id') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_receiver_id">Yang Menghadiri <small class="text-danger">*</small></label>
                <select name="receiver_id" id="input_receiver_id" class="form-control select2 form-control-alternative{{ $errors->has('receiver_id') ? ' is-invalid' : '' }}" required>
                    <option value="" selected>Pilih Yang Menghadiri:</option>
                    @foreach ($receivers as $receiver)
                        @php $selected_receiver = ($data->receiver_id ?? old('receiver_id', 0)) == $receiver->id ? 'selected' : ''; @endphp
                        <option value="{{ $receiver->id }}" {{ $selected_receiver }}>{{ $receiver->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('receiver_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('receiver_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="form-group{{ $errors->has('disposition_id') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_disposition_id">Disposisi <small class="text-danger">*</small></label>
                <select name="disposition_id" id="input_disposition_id" class="form-control select2-tag form-control-alternative{{ $errors->has('disposition_id') ? ' is-invalid' : '' }}" required>
                    <option value="" selected>Pilih atau Tambah Disposisi:</option>
                    @foreach ($dispositions as $disposition)
                        @php $selected_disposition = ($data->disposition_id ?? old('disposition_id', 0)) == $disposition->id ? 'selected' : ''; @endphp
                        <option value="{{ $disposition->id }}" {{ $selected_disposition }}>{{ $disposition->position }}</option>
                    @endforeach
                </select>

                @if ($errors->has('disposition_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('disposition_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="form-group{{ $errors->has('partner_id') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_partner_id">Pendamping</label>
                <select name="partner_id[]" id="input_partner_id" class="form-control select2-multiple form-control-alternative{{ $errors->has('partner_id') ? ' is-invalid' : '' }}" data-placeholder="Pilih atau Tambah Pendamping" multiple>
                    @foreach ($partners as $partner)
                        @php $selected_partner = in_array($partner->id, old('partner_id', ($agenda->all_partner ?? []))) ? 'selected' : ''; @endphp
                        <option value="{{ $partner->id }}" {{ $selected_partner }}>{{ $partner->position }}</option>
                    @endforeach
                </select>

                @if ($errors->has('partner_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('partner_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="form-control-label" for="input_type">Status <small class="text-danger">*</small></label>
                @php $status = $data->status ?? '1'; @endphp
                <div class="switch-button">
                    <a href="#" class="btn btn-{{ $status == '1' ? 'primary' : 'secondary' }} terbuka">
                        {!! $status == '1' ? '<i class="fa fa-check"></i>' : '' !!}
                        Terbuka
                    </a>
                    <a href="#" class="btn btn-{{ $status == '0' ? 'primary' : 'secondary' }} rahasia">
                        {!! $status == '0' ? '<i class="fa fa-check"></i>' : '' !!}
                        Rahasia
                    </a>
                </div>
                <input type="hidden" name="status" id="status" value="{{ $status }}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-description">Keterangan</label>
                <textarea class="form-control form-control-alternative {{ $errors->has('description') ? ' is-invalid' : '' }}" rows="3" placeholder="..." name="description">{{ $data->description ?? old('description') }}</textarea>

                @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
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

    <div>
        <button type="submit" class="btn btn-lg btn-success mt-3">
            <i class="fa fa-check"></i> Simpan {{ isset($data) ? 'Perubahan' : 'Data' }}
        </button>
        <a href="#" class="btn btn-lg btn-secondary mt-3" id="reload">
            <i class="fa fa-sync"></i> Muat Ulang
        </a>
    </div>
</div>
