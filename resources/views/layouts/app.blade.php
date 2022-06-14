<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Drisms') }}</title>
    <link rel="shortcut icon" href="{{ asset('/assets/images/icon.ico') }}">
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/css/simcify.min.css') }}" />

    <style>

        html, body{
            background: linear-gradient(rgba(4,9,30,0.7), rgba(4,9,30,0.7)), url("/images/login.jpg");
            font-family: 'Poppins', sans-serif;
            
        }
        .card{
            border: 1px solid black;
            width: 70%;
            margin: auto;
        }
        .card-header{
            font-family: 'Poppins', sans-serif;
            font-size: 200%;
            color: #800000;
            text-align: center;
            background-color: #f5ad42;
        }
        .card-body{
            background-color: #0b1c4d;
            font-family: 'Poppins', sans-serif;
            color:#fff;
        }
                
        #app{
            height: 100vh;
            overflow: auto;
        }
    </style>


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Drisms') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('student.register') }}">{{ __('Register') }}</a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Stafff Registration') }}</a>
                                </li>
    
    
    <!--<div class="text-center d-flex justify-content-center items-center " id="rg-select-opt" style="height:100vh "> -->
    <!--    <button class="btn btn-primary student-rg" >Student</button>-->
    <!--    <button class="btn btn-primary staff-rg">Staff</button>-->
    <!--</div>-->
    
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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


    <script src="{{ asset('js/components/simcify.min.js') }}"></script> 

</body>
</html>
