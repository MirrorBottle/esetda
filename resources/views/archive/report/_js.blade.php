<script>
$(function() {
    $('.switch-button a').on('click', function(e) {
        e.preventDefault();

        if ($(this).hasClass('masuk')) {
            $('.masuk').html('<i class="fa fa-check"></i> Surat Masuk')
            $('.masuk').addClass('btn-primary').removeClass('btn-secondary');
            $('.keluar').html('Surat Keluar')
            $('.keluar').addClass('btn-secondary').removeClass('btn-primary');
            $('.switch-button').attr('data-active', 'masuk');
            $('#type').val('masuk');
        } else {
            $('.keluar').html('<i class="fa fa-check"></i> Surat Keluar')
            $('.keluar').addClass('btn-primary').removeClass('btn-secondary');
            $('.masuk').html('Surat Masuk')
            $('.masuk').addClass('btn-secondary').removeClass('btn-primary');
            $('.switch-button').attr('data-active', 'keluar');
            $('#type').val('keluar');
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
