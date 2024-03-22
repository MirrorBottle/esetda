<script>
    $(function() {
        // remove button
        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const action = '{{ url("/surat-masuk") }}' +'/'+ id;
            $('#modal-delete').modal('show');
            $('#modal-delete').find('form').attr('action', action);
        });

        // detail button
        $('.btn-detail').on('click', function(e) {
            const $row = $(this).closest('tr');
            const no = $row.find('td').eq(2).text();
            const sender = $row.find('td').eq(3).text();
            const institution = $row.find('td').eq(4).text();
            const receiver = $row.find('td').eq(5).text();
            const date = $row.find('td').eq(6).text();
            const title = $row.attr('data-title');
            const description = $row.attr('data-description');
            const attachment = $row.attr('data-attachment');

            $('.detail-no-surat').text(no);
            $('.detail-title').text(title);
            $('.detail-sender').text(sender);
            $('.detail-institution').text(institution);
            $('.detail-receiver').text(receiver);
            $('.detail-description').text(description);
            $('.detail-date').text(date);

            const storageUrl = '{{ url("storage") }}';
            $('.view-attachment').attr('href', storageUrl +'/'+ attachment);
        });

        // forward button
        $('.btn-forward').on('click', function(e) {
            const $row = $(this).closest('tr');
            const id = $(this).data('id');
            const receiverId = $(this).data('receiver');
            $('#forward_id').val(id);
            $('#forward_receiver').val(receiverId).trigger('change');
            $('#forward_note').val('');

            // get no agenda
            $.get('/disposition/detail/'+id, function(res) {
                const noAgenda = res.data.no_agenda;
                const replaceNoAgenda = noAgenda.replace("TUPIM", "TAMU");
                $('#disposisi-no-agenda').val(replaceNoAgenda);
            });
        });

        // forward cancel
        $('#forward-cancel').on('click', function(e) {
            const id = $(this).data('id');
            $('#forward-method').val('DELETE');
            $('#form-forward').attr('action', '/surat-terusan/batal/'+ id);
            $('#form-forward').submit();
        });

        // invalid button
        $('.btn-invalid').on('click', function(e) {
            const $row = $(this).closest('tr');
            const id = $(this).data('id');
            const letterNumber = $row.find('td').eq(2).text();
            const letterSender = $row.find('td').eq(4).text();

            $('#invalid_id').val(id);
            $('#invalid_no_surat').val(letterNumber);
            $('#invalid_asal').val(letterSender);
            $('#invalid_note').val('');
        });

        // select2
        $('.select2').select2();

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
</script>
