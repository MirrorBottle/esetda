@auth()
    @include('layouts.navbars.navs.auth', ['page_title' => $page_title])
@endauth

@guest()
    @if (request()->segment(1) == 'login')
        @include('layouts.navbars.navs.login')
    @else
        @include('layouts.navbars.navs.guest')
    @endif
@endguest
