<script>
$(function() {
    // detail button
    $('.btn-detail').on('click', function(e) {
        const id = $(this).data('id');
        const type = $(this).data('type');
        const typeText = type == 'inbox' ? 'Surat Masuk' : 'Surat Keluar';

        $.get("/"+ type +"-detail/"+ id, function(res) {
            const data = res.data;

            $('.modal-title').text('Detail '+ typeText);
            $('.detail-no-surat').text(data.no_surat);
            $('.detail-no-agenda').text(data.no_agenda);
            $('.detail-title').text(data.title);
            $('.detail-sender').text(data.sender);
            $('.detail-receiver').text(data.receiver);
            $('.detail-sifat').text(data.sifat);
            $('.detail-date').text(data.date);
            $('.detail-category').text(data.category);
            $('.detail-description').text(data.description);
            $('.detail-forward').text(data.forward_note);
            if (data.is_attachment) {
                let attachmentData = '';
                let attachmentButton = '<a class="btn btn-sm btn-icon btn-3 btn-primary mb-2" href="#" target="_blank">';
                    attachmentButton += '<span class="btn-inner--icon"><i class="fa fa-file"></i></span>';
                    attachmentButton += '<span class="btn-inner--text">x</span></a>';

                let x = 0;
                for (x in data.attachments) {
                    const url = '{{ url("storage") }}';
                    const $btn = $(attachmentButton).clone();
                    $btn.attr('href', url+'/'+ data.attachments[x].name);
                    $btn.find('.btn-inner--text').text(data.attachments[x].title.substring(0, 40));
                    attachmentData += $btn.prop('outerHTML');
                }
                $('.attachment-area').html(attachmentData);
                $('.view-attachment').show();
                $('.view-attachment').attr('href', '/surat-lampiran?type='+type+'&id='+id);
            } else {
                $('.attachment-area').html('<small class="text-muted"><i>tidak ada</i></small>');
                $('.view-attachment').hide();
            }

            if (data.dispositions !== null) {
                let dispositionStatus = '';
                let classColor = ['success', 'info', 'warning', 'primary'];
                for (x = 0; x < data.dispositions.length; x++) {
                    if (x !== 0) {
                        dispositionStatus += '<i class="fa fa-angle-double-right text-muted mx-2"></i>';
                    }
                    dispositionStatus += '<span class="badge badge-'+ classColor[x] + '">'+ data.dispositions[x] + '</span>';
                }
                $('.detail-status').html(dispositionStatus);
            } else {
                $('.detail-status').text('-');
            }
        });
    });

    // detail button
    $('.btn-disposisi').on('click', function(e) {
        const id = $(this).data('id');
        const $row = $(this).closest('tr');
        const biro_id = $row.data('biro');
        const isTtdArea = parseInt('{{ $status_disposisi }}');
        // const currentDate = '{{ date("Y-m-d") }}';
        // const currentDateFormatted = '{{ $date }}';
        const selectedDate = $row.attr('data-date');
        const selectedDateFormatted = formatDate(selectedDate);

        $.get('/disposition/detail/'+id+'?biro_id='+biro_id, function(res) {
            $('#disposisi-date-receipt').val('');
            $('#disposisi-hidden-date-receipt').val('');
            $('#disposisi-time-receipt').val('');

            const data = res.data;
            if (res.type === 'add') {
                $('#disposisi-id').val('');
                $('#disposisi-no-agenda').val(data.no_agenda);
                $('#hidden-no-letter').val($row.data('no'));
                $('#disposisi-kop').val('1').trigger('change');
                $('#disposisi-property').val('1');
                $('#disposisi-sender').val( $row.data('sender') );
                $('#disposisi-date').val(selectedDateFormatted);
                $('#disposisi-hidden-date').val(selectedDate);
                // $('#disposisi-date-receipt').val(currentDateFormatted);
                // $('#disposisi-hidden-date-receipt').val(currentDate);
                $('#disposisi-description').val($row.data('description'));
                $('#disposisi-status-area').prop('checked', isTtdArea);
            } else {
                $('#hidden-no-letter').val($row.data('no'));
                $('#disposisi-date').val(selectedDateFormatted);
                $('#disposisi-hidden-date').val(selectedDate);

                $('#disposisi-id').val(data.id);
                $('#disposisi-no-agenda').val(data.no_agenda);
                $('#disposisi-kop').val(data.kop).trigger('change');
                $('#disposisi-ttd').val(data.ttd);
                $('#disposisi-property').val(data.property);
                $('#disposisi-sender').val(data.sender);
                $('#disposisi-date-receipt').val(data.date_indo_receipt);
                $('#disposisi-hidden-date-receipt').val(data.date_receipt);
                $('#disposisi-time-receipt').val(data.time_receipt);
                $('#disposisi-description').val(data.description);
                $('#disposisi-status-area').prop('checked', data.is_ttd);
            }

            $('#inbox-id').val(id);
            $('#disposisi-type').val(res.type);
        });

        // datepicker
        $('.datepicker-id').datepicker({
            format: 'DD, dd MM yyyy',
            language: 'id',
            autoclose: true,
            todayBtn: true,
            todayHighlight: true
        }).on('changeDate', function(e) {
            const convertDate = moment(e.date);
            $('#disposisi-hidden-date').val(convertDate.format('Y-M-D'));
        });

        $('.datepicker-id-receipt').datepicker({
            format: 'DD, dd MM yyyy',
            language: 'id',
            autoclose: true,
            todayBtn: true,
            todayHighlight: true
        }).on('changeDate', function(e) {
            const convertDate = moment(e.date);
            $('#disposisi-hidden-date-receipt').val(convertDate.format('Y-M-D'));
        });
    });

    // form lampiran
    $('.btn-lampiran').on('click', function(e) {
        const id = $(this).data('id');
        const forwardId = $(this).closest('tr').data('id');
        const userId = parseInt('{{ auth()->user()->id }}');

        // reset lampiran area
        $('.lampiran-area').html(defaultLampiranArea());
        // set form action & type
        $('#form-lampiran').attr('action', '/surat-terusan/lampiran/check/'+ id);
        $('#lampiran-type').val($(this).data('type'));

        $.get('/surat-terusan/lampiran/check/'+forwardId, function(res) {
            if (res.data !== null) {
                let x;
                for (x = 0; x < res.data.length; x++) {
                    let data = res.data[x];
                    let $fileInput = $('#attachment_'+ (x+1));
                    let actions = actionButton(data, userId);
                    $fileInput.attr('data-status', 'current');
                    $fileInput.prev().html('<i class="fa fa-check"></i> '+ data.title);
                    $fileInput.parent().after(actions);
                    if (data.user_id !== userId) {
                        $fileInput.prop('disabled', true);
                        $fileInput.parent().attr('class', 'btn btn-block btn-light');
                    }
                }
            }
        });
    });

    // form keterangan
    $('.btn-keterangan').on('click', function(e) {
        const id = $(this).data('id');
        const type = $(this).data('type');
        const note = $(this).data('note');

        // set form action & type
        $('#form-keterangan').attr('action', '/surat-terusan/keterangan/'+ id);
        $('#keterangan-type').val(type);
        $('#keterangan-text').val(note);
    });

    // duplikasi
    $('.btn-duplikat').on('click', function(e) {
        const $el    = $(this);
        const id     = $el.data('id');
        const type   = $el.data('type');
        const $cols  = $el.closest('tr').find('td');
        const action = '{{ url("/surat-terusan/duplikasi") }}';

        $('#duplikasi-modal').find('form').attr('action', action);
        $('#duplikasi-id').val(id);
        $('#duplikasi-type').val(type);
        $('#duplikasi-info').html(
            'Duplikasi '+ $cols.eq(2).text() +
            ' <br>No Surat: ' + $cols.eq(4).text() +
            ' <br>Asal Biro: ' + $cols.eq(3).text()
        );
    });

    // disposisi kop
    $('#disposisi-kop').on('change', function() {
        if ($(this).val() == '0') {
            $('#disposisi-ttd-area').show();
            $('#disposisi-kop-area').attr('class', 'col-6');
            $('#disposisi-ttd').prop('disabled', false);
        } else {
            $('#disposisi-ttd-area').hide();
            $('#disposisi-kop-area').attr('class', 'col-12');
            $('#disposisi-ttd').prop('disabled', true);
        }
    });

    // disposisi submit, auto close
    $('#disposisi-submit').on('click', function() {
        const timer = setTimeout( function(){
            $('#disposisi-modal').modal('hide');
            clearTimeout(timer);
        }, 1000);
    });

    // change label attachment
    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    // change file button with file name
    $('body').on('fileselect', ':file', function(event, numFiles, label) {
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

    // delete attachment on edit
    $('body').on('click', '.delete-attachment', function(e) {
        e.preventDefault();
        const $parent = $(this).parent();
        const $item = $parent.prev();
        $item.find('span').text('Lampiran #'+ $item.data('item'));
        $parent.find('input:first').val('removed');
        $parent.hide();
    });

    // init datatable
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

function formatDate(date) {
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

function actionButton(data, userId) {
    let action = `<div class="actions-area">
        <input type="hidden" name="uploaded_file[${data.id}]" value="current">
        <a href="/storage/${data.name}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat Lampiran</a>`;

    if (data.user_id === userId) {
        action += `<a href="#" class="btn btn-sm btn-outline-danger float-right delete-attachment">Hapus</a>`;
    }

    return action += `</div>`;
}

function defaultLampiranArea() {
    let x;
    let area = '';
    for (x = 1; x <= 4; x++) {
        const classBtn = x % 2 == 0 ? 'info' : 'primary';
        area += `<div class="form-group">
            <label class="btn btn-block btn-${classBtn} btn-file" data-item="${x}">
                <span>Lampiran #${x}</span>
                <input type="file" style="display: none;" accept="application/pdf, image/*"
                    name="attachment[${x}]" id="attachment_${x}" data-status="new">
            </label>
        </div>`;
    }
    return area;
}
</script>
