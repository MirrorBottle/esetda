<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \App\Setting::getValue('app_name_short') }} - {{ \App\Setting::getValue('app_name') }}</title>
    <link rel="shortcut icon" href="{{ asset('images/' . \App\Setting::getValue('favicon')) }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <style>
        body {
            font-size: .9rem;
        }

        .app-header {
            background: #3a4248;
            border-bottom: 0;
        }

        .app-header .navbar-brand {
            width: 240px;
        }

        .sidebar {
            background: #fff;
        }

        .sidebar-fixed .sidebar, .sidebar .sidebar-nav, .sidebar .nav {
            width: 240px;
        }

        html:not([dir=rtl]) .sidebar-lg-show.sidebar-fixed .app-footer, html:not([dir=rtl]) .sidebar-lg-show.sidebar-fixed .main, html:not([dir=rtl]) .sidebar-show.sidebar-fixed .app-footer, html:not([dir=rtl]) .sidebar-show.sidebar-fixed .main {
            margin-left: 240px;
        }

        .nav-link {
            color: #3a4248 !important;
            transition: ease-in-out .2s;
        }

        .nav-link.active {
            background: #4dbd74 !important;
            color: #fff !important;
        }

        .nav-link:hover {
            background: #44ab68 !important;
            color: #fff !important;
        }

        .nav-link.active .nav-icon {
            color: #fff !important;
        }

        .logo-sidebar {
            width: 40%;
            display: block;
            margin: 2rem auto;
        }

        .intro-text {
            font-size: 1.2rem;
            margin-top: .5rem;
            color: #fff;
            text-transform: uppercase;
        }

        #top-navbar li {
            margin: 0 1rem;
        }
        #top-navbar li a {
            color: #fff;
            font-size: 1.2rem;
            transition: ease-in-out .3s;
        }
        #top-navbar li a:hover {
            color: #4dbd74;
        }

        .nav-tabs {
            border-bottom: 4px solid #e2e2e2;
        }

        .nav-tabs .nav-link.active {
            border-color: #4dbd74;
            border-bottom: 3px solid #3d985d;
        }
    </style>
    @stack('css')
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed pace-done sidebar-lg-show">
    <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand text-white" href="{{ url('/') }}">
            <span class="navbar-brand-full">
                @php $split_app = explode("-", \App\Setting::getValue('app_name_short')); @endphp
                {{ $split_app[0] }}-<b>{{ $split_app[1] }}</b>
            </span>
            <span class="navbar-brand-minimized">{{ $split_app[0][0] . $split_app[1][0] }}</span>
        </a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="intro-text">{{ \App\Setting::getValue('app_name') }}</h1>

        <ul class="nav navbar-nav ml-auto mr-3" id="top-navbar">
            <li>
                <a href="{{ \App\Setting::getValue('facebook') }}" target="_blank">
                    <i class="fa fa-facebook"></i>
                </a>
            </li>
            <li>
                <a href="{{ \App\Setting::getValue('twitter') }}" target="_blank">
                    <i class="fa fa-twitter"></i>
                </a>
            </li>
            <li>
                <a href="{{ \App\Setting::getValue('instagram') }}" target="_blank">
                    <i class="fa fa-instagram"></i>
                </a>
            </li>
            <li>
                <a href="mailto:{{ \App\Setting::getValue('email') }}" target="_blank">
                    <i class="fa fa-envelope-o"></i>
                </a>
            </li>
        </ul>
    </header>

    <div class="app-body">
        @include('partials.menu_guest')
        <main class="main">

            <div style="padding-top: 20px" class="container-fluid">
                @yield('content')
            </div>

        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
    @if ( Request::is('daftar-statistik') || Request::is('daftar-kerjasama') )
        <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    @endif
    @stack('js')
</body>

</html>
