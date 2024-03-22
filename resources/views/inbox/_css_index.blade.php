<style>
    .table td, .table th {
        white-space: normal;
        vertical-align: middle;
    }
    .table th {
        vertical-align: middle !important;
    }
    .table th .badge {
        padding: .2rem .4rem.2rem .4rem;
    }
    .badge-calendar {
        font-size: 80%;
        display: block;
    }
    .table-fix-head          { overflow-y: auto; height: 100px; }
    .table-fix-head thead th { position: sticky; top: 0; }
    .dataTables_wrapper .row:first-child {
        padding: 0 1.5rem;
        font-size: 13px;
    }
    .dataTables_wrapper .row:last-child {
        padding: 2em;
        font-size: 13px;
    }

    .select2-container {
        width: 100% !important;
    }
    .select2-container--default .select2-selection--multiple {
        border: solid #d4d4d4 1px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
        font-size: .9rem;
    }
    .badge-dot {
        font-size: 1rem;
    }

    .datatable tbody tr { cursor: pointer; }

    table.dataTable thead .sorting::before, table.dataTable thead .sorting::after, table.dataTable thead .sorting_asc::before, table.dataTable thead .sorting_asc::after, table.dataTable thead .sorting_desc::before, table.dataTable thead .sorting_desc::after, table.dataTable thead .sorting_asc_disabled::before, table.dataTable thead .sorting_asc_disabled::after, table.dataTable thead .sorting_desc_disabled::before, table.dataTable thead .sorting_desc_disabled::after {
        bottom: 1.8em;
    }
</style>
