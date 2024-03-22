@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show mx-4" role="alert">
        <span class="alert-inner--text"><strong>SUKSES!</strong> {{ $message }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show mx-4" role="alert">
        <span class="alert-inner--text"><strong>GAGAL!</strong> {{ $message }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-warning alert-dismissible fade show mx-4" role="alert">
        <span class="alert-inner--text"><strong>ERROR!</strong> Terjadi Kesalahan</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
