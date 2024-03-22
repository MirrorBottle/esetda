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

        $('.datepicker-id-start').datepicker({
            format: 'DD, dd MM yyyy',
            language: 'id',
            autoclose: true,
            todayBtn: true,
            todayHighlight: true
        }).on('changeDate', function(e) {
            const convertDate = moment(e.date);
            $('#hidden_date_start').val(convertDate.format('Y-M-D'));
        });

        $('.datepicker-id-end').datepicker({
            format: 'DD, dd MM yyyy',
            language: 'id',
            autoclose: true,
            todayBtn: true,
            todayHighlight: true
        }).on('changeDate', function(e) {
            const convertDate = moment(e.date);
            $('#hidden_date_end').val(convertDate.format('Y-M-D'));
        });

        $('.select2').select2();
    });
</script>
