<script>
    $(function() {
        // get order number
        $('#input_month, #input_year').on('change', function(e) {
            e.preventDefault();
            const month = $('#input_month').val();
            const year = $('#input_year').val();
            if (month !== '') {
                const formatDate = year + '-' + month + '-01';
                // request data
                $.get('/number-order/'+ formatDate, function(res) {
                    if (res.type == 'success') {
                        $('#input_order').val(res.order);
                        $('#hidden_letter_number_id').val(res.id);
                        $('#generate-error-area').addClass('d-none');
                        $('.toggle-bottom-area').show();
                    } else {
                        $('#input_order').val('');
                        $('#hidden_letter_number_id').val('');
                        $('#generate-error-area').removeClass('d-none');
                        $('.toggle-bottom-area').hide();
                    }
                });
            } else {
                $('#input_order').val('');
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
                $el.prev().html('<i class="fa fa-check"></i> '+ label);
            }
        });

        $('.delete-attachment').on('click', function(e) {
            e.preventDefault();
            const $item = $(this).parent().prev();
            $item.find('span').text('Lampiran');
            $item.find('input:first').val('removed');
            // $item.find('input:last').attr('data-status', 'new');
            $(this).parent().remove();
        });
    });
</script>
