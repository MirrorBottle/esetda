{{-- restore form modal --}}
<div class="modal fade" id="modal-restore" tabindex="-1" role="dialog" aria-labelledby="modal-restore" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="#" method="POST">
            @csrf
            <input type="hidden" name="file_name" value="" id="restore_file_name">

            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h3 class="modal-title">Restore Database</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-info-circle display-1"></i>
                        <h3 class="my-3">Anda yakin ingin melakukan restore data dari berkas <strong class="restore_file_text display-4">x</strong></h3>
                        <p>Pastikan database saat ini sudah di backup terlebih dahulu.</p>
                    </div>
                </div>
                <div class="modal-footer bg-secondary">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-check"></i> Ya, Lanjutkan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
