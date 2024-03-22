@extends('layouts.app', ['page_title' => 'Penomoran Surat'])

@section('content')
    @include('layouts.headers.empty')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                {{-- custom info message --}}
                @if ($message = Session::get('info'))
                    <div class="card mb-2 border-info">
                        <div class="card-body bg-info text-white py-3 border-0">
                            <span class="alert-inner--text"><strong>BERHASIL!</strong> Klik tombol <a href="#" class="btn btn-sm btn-danger btn-copy" data-toggle="tooltip" title="{{ $message }}"><i class="fa fa-copy"></i> Copy</a> atau salin tautan berikut <b>{{ $message }}</b> untuk melihat bundel penomoran surat terpilih</span>
                        </div>
                    </div>
                @endif

                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Data Penomoran Surat {{ auth()->user()->username == 'fahmi' ? '(Terhapus)' : '' }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                @if (auth()->user()->username !== 'fahmi')
                                    <a href="#" class="text-left btn btn-sm btn-secondary check-all">
                                        <i class="fa fa-check-circle"></i> <span>Check All</span>
                                    </a>

                                    <a href="#" class="text-left btn btn-sm btn-default btn-send" style="display: none;" data-toggle="modal" data-target="#send-modal">
                                        <i class="fa fa-check"></i> Kirim Data
                                    </a>

                                    <a href="{{ url('/arsip/penomoran/create') }}" class="text-left btn btn-sm btn-primary">
                                        <i class="fa fa-plus"></i> Tambah
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-flush" id="datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No</th>
                                    <th scope="col">Nomor Urut</th>
                                    <th scope="col">Nomor Surat</th>
                                    <th scope="col">Pengirim</th>
                                    <th scope="col">Tanggal Buat</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($letter_number_useds as $letter_number_used)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="checkbox" value="{{ $letter_number_used->id }}">
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $letter_number_used->order }}</td>
                                        <td>{{ $letter_number_used->number }}</td>
                                        <td>{{ $letter_number_used->sender }}</td>
                                        <td>{{ $letter_number_used->date }}</td>
                                        <td>
                                            @if ($letter_number_used->attachment !== null)
                                                <a href="{{ url('storage/'. $letter_number_used->attachment) }}" target="_blank" class="btn btn-sm btn-info">
                                                    <i class="fa fa-file"></i>
                                                </a>
                                            @endif

                                            @if (auth()->user()->username == 'fahmi')
                                                <a href="{{ url('arsip/penomoran/'. $letter_number_used->id .'/restore') }}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Restore">
                                                    <i class="fa fa-sync"></i>
                                                </a>
                                                {{-- <a href="{{ url('arsip/penomoran/'. $letter_number_used->id .'/force-delete') }}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Force Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a> --}}
                                            @else
                                                <a href="{{ url('arsip/penomoran/'. $letter_number_used->id .'/edit') }}" class="btn btn-sm btn-edit btn-success">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-delete btn-danger" data-id="{{ $letter_number_used->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.remove-modal')
        @include('letter_number.used._confirm_modal')
        @include('layouts.footers.auth')
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <style>
        .table td, .table th {
            white-space: normal;
        }
        .table th {
            vertical-align: middle !important;
        }
        .table tbody tr { cursor: pointer; }
        .table-fix-head          { overflow-y: auto; height: 100px; }
        .table-fix-head thead th { position: sticky; top: 0; }
        .dataTables_wrapper .row:first-child {
            padding: 0 1.5rem;
            font-size: 13px;
        }
        .dataTables_wrapper .row:last-child {
            padding: 2em;
            font-size: 13px;
        }
    </style>
@endpush

@push('js')
    {{-- datatable --}}
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function() {
            // copy to clipboard
            $('.btn-copy').on('click', function(e) {
                e.preventDefault();

                // ambil link dan buat fake elemen
                const textLink = $(this).attr('data-original-title');
                var textArea = document.createElement("textarea");
                textArea.value = textLink;

                // hindari scroll ke bawah
                textArea.style.top = "0";
                textArea.style.left = "0";
                textArea.style.position = "fixed";

                // tambahkan elemen dan seleksi teks-nya
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();

                try {
                    var successful = document.execCommand('copy');
                    var msg = successful ? 'successful' : 'unsuccessful';
                    // ganti tooltip dengan pesan
                    $(this).attr('data-original-title', "Berhasil menyalin tautan :)").tooltip('show');
                } catch (err) {
                    alert('Oops, gagal menyalin tautan, silahkan di salin manual');
                }

                // hapus elemen yg di buat dan kembalikan tooltip
                document.body.removeChild(textArea);
                $(this).attr('data-original-title', textLink);
            });

            // remove button
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                const action = '{{ url("/arsip/penomoran") }}' +'/'+ id;
                $('#modal-delete').modal('show');
                $('#modal-delete').find('form').attr('action', action);
            });

            // send button
            $('.btn-send').on('click', function(e) {
                e.preventDefault();
                let listId = '';
                $('.checkbox:checked').each(function(e) {
                    listId += $(this).val() + ',';
                });

                $('#send_list_id').val(listId.slice(0, -1));
            });

            // check all button
            $('.check-all').on('click', function(e) {
                e.preventDefault();
                const $el = $(this);

                if ($el.attr('data-status') == 'check') {
                    $(".checkbox").each(function() {
                        this.checked=false;
                    });
                    $('.check-all').attr('data-status', 'uncheck');
                    $('.check-all span').text('Check All');
                    $('.btn-send').hide();
                } else {
                    $(".checkbox").each(function() {
                        this.checked=true;
                    });
                    $('.check-all').attr('data-status', 'check');
                    $('.check-all span').text('Uncheck All');
                    $('.btn-send').show();
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
                    $('.btn-send').hide();
                } else {
                    $('.btn-send').show();
                }
            });

            // init datatable with custom lang
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
