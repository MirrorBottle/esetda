<div class="card shadow mb-3">
    <div class="card-header bg-secondary border-0">
        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">Form Backup Data</h3>
            </div>
        </div>
    </div>
    <div class="card-body pb-0">
        <div class="row">
            <div class="col-12 col-md-6">
                <form action="{{ route('backup.store') }}" method="post" id="form-backup">
                    {{ csrf_field() }}
                    <input type="hidden" name="type" value="" id="hidden_backup_type">
                    <div class="form-group mb-3">
                        <label for="file_name" class="control-label">Buat File Backup</label>
                        <input type="text" name="file_name" class="form-control" value="sisda_{{ date('Y_m_d') }}">
                        {!! $errors->first('file_name', '<div class="text-danger text-right">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-success btn-info backup-mingguan">Backup Mingguan</button>
                        <button type="button" class="btn btn-success btn-bulanan backup-bulanan">Backup Bulanan</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-6">
                <form action="{{ route('backup.upload') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group mb-3">
                        <label for="backup_file" class="control-label">Upload Berkas Database</label>
                        <input type="file" name="backup_file" class="form-control">
                        {!! $errors->first('backup_file', '<div class="text-danger text-right">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Upload" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
