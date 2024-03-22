<div class="card shadow mb-4">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">Notifikasi Baru</h3>
            </div>
            <div class="col-4">
                <div class="float-right">
                    <a href="#" class="btn btn-sm btn-success btn-add-phone" data-toggle="modal" data-target="#phone-modal">
                        <i class="fa fa-phone mr-1"></i> Tambah Penerima
                    </a>
                    <a href="#" class="btn btn-sm btn-info btn-add-template" data-toggle="modal" data-target="#template-modal">
                        <i class="fa fa-file-alt mr-1"></i> Tambah Template
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body bg-secondary">
        <form method="post" action="{{ url('notif-spt') }}">
            @csrf
            <div class="form-group{{ $errors->has('phone_id') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-phone_id">Penerima</label>
                <select name="phone_id" id="input-phone-id" class="select2 form-control form-control-alternative{{ $errors->has('phone_id') ? ' is-invalid' : '' }}" required>
                    <option value="">-- Pilih Penerima:</option>
                    @foreach ($phones as $phone)
                        <option value="{{ $phone->id }}">{{ $phone->name .' | '. $phone->institution .' | '. $phone->institution_head .' | '. $phone->wa }}</option>
                    @endforeach
                </select>

                @if ($errors->has('phone_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone_id') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('template_id') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-template-id">
                    Template Pesan
                    <span class="template-action" style="display: none;">
                        <a href="#" class="btn btn-sm btn-info btn-edit-template ml-2" data-toggle="modal" data-target="#template-modal"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-sm btn-danger btn-delete-template" ><i class="fa fa-trash"></i></a>
                    </span>
                </label>
                <select name="template_id" id="input-template-id" class="select2 form-control form-control-alternative{{ $errors->has('template_id') ? ' is-invalid' : '' }}" required>
                    <option value="">-- Pilih Template:</option>
                    @foreach ($templates as $template)
                        <option value="{{ $template->id }}">{{ $template->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('template_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('template_id') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('message') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-message">Kiriman Pesan</label>
                <textarea name="message" id="input-message" class="form-control form-control-alternative{{ $errors->has('message') ? ' is-invalid' : '' }}" rows="16" required>{{ old('message') }}</textarea>

                @if ($errors->has('message'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('message') }}</strong>
                @endif
            </div>

            <div class="form-group">
                <input type="hidden" name="phone_number" id="hidden_phone_number">
                <button type="submit" class="btn btn-block btn-success mt-4">
                    <i class="fa fa-comment-dots"></i> Kirim Pesan Notifikasi
                </button>
            </div>
        </form>
    </div>

    <div id="hidden_template" class="d-none">
        @foreach ($templates as $template)
            <div id="template_{{ $template->id }}">{{ $template->content }}</div>
        @endforeach
    </div>
</div>
