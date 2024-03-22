<div class="pl-lg-4">
    <div class="form-group{{ $errors->has('inbox_id') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input_inbox_id">Dasar Surat <span class="text-danger">*</span></label>
        <select name="inbox_id" id="input_inbox_id"
            class="form-control select2 form-control-alternative{{ $errors->has('inbox_id') ? ' is-invalid' : '' }}"
            required autofocus>
            <option value="" disabled selected>Cari Nomor Surat:</option>
            @foreach ($inboxes as $inbox)
                @if ($get_inbox_id !== null)
                    @php $set_inbox_id = $get_inbox_id @endphp
                @else
                    @php $set_inbox_id = $spt->inbox_id ?? '' @endphp
                @endif
                @php $selected_inbox = old('inbox_id', $set_inbox_id) == $inbox->id ? 'selected' : ''; @endphp
                <option value="{{ $inbox->id }}" {{ $selected_inbox }} data-title="{{ $inbox->title }}"
                    data-sender="{{ $inbox->sender }}">{{ $inbox->no }}</option>
            @endforeach
        </select>

        @if ($errors->has('inbox_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('inbox_id') }}</strong>
            </span>
        @endif

        {{-- detail inbox --}}
        <div class="detail-action mt-2">
            <a href="#" data-target="detail-inbox" class="btn btn-sm btn-primary show-detail"
                style="{{ ($spt ?? null) !== null ? '' : 'display: none;' }}">Lihat Detail</a>
            <a href="#" data-target="detail-inbox" class="btn btn-sm btn-dark close-detail"
                style="display: none;">Tutup Detail</a>
        </div>
        <table class="table table-striped detail-inbox mt-2" style="display: none;">
            <tr style="background: #4c7273; color: #fff;">
                <td colspan="3"><b>INFO SURAT MASUK</b></td>
            </tr>
            <tr>
                <td style="width: 140px;">PENGIRIM</td>
                <td style="width: 20px;">:</td>
                <td class="detail-inbox-sender"></td>
            </tr>
            <tr>
                <td>JUDUL</td>
                <td>:</td>
                <td class="detail-inbox-title" style="white-space: normal;"></td>
            </tr>
        </table>
    </div>

    <div class="form-group{{ $errors->has('skpd_id') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input_skpd_id">SKPD Penanggungjawab<span
                class="text-danger">*</span></label>
        <select name="skpd_id" id="input_skpd_id"
            class="form-control select2 form-control-alternative{{ $errors->has('skpd_id') ? ' is-invalid' : '' }}"
            required>
            <option value="" disabled selected>Pilih SKPD:</option>
            @foreach ($skpds as $skpd)
                @php $selected_skpd = old('skpd_id', $spt->skpd_id ?? '') == $skpd->id ? 'selected' : ''; @endphp
                <option value="{{ $skpd->id }}" {{ $selected_skpd }} data-budget="{!! $skpd->budget_expanse !!}">
                    {{ $skpd->name }}</option>
            @endforeach
        </select>

        @if ($errors->has('skpd_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('skpd_id') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('skpd_employee_id') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input_skpd_employee_id">
            Pejabat <span class="text-danger">*</span> <small>(maksimal 5 orang)</small>
        </label>
        <select name="skpd_employee_id[]" id="input_skpd_employee_id"
            class="form-control select2-multiple form-control-alternative{{ $errors->has('skpd_employee_id') ? ' is-invalid' : '' }}"
            multiple required>
            @foreach ($skpd_employees as $employee)
                @php $selected_employee = in_array($employee->id, old('skpd_employee_id', $spt->employee_list_id ?? [])) ? 'selected' : ''; @endphp
                <option value="{{ $employee->id }}" {{ $selected_employee }} data-skpd="{{ $employee->skpd->name }}"
                    data-nip="{{ $employee->nip }}" data-position="{{ $employee->position }}"
                    data-group="{{ $employee->group }}">{{ $employee->name }}</option>
            @endforeach
        </select>

        @if ($errors->has('skpd_employee_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('skpd_employee_id') }}</strong>
            </span>
        @endif

        {{-- detail pejabat --}}
        <div class="detail-action mt-2">
            <a href="#" data-target="detail-employee" class="btn btn-sm btn-primary show-detail"
                style="{{ ($spt ?? null) !== null ? '' : 'display: none;' }}">Lihat Detail</a>
            <a href="#" data-target="detail-employee" class="btn btn-sm btn-dark close-detail"
                style="display: none;">Tutup Detail</a>
        </div>
        <div class="row detail-employee mt-2 mx-0" style="display: none;">
            @foreach (range(0, 4) as $index)
                {{-- input hidden array name --}}
                <input type="hidden" name="skpd_employee_name[]" class="detail-employee-input-{{ $index }}" />
                <div class="col-md-4 d-none detail-employee-item-{{ $index }} p-1">
                    <table class="table">
                        <tr style="background: #4c7273; color: #fff;">
                            <td><b>INFO PEJABAT {{ $index + 1 }}</b></td>
                        </tr>
                        <tr>
                            <td class="p-0">
                                <table class="table table-striped">
                                    <tr>
                                        <td>SKPD</td>
                                        <td class="detail-employee-skpd-{{ $index }}"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 40px;">NAMA</td>
                                        <td class="detail-employee-name-{{ $index }}"></td>
                                    </tr>
                                    <tr>
                                        <td>NIP</td>
                                        <td class="detail-employee-nip-{{ $index }}"></td>
                                    </tr>
                                    <tr>
                                        <td>JABATAN</td>
                                        <td class="detail-employee-position-{{ $index }}"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('purpose') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_purpose">Dalam Rangka <span
                        class="text-danger">*</span></label>
                <textarea class="form-control form-control-alternative {{ $errors->has('purpose') ? ' is-invalid' : '' }}"
                    rows="3" name="purpose" id="input_purpose" required>{{ old('purpose', $spt->purpose ?? '') }}</textarea>

                @if ($errors->has('purpose'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('purpose') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('budget_expanse') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_budget_expanse">Beban Anggaran <span
                        class="text-danger">*</span></label>
                <textarea class="form-control form-control-alternative {{ $errors->has('budget_expanse') ? ' is-invalid' : '' }}"
                    rows="3" name="budget_expanse" id="input_budget_expanse" required>{{ old('budget_expanse', $spt->budget_expanse ?? '') }}</textarea>

                @if ($errors->has('budget_expanse'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('budget_expanse') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group{{ $errors->has('letter_number') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_letter_number">Nomor SPT <span
                        class="text-danger mr-1">*</span> <small>(800.1.11.1/<b>[NO SPT]</b>/B.Um.I)</small></label>
                <input type="number" name="letter_number" id="input_letter_number"
                    class="form-control form-control-alternative{{ $errors->has('letter_number') ? ' is-invalid' : '' }}"
                    value="{{ $spt->letter_number ?? $last_spt_number }}"
                    {{ ($spt->letter_number ?? null) !== null ? 'readonly' : '' }} required>

                @if ($errors->has('letter_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('letter_number') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group{{ $errors->has('place') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_place">Tempat Berangkat <span
                        class="text-danger">*</span></label>
                <input type="text" name="place" id="input_place"
                    class="form-control form-control-alternative{{ $errors->has('place') ? ' is-invalid' : '' }}"
                    value="{{ old('place', $spt->place ?? 'Samarinda') }}" required>

                @if ($errors->has('place'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('place') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group{{ $errors->has('destination') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_destination">Tujuan <span
                        class="text-danger">*</span></label>
                <input type="text" name="destination" id="input_destination"
                    class="form-control form-control-alternative{{ $errors->has('destination') ? ' is-invalid' : '' }}"
                    value="{{ old('destination', $spt->destination ?? '') }}" required>

                @if ($errors->has('destination'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('destination') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group{{ $errors->has('letter_date') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_letter_date">Tanggal Surat <small
                        class="text-danger">*</small></label>
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="form-control datepicker-id {{ $errors->has('letter_date') ? ' is-invalid' : '' }}"
                        id="input_letter_date" placeholder="Pilih tanggal" name="letter_date_indo" type="text"
                        value="{{ $letter_date_indo ?? old('letter_date_indo', $current_date) }}" autocomplete="off"
                        required>
                    <input type="hidden" id="hidden_letter_date" name="letter_date"
                        value="{{ $spt->letter_date ?? old('letter_date', date('Y-m-d')) }}">
                </div>

                @if ($errors->has('letter_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('letter_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group{{ $errors->has('departure_date') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_departure_date">Tanggal Berangkat <small
                        class="text-danger">*</small></label>
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input
                        class="form-control datepicker-id {{ $errors->has('departure_date') ? ' is-invalid' : '' }}"
                        id="input_departure_date" placeholder="Pilih tanggal" name="departure_date_indo"
                        type="text" value="{{ $departure_date_indo ?? old('departure_date_indo') }}"
                        autocomplete="off" required>
                    <input type="hidden" id="hidden_departure_date" name="departure_date"
                        value="{{ $spt->departure_date ?? old('departure_date') }}">
                </div>

                @if ($errors->has('departure_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('departure_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group{{ $errors->has('return_date') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_return_date">Tanggal Kembali <small
                        class="text-danger">*</small></label>
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="form-control datepicker-id {{ $errors->has('return_date') ? ' is-invalid' : '' }}"
                        id="input_return_date" placeholder="Pilih tanggal" name="return_date_indo" type="text"
                        value="{{ $return_date_indo ?? old('return_date_indo') }}" autocomplete="off" required>
                    <input type="hidden" id="hidden_return_date" name="return_date"
                        value="{{ $spt->return_date ?? old('return_date', date('Y-m-d')) }}">
                </div>

                @if ($errors->has('return_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('return_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group{{ $errors->has('duration') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_duration">Lamanya <small
                        class="text-danger">*</small></label>
                <div class="input-group input-group-alternative">
                    <input type="number" name="duration" id="input_duration"
                        class="form-control form-control-alternative{{ $errors->has('duration') ? ' is-invalid' : '' }}"
                        value="{{ old('duration', $spt->duration ?? '') }}" required>
                    <div class="input-group-append">
                        <span class="input-group-text border-0">hari</span>
                    </div>
                </div>

                @if ($errors->has('duration'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('duration') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_signer_id">Status</label>
                <select name="status" id="input_status" class="form-control select2 form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}">
                    <option value="P" {{ old('status', $spt->status ?? '') == 'P' ? 'selected' : '' }}>Proses</option>
                    <option value="S" {{ old('status', $spt->status ?? '') == 'S' ? 'selected' : '' }}>Selesai</option>
                    <option value="B" {{ old('status', $spt->status ?? '') == 'B' ? 'selected' : '' }}>Batal</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group{{ $errors->has('signer_id') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input_signer_id">Penandatangan <span
                        class="text-danger">*</span></label>
                <select name="signer_id" id="input_signer_id"
                    class="form-control select2 form-control-alternative{{ $errors->has('signer_id') ? ' is-invalid' : '' }}"
                    required>
                    <option value="" disabled selected>Pilih Penandatangan:</option>
                    @foreach ($signers as $signer)
                        @php $selected_signer = old('signer_id', $spt->signer_id ?? '') == $signer->id ? 'selected' : ''; @endphp
                        <option value="{{ $signer->id }}" {{ $selected_signer }}
                            data-title="{{ $signer->title }}" data-name="{{ $signer->name }}"
                            data-position="{{ $signer->position }}" data-nip="{{ $signer->nip }}">
                            {{ $signer->label }}</option>
                    @endforeach
                </select>

                @if ($errors->has('signer_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('signer_id') }}</strong>
                    </span>
                @endif

                <div class="detail-action mt-2">
                    <a href="#" data-target="detail-signer" class="btn btn-sm btn-primary show-detail"
                        style="{{ ($spt ?? null) !== null ? '' : 'display: none;' }}">Lihat Detail</a>
                    <a href="#" data-target="detail-signer" class="btn btn-sm btn-dark close-detail"
                        style="display: none;">Tutup Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('is_paraf') ? ' has-danger' : '' }}">
                <label class="form-control-label">Kolom Paraf</label>
                @php $is_paraf = ($spt->letter_signers ?? null) !== null ? '1' : '0'; @endphp
                <div class="switch-button">
                    <a href="#" class="btn btn-{{ $is_paraf == '1' ? 'primary' : 'secondary' }} paraf_yes">
                        {!! $is_paraf == '1' ? '<i class="fa fa-check"></i>' : '' !!}
                        Ya
                    </a>
                    <a href="#" class="btn btn-{{ $is_paraf == '0' ? 'primary' : 'secondary' }} paraf_no">
                        {!! $is_paraf == '0' ? '<i class="fa fa-check"></i>' : '' !!}
                        Tidak
                    </a>
                </div>
                <input type="hidden" name="is_paraf" id="is_paraf" value="{{ $is_paraf }}">
            </div>
        </div>
    </div>

    {{-- detail penandatangan --}}
    <table class="table table-striped detail-signer mb-3" style="display: none;">
        <tr style="background: #4c7273; color: #fff;">
            <td colspan="3"><b>INFO PENANDATANGAN</b></td>
        </tr>
        <tr>
            <td style="width: 140px;">NAMA</td>
            <td style="width: 20px;">:</td>
            <td class="detail-signer-name"></td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td class="detail-signer-nip"></td>
        </tr>
        <tr>
            <td>POSISI</td>
            <td>:</td>
            <td class="detail-signer-position"></td>
        </tr>
        <tr>
            <td>TITLE</td>
            <td>:</td>
            <td class="detail-signer-title"></td>
        </tr>
    </table>

    <div class="row paraf-form {{ ($spt->letter_signers ?? null) !== null ? '' : 'd-none' }}"
        style="background: #eee;border-radius: 10px;padding: 1rem;margin: 0 0 1rem 0;">
        <div class="col-md-12">
            <h3 style="color: #333;">Form Kolom Paraf</h3>
        </div>
        @foreach (range(0, 2) as $index)
            @php
                $paraf_name = $spt->letter_signer_list['name'][$index] ?? '';
                $paraf_position = $spt->letter_signer_list['position'][$index] ?? '';
                if ($index === 0 && $paraf_name == '') {
                    $paraf_name = 'Heldi, S.E';
                    $paraf_position = 'Analis kebijakan (Koord. Persuratan & Arsip)';
                }
            @endphp

            <div class="col-md-6">
                <div class="form-group{{ $errors->has('paraf_name_' . $index) ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input_paraf_name_{{ $index }}">Nama
                        {{ $index + 1 }}</label>
                    <input type="text" name="paraf_name[{{ $index }}]"
                        id="input_paraf_name_{{ $index }}"
                        class="form-control form-control-alternative{{ $errors->has('paraf_name_' . $index) ? ' is-invalid' : '' }}"
                        value="{{ old('paraf_name_' . $index, $paraf_name) }}">

                    @if ($errors->has('paraf_name_' . $index))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('paraf_name_' . $index) }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('paraf_position[' . $index . ']') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input_paraf_position_{{ $index }}">Jabatan
                        {{ $index + 1 }}</label>
                    <input type="text" name="paraf_position[{{ $index }}]"
                        id="input_paraf_position_{{ $index }}"
                        class="form-control form-control-alternative{{ $errors->has('paraf_position[' . $index . ']') ? ' is-invalid' : '' }}"
                        value="{{ old('paraf_position[' . $index . ']', $paraf_position) }}">

                    @if ($errors->has('paraf_position[' . $index . ']'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('paraf_position[' . $index . ']') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div>
        <button type="submit" class="btn btn-success mt-2">
            <i class="fa fa-check"></i> Simpan Data
        </button>
    </div>
</div>
