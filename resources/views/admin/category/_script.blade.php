<script>
$(function() {
    const url  = '{{ route("admin.kategori.store") }}';

    $('.btn-add').on('click', function(e) {
        e.preventDefault();
        $('#formModal').modal('show');
        $('#formModal').find('form').attr('action', url);
        $('input[name="_method"]').prop('disabled', true);
        $('#name').val('');
    });

    $('.btn-edit').on('click', function(e) {
        e.preventDefault();
        const $row = $(this).closest('tr');
        const id = $(this).data('id');

        $('#formModal').modal('show');
        $('#formModal').find('form').attr('action', url +'/'+ id);
        $('input[name="_method"]').prop('disabled', false);
        $('#name').val(
            $row.find('td').eq(1).text()
        );
    });
});
</script>
