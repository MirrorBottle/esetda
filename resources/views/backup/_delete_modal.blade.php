<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-delete" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered" role="document">
        <div class="modal-content bg-gradient-danger">
            <form action="" method="POST">
                @csrf
                @method("DELETE")
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-notification">Konfirmasi Hapus Data</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="heading mt-4">Peringatan!</h4>
                        <p>Data yang dihapus tidak akan bisa dikembalikan.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-white">Ya, Hapus</button>
                    <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
