<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="modal-confirm" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ url('arsip/confirm') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="bundle_id" value="{{ $bundle_id }}">
                <input type="hidden" name="type" value="{{ $type }}">
                <div class="modal-header bg-secondary">
                    <h3 class="modal-title" id="modal-title-notification">Data Arsip Terpilih</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Biro</th>
                                <th>No Surat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Proses Validasi</button>
                    <button type="button" class="btn btn-secondary ml-auto" data-dismiss="modal">Batal</button>
                </div>
            </form>

            <div id="switch-template" class="d-none">
                <div class="switch-validation">
                    <a href="#" class="btn btn-sm btn-default approve">
                        <i class="fa fa-check"></i>
                        Terima
                    </a>
                    <a href="#" class="btn btn-sm btn-secondary reject">
                        Tolak
                    </a>
                </div>
                <input type="hidden" name="surat[1]" class="validasi_1" value="1">
            </div>
        </div>
    </div>
</div>
