<style>
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

    .select2-container--default .select2-selection--multiple {
        border: 1px solid white;
        transition: box-shadow .15s ease;
        padding: .3rem;
        box-shadow: 0 1px 3px rgba(50, 50, 93, .15), 0 1px 0 rgba(0, 0, 0, .02);
    }
    .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
        font-size: .9rem;
    }

    .invalid-feedback {
        display: block;
    }

    .has-success:after, .has-danger:after {
        top: -6px;
    }

    /* custom alert style */
    .alert {
        position: fixed;
        top: 4rem;
        margin-left: 2.4rem;
        z-index: 999999;
        width: 35%;
    }

    .table td, .table th {
        white-space: normal;
    }
</style>
