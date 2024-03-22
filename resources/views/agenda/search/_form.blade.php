<div class="pl-lg-4">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="form-control-label" for="input_receiver_id">
                    @if (auth()->user()->isAdmin())
                        Yang Menghadiri <small class="text-primary">* (kosong = seluruh tujuan)</small>
                    @else
                        Yang Menghadiri
                    @endif
                </label>
                @if (auth()->user()->isAdmin())
                    <select name="receiver_id[]" id="input_receiver_id" class="form-control select2 form-control-alternative" multiple>
                        @foreach ($receivers as $receiver)
                            @php $selected_receiver = ($data->receiver_id ?? old('receiver_id', 0)) == $receiver->id ? 'selected' : ''; @endphp
                            <option value="{{ $receiver->id }}" {{ $selected_receiver }}>{{ $receiver->name }}</option>
                        @endforeach
                    </select>
                @else
                    <input type="hidden" name="receiver_id[]" id="input_receiver_id" value="{{ $default->id }}">
                    <input type="text" class="form-control" value="{{ $default->name }}" readonly>
                @endif
            </div>
        </div>
        <div class="col-12">
            <label class="form-control-label" for="input_tgl_surat">Tanggal Acara</label>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker-id-start" placeholder="Awal" name="date_indo_start" type="text" value="{{ request()->date_indo_start ?? '' }}" autocomplete="off">
                            <input type="hidden" id="hidden_date_start" name="date_start" value="{{ request()->date_start ?? '' }}">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker-id-end" placeholder="Akhir" name="date_indo_end" type="text" value="{{ request()->date_indo_end ?? '' }}" autocomplete="off">
                            <input type="hidden" id="hidden_date_end" name="date_end" value="{{ request()->date_end ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group{{ $errors->has('no') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-no">No Surat</label>
                <input type="text" class="form-control form-control-alternative {{ $errors->has('no') ? ' is-invalid' : '' }}" placeholder="..." name="no" value="{{ request()->no ?? '' }}">

                @if ($errors->has('no'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('no') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-12">
            <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-description">Uraian</label>
                <input type="text" class="form-control form-control-alternative {{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="..." name="description" value="{{ request()->description ?? '' }}">

                @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-success mt-2">
            <i class="fa fa-search"></i> Cari Data
        </button>
        <a href="{{ url('/arsip/pencarian') }}" class="btn btn-default mt-2">
            <i class="fa fa-sync"></i> Muat Ulang
        </a>
    </div>
</div>
