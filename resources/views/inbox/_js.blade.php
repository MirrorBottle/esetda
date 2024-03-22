<script>
    $(function() {
        // init default receiver data
        adjustReceiver();

        $('.switch-button a').on('click', function(e) {
            e.preventDefault();

            if ($(this).hasClass('lingkup')) {
                $('.lingkup').html('<i class="fa fa-check"></i> Lingkup Setda')
                $('.lingkup').addClass('btn-success').removeClass('btn-secondary');
                $('.luar').html('Luar Setda')
                $('.luar').addClass('btn-secondary').removeClass('btn-success');
                $('.switch-button').attr('data-active', 1);
                $('.receiver_type').val(1);
            } else {
                $('.luar').html('<i class="fa fa-check"></i> Luar Setda')
                $('.luar').addClass('btn-success').removeClass('btn-secondary');
                $('.lingkup').html('Lingkup Setda')
                $('.lingkup').addClass('btn-secondary').removeClass('btn-success');
                $('.switch-button').attr('data-active', 0);
                $('.receiver_type').val(0);
            }

            adjustReceiver(true);
        });

        $(document).on('change', ':file', function() {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        // change file button with file name
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

        // init datepicker
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

        $('#input_category_id').select2({templateResult: resultState});

        // delete attachment on edit
        $('.delete-attachment').on('click', function(e) {
            e.preventDefault();
            const $item = $(this).parent().prev();
            $item.find('span').text('Lampiran #'+ $item.data('item'));
            $item.find('input:first').val('removed');
            // $item.find('input:last').attr('data-status', 'new');
            $(this).parent().remove();
        });

        // reload page
        $('#reload').on('click', function(e) {
            e.preventDefault();
            location.reload();
        });

        // disposisi show/hide input
        $('#disposisi-check').on('change', function() {
            const $disposisiAgenda = $('#disposisi-no-agenda');
            const $disposisiProperty = $('#disposisi-property');

            if (this.checked) {
                $('.disposisi-input-area').show();
                $disposisiAgenda.prop('disabled', false);
                $disposisiProperty.prop('disabled', false);

                if ($disposisiAgenda.attr('data-status') == 'new') {
                    // get no agenda
                    const biroId = $disposisiAgenda.attr('data-biro');
                    $.get('/disposition/detail/'+ biroId, function(res) {
                        $disposisiAgenda.val(res.data.no_agenda);
                    });
                }
            } else {
                $('.disposisi-input-area').hide();
                $disposisiAgenda.prop('disabled', true);
                $disposisiProperty.prop('disabled', true);
            }
        });

    });

    function adjustReceiver(clear = false) {
        const $select   = $('#input_receiver_id')
        const type      = $('.receiver_type').val();
        const $options  = $select.find('option[data-type='+type+']');

        // clear selected data
        if (clear) {
            $select.val(null).trigger("change");
        }

        // show by type
        if ($options.length === 0) {
            $select.find('option').addClass('optInvisible');
            $('.null-tujuan').show();
        } else {
            // $select.prop('disabled', false);
            $select.find('option').each(function() {
                const $option = $(this);
                if ($option.attr('data-type') !== type) { $option.addClass('optInvisible'); }
                else { $option.removeClass('optInvisible'); }
            });
            $('.null-tujuan').hide();
        }

        // init select2
        if (type == 0) {
            $select.select2({
                templateResult: resultState,
                tags: true,
                createTag: function (tag) {
                    return {
                        id: tag.term,
                        text: tag.term + ' (baru)',
                        isNew : true
                    };
                }
            });
        } else {
            $select.select2({ templateResult: resultState });
        }
    }

    function resultState(data, container) {
        if(data.element) {
            $(container).addClass($(data.element).attr("class"));
        }
        return data.text;
    }
</script>
