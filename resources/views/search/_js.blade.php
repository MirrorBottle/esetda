<script>
$(function() {
    $('.switch-button a').on('click', function(e) {
        e.preventDefault();
        const $button = $(this);

        if ($button.hasClass('masuk')) {
            $('.masuk').html('<i class="fa fa-check"></i> Surat Masuk')
            $('.masuk').addClass('btn-primary').removeClass('btn-secondary');
            $('.keluar').html('Surat Keluar')
            $('.terusan').html('Surat Lingkup Setda')
            $('.keluar, .terusan').addClass('btn-secondary').removeClass('btn-primary');
            $('#type').val('masuk');
            $('#sender-area').show();
            // $('#biro-area').hide();
            $('#sender-area').find('input').prop('disabled', false);
            // $('#biro-area').find('select').prop('disabled', true);
        } else if ($button.hasClass('keluar')) {
            $('.keluar').html('<i class="fa fa-check"></i> Surat Keluar')
            $('.keluar').addClass('btn-primary').removeClass('btn-secondary');
            $('.masuk').html('Surat Masuk')
            $('.terusan').html('Surat Lingkup Setda')
            $('.masuk, .terusan').addClass('btn-secondary').removeClass('btn-primary');
            $('#type').val('keluar');
            $('#sender-area').hide();
            // $('#biro-area').hide();
            $('#sender-area').find('input').prop('disabled', true);
            // $('#biro-area').find('select').prop('disabled', true);
        } else {
            $('.terusan').html('<i class="fa fa-check"></i> Surat Lingkup Setda')
            $('.terusan').addClass('btn-primary').removeClass('btn-secondary');
            $('.masuk').html('Surat Masuk')
            $('.keluar').html('Surat Keluar')
            $('.masuk, .keluar').addClass('btn-secondary').removeClass('btn-primary');
            $('#type').val('terusan');
            $('#biro-area').show();
            $('#sender-area').hide();
            $('#sender-area').find('input').prop('disabled', true);
            $('#biro-area').find('select').prop('disabled', false);
        }
    });

    $('.switch-tipe a').on('click', function(e) {
        e.preventDefault();

        if ($(this).hasClass('lingkup')) {
            $('.lingkup').html('<i class="fa fa-check"></i> Lingkup Setda')
            $('.lingkup').addClass('btn-primary').removeClass('btn-secondary');
            $('.luar').html('Luar Setda')
            $('.luar').addClass('btn-secondary').removeClass('btn-primary');
            $('.switch-tipe').attr('data-active', 1);
            $('.receiver_type').val(1);
        } else {
            $('.luar').html('<i class="fa fa-check"></i> Luar Setda')
            $('.luar').addClass('btn-primary').removeClass('btn-secondary');
            $('.lingkup').html('Lingkup Setda')
            $('.lingkup').addClass('btn-secondary').removeClass('btn-primary');
            $('.switch-tipe').attr('data-active', 0);
            $('.receiver_type').val(0);
        }

        getReceiver();
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

    // call default receiver
    // getReceiver();
});

function getReceiver()
{
    const type = $('.switch-tipe').attr('data-active');
    const url = '{{ url("receiver-data") }}'+ '?type='+type;
    let listOptions = '';
    $.get(url, function(res) {
        if (res.success) {
            for (let x in res.data) {
                listOptions += '<option value="'+ res.data[x].id +'">'+ res.data[x].name +'</option>';
            }

            $('#input_receiver_id').prop('disabled', false);
            $('#input_receiver_id').html(listOptions);
            $('.null-tujuan').hide();
        } else {
            $('#input_receiver_id').html('');
            $('.null-tujuan').show();
        }
    });

    if (type == 0) {
        $('#input_receiver_id').select2({
            tags: true,
            createTag: function (tag) {
                return {
                    id: tag.term,
                    text: tag.term + ' (baru)',
                    isNew : true
                };
            }
        });
    } else {
        $('#input_receiver_id').select2();
    }
}
</script>
