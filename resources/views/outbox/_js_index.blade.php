<script>
$(function() {
    // remove button
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        const action = '{{ url("/surat-keluar") }}' +'/'+ id;
        $('#modal-delete').modal('show');
        $('#modal-delete').find('form').attr('action', action);
    });

    // forward button
    $('.btn-forward').on('click', function(e) {
        const id = $(this).data('id');
        const type = $(this).data('type');
        $('#forward-outbox-id').val(id);
        $.get("/surat-terusan/check/"+ type +"/"+ id, function(res) {
            if (res.data !== null) {
                const splitBiroId = (res.data.biro_id).split(',');
                $('#forward-receiver').val(splitBiroId).trigger("change");
                $('#forward-note').val(res.data.note);
                $('#forward-save-type').val('update');
                $('#forward-cancel').show();
                $('#forward-cancel').attr('data-id', id);
            } else {
                $('#forward-receiver').val('').trigger("change");
                $('#forward-note').val('');
                $('#forward-save-type').val('insert');
                $('#forward-cancel').hide();
            }
        });
    });

    // forward cancel
    $('#forward-cancel').on('click', function(e) {
        const id = $(this).data('id');
        $('#forward-method').val('DELETE');
        $('#form-forward').attr('action', '/surat-terusan/batal/'+ id);
        $('#form-forward').submit();
    });

    // detail button
    $('.btn-detail').on('click', function(e) {
        const id = $(this).data('id');
        $.get("/outbox-detail/"+ id, function(res) {
            const data = res.data;

            $('.detail-no-surat').text(data.no_surat);
            $('.detail-title').text(data.title);
            $('.detail-receiver').text(data.receiver);
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
                $('.view-attachment').attr('href', '/surat-lampiran?type=outbox&id='+id);
            } else {
                $('.attachment-area').html('<small class="text-muted"><i>tidak ada</i></small>');
                $('.view-attachment').hide();
            }
        });
    });

    // forward button
    $('.btn-forward').on('click', function(e) {
        const id = $(this).data('id');
        $('#forward-outbox-id').val(id);
    });

     // upload receipt
     $('.btn-receipt').on('click', function(e) {
        const id = $(this).data('id');
        const type = $(this).data('type');
        $('#receipt-id').val(id);
        $('#receipt-type').val(type);
        $('#receipt-uploaded').val('');

        $.get("/tanda-terima/upload/"+ type +"/"+ id, function(res) {
            if (res.data !== null) {
                $('#receipt-action').val('edit');
                $('#receipt-note').val(res.data.note);
                if (res.data.attachment !== null) {
                    $('#receipt-attachment-url').attr('href', 'storage/'+ res.data.attachment);
                    $('#receipt-title').text(res.data.attachment);
                    $('#receipt-attachment-action').show();
                } else {
                    $('#receipt-title').text('Pilih Berkas');
                    $('#receipt-attachment-action').hide();
                }
            } else {
                $('#receipt-action').val('new');
                $('#receipt-note').val('');
                $('#receipt-attachment-url').attr('href', '#');
                $('#receipt-title').text('Pilih Berkas');
                $('#receipt-attachment-action').hide();
            }
        });
    });

    // archive button
    $('.btn-archive').on('click', function(e) {
        const id = $(this).data('id');
        const action = '{{ url("/surat-arsip-keluar") }}' +'/'+ id;
        $('#archive-modal').find('form').attr('action', action);
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
            $('.btn-validate').hide();
        } else {
            $(".checkbox").each(function() {
                this.checked=true;
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

    // attachment actions
    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    $(':file').on('fileselect', function(event, numFiles, label) {
        // set file label
        const $el = $(this);
        if ($el.attr('data-status') == 'edited') {
            $el.prev().prev().html('<i class="fa fa-sync-alt"></i> '+ label);
            $el.prev().val('changed');
            $el.parent().next().remove();
        } else {
            $el.prev().prev().html('<i class="fa fa-check"></i> '+ label);
        }
    });

    $('.delete-attachment').on('click', function(e) {
        e.preventDefault();
        const $item = $(this).parent().prev();
        $item.find('span').text('Pilih Berkas');
        $item.find('input:first').val('removed');
        $(this).parent().remove();
    });

    // select2
    $('.select2-multiple').select2();

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
