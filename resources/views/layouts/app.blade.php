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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap"
          rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
{{--    <link rel="stylesheet" href="{{ asset('css/css/simcify.min.css') }}"/>--}}

    <style>

        html, body {
            /*background: linear-gradient(rgba(4, 9, 30, 0.7), rgba(4, 9, 30, 0.7)), url("/images/login.jpg");*/

            font-family: 'Poppins', sans-serif;

        }

        .card {
            border: 1px solid black;
            width: 70%;
            margin: auto;
        }

        .card-header {
            font-family: 'Poppins', sans-serif;
            font-size: 200%;
            color: #800000;
            text-align: center;
            background-color: #f5ad42;
        }

        .card-body {
            background-color: beige;
            font-family: 'Poppins', sans-serif;
            color: #0b1c4d;
        }

        #app {
            height: 100vh;
            overflow: auto;
        }
        #videoBG {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
        }
        @media (min-aspect-ratio: 16/9) {
            #videoBG {
                width: 100%;
                height: auto;
            }
        }
    </style>


</head>
<body>
<div id="app">


    <main class="py-4">

        @yield('content')
    </main>
</div>


{{--<script src="{{ asset('js/components/simcify.min.js') }}"></script>--}}
<video id="videoBG" autoplay muted loop>
    <source src="{{ asset("assets/video/v.mp4") }}" type="video/mp4">
</video>
</body>
</html>
