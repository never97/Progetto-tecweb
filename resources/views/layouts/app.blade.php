<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('Gestione aziendale', 'Gestione aziendale') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    @stack('scripts')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('Gestione aziendale', 'Gesione aziendale') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @if(Auth::user() !== null && Auth::user()->isAdmin())
                        {{--<li class="nav-item">
                            <a class="nav-link"
                               href="{{ URL::action('App\Http\Controllers\ProgettoController@index') }}">Progetti</a>
                        </li>--}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Project operations
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ URL::action('App\Http\Controllers\ProgettoController@index') }}">Crezione</a>
                                <a class="dropdown-item" href="{{ URL::action('App\Http\Controllers\AssegnazioneController@index') }}">Assegnazione</a>
                                <a class="dropdown-item" href="{{ URL::action('App\Http\Controllers\SchedaOreController@filter') }}">Statistiche</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ URL::action('App\Http\Controllers\ClienteController@index') }}">Clienti</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::action('App\Http\Controllers\UserController@index') }}">Utenti</a>
                        </li>
                    {{--
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::action('App\Http\Controllers\AssegnazioneController@index') }}">Assegnazione</a>
                        </li>
                        --}}
                    @endif
                        @if(Auth::user() !== null)

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Schede ore
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ URL::action('App\Http\Controllers\SchedaOreController@index') }}">Visualizza schede</a>
                                    <a class="dropdown-item" href="{{ URL::action('App\Http\Controllers\SchedaOreController@filterStat') }}">Statistiche</a>
                                </div>
                            </li>


                        @endif
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->cognome}} {{ Auth::user()->nome }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
