<div class="header bg-gradient-primary pt-7 pb-6" style="min-height: 100vh;">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Arsip Bulan Ini</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $data['monthly'] }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Arsip Keseluruhan</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $data['all'] }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (auth()->user()->isAdmin())
            <div class="row mt-3">
                <div class="col-md-6 col-sm-12">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Arsip Surat Masuk Belum Tervalidasi</h5>
                                    <span class="h2 font-weight-bold mb-0">4</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Arsip Surat Keluar Belum Tervalidasi</h5>
                                    <span class="h2 font-weight-bold mb-0">10</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fa fa-envelope-open"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- archive info inbox --}}
            <div class="card shadow mt-4">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Surat Masuk yang belum di arsipkan</h3>
                        </div>
                        <div class="col-4 text-right">
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal Pengajuan</th>
                                <th scope="col">No Surat</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data['inbox'] as $archive_info)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $archive_info->date_formatted }}</td>
                                    <td>{{ $archive_info->archivable->no }}</td>
                                    <td>{{ $archive_info->archivable->title }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info btn-detail" data-toggle="modal" data-target="#detail-modal" data-id="{{ $archive_info->archivable->id }}" data-type="inbox">
                                            Detail
                                        </a>
                                        <a href="{{ url('arsip/masuk/create-custom/'. $archive_info->id) }}" class="btn btn-sm btn-primary">
                                            Arsipkan
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="5">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- archive info outbox --}}
            <div class="card shadow mt-4">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Surat Keluar yang belum di arsipkan</h3>
                        </div>
                        <div class="col-4 text-right">
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal Pengajuan</th>
                                <th scope="col">No Surat</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data['outbox'] as $archive_info)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $archive_info->date_formatted }}</td>
                                    <td>{{ $archive_info->archivable->no }}</td>
                                    <td>{{ $archive_info->archivable->title }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info btn-detail" data-toggle="modal" data-target="#detail-modal" data-id="{{ $archive_info->archivable->id }}" data-type="outbox">
                                            Detail
                                        </a>
                                        <a href="{{ url('arsip/keluar/create-custom/'. $archive_info->id) }}" class="btn btn-sm btn-primary">
                                            Arsipkan
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="5">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>

@include('partials.detail-modal')

@push('css')
    <style>
        body {
            background-color: #0389a5;
        }
    </style>
@endpush

@push('js')
    <script>
        $(function() {
            $('.btn-detail').on('click', function(e) {
                e.preventDefault();

                const id   = $(this).data('id');
                const type = $(this).data('type');
                $.get("/"+ type +"-detail/"+ id, function(res) {
                    const data = res.data;

                    $('.detail-no-surat').text(data.no_surat);
                    $('.detail-no-agenda').text(data.no_agenda);
                    $('.detail-title').text(data.title);
                    $('.detail-sender').text(data.sender);
                    $('.detail-receiver').text(data.receiver);
                    $('.detail-sifat').text(data.sifat);
                    $('.detail-date').text(data.date);
                    $('.detail-category').text(data.category);
                    $('.detail-description').text(data.description);

                    if (data.is_attachment) {
                        let attachmentData = '';
                        let attachmentButton = '<a class="btn btn-sm btn-icon btn-3 btn-primary mb-2" href="#" target="_blank">';
                            attachmentButton += '<span class="btn-inner--icon"><i class="fa fa-file"></i></span>';
                            attachmentButton += '<span class="btn-inner--text">x</span></a>';

                        let x = 0;
                        for (x in data.attachments) {
                            const url = '{{ url("storage") }}';
                            const $btn = $(attachmentButton).clone();
                            $btn.attr('href', url+'/'+ data.attachments[x].name);
                            $btn.find('.btn-inner--text').text(data.attachments[x].title);
                            attachmentData += $btn.prop('outerHTML');
                        }
                        $('.attachment-area').html(attachmentData);
                    } else {
                        $('.attachment-area').html('<small class="text-muted"><i>tidak ada</i></small>');
                    }

                    // hide sender on outbox
                    if (type == 'outbox') {
                        $('.detail-sender').parent().hide();
                        $('.detail-sender').parent().prev().hide();
                        $('#detail-modal-label').text('Detail Surat Keluar');
                    } else {
                        $('.detail-sender').parent().show();
                        $('.detail-sender').parent().prev().show();
                        $('#detail-modal-label').text('Detail Surat Masuk');
                    }
                });
            })
        });
    </script>
@endpush
