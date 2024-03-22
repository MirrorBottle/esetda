@extends('layouts.app', ['page_title' => 'Data SPT'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Data Surat Perintah Tugas</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="#" class="text-left btn btn-sm btn-secondary check-all">
                                    <i class="fa fa-check-circle"></i> <span>Check All</span>
                                </a>
                                <a href="#" class="text-left btn btn-sm btn-success btn-validate"
                                    style="display: none;" data-toggle="modal" data-target="#validate-modal">
                                    <i class="fa fa-check"></i> Tandai Terima
                                </a>
                                {{-- <a href="{{ url('/spt/create') }}" class="btn btn-sm btn-primary">Tambah Data</a> --}}
                                <a href="/" class="btn btn-sm btn-primary">Tambah Data</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No SPT</th>
                                    <th scope="col">Dasar Surat</th>
                                    <th scope="col">Nama Pejabat</th>
                                    <th scope="col">Dalam Rangka</th>
                                    <th scope="col">Tanggal Berangkat</th>
                                    <th scope="col">Tujuan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($spts as $spt)
                                    <tr data-id="{{ $spt->id }}">
                                        <td style="width: 10px; text-align: center">
                                            @if (!$spt->is_accepted)
                                                <input type="checkbox" class="checkbox" value="{{ $spt->id }}"
                                                    autocomplete="off" />
                                            @endif
                                        </td>
                                        <td style="width: 20px; text-align: center">
                                            <span class="badge badge-{{ $spt->is_accepted ? 'primary' : 'danger' }}"
                                                data-toggle="tooltip"
                                                title="{{ $spt->is_accepted ? 'sudah diterima' : 'belum diterima' }}"
                                                style="font-size: 12px;">{{ $spt->letter_number_zero_pad }}</span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn-detail" data-toggle="modal"
                                                data-target="#detail-modal" data-id="{{ $spt->inbox_id }}">
                                                {{ $spt->inbox->no ?? '' }}
                                            </a>
                                        </td>

                                        <td style="width: 220px">{!! $spt->employee_list !!}</td>
                                        <td>{{ $spt->purpose }}</td>
                                        <td style="width: 120px">{!! $spt->date_range !!}</td>
                                        <td>{{ $spt->destination }}</td>
                                        <td>{{ $spt->status_formatted }}</td>
                                        <td style="width: 180px">
                                            <a href="{{ url('/spt/' . $spt->id) }}" target="_blank"
                                                class="btn btn-sm btn-warning mb-1">
                                                <i class="fa fa-print"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-success btn-detail-spt mb-1"
                                                data-toggle="modal" data-target="#detail-spt"
                                                data-no="{{ $spt->letter_number_zero_pad }}"
                                                data-skpd="{{ $spt->skpd->name ?? '' }}"
                                                data-budget="{{ $spt->budget_expanse }}" data-place="{{ $spt->place }}"
                                                data-date="{{ full_indo_date($spt->letter_date->format('Y-m-d')) }}"
                                                data-duration="{{ $spt->duration . ' hari' }}"
                                                data-signer="{{ ($spt->signer->label ?? '') . ' (' . ($spt->signer->name ?? '') . ')' }}"
                                                data-paraf="{{ $spt->letter_signer_formatted }}"
                                                data-spt-status="{{ $spt->status_formatted }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ url('/spt/' . $spt->id) . '/edit' }}"
                                                class="btn btn-sm btn-primary btn-edit  mb-1">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-danger btn-delete mb-1">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>

    @include('partials.remove-modal')
    @include('partials.detail-modal')
    @include('spt._detail_spt')
    @include('spt._validate_modal')
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <style>
        .table tbody tr {
            cursor: pointer;
        }

        .table td,
        .table th {
            white-space: normal;
        }

        .table th {
            vertical-align: middle !important;
        }

        .badge-calendar {
            font-size: 80%;
            display: block;
        }

        .table-fix-head {
            overflow-y: auto;
            height: 100px;
        }

        .table-fix-head thead th {
            position: sticky;
            top: 0;
        }

        .dataTables_wrapper .row:first-child {
            padding: 0 1.5rem;
            font-size: 13px;
        }

        .dataTables_wrapper .row:last-child {
            padding: 2em;
            font-size: 13px;
        }

        .badge-primary {
            color: #4c7273;
            background-color: #b5ebf7;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function() {
            // delete modal
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                const id = $(this).closest('tr').data('id');
                const action = '{{ url('/spt') }}' + '/' + id;
                $('#modal-delete').modal('show');
                $('#modal-delete').find('form').attr('action', action);
            });

            // detail inbox modal
            $('.btn-detail').on('click', function(e) {
                const id = $(this).data('id');
                $.get("/inbox-detail/" + id, function(res) {
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
                    $('.detail-forward').text(data.forward_note);
                    if (data.is_attachment) {
                        let attachmentData = '';
                        let attachmentButton =
                            '<a class="btn btn-sm btn-icon btn-3 btn-primary mb-2" href="#" target="_blank">';
                        attachmentButton +=
                            '<span class="btn-inner--icon"><i class="fa fa-file"></i></span>';
                        attachmentButton += '<span class="btn-inner--text">x</span></a>';

                        let x = 0;
                        for (x in data.attachments) {
                            const url = '{{ url('storage') }}';
                            const $btn = $(attachmentButton).clone();
                            $btn.attr('href', url + '/' + data.attachments[x].name);
                            $btn.find('.btn-inner--text').text(data.attachments[x].title.substring(
                                0, 40));
                            attachmentData += $btn.prop('outerHTML');
                        }
                        $('.attachment-area').html(attachmentData);
                        $('.view-attachment').show();
                        $('.view-attachment').attr('href', '/surat-lampiran?type=inbox&id=' + id);
                    } else {
                        $('.attachment-area').html(
                            '<small class="text-muted"><i>tidak ada</i></small>');
                        $('.view-attachment').hide();
                    }

                    if (data.dispositions !== null) {
                        let dispositionStatus = '';
                        let classColor = ['success', 'info', 'warning', 'primary'];
                        for (x = 0; x < data.dispositions.length; x++) {
                            if (x !== 0) {
                                dispositionStatus +=
                                    '<i class="fa fa-angle-double-right text-muted mx-2"></i>';
                            }
                            dispositionStatus += '<span class="badge badge-' + classColor[x] +
                                '">' + data.dispositions[x] + '</span>';
                        }
                        $('.detail-status').html(dispositionStatus);
                        $('.view-all-disposition').show();
                        $('.view-all-disposition').attr('href', '/lihat-disposisi/' + id);
                    } else {
                        $('.detail-status').text('-');
                        $('.view-all-disposition').hide();
                    }
                });
            });

            // detail inbox modal
            $('.btn-detail-spt').on('click', function(e) {
                const $detail = $(this);
                $('.detail-spt-no').text('800.1.11.1/' + $detail.attr('data-no') + '/B.Um.I');
                $('.detail-spt-skpd').text($detail.attr('data-skpd'));
                $('.detail-spt-budget').text($detail.attr('data-budget'));
                $('.detail-spt-place').text($detail.attr('data-place'));
                $('.detail-spt-date').text($detail.attr('data-date'));
                $('.detail-spt-duration').text($detail.attr('data-duration'));
                $('.detail-spt-signer').text($detail.attr('data-signer'));
                $('.detail-spt-paraf').text($detail.attr('data-paraf'));
                $('.detail-spt-status').text($detail.attr('data-spt-status'));
            });

            // check all button
            $('.check-all').on('click', function(e) {
                e.preventDefault();
                const $el = $(this);

                if ($el.attr('data-status') == 'check') {
                    $(".checkbox").each(function() {
                        this.checked = false;
                    });
                    $('.check-all').attr('data-status', 'uncheck');
                    $('.check-all span').text('Check All');
                    $('.btn-validate').hide();
                } else {
                    $(".checkbox").each(function() {
                        this.checked = true;
                    });
                    $('.check-all').attr('data-status', 'check');
                    $('.check-all span').text('Uncheck All');
                    $('.btn-validate').show();
                }
            });

            // checked row
            $('tr').on('click', function() {
                const $row = $(this);
                if ($row.attr('data-checked') == 'false') {
                    $row.find('.checkbox').prop('checked', true);
                    $row.attr('data-checked', 'true');
                } else {
                    $row.find('.checkbox').prop('checked', false);
                    $row.attr('data-checked', 'false');
                }

                const countChecked = $('.checkbox:checked').length;
                if (countChecked == 0) {
                    $('.btn-validate').hide();
                } else {
                    $('.btn-validate').show();
                }
            });

            // validate button
            $('.btn-validate').on('click', function(e) {
                e.preventDefault();
                let listId = '';
                $('.checkbox:checked').each(function(e) {
                    listId += $(this).val() + ',';
                });

                $('#validate_list_id').val(listId.slice(0, -1));
                $('#validate-modal').find('span').hide();
                $('#validate-modal').find('.btn-default').hide();
                $('#validate-modal').find('.btn-success').show();
            });

            // datatable
            $('.table').DataTable({
                "language": {
                    "sProcessing": "Sedang proses...",
                    "sLengthMenu": "Tampilan _MENU_ entri",
                    "sZeroRecords": "Tidak ditemukan data yang sesuai",
                    "sInfo": "Tampilan _START_ sampai _END_ dari _TOTAL_ entri",
                    "sInfoEmpty": "Tampilan 0 hingga 0 dari 0 entri",
                    "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                    "sInfoPostFix": "",
                    "sSearch": "Cari:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "«",
                        "sPrevious": "<",
                        "sNext": ">",
                        "sLast": "»"
                    }
                }
            });
        });
    </script>
@endpush
