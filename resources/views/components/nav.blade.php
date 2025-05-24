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
            <a href="{{ route('notification') }}"><i class="fa-solid fa-bell"></i><span
                    class="badge badge-pill unread-bell badge-danger">{{ $unReadNotiCount }}</span></a>
            @auth
                <img width="42" class="rounded-circle"
                    src="https://ui-avatars.com/api/?name={{ auth()->guard('web')->user()->name }}" alt="" />
            @endauth
        </div>
    </div>
</nav>
