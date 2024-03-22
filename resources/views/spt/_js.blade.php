<script>
    $(function() {
        // get skpd employeess data
        const employees = @json($skpd_employees);
        const checkSpt = @json($spt->id ?? 0);

        // show inbox detail
        const $selectIinbox = $('#input_inbox_id');
        $selectIinbox.on('change', function() {
            if ($(this).val() !== "") {
                const $option = $('#input_inbox_id option[value="'+ $(this).val() +'"]');
                $('.detail-inbox-sender').text($option.attr('data-sender'));
                $('.detail-inbox-title').text($option.attr('data-title'));
                $('.show-detail[data-target="detail-inbox"]').show();
            }
        });

        if ($selectIinbox.val() != null) {
            $selectIinbox.val($selectIinbox.val()).trigger('change');
        }

        // show/hide employee list data
        $('#input_skpd_id').on('change', function() {
            const selectedId = $(this).val();
            if (selectedId !== "" && checkSpt === 0) {
                const $option = $('#input_skpd_id option[value="'+ selectedId +'"]');
                $('#input_budget_expanse').val($option.attr('data-budget'));
            }
        });

        $('#input_skpd_id').val($('#input_skpd_id').val()).trigger('change');

        // preview employee data
        $('#input_skpd_employee_id').on('change', function() {
            const listId = $(this).val();
            if (listId.length > 0) {
                $('.show-detail[data-target="detail-employee"]').show();
                for (let z = 0; z < listId.length; z++) {
                    const $option = $('#input_skpd_employee_id option[value="'+ listId[z] +'"]');
                    $('.detail-employee-item-'+z).removeClass('d-none');
                    $('.detail-employee-name-'+z).text($option.text());
                    $('.detail-employee-skpd-'+z).text($option.attr('data-skpd') == 'null' ? '-' : $option.attr('data-skpd'));
                    $('.detail-employee-nip-'+z).text($option.attr('data-nip') == 'null' ? '-' : $option.attr('data-nip'));
                    $('.detail-employee-position-'+z).text($option.attr('data-position'));
                    $('.detail-employee-input-'+z).val($option.text());
                }
            } else {
                $('.show-detail[data-target="detail-employee"]').hide();
                for (let z = 0; z < 3; z++) {
                    $('.detail-employee-item-'+z).addClass('d-none');
                }
            }
        });

        $('#input_skpd_employee_id').val($('#input_skpd_employee_id').val()).trigger('change');

        // preview employee detail
        const $selectSigner = $('#input_signer_id');
        $selectSigner.on('change', function() {
            if ($(this).val() !== "") {
                const $option = $('#input_signer_id option[value="'+ $(this).val() +'"]');
                $('.detail-inbox-sender').text($option.attr('data-sender'));
                $('.detail-inbox-title').text($option.attr('data-title'));
                $('.detail-signer-name').text($option.attr('data-name'));
                $('.detail-signer-nip').text($option.attr('data-nip'));
                $('.detail-signer-position').text($option.attr('data-position'));
                $('.detail-signer-title').text($option.attr('data-title'));
                $('.show-detail[data-target="detail-signer"]').show();
            }
        });

        if ($selectSigner.val() != null) {
            $selectSigner.val($selectSigner.val()).trigger('change');
        }

        // show/hide additional paraf form
        $('.switch-button a').on('click', function(e) {
            e.preventDefault();

            if ($(this).hasClass('paraf_no')) {
                $('.paraf_no').html('<i class="fa fa-check"></i> Tidak')
                $('.paraf_no').addClass('btn-primary').removeClass('btn-secondary');
                $('.paraf_yes').html('Ya')
                $('.paraf_yes').addClass('btn-secondary').removeClass('btn-primary');
                $('.switch-button').attr('data-active', 1);
                $('#is_paraf').val(1);
                $('.paraf-form').addClass('d-none');
            } else {
                $('.paraf_yes').html('<i class="fa fa-check"></i> Ya')
                $('.paraf_yes').addClass('btn-primary').removeClass('btn-secondary');
                $('.paraf_no').html('Tidak')
                $('.paraf_no').addClass('btn-secondary').removeClass('btn-primary');
                $('.switch-button').attr('data-active', 0);
                $('#is_paraf').val(0);
                $('.paraf-form').removeClass('d-none');
            }
        });

        // show detail info table
        $('.show-detail').on('click', function(e) {
            e.preventDefault();
            const $showDetail = $(this);
            $('.' + $showDetail.attr('data-target')).show();
            $showDetail.next().show();
        });

        // close detail info table
        $('.close-detail').on('click', function(e) {
            e.preventDefault();
            const $closeDetail = $(this);
            $('.' + $closeDetail.attr('data-target')).hide();
            // $closeDetail.prev().show();
            $closeDetail.hide();
        });

        // datepicker setup
        $('.datepicker-id').datepicker({
            format: 'DD, dd MM yyyy',
            language: 'id',
            autoclose: true,
            todayBtn: true,
            todayHighlight: true
        }).on('changeDate', function(e) {
            // set hidden input
            const convertDate = moment(e.date);
            $(this).next().val(convertDate.format('Y-M-D'));
            // calculate day range
            const selectedId = $(this).attr('id');
            if (selectedId === 'input_departure_date' || selectedId === 'input_return_date') {
                const departure_date = moment($('#hidden_departure_date').val());
                const return_date = moment($('#hidden_return_date').val());
                $('#input_duration').val(return_date.diff(departure_date, 'days'));
            }
        });

        // select2 setup
        $('.select2').select2();
        $('.select2-multiple').select2({
            minimumResultsForSearch: -1,
            maximumSelectionLength: 5,
            placeholder: function(){
                $(this).data('placeholder');
            }
        });

    });
</script>
