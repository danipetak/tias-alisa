<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', config('app.name', 'Laravel'))</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <script src="{{ asset('js/jquery.js') }}"></script>
        @yield('header')
    </head>
    <body>
        <header>
            <div class="header">
                <div class="row">
                    <div class="col-2">
                        <a href="{{ route('index') }}">
                            <div class="header-title">
                                <img src="{{ asset('img/tias.png') }}">
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <div class="header-navigation">
                            @guest
                                <b>Totally Interconnect Accounting System</b>
                            @endguest
                            @auth
                                <a href="{{ route('index') }}">Home</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main>
            @guest
                @yield('content')
            @else
            <div class="container">
                <div class="row">
                    <div class="col-3 pr-1">
                        <div class="mb-2 pb-1 border-bottom">
                            Selamat Datang,
                            <div class="text-bold">{{ Auth::user()->name }}</div>
                            <a href="{{ route('index') }}">Home</a> |
                            <a href="{{ route('profil.index') }}">Profil</a> |
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                        @include('layouts.sidebar')
                    </div>

                    <div class="col pl-1">
                        @if (session('status') OR session('error'))
                            <div class="alert @if (session('status')) alert-success @endif @if (session('error')) alert-danger @endif" role="alert">
                                {{ session('status') }}
                                {{ session('error') }}
                            </div>
                        @endif
                        <div id="topbar-notification">
                            <div class="alert alert-success" style="display: none" id="notif-success"></div>
                            <div class="alert alert-danger" style="display: none" id="notif-error"></div>
                        </div>

                        <h1 class="page-title my-2">@yield('title')</h1>
                        @yield('content')
                    </div>
                </div>
            </div>
            @endguest
        </main>

        <footer>
            <div class="footer">
                &copy; 2020 - {{ date('Y') }}. ALISA IDN. <a href="https://pdki-indonesia.dgip.go.id/detail/EC00202001044?type=copyright&keyword=EC00202001044">Hak Cipta Dilindungi Undang-Undang</a>
            </div>
        </footer>

        @yield('footer')
    </body>
</html>
