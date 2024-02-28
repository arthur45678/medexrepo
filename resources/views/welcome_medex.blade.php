<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Fanarjyan - national center of oncology</title>
        <!-- Styles -->
        <style>
            html, body {
                color: #636b6f;
                /* font-family: 'Nunito', sans-serif; */
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            body{
                background-image: url("assets/img/main/medex-logo2.jpg");
                background-repeat: no-repeat;
                background-size: 100% 100%;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                /* font-size: 84px; */
                font-size: 55px;
                max-width: 800px;
            }

            .links > a {
                color: #ffffff;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .mini-title{
                width: 100%;
                text-align: center;
                background-color: #1bccc1;
                margin-top: 97.2vh;
                text-transform: uppercase;
                color: #ffffff;
            }
            .top-logo{
                position: absolute;
                width: 100%;
                height: 9vh;
                background-color: #1bccc1;
                background-image: url("assets/img/main/fanarjyan-logo.png");
                background-repeat: no-repeat;
                background-size: 385px 62px;
            }

            @media (min-width: 500px) {
                body {
                width: 100%;
                overflow: hidden;
                background-image: url("assets/img/main/medex-logo2.jpg");
                background-repeat: no-repeat;
                }
                .top-logo{
                    height: 10.5vh;
                }
            }
                @media (min-width: 576px) {
                    .top-logo{
                    height: 10.5vh;
                    }
                }

                @media (min-width: 768px) {
                    .top-logo{
                    height: 10.5vh;
                    }
                }

                @media (min-width: 992px) {
                    .top-logo{
                    height: 10.5vh;
                    }
                }

                @media (min-width: 1200px) {
                    .top-logo{
                    height: 10.5vh;
                }
                    body {
                    width: 100%;
                    height: auto;
                    overflow: hidden;
                    background-size: cover;
                    }

                }
                @media (min-width: 1300px) {
                    .top-logo{
                    height: 9vh;
                }

                }
        </style>
    </head>
    <body>
    <div class="top-logo"></div>

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth

                        @can('view patients')
                        <a href="{{ url('/patients') }}">Հիվանդներ</a>
                        @endcan

                        @can('view users')
                        <a href="{{ url('/users') }}">Անձնակազմ</a>
                        @endcan

                        @hasrole('moderator')
                        <a href="{{ url('/admin') }}">Ադմին պանել</a>
                        @endhasrole

                    @else
                        <a href="{{ route('login') }}">Մուտք</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Գրանցվել</a>
                        @endif
                    @endauth

                </div>
            @endif
                <div class="mini-title">&copy;Webex Technologis llc</div>
                {{-- <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div> --}}
            </div>

        </div>

    </body>
</html>
