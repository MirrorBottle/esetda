<script>
$(function() {
    const notifUrl = '{{ url("notif-spt") }}';
    // select2
    $('.select2').select2();

    // datatable
    $('#datatable').DataTable({
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

    // setup template message
    $('#input-template-id, #input-phone-id').on('change', function() {
        const templateId = $('#input-template-id').val();
        const phoneId    = $('#input-phone-id').val();

        if (templateId !== "" && phoneId !== "") {
            const phoneData  = $('#input-phone-id option[value='+phoneId+']').text().split(' | ');
            let template     = $('#template_'+ templateId).text();

            template = template.replace("<kepala_dinas>", phoneData[2]);
            template = template.replace("<institusi>", phoneData[1]);
            template = template.split("\\n").join("\n"); // replace line break string

            $('#input-message').val(template);
            $('#hidden_phone_number').val(phoneData[3]);
            $('.template-action').show();
        } else {
            $('#input-message').val('');
            $('.template-action').hide();
        }
    });

    // add phone data
    $('.btn-add-phone').on('click', function(e) {
        e.preventDefault();

        $('#form-phone').attr('action', notifUrl +'/phone');
        $('#form-phone').find('input[name="_method"]').prop('disabled', true);
        $('#input-name').val('');
        $('#input-wa').val('');
        $('#input-institution').val('');
        $('#input-institution-head').val('');
    });

    // add template data
    $('.btn-add-template').on('click', function(e) {
        e.preventDefault();

        $('#form-template').attr('action', notifUrl +'/template');
        $('#form-template').find('input[name="_method"]').prop('disabled', true);
        $('#template-name').val('');
        $('#template-content').val('');
    });

    // edit phone data
    $('body').on('click', '.btn-edit-phone', function(e) {
        e.preventDefault();

        const $row = $(this).closest('tr');
        const $col = $row.find('td');
        const id   = $row.data('id');

        $('#form-phone').attr('action', notifUrl +'/phone/'+ id);
        $('#form-phone').find('input[name="_method"]').prop('disabled', false);
        $('#input-name').val( $col.eq(1).text() );
        $('#input-wa').val( $col.eq(2).text() );
        $('#input-institution').val( $col.eq(3).text() );
        $('#input-institution-head').val( $col.eq(4).text() );
    });

    // edit template data
    $('.btn-edit-template').on('click', function(e) {
        e.preventDefault();

        const templateId    = $('#input-template-id').val();
        const templateName  = $('#input-template-id option[value='+templateId+']').text();
        let templateContent = $('#template_'+ templateId).text();
        templateContent     = templateContent.split("\\n").join("\n"); // replace line break string

        $('#form-template').attr('action', notifUrl +'/template/'+ templateId);
        $('#form-template').find('input[name="_method"]').prop('disabled', false);
        $('#template-name').val(templateName);
        $('#template-content').val(templateContent);
    });

    // remove phone data
    $('body').on('click', '.btn-delete-phone').on('click', function(e) {
        e.preventDefault();
        const id = $(this).closest('tr').data('id');
        $('#modal-delete').modal('show');
        $('#modal-delete').find('form').attr('action', notifUrl +'/phone/'+ id);
    });

    // remove phone data
    $('.btn-delete-template').on('click', function(e) {
        e.preventDefault();
        const id = $('#input-template-id').val();
        $('#modal-delete').modal('show');
        $('#modal-delete').find('form').attr('action', notifUrl +'/template/'+ id);
    });
})
</script>
