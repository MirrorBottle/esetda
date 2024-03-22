<script>
    $(function() {
        // datepicker
        $('.datepicker-id-start').datepicker({
            format: 'DD, dd MM yyyy',
            language: 'id',
            autoclose: true,
            todayBtn: true,
            todayHighlight: true
        }).on('changeDate', function(e) {
            const convertDate = moment(e.date);
            $('#hidden-date-start').val(convertDate.format('Y-M-D'));
        });

        $('.datepicker-id-end').datepicker({
            format: 'DD, dd MM yyyy',
            language: 'id',
            autoclose: true,
            todayBtn: true,
            todayHighlight: true
        }).on('changeDate', function(e) {
            const convertDate = moment(e.date);
            $('#hidden-date-end').val(convertDate.format('Y-M-D'));
        });

        $('.switch-button a').on('click', function(e) {
            e.preventDefault();
            const isTupim = parseInt('{{ auth()->user()->biro_id == 1 }}');

            if ($(this).hasClass('masuk')) {
                $('.masuk').html('<i class="fa fa-check"></i> Surat Masuk')
                $('.masuk').addClass('btn-primary').removeClass('btn-secondary');
                $('.keluar').html('Surat Keluar')
                $('.keluar').addClass('btn-secondary').removeClass('btn-primary');
                $('#type').val('masuk');
                $('#tipe-area').hide();
                if (isTupim) { $('#receiver-area').show(); }
                else { $('#receiver-area').hide(); }
            } else {
                $('.keluar').html('<i class="fa fa-check"></i> Surat Keluar')
                $('.keluar').addClass('btn-primary').removeClass('btn-secondary');
                $('.masuk').html('Surat Masuk')
                $('.masuk').addClass('btn-secondary').removeClass('btn-primary');
                $('#type').val('keluar');
                $('#tipe-area').show();
                $('#receiver-area').show();
                $('.keduanya').click();
            }
            // select2
            adjustReceiver();
        });

        $('.switch-file a').on('click', function(e) {
            e.preventDefault();
            const isTupim = parseInt('{{ auth()->user()->biro_id == 1 }}');

            if ($(this).hasClass('pdf')) {
                $('.pdf').html('<i class="fa fa-check"></i> PDF')
                $('.pdf').addClass('btn-primary').removeClass('btn-secondary');
                $('.excel').html('Excel')
                $('.excel').addClass('btn-secondary').removeClass('btn-primary');
                $('#file_type').val('pdf');
            } else {
                $('.excel').html('<i class="fa fa-check"></i> Excel')
                $('.excel').addClass('btn-primary').removeClass('btn-secondary');
                $('.pdf').html('PDF')
                $('.pdf').addClass('btn-secondary').removeClass('btn-primary');
                $('#file_type').val('excel');
            }
        });

        // switch tipe receiver
        $('.switch-tipe a').on('click', function(e) {
            e.preventDefault();

            if ($(this).hasClass('lingkup')) {
                $('.lingkup').html('<i class="fa fa-check"></i> Lingkup Setda')
                $('.lingkup').addClass('btn-primary').removeClass('btn-secondary');
                $('.luar').html('Luar Setda')
                $('.luar').addClass('btn-secondary').removeClass('btn-primary');
                $('.keduanya').html('Semua')
                $('.keduanya').addClass('btn-secondary').removeClass('btn-primary');
                $('.switch-tipe').attr('data-active', 1);
                $('.receiver_type').val(1);
            } else if ($(this).hasClass('luar')) {
                $('.luar').html('<i class="fa fa-check"></i> Luar Setda')
                $('.luar').addClass('btn-primary').removeClass('btn-secondary');
                $('.lingkup').html('Lingkup Setda')
                $('.lingkup').addClass('btn-secondary').removeClass('btn-primary');
                $('.keduanya').html('Semua')
                $('.keduanya').addClass('btn-secondary').removeClass('btn-primary');
                $('.switch-tipe').attr('data-active', 0);
                $('.receiver_type').val(0);
            } else {
                $('.keduanya').html('<i class="fa fa-check"></i> Semua')
                $('.keduanya').addClass('btn-primary').removeClass('btn-secondary');
                $('.lingkup').html('Lingkup Setda')
                $('.lingkup').addClass('btn-secondary').removeClass('btn-primary');
                $('.luar').html('Luar Setda')
                $('.luar').addClass('btn-secondary').removeClass('btn-primary');
                $('.switch-tipe').attr('data-active', 99);
                $('.receiver_type').val(99);
            }

            adjustReceiver();
        });

        $('#input_multi_receiver_id').select2({
            placeholder: '-- Semua --',
            templateResult: resultState
        });
    });

    function adjustReceiver() {
        const $select   = $('#input_multi_receiver_id')
        const type      = $('.receiver_type').val();
        const $options  = $select.find('option[data-type='+type+']');

        // show by type
        if (type == 99) {
            $select.find('option').removeClass('optInvisible');
        } else {
            if ($options.length === 0) {
                $select.prop('disabled', true);
                $('.null-tujuan').show();
            } else {
                $select.prop('disabled', false);
                $select.find('option').each(function() {
                    const $option = $(this);
                    if ($option.attr('data-type') !== type) { $option.addClass('optInvisible'); }
                    else { $option.removeClass('optInvisible'); }
                });
                $('.null-tujuan').hide();
            }
        }

        $select.select2({
            placeholder: '-- Semua --',
            templateResult: resultState
        });
    }

    function resultState(data, container) {
        if(data.element) {
            $(container).addClass($(data.element).attr("class"));
        }
        return data.text;
    }
</script>
