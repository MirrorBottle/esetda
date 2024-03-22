<div class="modal fade" id="modal-restore" tabindex="-1" role="dialog" aria-labelledby="modal-restore" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <form action="{{ url('recycle/restore') }}" method="POST">
                @csrf
                @method("PUT")
                <input type="hidden" name="type" value="{{ $type }}">
                <input type="hidden" name="list_id" id="restore_list_id">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-notification">Pesan Konfirmasi</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="fa fa-info-circle display-1"></i>
                        <h4 class="heading mt-4">Anda yakin ingin mengembalikan data surat?</h4>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Ya, Lanjutkan</button>
                    <button type="button" class="btn btn-white ml-auto" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
