<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google -->
    <meta name="google-site-verification" content="nsELjQgjVA1tvYjo4EUcMHRE1RSnoWFyxOQ9rceTpGc" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Days One" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/ab9551d5a4.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app" style="overflow: hidden;">
        <nav class="navbar navbar-expand-md mb-5 navbar-light border-bottom border-eviolet">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                            <a class="navbar-brand" href="/">
                            <img src="{{ url('img/vlast.png')}}" width="30" height="30" class="d-inline-block align-top" alt="">
                            V-End
                        </a>
                        @else
                            <a class="navbar-brand" href="/dashboard">
                            <img src="{{ url('img/vlast.png')}}" width="30" height="30" class="d-inline-block align-top" alt="">
                            V-End
                        </a>
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item mx-1 shadow-sm rounded">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('nav.login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('dashboard') }}" class="dropdown-item">{{ __('nav.dashboard') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('nav.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<footer>
    {{-- <div class="row justify-content-center">
        <div class="d-flex h-100 align-items-center text-lg-left my-auto">
            <p class="text-muted small mb-4 mb-lg-0">&copy; {{ __('nav.copyright')}}</p>
        </div>
    </div> --}}

  <div class="footer-copyright text-center py-3">
    <a href="https://127.0.0.1:8000"> V-End</a>
    © 2021 {{__('nav.copyright')}}
  </div>
</footer>
</html>
