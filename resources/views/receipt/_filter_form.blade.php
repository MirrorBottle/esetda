<form method="GET" action="">
    <div class="row">
        <div class="col-md-5">
            <label class="form-control-label">
                Tanggal Awal
            </label>
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                </div>
                <input class="form-control datepicker-id-start" placeholder="Awal" name="date_indo_start" autocomplete="off" value="{{ $date_start_indo }}" type="text">
                <input type="hidden" id="hidden-date-start" name="date_start" value="{{ $date_start }}">
            </div>
        </div>
        <div class="col-md-5">
            <label class="form-control-label">
                Tanggal Akhir
            </label>
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                </div>
                <input class="form-control datepicker-id-end" placeholder="Akhir" name="date_indo_end" type="text" value="{{ $date_end_indo }}" autocomplete="off">
                <input type="hidden" id="hidden-date-end" name="date_end" value="{{ $date_end }}">
            </div>
        </div>
        <div class="col-md-2">
            <label class="form-control-label">
                &nbsp;
            </label>
            <div>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-search"></i> Cari Data
                </button>
            </div>
        </div>
    </div>
</form>
