<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        {{
            $title
        }}

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=Nunito"
            rel="stylesheet"
        />

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
            rel="stylesheet"
        />

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <script
            src="https://kit.fontawesome.com/225a355f8f.js"
            crossorigin="anonymous"
        ></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            body {
                background-color: #f0f1f3;
                font-family: "Open Sans", sans-serif;
                font-optical-sizing: auto;
                font-weight: 500;
                font-style: normal;
                font-variation-settings: "wdth" 100;
            }

            .fa-solid {
                cursor: pointer;
            }

            .fa-solid:hover {
                color: #51ccff;
                transition: 0.2s;
            }

            .bot-menu {
                background-color: #ffffff;
                bottom: 0;
                position: fixed;
                left: 0;
                right: 0;
                display: flex;
                justify-content: space-around;
                align-items: center;
                margin: 0 auto;
                max-width: 900px;
                border-radius: 10px 10px 0 0;
            }

            .icon-menu {
                padding: 10px 10px;
                display: flex;
                flex-direction: column;
                cursor: pointer;
                align-items: center;
            }

            .icon-menu:hover i {
                color: #3629b7;
                transition: 0.2s;
            }

            .icon-menu:hover span {
                color: #51ccff;
                transition: 0.2s;
            }

            .font-icon {
                font-size: 18px;
                color: #999999;
            }

            a span {
                color: #999999;
            }

            .fa-bell {
                font-size: 18px;
                color: blue;
            }

            .navbar {
                margin: 0 auto;
                max-width: 900px;
                position: sticky;
                top: 0;
                z-index: 999;
            }

            .user-info {
                width: 100px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            a {
                text-decoration: none;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .profile {
                text-align: center;
            }

            .profile img {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                padding: 5px;
                border: 1px solid #ddd;
                background-color: #ffffff;
            }

            .main {
                max-width: 900px;
                margin: 0 auto;
            }

            .text-select {
                cursor: pointer;
                user-select: none;
            }
        </style>
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
            $(document).ready(function () {
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
            });
        </script>
        @yield('script')
    </body>
</html>
