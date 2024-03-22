<div class="pl-lg-4">
    <div class="row">
        @if ( auth()->user()->isAdmin() )
            <div class="col-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-biro">Unit Pengolah <small class="text-primary">* (kosong = semua biro)</small></label>
                    <select name="biro_id[]" id="input_biro_id" class="form-control select2 form-control-alternative" multiple>
                        @foreach ($biros as $biro)
                            <option value="{{ $biro->id }}">{{ $biro->alias }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        <div class="col-6">
            <div class="form-group">
                <label class="form-control-label" for="input_type">Tipe Arsip</label>
                <div class="switch-button">
                    <a href="#" class="btn btn-primary masuk">
                        <i class="fa fa-check"></i>
                        Surat Masuk
                    </a>
                    <a href="#" class="btn btn-secondary keluar">
                        Surat Keluar
                    </a>
                </div>
                <input type="hidden" name="type" id="type" value="masuk">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="form-control-label" for="input_year">Tahun</label>
                <select name="year" id="input_year" class="form-control select2 form-control-alternative">
                    <option value="" disabled selected>Pilih Tahun:</option>
                    @foreach (range(date('Y'), 2010) as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{-- <div class="col-6">
            <div class="form-group">
                <label class="form-control-label" for="input_type">Kondisi Arsip</label>
                <div class="switch-button-condition">
                    <a href="#" class="btn btn-secondary good">
                        Baik
                    </a>
                    <a href="#" class="btn btn-secondary bad">
                        Tidak Baik
                    </a>
                </div>
                <input type="hidden" name="condition" id="condition">
            </div>
        </div> --}}
        <div class="col-12">
            <label class="form-control-label" for="input_tgl_surat">Tanggal Arsip</label>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker-id-start" placeholder="Tanggal Awal" name="date_indo_start" type="text" value="{{ request()->date_indo_start ?? '' }}" autocomplete="off">
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
                            <input class="form-control datepicker-id-end" placeholder="Tanggal Akhir" name="date_indo_end" type="text" value="{{ request()->date_indo_end ?? '' }}" autocomplete="off">
                            <input type="hidden" id="hidden_date_end" name="date_end" value="{{ request()->date_end ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-6">
            <div class="form-group{{ $errors->has('no') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-no">No Surat</label>
                <input type="text" class="form-control form-control-alternative {{ $errors->has('no') ? ' is-invalid' : '' }}" placeholder="..." name="no" value="{{ request()->no ?? '' }}">

                @if ($errors->has('no'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('no') }}</strong>
                    </span>
                @endif
            </div>
        </div> --}}
        {{-- <div class="col-12">
            <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-description">Uraian Surat</label>
                <input type="text" class="form-control form-control-alternative {{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder=".." name="description" value="{{ request()->description ?? '' }}">

                @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div> --}}
    </div>

    <div class="mb-7">
        <button type="submit" class="btn btn-info mt-2">
            <i class="fa fa-search"></i> Cari Data
        </button>
        <a href="{{ url('/agenda/pencarian') }}" class="btn btn-default mt-2">
            <i class="fa fa-sync"></i> Muat Ulang
        </a>
    </div>
</div>
