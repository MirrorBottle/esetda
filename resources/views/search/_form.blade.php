<form method="get" action="{{ url('/pencarian-surat/hasil') }}" autocomplete="off">
    @php $tipe_surat = request()->type ?? 'masuk'; @endphp
    <div class="pl-lg-4">
        <div class="form-group">
            <label class="form-control-label" for="input_type">Tipe Surat</label>
            @if ($user->isTupimDua())
                <div class="switch-button">
                    <a href="#" class="btn btn-primary keluar">
                        <i class="fa fa-check"></i> Surat Keluar
                    </a>
                </div>
                <input type="hidden" name="type" id="type" value="{{ $tipe_surat }}">
            @else
                <div class="switch-button">
                    <a href="#" class="btn btn-{{ $tipe_surat == 'masuk' ? 'primary' : 'secondary' }} masuk">
                        {!! $tipe_surat == 'masuk' ? '<i class="fa fa-check"></i>' : '' !!}
                        Surat Masuk
                    </a>
                    @if ($user->type_formatted !== 'super' || $user->username === 'fahmi')
                        <a href="#" class="btn btn-{{ $tipe_surat == 'keluar' ? 'primary' : 'secondary' }} keluar">
                            {!! $tipe_surat == 'keluar' ? '<i class="fa fa-check"></i>' : '' !!}
                            Surat Keluar
                        </a>
                    @endif
                    {{-- <a href="#" class="btn btn-{{ $tipe_surat == 'terusan' ? 'primary' : 'secondary' }} terusan">
                        {!! $tipe_surat == 'terusan' ? '<i class="fa fa-check"></i>' : '' !!}
                        Surat Lingkup Setda
                    </a> --}}
                </div>
                <input type="hidden" name="type" id="type" value="{{ $tipe_surat }}">
            @endif
        </div>

        <div class="form-group">
            <label class="form-control-label" for="input_status">Status</label>
            <div>
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" name="is_forwarded" class="custom-control-input" id="status-forward" value="1">
                    <label class="custom-control-label" for="status-forward">Surat Terusan</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" name="is_archived" class="custom-control-input" id="status-archive" value="1">
                    <label class="custom-control-label" for="status-archive">Arsip</label>
                </div>
            </div>
        </div>
        
        @if ($tipe_surat === 'terusan' || $user->username === 'fahmi')
            <div class="form-group" id="biro-area"  style="{{ $tipe_surat === 'terusan' || $user->username === 'fahmi' ? '' : 'display: none;' }}">
                <label class="form-control-label" for="input_biro_id">Biro Pengirim</label>
                <select name="biro_id" id="input_biro_id" class="form-control select2 form-control-alternative">
                    <option value="">Pilih Biro:</option>
                    @foreach ($biros as $biro)
                        <option value="{{ $biro->id }}" {{ (request()->biro_id ?? $user->biro_id) == $biro->id ? 'selected' : '' }}>{{ $biro->alias }}</option>
                    @endforeach
                </select>
            </div>    
        @else
            <input type="hidden" name="biro_id" id="biro_id" value="{{ $user->biro_id }}">
        @endif

        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label class="form-control-label" for="input_tgl_surat">Tanggal Entry</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="form-control datepicker-id-start" placeholder="Awal" name="date_indo_start" type="text" value="{{ request()->date_indo_start ?? '' }}" autocomplete="off">
                                <input type="hidden" id="hidden_date_start" name="date_start" value="{{ request()->date_start ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
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
        </div>

        <div class="form-group">
            <label class="form-control-label" for="input_no">No Surat</label>
            <input type="text" name="no" id="input_no" class="form-control form-control-alternative" value="{{ request()->no ?? '' }}">
        </div>

        <div class="form-group">
            <label class="form-control-label" for="input_title">Judul</label>
            <input type="text" name="title" id="input_title" class="form-control form-control-alternative" value="{{ request()->title ?? '' }}">
        </div>

        <div class="form-group" id="sender-area" style="{{ $tipe_surat !== 'masuk' ? 'display: none;' : '' }}">
            <label class="form-control-label" for="input_sender">Pengirim</label>
            <input type="text" name="sender" id="input_sender" class="form-control form-control-alternative" value="{{ request()->sender ?? '' }}">
        </div>

        {{-- hide on super admin --}}
        @if ($user->type_formatted !== 'super'|| $user->username === 'fahmi')
            <div class="form-group">
                <label class="form-control-label" for="input_category_id">Kategori Surat</label>
                <select name="category_id" id="input_category_id" class="form-control select2 form-control-alternative">
                    <option value="" selected>Pilih Kategori:</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ (request()->category_id ?? 0) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-control-label" for="input_id_detail_type">Tipe Tujuan</label>
                <div class="switch-tipe" data-active="">
                    <div>
                        <a href="#" class="btn btn-secondary lingkup">
                            Lingkup Setda
                        </a>
                        <a href="#" class="btn btn-secondary luar">
                            Luar Setda
                        </a>
                    </div>
                    <input type="hidden" class="receiver_type" name="receiver_type">
                </div>
            </div>

            <div class="form-group">
                <label class="form-control-label" for="input_receiver_id">
                    Tujuan Surat
                    <small class="text-danger ml-2 null-tujuan">* tidak ada data</small>
                </label>
                @php $receiver_id = request()->receiver_id ?? '' @endphp
                <select name="receiver_id" id="input_receiver_id" class="form-control select2 form-control-alternative" {{ $receiver_id == null ? 'disabled' : '' }} data-selected="{{ $receiver_id }}">
                    <option value="">Pilih Tujuan Surat:</option>
                </select>
            </div>
        @endif

        <div class="text-center">
            <button type="submit" class="btn btn-success mt-4">
                <i class="fa fa-search"></i> Cari Data
            </button>
            <a href="{{ url('/pencarian-surat') }}" class="btn btn-default mt-4">
                <i class="fa fa-sync"></i> Muat Ulang
            </a>
        </div>
    </div>
</form>
