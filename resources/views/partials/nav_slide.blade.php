<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('images/favicons/favicon-96x96.png')  }}" alt="logo" style="height: 4.2rem;">
        <span style="font-size: 2.5rem; color: #444; margin-top: 1rem; margin-left: 1rem; float: right; display: block;">EKSPERIMEN APP</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            @if (auth()->user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin') }}">Dashboard Admin</a>
                </li>
            @endif
        </ul>

        <ul class="mt-3">
            <li>
                <p class="ml-3">
                    <i class="fa fa-user-circle"></i>&nbsp; {{ Auth::user()->name }}
                </p>
            </li>
            <li>
                <a class="nav-link mt-3 ml-0" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();"">Logout</span></a>
                <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
</nav>
