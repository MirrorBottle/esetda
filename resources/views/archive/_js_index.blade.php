<script>
    $(function() {
        // remove button
        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const type = $(this).data('type');
            const action = '{{ url("/arsip") }}' +'/'+ type +'/'+id;
            $('#modal-delete').modal('show');
            $('#modal-delete').find('form').attr('action', action);
        });

        // detail button
        $('.btn-detail').on('click', function(e) {
            const type = '{{ $type }}';
            const id = $(this).data('id');
            $.get("/archive-detail/"+ type +"/"+ id, function(res) {
                const data = res.data;
                // detail arsip
                $('.detail-code').text(data.clasification_code);
                $('.detail-clasification').text(data.clasification);
                $('.detail-tk-prk').text(data.tk_prk);
                $('.detail-qty').text(data.qty);
                $('.detail-no-box').text(data.no_box);
                $('.detail-no-folder').text(data.no_folder);
                $('.detail-note').text(data.note);
                // detail surat
                $('.detail-no-surat').text(data.archivable.no_surat);
                $('.detail-no-agenda').text(data.archivable.no_agenda);
                $('.detail-title').text(data.archivable.title);
                $('.detail-sender').text(data.archivable.sender);
                $('.detail-receiver').text(data.archivable.receiver);
                $('.detail-sifat').text(data.archivable.sifat);
                $('.detail-date').text(data.archivable.date);
                $('.detail-category').text(data.archivable.category);
                $('.detail-description').text(data.archivable.description);
                $('.detail-forward').text(data.archivable.forward_note);

                if (data.is_attachment == 1) {
                    const urlStorage = '{{ url("storage") }}';
                    $('.detail-attachment').show();
                    $('.detail-attachment').text(data.attachment.name.substring(0, 40));
                    $('.detail-attachment').attr('href', urlStorage+ '/' + data.attachment.path);
                    $('.detail-attachment').attr('target', '_blank');
                } else {
                    $('.detail-attachment').hide();
                }

                if (data.archivable.is_attachment) {
                    const typeClass = type == 'masuk' ? 'inbox' : 'outbox';
                    let attachmentData = '';
                    let attachmentButton = '<a class="btn btn-sm btn-icon btn-3 btn-info mb-2" href="#" target="_blank">';
                        attachmentButton += '<span class="btn-inner--icon"><i class="fa fa-file"></i></span>';
                        attachmentButton += '<span class="btn-inner--text">x</span></a>';

                    let x = 0;
                    for (x in data.archivable.attachments) {
                        const url = '{{ url("storage") }}';
                        const $btn = $(attachmentButton).clone();
                        $btn.attr('href', url+'/'+ data.archivable.attachments[x].name);
                        $btn.find('.btn-inner--text').text(data.archivable.attachments[x].title.substring(0, 40));
                        attachmentData += $btn.prop('outerHTML');
                    }
                    $('.attachment-area').html(attachmentData);
                    $('.view-attachment').show();
                    $('.view-attachment').attr('href', '/surat-lampiran?type='+typeClass+'&id='+data.archivable.id);
                } else {
                    $('.attachment-area').html('<small class="text-muted"><i>tidak ada</i></small>');
                    $('.view-attachment').hide();
                }
            });
        });

        // validate button
        $('.btn-validate').on('click', function(e) {
            e.preventDefault();
            let listId = '';
            $('.checkbox:checked').each(function(e) {
                listId += $(this).val() + ',';
            });

            $('#validate_list_id').val(listId.slice(0, -1));
            $('#validate-modal').find('span').hide();
            $('#validate-modal').find('.btn-default').hide();
            $('#validate-modal').find('.btn-success').show();
        });

        // check all button
        $('.check-all').on('click', function(e) {
            e.preventDefault();
            const $el = $(this);

            if ($el.attr('data-status') == 'check') {
                $(".checkbox").each(function() {
                    this.checked=false;
                });
                $('.check-all').attr('data-status', 'uncheck');
                $('.check-all span').text('Check All');
                $('.btn-confirm').hide();
                $('.btn-validate').hide();
            } else {
                $(".checkbox").each(function() {
                    this.checked=true;
                });
                $('.check-all').attr('data-status', 'check');
                $('.check-all span').text('Uncheck All');
                $('.btn-confirm').show();
                $('.btn-validate').show();
            }
        });

        // retry button
        $('.btn-retry').on('click', function(e) {
            e.preventDefault();
            $('#validate_list_id').val($(this).attr('data-id'));
            $('#validate-modal').find('span').show();
            $('#validate-modal').find('.btn-default').show();
            $('#validate-modal').find('.btn-success').hide();
        });

        // switch validation button
        $('body').on('click', '.switch-validation a', function(e) {
            e.preventDefault();
            const $parent = $(this).parent();
            if ($(this).hasClass('approve')) {
                $parent.find('.approve').html('<i class="fa fa-check"></i> Terima')
                $parent.find('.approve').addClass('btn-default').removeClass('btn-secondary');
                $parent.find('.reject').html('Tolak')
                $parent.find('.reject').addClass('btn-secondary').removeClass('btn-default');
                $parent.next().val(1);
            } else {
                $parent.find('.reject').html('<i class="fa fa-check"></i> Tolak')
                $parent.find('.reject').addClass('btn-default').removeClass('btn-secondary');
                $parent.find('.approve').html('Terima')
                $parent.find('.approve').addClass('btn-secondary').removeClass('btn-default');
                $parent.next().val(0);
            }
        });

        // validasi button (admin)
        $('.btn-confirm').on('click', function(e) {
            e.preventDefault();
            let no = 1;
            let data = '';

            $('.checkbox:checked').each(function(e) {
                const $row       = $(this).closest('tr');
                const id         = $row.attr('data-id');
                const biro       = $row.find('td').eq(2).text();
                const no_surat   = $row.find('td').eq(4).text();
                const $actionBtn = $('#switch-template').clone();
                $actionBtn.find('input').attr('name', 'list_id['+ id +']');

                data += '<tr>';
                data += '<td>'+ no +'</td>';
                data += '<td>'+ biro +'</td>';
                data += '<td>'+ no_surat +'</td>';
                data += '<td>'+ $actionBtn.html() +'</td>';
                data += '</tr>'
                no++;
            });

            $('#confirm-modal').find('table tbody').html(data);
        });

        // checked row
        $('tr').on('click', function() {
            const $row = $(this);
            if ($row.attr('data-checked') == 'false') {
                $row.find('.checkbox').prop('checked', true);
                $row.attr('data-checked', 'true');
            } else {
                $row.find('.checkbox').prop('checked', false);
                $row.attr('data-checked', 'false');
            }

            const countChecked = $('.checkbox:checked').length;
            if (countChecked == 0) {
                $('.btn-validate').hide();
                $('.btn-confirm').hide();
            } else {
                $('.btn-validate').show();
                $('.btn-confirm').show();
            }
        });

        // datatable
        $('#datatable').DataTable({
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

        // hide check all when empty checkbox
        const isNullCheckbox = $(".checkbox").length == 0;
        if (isNullCheckbox) { $('.check-all').hide(); }
    });

    function formatDate(date)
    {
        let splitDate = date.split("-");
        let days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        let dateObject = new Date(date);
        let dayName = days[dateObject.getDay()];

        $months = [
            '',
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September' ,
            'Oktober',
            'November',
            'Desember'
        ];

        return dayName +', '+ splitDate[2] +' '+ $months[parseInt(splitDate[1])] +' '+ splitDate[0];
    }
</script>
