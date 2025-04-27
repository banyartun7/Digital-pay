<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{ $title }}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/225a355f8f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body>
    <div id="app">
        <x-nav />

        <main class="main py-4">
            {{ $slot }}
        </main>
        <x-front-footer />
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        $(document).ready(function() {
            let token = document.head.querySelector(
                'meta[name="csrf-token"]'
            );
            if (token) {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF_TOKEN": token.content,
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                });
            }

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            @if (session('create'))
                Toast.fire({
                    icon: "success",
                    title: "{{ session('create') }}"
                });
            @endif

            $('.btn-back').on('click', function(e) {
                e.preventDefault();
                window.history.go(-1);
                return false;
            })
        });
    </script>
    @yield('script')
</body>

</html>
