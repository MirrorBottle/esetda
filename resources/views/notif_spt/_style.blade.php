<style>
    .table td, .table th {
        white-space: normal;
    }
    .table th {
        vertical-align: middle !important;
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

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border-radius: 4px;
        transition: box-shadow .15s ease;
        border: 0;
        box-shadow: 0 1px 3px rgba(50, 50, 93, .15), 0 1px 0 rgba(0, 0, 0, .02);
        height: 45px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #9aa7b7;
        line-height: 46px;
        font-size: .9rem;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 46px;
    }

    .select2-container .select2-results__option.optInvisible {
        display: none;
    }
</style>
