<script>
    $(function() {
        $('.switch-button-condition a').on('click', function(e) {
            e.preventDefault();

            if ($(this).hasClass('good')) {
                $('.good').html('<i class="fa fa-check"></i> Baik')
                $('.good').addClass('btn-primary').removeClass('btn-secondary');
                $('.bad').html('Tidak Baik')
                $('.bad').addClass('btn-secondary').removeClass('btn-primary');
                $('.switch-button-condition').attr('data-active', 1);
                $('#condition').val(1);
            } else {
                $('.bad').html('<i class="fa fa-check"></i> Tidak Baik')
                $('.bad').addClass('btn-primary').removeClass('btn-secondary');
                $('.good').html('Baik')
                $('.good').addClass('btn-secondary').removeClass('btn-primary');
                $('.switch-button-condition').attr('data-active', 0);
                $('#condition').val(0);
            }
        });

        $('.switch-button-tk-prk a').on('click', function(e) {
            e.preventDefault();

            if ($(this).hasClass('copy')) {
                $('.copy').html('<i class="fa fa-check"></i> Copy')
                $('.copy').addClass('btn-primary').removeClass('btn-secondary');
                $('.non-copy').html('Asli')
                $('.non-copy').addClass('btn-secondary').removeClass('btn-primary');
                $('.switch-button-tk-prk').attr('data-active', 1);
                $('#tk_prk').val(1);
            } else {
                $('.non-copy').html('<i class="fa fa-check"></i> Asli')
                $('.non-copy').addClass('btn-primary').removeClass('btn-secondary');
                $('.copy').html('Copy')
                $('.copy').addClass('btn-secondary').removeClass('btn-primary');
                $('.switch-button-tk-prk').attr('data-active', 0);
                $('#tk_prk').val(0);
            }
        });

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
                $el.prev().html('<i class="fa fa-check"></i> '+ label);
            }
        });

        $('.datepicker-id').datepicker({
            format: 'DD, dd MM yyyy',
            language: 'id',
            autoclose: true,
            todayBtn: true,
            todayHighlight: true
        }).on('changeDate', function(e) {
            const convertDate = moment(e.date);
            $('#hidden_date').val(convertDate.format('Y-M-D'));
        });

        $('.select2').select2();

        $('.delete-attachment').on('click', function(e) {
            e.preventDefault();
            const $item = $(this).parent().prev();
            $item.find('span').text('Lampiran');
            $item.find('input:first').val('removed');
            // $item.find('input:last').attr('data-status', 'new');
            $(this).parent().remove();
        });

        $('#reload').on('click', function(e) {
            e.preventDefault();
            location.reload();
        });

        // detail button
        $('#input_inbox_id').on('change', function(e) {
            const id = $(this).val();
            $.get("/inbox-detail/"+ id, function(res) {
                $('#description').text(res.data.title);
            });
        });

        // select surat change
        $('#input_surat_id').on('change', function(e) {
            const id = $(this).val();
            const url = $(this).data('type') == 'masuk' ? '/inbox-detail' : '/outbox-detail';
            $.get(url +"/"+ id, function(res) {
                $('#description').text(res.data.title);
            });
        });
    });
</script>
