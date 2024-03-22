<script>
    $(function() {
        $('.switch-button a').on('click', function(e) {
            e.preventDefault();

            if ($(this).hasClass('terbuka')) {
                $('.terbuka').html('<i class="fa fa-check"></i> Terbuka')
                $('.terbuka').addClass('btn-primary').removeClass('btn-secondary');
                $('.rahasia').html('Rahasia')
                $('.rahasia').addClass('btn-secondary').removeClass('btn-primary');
                $('.switch-button').attr('data-active', 1);
                $('#status').val(1);
            } else {
                $('.rahasia').html('<i class="fa fa-check"></i> Rahasia')
                $('.rahasia').addClass('btn-primary').removeClass('btn-secondary');
                $('.terbuka').html('Terbuka')
                $('.terbuka').addClass('btn-secondary').removeClass('btn-primary');
                $('.switch-button').attr('data-active', 0);
                $('#status').val(0);
            }
        });

        // timepicker
        $('#time_start, #time_end').timepicker({
            showSeconds: false,
            showMeridian: false,
            icons: {
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down'
            },
            defaultTime: false
        });

        // datepicker
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
        $('.select2-tag').select2({
            tags: true,
            createTag: function (tag) {
                return {
                    id: tag.term,
                    text: tag.term + ' (baru)',
                    isNew : true
                };
            }
        });
        $('.select2-multiple').select2({
            tags: true,
            createTag: function (tag) {
                return {
                    id: tag.term,
                    text: tag.term + ' (baru)',
                    isNew : true
                };
            },
            minimumResultsForSearch: -1,
            placeholder: function(){
                $(this).data('placeholder');
            }
        });

        $('#reload').on('click', function(e) {
            e.preventDefault();
            location.reload();
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
