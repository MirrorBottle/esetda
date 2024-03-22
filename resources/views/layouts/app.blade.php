@auth
    @php $user_type = auth()->user()->type_formatted @endphp
    @if ($user_type == 'esetda')
        @php $web_title = auth()->user()->biro->alias ." - E-SETDA KALTIM" @endphp
    @elseif ($user_type == 'eagenda')
        @php $web_title = "E-AGENDA KALTIM" @endphp
    @elseif ($user_type == 'earsip')
        @php $web_title = (auth()->user()->biro->alias ?? 'ADMIN') ." - E-ARSIP KALTIM" @endphp
    @else
        @php $web_title = 'SUPER ADMIN' @endphp
    @endif
@endauth

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $web_title ?? 'E-SETDA KALTIM' }}</title>
        <!-- Favicon -->
        <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('images/favicon.ico') }}"/>
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}"/>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v={{ time() }}" rel="stylesheet">
        @auth
            @if ($user_type == 'eagenda')
                <link type="text/css" href="{{ asset('css/eagenda.css') }}" rel="stylesheet">
            @elseif ($user_type == 'earsip')
                <link type="text/css" href="{{ asset('css/earsip.css') }}" rel="stylesheet">
        @elseif ($user_type == 'super')
            <link type="text/css" href="{{ asset('css/super.css') }}" rel="stylesheet">
            @endif
        @endauth
        @stack('css')
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
        @endauth

        <div class="main-content">
            @include('layouts.navbars.navbar', ['page_title' => $page_title ?? ''])
            @yield('content')
        </div>

        @guest()
            @include('layouts.footers.guest')
        @endguest

        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        @stack('js')

        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
        <script>
            $(function() {
                $(".alert").delay(4000).slideUp(200, function() {
                    $(this).alert('close');
                });

                const $lingkupSetda = $('#badge-lingkup-setda');
                if ($lingkupSetda.length) {
                    $.get("/count-forward", function(res) {
                        if (res.total > 0) {
                            $('#badge-lingkup-setda').text(res.total);
                            $('#badge-lingkup-setda').show();
                        }
                    });
                }

                const $tamuSetda = $('#badge-tamu-setda');
                if ($tamuSetda.length) {
                    $.get("/count-visitor", function(res) {
                        if (res.total > 0) {
                            $('#badge-tamu-setda').text(res.total);
                            $('#badge-tamu-setda').show();
                        }
                    });
                }
            });
        </script>

    </body>
</html>
