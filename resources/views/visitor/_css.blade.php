<style>
    .header {
        padding-bottom: 1rem !important;
        padding-top: 17rem !important;
        background-size: cover;
        background-position: center top;
    }

    .navbar-horizontal .navbar-brand img {
        height: 68px;
        margin-top: .9rem;
    }

    .copyright {
        color: #aaa !important;
    }

    .copyright a {
        color: #278daa !important;
    }

    .card-action-buttons {
        text-align: right;
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

    .select2-container--default .select2-selection--multiple {
        border: 1px solid white;
        transition: box-shadow .15s ease;
        padding: .3rem;
        box-shadow: 0 1px 3px rgba(50, 50, 93, .15), 0 1px 0 rgba(0, 0, 0, .02);
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
        font-size: .9rem;
    }

    .timeline {
        position: relative;
        width: 100%;
        padding: 0 0 3rem 0;
    }

    .timeline .timeline-container {
        position: relative;
        width: 100%;
    }

    .timeline .timeline-end,
    .timeline .timeline-start,
    .timeline .timeline-year {
        position: relative;
        width: 100%;
        text-align: center;
        z-index: 1;
    }

    .timeline .timeline-end p,
    .timeline .timeline-start p,
    .timeline .timeline-year p {
        display: inline-block;
        width: 80px;
        height: 80px;
        margin: 0;
        padding: 30px 0;
        text-align: center;
        background: linear-gradient(#4c7273, #084b59);
        border-radius: 100px;
        box-shadow: 0 0 5px rgba(0, 0, 0, .4);
        color: #ffffff;
        font-size: 14px;
        text-transform: uppercase;
    }

    .timeline .timeline-year {
        margin: 30px 0;
    }

    .timeline .timeline-continue {
        position: relative;
        width: 100%;
        padding: 60px 0;
    }

    .timeline .timeline-continue::after {
        position: absolute;
        content: "";
        width: 1px;
        height: 100%;
        top: 0;
        left: 50%;
        margin-left: -1px;
        background: #4c7273;
    }

    .timeline .row.timeline-left,
    .timeline .row.timeline-right .timeline-date {
        text-align: right;
    }

    .timeline .row.timeline-right,
    .timeline .row.timeline-left .timeline-date {
        text-align: left;
    }

    .timeline .timeline-date {
        font-size: 14px;
        font-weight: 600;
        margin: 41px 0 0 0;
    }

    .timeline .timeline-date::after {
        content: '';
        display: block;
        position: absolute;
        width: 14px;
        height: 14px;
        top: 45px;
        background: linear-gradient(#4c7273, #084b59);
        box-shadow: 0 0 5px rgba(0, 0, 0, .4);
        border-radius: 15px;
        z-index: 1;
    }

    .timeline .row.timeline-left .timeline-date::after {
        left: -7px;
    }

    .timeline .row.timeline-right .timeline-date::after {
        right: -7px;
    }

    .timeline .timeline-box,
    .timeline .timeline-launch {
        position: relative;
        display: inline-block;
        margin: 15px;
        padding: 20px;
        border: 1px solid #dddddd;
        border-radius: 6px;
        background: #ffffff;
    }

    .timeline .timeline-launch {
        width: 100%;
        margin: 15px 0;
        padding: 0;
        border: none;
        text-align: center;
        background: transparent;
    }

    .timeline .timeline-box::after,
    .timeline .timeline-box::before {
        content: '';
        display: block;
        position: absolute;
        width: 0;
        height: 0;
        border-style: solid;
    }

    .timeline .row.timeline-left .timeline-box::after,
    .timeline .row.timeline-left .timeline-box::before {
        left: 100%;
    }

    .timeline .row.timeline-right .timeline-box::after,
    .timeline .row.timeline-right .timeline-box::before {
        right: 100%;
    }

    .timeline .timeline-launch .timeline-box::after,
    .timeline .timeline-launch .timeline-box::before {
        left: 50%;
        margin-left: -10px;
    }

    .timeline .timeline-box::after {
        top: 26px;
        border-color: transparent transparent transparent #ffffff;
        border-width: 10px;
    }

    .timeline .timeline-box::before {
        top: 25px;
        border-color: transparent transparent transparent #dddddd;
        border-width: 11px;
    }

    .timeline .row.timeline-right .timeline-box::after {
        border-color: transparent #ffffff transparent transparent;
    }

    .timeline .row.timeline-right .timeline-box::before {
        border-color: transparent #dddddd transparent transparent;
    }

    .timeline .timeline-launch .timeline-box::after {
        top: -20px;
        border-color: transparent transparent #dddddd transparent;
    }

    .timeline .timeline-launch .timeline-box::before {
        top: -19px;
        border-color: transparent transparent #ffffff transparent;
        border-width: 10px;
        z-index: 1;
    }

    .timeline .timeline-box .timeline-icon {
        position: relative;
        width: 40px;
        height: auto;
        float: left;
    }

    .timeline .timeline-icon i {
        font-size: 25px;
        color: #4c7273;
    }

    .timeline .timeline-box .timeline-text {
        position: relative;
        width: calc(100% - 40px);
        float: left;
    }

    .timeline .timeline-launch .timeline-text {
        width: 100%;
    }

    .timeline .timeline-text h3 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 3px;
    }

    .timeline .timeline-text p {
        font-size: 14px;
        font-weight: 400;
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .timeline .timeline-continue::after {
            left: 40px;
        }

        .timeline .timeline-end,
        .timeline .timeline-start,
        .timeline .timeline-year,
        .timeline .row.timeline-left,
        .timeline .row.timeline-right .timeline-date,
        .timeline .row.timeline-right,
        .timeline .row.timeline-left .timeline-date,
        .timeline .timeline-launch {
            text-align: left;
        }

        .timeline .row.timeline-left .timeline-date::after,
        .timeline .row.timeline-right .timeline-date::after {
            left: 47px;
        }

        .timeline .timeline-box,
        .timeline .row.timeline-right .timeline-date,
        .timeline .row.timeline-left .timeline-date {
            margin-left: 55px;
        }

        .timeline .timeline-launch .timeline-box {
            margin-left: 0;
        }

        .timeline .row.timeline-left .timeline-box::after {
            left: -20px;
            border-color: transparent #ffffff transparent transparent;
        }

        .timeline .row.timeline-left .timeline-box::before {
            left: -22px;
            border-color: transparent #dddddd transparent transparent;
        }

        .timeline .timeline-launch .timeline-box::after,
        .timeline .timeline-launch .timeline-box::before {
            left: 30px;
            margin-left: 0;
        }
    }

    @media (max-width: 480px) {
        .navbar {
            margin-top: .25rem !important;
        }

        .navbar-brand {
            position: relative;
        }

        /* .navbar-brand img {
            height: 22rem !important;
            position: absolute;
            left: -16rem;
        } */

        .header {
            padding-bottom: 1.5rem !important;
            padding-top: 11rem !important;
        }

        .header-area {
            padding-top: 5.7rem !important;
        }

        .card-action-buttons {
            text-align: left;
            margin-top: 1rem;
        }

        .card-header h3 {
            font-size: 1.6rem;
            line-height: 1.2;
        }

        .timeline {
            padding: 0 0 2rem 0;
        }

        .timeline .container {
            padding: 0;
        }
    }
</style>
