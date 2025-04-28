<!--
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            Laravel
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
             Left Side Of Navbar
            <ul class="navbar-nav me-auto">

            </ul>

            Right Side Of Navbar
            <ul class="navbar-nav ms-auto">
                Authentication Links
                @guest
                                        @if (Route::has('login'))
    <li class="nav-item">
                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
    @endif

                                        @if (Route::has('register'))
    <li class="nav-item">
                                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
    @endif
@else
    <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }}
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
-->

<nav class="navbar navbar-light bg-white shadow-sm">
    <div class="container">
        @if (!request()->is('/'))
            <i class="fa-solid fa-circle-arrow-left btn-back" style="font-size: 18px; color: #999999"></i>
        @endif
        <div class="mx-auto">
            <a class="navbar-brand" style="padding-left: 60px" href="{{ url('/') }}">
                @yield('header')
            </a>
        </div>
        <div class="user-info">
            <i class="fa-solid fa-bell"></i>
            @auth
                <img width="42" class="rounded-circle"
                    src="https://ui-avatars.com/api/?name={{ auth()->guard('web')->user()->name }}" alt="" />
            @endauth
        </div>
    </div>
</nav>
