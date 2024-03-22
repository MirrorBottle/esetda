<script>
$(function() {

    // switch tipe surat
    $('.switch-button a').on('click', function(e) {
        e.preventDefault();
        const isTupim = parseInt('{{ auth()->user()->biro_id == 1 }}');

        if ($(this).hasClass('masuk')) {
            $('.masuk').html('<i class="fa fa-check"></i> Surat Masuk')
            $('.masuk').addClass('btn-success').removeClass('btn-secondary');
            $('.keluar').html('Surat Keluar')
            $('.keluar').addClass('btn-secondary').removeClass('btn-success');
            $('#input_type').val('masuk');
        } else {
            $('.keluar').html('<i class="fa fa-check"></i> Surat Keluar')
            $('.keluar').addClass('btn-success').removeClass('btn-secondary');
            $('.masuk').html('Surat Masuk')
            $('.masuk').addClass('btn-secondary').removeClass('btn-success');
            $('#input_type').val('keluar');
        }
    });

    // remove button
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        $('#delete_list_id').val(id);
        $('#modal-delete').modal('show');
    });

    $('.btn-delete-all').on('click', function(e) {
        e.preventDefault();
        const $checkedRow = $('.table .checkbox:checked');

        let listId = '';
        $checkedRow.each(function() {
            listId += $(this).val() + ',';
        });

        $('#delete_list_id').val(listId.slice(0, -1));
        $('#modal-delete').modal('show');
    });

    // restore button
    $('.btn-restore').on('click', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        $('#restore_list_id').val(id);
        $('#modal-restore').modal('show');
    });

    $('.btn-restore-all').on('click', function(e) {
        e.preventDefault();
        const $checkedRow = $('.table .checkbox:checked');

        let listId = '';
        $checkedRow.each(function() {
            listId += $(this).val() + ',';
        });

        $('#restore_list_id').val(listId.slice(0, -1));
        $('#modal-restore').modal('show');
    });

    // detail button
    $('.btn-detail').on('click', function(e) {
        const id = $(this).data('id');
        const type = $(this).data('type');
        const typeClass = type == 'masuk' ? 'inbox' : 'outbox';
        const typeText = type == 'masuk' ? 'Surat Masuk' : 'Surat Keluar';

        $.get("/"+ typeClass +"-detail/"+ id, function(res) {
            const data = res.data;

            $('.modal-title').text('Detail '+ typeText);
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
                let attachmentButton = '<a class="btn btn-sm btn-icon btn-3 btn-primary mb-2" href="#" target="_blank">';
                    attachmentButton += '<span class="btn-inner--icon"><i class="fa fa-file"></i></span>';
                    attachmentButton += '<span class="btn-inner--text">x</span></a>';

                let x = 0;
                for (x in data.attachments) {
                    const url = '{{ url("storage") }}';
                    const $btn = $(attachmentButton).clone();
                    $btn.attr('href', url+'/'+ data.attachments[x].name);
                    $btn.find('.btn-inner--text').text(data.attachments[x].title.substring(0, 40));
                    attachmentData += $btn.prop('outerHTML');
                }
                $('.attachment-area').html(attachmentData);
                $('.view-attachment').show();
                $('.view-attachment').attr('href', '/surat-lampiran?type='+typeClass+'&id='+id);
            } else {
                $('.attachment-area').html('<small class="text-muted"><i>tidak ada</i></small>');
                $('.view-attachment').hide();
            }
        });
    });

    // destroy detail button
    $('.btn-destroy-detail').on('click', function(e) {
        const $el = $(this);
        $('.destroy-detail-date').text( $el.data('date') );
        $('.destroy-detail-time').text( $el.data('time') );
        $('.destroy-detail-user').text( $el.data('user') );
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
            $('.btn-delete-all').hide();
            $('.btn-resttore-all').hide();
        } else {
            $(".checkbox").each(function() {
                this.checked=true;
            });
            $('.check-all').attr('data-status', 'check');
            $('.check-all span').text('Uncheck All');
            $('.btn-delete-all').show();
            $('.btn-resttore-all').show();
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
            $('.btn-delete-all').hide();
            $('.btn-restore-all').hide();
        } else {
            $('.btn-delete-all').show();
            $('.btn-restore-all').show();
        }
    });

    // datatable
    $('.datatable').DataTable({
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
