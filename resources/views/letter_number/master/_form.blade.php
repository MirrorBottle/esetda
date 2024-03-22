<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group{{ $errors->has('month') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="input-month">Bulan</label>
            <select name="month" id="input_month" class="form-control form-control-alternative{{ $errors->has('month') ? ' is-invalid' : '' }}" {{ isset($data) ? 'disabled' : '' }} required>
                <option value="">Pilih: </option>
                @foreach (range(1, 12) as $month)
                    <option value="{{ $month }}" {{ $month == (int) ($data->month_number ?? date('m')) ? 'selected=selected' : '' }}>{{ to_indo_month($month) }}</option>
                @endforeach
            </select>

            @if ($errors->has('month'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('month') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group{{ $errors->has('year') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="input-year">Tahun</label>
            <select name="year" id="input_year" class="form-control form-control-alternative{{ $errors->has('year') ? ' is-invalid' : '' }}" style="width: 12rem;" {{ isset($data) ? 'disabled' : '' }} required>
                <option value="">Pilih: </option>
                @foreach (range(date('Y') + 1, date('Y') - 4) as $year)
                    <option value="{{ $year }}" {{ (int) $year === (int) ($data->year ?? date('Y')) ? 'selected=selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>

            @if ($errors->has('year'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('year') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group{{ $errors->has('start') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-start">Nomor Awal</label>
                    <input type="number" name="start" id="input-start" class="form-control form-control-alternative{{ $errors->has('start') ? ' is-invalid' : '' }}" min="1" value="{{ $data->start ?? old('start', 1) }}" required>

                    @if ($errors->has('start'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('start') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group{{ $errors->has('end') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-end">Nomor Akhir</label>
                    <input type="number" name="end" id="input-end" class="form-control form-control-alternative{{ $errors->has('end') ? ' is-invalid' : '' }}" min="0" max="10000" value="{{ $data->end ?? old('end', 10000) }}" required>

                    @if ($errors->has('end'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('end') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
