@extends('layouts.app', ['page_title' => 'Backup Data'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                {{-- backup form --}}
                @include('backup.form')

                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Riwayat Backup Data</h3>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Berkas Database</th>
                                    <th scope="col">Ukuran Berkas Database</th>
                                    <th scope="col">Berkas Lampiran</th>
                                    <th scope="col">Ukuran Berkas Lampiran</th>
                                    <th scope="col">Tanggal Backup</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($backups as $key => $backup)
                                {{-- validate backup attachments data --}}
                                @php
                                    $attachment_size = 0;
                                    $attachment_name = substr($backup->getFilename(), 0, -3) .'_attachments.zip';
                                    $backup_dir = storage_path('app/backup/attachment');
                                    $filetopath = $backup_dir.'/'.$attachment_name;
                                    // check file exist or not yet
                                    if (file_exists($filetopath)) {
                                        $attachment_size = \File::size(storage_path('app/backup/attachment/'. $attachment_name));
                                    } else {
                                        $attachment_name = '(dalam proses)';
                                    }
                                @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $backup->getFilename() }}</td>
                                        <td>{{ formatSizeUnits($backup->getSize()) }}</td>
                                        <td>{{ $attachment_name }}</td>
                                        <td>{{ formatSizeUnits($attachment_size) }}</td>
                                        <td>{{ date('d M Y - H:i', $backup->getMTime()) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('backup.download', [$backup->getFilename()]) }}"
                                                class="btn btn-sm btn-info"
                                                data-toggle="tooltip" title="Unduh Berkas Database"><i class="fa fa-download"></i></a>
                                            <a href="{{ route('backup.download_attachment', [$attachment_name]) }}"
                                                class="btn btn-sm btn-primary"
                                                data-toggle="tooltip" title="Unduh Berkas Lampiran"><i class="fa fa-download"></i></a>
                                            <a href="#" data-name="{{ $backup->getFilename() }}"
                                                class="btn btn-sm btn-warning btn-restore"
                                                data-toggle="tooltip" title="Restore Database"><i class="fa fa-sync-alt"></i></a>
                                            <a href="#" data-name="{{ $backup->getFilename() }}"
                                                class="btn btn-sm btn-danger btn-delete"
                                                data-toggle="tooltip" title="Hapus Berkas"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5">Tidak ada riwayat berkas</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>

    {{-- restore and delete modal --}}
    @include('backup._restore_modal')
    @include('backup._delete_modal')
@endsection

@push('js')
    <script>
        $(function() {
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                const $el = $(this);
                const name = $(this).attr('data-name');
                const action = '{{ url("/backup") }}' +'/'+ name;
                $('#delete_file_name').val(name);
                $('#modal-delete').modal('show');
                $('#modal-delete').find('form').attr('action', action);
            });

            $('.btn-restore').on('click', function(e) {
                e.preventDefault();
                const $el = $(this);
                const name = $(this).attr('data-name');
                const action = '{{ url("/backup") }}' +'/'+ name + '/restore';
                $('#restore_file_name').val(name);
                $('.restore_file_text').text(name);
                $('#modal-restore').modal('show');
                $('#modal-restore').find('form').attr('action', action);
            });

            $('.backup-mingguan').on('click', function(e) {
                e.preventDefault();
                $('#hidden_backup_type').val('weekly');
                $('#form-backup').submit();
            });

            $('.backup-bulanan').on('click', function(e) {
                e.preventDefault();
                $('#hidden_backup_type').val('monthly');
                $('#form-backup').submit();
            });
        });
    </script>
@endpush
