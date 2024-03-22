<script>
    $(function() {
        // init select2
        $('.select2').select2();

        // change gile
        $(document).on('change', ':file', function() {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        // change file button with file name
        $(':file').on('fileselect', function(event, numFiles, label) {
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

        // reload page
        $('#reload').on('click', function(e) {
            e.preventDefault();
            location.reload();
        });

        // copy to clipboard
        $('#copy').on('click', function(e) {
            e.preventDefault();
            copyToClipboard('.unique-code');
        });
    });

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }
</script>
