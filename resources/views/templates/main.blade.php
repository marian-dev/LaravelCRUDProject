<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="crsf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'User Management System') }}</title>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="#">{{ config('app.name', 'User Management System') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link {{ (request()->is('home')) ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ (request()->is('cars*')) ? 'active' : '' }}" href="{{ route('cars.index') }}">Cars</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (request()->is('drivers*')) ? 'active' : '' }}" href="{{ route('drivers.index') }}">Drivers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (request()->is('dashboard*')) ? 'active' : '' }}" href="{{ route('dashboard.index') }}">Dashboard</a>
                            </li>
                        @endauth
                   </ul>
                    <div class="form-inline my-2 my-lg-0" style="margin-left:auto;">
                        @if (Route::has('login'))
                            <div>
                                @auth
                                    <div class="dropdown">
                                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                                @csrf;
                                            </form>
                                        </div>
                                    </div>                                 
                                @else
                                    <a class="{{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                                    &nbsp;
                                    @if (Route::has('register'))
                                        <a class="{{ (request()->is('register')) ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                   </div>
                </div>
            </div>
        </nav>
        <main class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
            @yield('content')
        </main>
        <!-- JS -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        @yield('after_scripts')
    </body>
</html>
