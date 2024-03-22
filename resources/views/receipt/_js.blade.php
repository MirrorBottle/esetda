<script>
    $(function() {
        // collect instruction value
        let checkedItems = @json($list_id);
        let instructions = {id: [], value: []};

        // submit instruction button
        $('.btn-instruction').on('click', function(e) {
            setTimeout(function(){ location.reload(); }, 2000);

            $('#hidden_item').val(checkedItems.join());
            $('#hidden_id').val(instructions.id.join());
            $('#hidden_instruction').val(instructions.value.join());
            $('#form-instruction').submit();
            e.preventDefault();
        });

        // set instruction value on input
        $('.custom-textarea').on('change', function(e) {
            const $el = $(this);
            const selectedId = parseInt($el.attr('data-id'));
            const selectedValue = $el.val();

            if (isInArray(instructions.id, selectedId)) {
                const key = instructions.id.indexOf(selectedId);
                instructions.value[key] = selectedValue;
            } else {
                instructions.id.push(selectedId);
                instructions.value.push(selectedValue);
            }
        });

        // set checked row
        $('.checkbox').on('change', function(e) {
            const $cell  = $(this).parent();
            const id = parseInt($cell.attr('data-id'));
            const status = $cell.attr('data-checked');

            if (status == 'true') {
                $cell.attr('data-checked', 'false');
                // remove items id
                const index = checkedItems.indexOf(id);
                if (index > -1) {
                    checkedItems.splice(index, 1);
                }
            } else {
                $cell.attr('data-checked', 'true');
                // add items id
                checkedItems.push(id);
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

        // checked row
        // $('tr').on('click', function() {
        //     const $row = $(this);
        //     if ($row.attr('data-checked') == 'false') {
        //         $row.find('.checkbox').prop('checked', true);
        //         $row.attr('data-checked', 'true');
        //     } else {
        //         $row.find('.checkbox').prop('checked', false);
        //         $row.attr('data-checked', 'false');
        //     }
        // });

        // datatable
        $('.datatable').DataTable({
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
    });

    function isInArray(array, search) {
        return array.indexOf(search) >= 0;
    }
</script>
