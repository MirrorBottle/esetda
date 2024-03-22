<div class="modal fade" id="duplikasi-modal" tabindex="-1" role="dialog" aria-labelledby="duplikasi-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <form action="" method="POST">
                @csrf
                <input type="hidden" name="id" id="duplikasi-id">
                <input type="hidden" name="type" id="duplikasi-type">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-notification">Pesan Konfirmasi</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                    <i class="fa fa-question-circle" style="font-size: 4rem;"></i>
                    <h3 class="mt-3" id="duplikasi-info">Duplikasi ke surat masuk?</h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ya, Lanjutkan</button>
                    <button type="button" class="btn btn-light ml-auto" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
