<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar Search-->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <h2><a href="{{ route('order.index') }}" style="text-decoration: none;">Computer fix order management</a><h2>
                        </li>
                        <li class="nav-item">
                                <form method="get" action="{{ route('order.index') }}" style="width: 400px">
                                    <div class="row">
                                        <div class="col-8">
                                            @if (Cookie::get('search') !== null)
                                            <div class="input-group pr-1 rounded">
                                                <input type="search" name="search" value="{{ Cookie::get('search') }}" class="form-control rounded" placeholder="Search" aria-label="Search"
                                                aria-describedby="search-addon" />
                                        </div>
                                          @else
                                            <div class="input-group pr-1 rounded">
                                                    <input type="search" name="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                                                    aria-describedby="search-addon" />
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-danger" id="search-addon">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                        </li>
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (auth()->user()->admin)
                                        <a class="dropdown-item" href="{{ route('report.index') }}">
                                            {{ __('All reports') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.order.index') }}">
                                            {{ __('Orders for approval') }}
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('user.order') }}">
                                        {{ __('My orders') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('order.create', ) }}">
                                        {{ __('New order') }}
                                    </a>
                                    @if(!auth()->user()->admin )
                                        <a class="dropdown-item" href="{{ route('report.index' ) }}">
                                            {{ __('My reported orders') }}
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('user.setting.index' ) }}">
                                        {{ __('User settings') }}
                                    </a>
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
