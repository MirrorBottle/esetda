<div class="card bg-secondary shadow mb-3">
    <div class="card-header bg-white border-0">
        <div class="row align-items-center">
            <h3 class="col-12 mb-0"><i class="fa fa-user mr-1 text-success"></i> Ubah Data Profil</h3>
        </div>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
            @csrf
            @method('put')

            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="form-area">
                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">Nama Lengkap</label>
                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-email">Alamat Email</label>
                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                @php $user_type = auth()->user()->type_formatted @endphp

                @if ($user_type == 'esetda')
                    @php $notif_text = 'Surat Lingkup Setda' @endphp
                @elseif ($user_type == 'eagenda')
                    @php $notif_text = 'Agenda Pimpinan' @endphp
                @else
                    @php $notif_text = '' @endphp
                @endif
                <div class="form-group{{ $errors->has('wa') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-wa">No WhatsApp  <a href="#" data-toggle="tooltip" title="Masukan nomor WhatsApp untuk mendapatkan Notifikasi {{ $notif_text }}"><i class="fa fa-info-circle"></i></a></label>
                    <input type="text" name="wa" id="input-wa" class="form-control form-control-alternative{{ $errors->has('wa') ? ' is-invalid' : '' }}" placeholder="contoh: 6281242871122" value="{{ old('wa', auth()->user()->wa) }}">

                    @if ($errors->has('wa'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('wa') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-success mt-1">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
