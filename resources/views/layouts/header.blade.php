<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Drisms') }}</title>
    <link rel="shortcut icon" href="{{ asset('/assets/images/icon.ico') }}">

{{--    <link rel="stylesheet" href="{{ asset('css/css/simcify.min.css') }}" />--}}
     <!-- Material design icons -->
    <link rel="stylesheet" href="{{ asset('css/fonts/mdi/css/materialdesignicons.min.css') }}" />
    <link href="{{ asset('libs/dropify/css/dropify.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('libs/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/css/style.css') }}" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    <style>

        html, body{
            font-family: 'Poppins', sans-serif;
        }


        .reg_card{
            background-color: #0b1c4d;
            font-family: 'Poppins', sans-serif;
            color:#fff;
        }
        .reg_card-header{
            font-family: 'Poppins', sans-serif;
            font-size: 200%;
            color: #800000;
            text-align: center;
            background-color: #f5ad42;
        }

        #app{
            height: 100vh;
            overflow: auto;
        }

        #loading{
            position: absolute;
            right: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0, 0.3);
            z-index: 9999;
        }
        .sub-loading{
            position: relative;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
        .hidden{
            display: none;
        }
        .active{
        animation: fade-action 2s;
            display: block !important;
        }
        @keyframes fade-action {
        /* You could think of as "step 1" */
            0% {
                opacity: 0;
            }
            /* You could think of as "step 2" */
            100% {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <main class="">
            @yield('content')
        </main>
    </div>


</body>
</html>
