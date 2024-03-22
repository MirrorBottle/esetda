<script>
    $(function() {
        $('.select2-multiple').select2({
            minimumResultsForSearch: -1,
            placeholder: function(){
                $(this).data('placeholder');
            }
        });

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

            if ($(this).hasClass('periode')) {
                $('.periode').html('<i class="fa fa-check"></i> Periode')
                $('.periode').addClass('btn-primary').removeClass('btn-secondary');
                $('.tahunan').html('Tahunan')
                $('.tahunan').addClass('btn-secondary').removeClass('btn-primary');
                $('#type').val('periode');
                $('#tahunan-area').hide();
                $('#periode-area').show();
            } else {
                $('.tahunan').html('<i class="fa fa-check"></i> Tahunan')
                $('.tahunan').addClass('btn-primary').removeClass('btn-secondary');
                $('.periode').html('Periode')
                $('.periode').addClass('btn-secondary').removeClass('btn-primary');
                $('#type').val('tahunan');
                $('#periode-area').hide();
                $('#tahunan-area').show();
            }
        });
    });
</script>
