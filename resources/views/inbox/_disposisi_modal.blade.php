<!-- Modal -->
<div class="modal fade" id="disposisi-modal" tabindex="-1" role="dialog" aria-labelledby="disposisi-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ url('disposisi') }}" method="POST" id="form-disposisi" target="_blank">
                <div class="modal-header bg-secondary">
                    <h3 class="modal-title" id="detail-modal-label">Form Lembar Disposisi</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="disposisi-id">
                    <input type="hidden" name="inbox_id" id="inbox-id">
                    <input type="hidden" name="type" id="disposisi-type">
                    <input type="hidden" name="no_letter" id="hidden-no-letter">

                    <div class="row">
                        <div class="col-6 d-none">
                            <div class="form-group">
                                <label class="form-control-label" for="disposisi-no-agenda">
                                    No Agenda
                                </label>
                                <input type="text" name="no_agenda" class="form-control" id="disposisi-no-agenda" readonly>
                            </div>
                        </div>

                        {{-- <div class="col-6 d-none">
                            <div class="form-group">
                                <label class="form-control-label" for="disposisi-no-letter">
                                    No Surat <span class="text-danger">*</span>
                                </label>
                                <input type="hidden" name="no_letter" id="hidden-no-letter">
                            </div>
                        </div> --}}

                        <div class="col-12" id="disposisi-kop-area">
                            <div class="form-group">
                                <label class="form-control-label" for="disposisi-kop">
                                    Kop Surat <span class="text-danger">*</span>
                                </label>
                                <select name="kop" id="disposisi-kop" class="form-control" required>
                                    <option value="1">GUBERNUR</option>
                                    <option value="2">WAKIL GUBERNUR</option>
                                    <option value="0">SEKRETARIS DAERAH</option>
                                </select>
                                </select>
                            </div>
                        </div>

                        <div class="col-6" id="disposisi-ttd-area" style="display: none;">
                            <div class="form-group">
                                <label class="form-control-label" for="disposisi-ttd">
                                    Penandatangan <span class="text-danger">*</span>
                                </label>
                                <select name="ttd" id="disposisi-ttd" class="form-control" required>
                                    @foreach ($sekdas as $sekda)
                                        <option value="{{ $sekda->id }}">{{ $sekda->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-control-label" for="disposisi-property">
                                    Sifat <span class="text-danger">*</span>
                                </label>
                                <select name="property" id="disposisi-property" class="form-control" required>
                                    <option value="1">Segera</option>
                                    <option value="2">Rahasia</option>
                                    <option value="3">Sangat Segera</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-control-label" for="disposisi-sender">
                                    Surat Dari <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="sender" class="form-control" id="disposisi-sender" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-control-label" for="disposisi-date">
                                    Tanggal Surat <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control datepicker-id" id="disposisi-date" readonly>
                                <input type="hidden" id="disposisi-hidden-date" name="date">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-8">
                                        <label class="form-control-label" for="disposisi-date-receipt">
                                            Tanggal Terima <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control datepicker-id-receipt"name="hidden_date_receipt" id="disposisi-date-receipt">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-control-label" for="disposisi-date-receipt">
                                            Jam Terima <span class="text-danger">*</span>
                                        </label>
                                        <input type="time" name="time_receipt" class="form-control timepicker" id="disposisi-time-receipt"/>
                                    </div>
                                </div>
                                <input type="hidden" id="disposisi-hidden-date-receipt" name="date_receipt">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-control-label" for="disposisi-note">
                                    Hal <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" name="description"
                                    id="disposisi-description" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="is_ttd" id="disposisi-status-area" value="0" {{ $status_disposisi == 0 ? 'checked' : '' }}>
                                <label class="form-control-label" for="disposisi-status-area">
                                    Kosongkan Area Ttd <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-secondary">
                    <button type="submit" class="btn btn-success" id="disposisi-submit">
                        <i class="fa fa-print"></i> Cetak Disposisi</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
