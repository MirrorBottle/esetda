<div class="modal fade" id="archive-modal" tabindex="-1" role="dialog" aria-labelledby="archive-modal" aria-hidden="true">
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
                    <i class="fa fa-question-circle" style="font-size: 4rem;"></i>
                    <h3 class="mt-3">Kirim surat ke pengarsipan?</h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ya, Kirim</button>
                    <button type="button" class="btn btn-light ml-auto" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
