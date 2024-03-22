<script>
 $(function() {
        let customButtons = [
            {
                extend: 'print',
                className: 'btn-sm btn-default',
                text: '<i class="fa fa-print"></i> Print',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ];

        @isset($filter)
            customButtons.unshift({
                text: '<i class="fa fa-filter"></i> Filter Data',
                className: 'btn-sm btn-default btn-filter'
            });
        @endisset

        $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
        $.extend(true, $.fn.dataTable.defaults, {
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
            },
            columnDefs: [{
                orderable: false,
                searchable: false,
                targets: -1
            }],
            select: {
                style:    'multi+shift',
                selector: 'td:first-child'
            },
            order: [],
            scrollX: true,
            pageLength: 100,
            dom: 'lBfrtip<"actions">',
            buttons: customButtons
        });

        $.fn.dataTable.ext.classes.sPageButton = '';
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);

        $('.datatable:not(.ajaxTable)').DataTable({
            buttons: dtButtons,
            lengthMenu: [[25, 50, 75, 100, -1], [25, 50, 75, 100, "All"]]
        })
    });
</script>
