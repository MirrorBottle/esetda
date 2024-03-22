<script>
    $(function() {
        // remove button
        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const action = '{{ url("/agenda/jadwal") }}' +'/'+ id;
            $('#modal-delete').modal('show');
            $('#modal-delete').find('form').attr('action', action);
        });

        // detail button
        $('.btn-detail').on('click', function(e) {
            const id = $(this).data('id');
            $.get("/agenda-detail/"+ id, function(res) {
                const data = res.data;
                $('.agenda-reference').text(data.reference);
                $('.agenda-date').text(data.date);
                $('.agenda-time').text(data.time);
                $('.agenda-event').text(data.agenda);
                $('.agenda-status').text(data.status);
                $('.agenda-place').text(data.place);
                $('.agenda-apparel').text(data.apparel);
                $('.agenda-disposition').text(data.disposition);
                $('.agenda-description').text(data.description);
                $('.agenda-receiver').text(data.receiver);

                if (data.is_attachment == 1) {
                    const urlStorage = '{{ url("storage") }}';
                    $('.agenda-attachment').show();
                    $('.agenda-attachment').text(data.attachment.name.substring(0, 70));
                    $('.agenda-attachment').attr('href', urlStorage+ '/' + data.attachment.path);
                    $('.agenda-attachment').attr('target', '_blank');
                } else {
                    $('.agenda-attachment').hide();
                }

                let x = 0;
                let partners = '';
                if (data.partners.length > 0) {
                    for (x in data.partners) {
                        if (x != 0) { partners += ', '; }
                        partners += data.partners[x].position;
                    }
                } else {
                    partners = '-';
                }
                $('.agenda-partners').text(partners);

                // detail surat
                if (data.reference !== '-') {
                    $('.referensi-area').show();
                    $('.detail-no-surat').text(data.inbox.no_surat);
                    $('.detail-no-agenda').text(data.inbox.no_agenda);
                    $('.detail-title').text(data.inbox.title);
                    $('.detail-sender').text(data.inbox.sender);
                    $('.detail-receiver').text(data.inbox.receiver);
                    $('.detail-sifat').text(data.inbox.sifat);
                    $('.detail-date').text(data.inbox.date);
                    $('.detail-category').text(data.inbox.category);
                    $('.detail-description').text(data.inbox.description);
                    $('.detail-forward').text(data.inbox.forward_note);

                    if (data.inbox.is_attachment) {
                        let attachmentData = '';
                        let attachmentButton = '<a class="btn btn-sm btn-icon btn-3 btn-info mb-2" href="#" target="_blank">';
                            attachmentButton += '<span class="btn-inner--icon"><i class="fa fa-file"></i></span>';
                            attachmentButton += '<span class="btn-inner--text">x</span></a>';

                        let x = 0;
                        for (x in data.inbox.attachments) {
                            const url = '{{ url("storage") }}';
                            const $btn = $(attachmentButton).clone();
                            $btn.attr('href', url+'/'+ data.inbox.attachments[x].name);
                            $btn.find('.btn-inner--text').text(data.inbox.attachments[x].title.substring(0, 40));
                            attachmentData += $btn.prop('outerHTML');
                        }
                        $('.attachment-area').html(attachmentData);
                        $('.view-attachment').show();
                        $('.view-attachment').attr('href', '/surat-lampiran?type=inbox&id='+data.inbox.id);
                    } else {
                        $('.attachment-area').html('<small class="text-muted"><i>tidak ada</i></small>');
                        $('.view-attachment').hide();
                    }
                } else {
                    $('.referensi-area').hide();
                }
            });
        });

        // select2
        $('.select2-multiple').select2();

        // datatable
        $('.table').DataTable({
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
