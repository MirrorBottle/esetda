<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="modal-delete" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <form action="" method="POST">
                @csrf
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-notification">Pesan Konfirmasi</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <h2>{{ $confirm_message ?? 'Yakin ingin melanjutkan?' }}</h2>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ya, lanjutkan</button>
                    <button type="button" class="btn btn-secondary ml-auto" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
