<div class="modal fade" id="validate-modal" tabindex="-1" role="dialog" aria-labelledby="modal-validate" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <form action="{{ url('spt-accept') }}" method="POST">
                @csrf
                <input type="hidden" name="list_id" id="validate_list_id">
                <div class="modal-header bg-secondary">
                    <h3 class="modal-title" id="modal-title-notification">Konfirmasi SPT</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="display-1 fa fa-info-circle"></i>
                        <h2 class="mt-4">Anda yakin ingin menerima SPT terpilih?</h2>
                    </div>
                </div>
                <div class="modal-footer bg-secondary">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ya, Terima</button>
                </div>
            </form>
        </div>
    </div>
</div>
