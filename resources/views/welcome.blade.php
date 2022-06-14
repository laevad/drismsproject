<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Drisms</title>
        <link rel="shortcut icon" href="{{ asset('/assets/images/icon.ico') }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('css/css/style.css') }}" />
        <!-- Styles -->
        <style>
            html, body {
                background: linear-gradient(rgba(4,9,30,0.7), rgba(4,9,30,0.7)), url("/images/driving.jpg");
                color: #636b6f;
                font-family: 'Poppins', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
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
                font-size: 84px;
            }

            .links > a {
                color: #fff;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
                color: #fff;
                font-size: 100px;
            }
            p{
                margin: 10px 4px;
                font-size: 14px;
                color: #fff;
            }
            .hero-btn{
                display: inline-block;
                text-decoration: none;
                color: #fff;
                border: 1px solid #fff;
                padding: 12px 34px;
                font-size: 13px;
                background: transparent;
                position: relative;
                cursor: pointer;
            }
            .hero-btn:hover{
                border: 1px solid #f44336;
                background: #f44336;
                transition: 1s;
            }
            #qrcode {
            width:160px;
            height:160px;
            margin-top:15px;
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
                    width:100%;
                    height: auto;
             }
}
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            @if (Route::has('login'))
                <div class="top-right links " style="color: white">
                    @auth
                        <a href="{{ url('/dashboard') }}">{{ __('Dashboard') }}</a>
                    @else
                            <a href="{{ route('login') }}">Login</a>
                        @if (Route::has('register'))
                            <!--<a href="{{ route('register') }}">Register</a>-->


                            <a href="{{ route('student.register') }}">Register</a>

                            <a href="{{ route('register') }}">Staff Registration</a>


                        @endif

                            <a href="{{ route('contact-us') }}">Contact Us</a>
                    @endauth
                </div>
            @endif
            <div class="content">
                <div class="title m-b-md">



                        <h1><b><i> DriSMS </i></b></h1>
                        <p> Designing your driving future. </p>
                </div>
            </div>
        </div>

        <script>


        // var qrcode = new QRCode("qrcode");

        //     function makeCode () {
        //     var elText = document.getElementById("text");

        //     if (!elText.value) {
        //         alert("Input a text");
        //         elText.focus();
        //         return;
        //     }

        //     qrcode.makeCode(elText.value);
        //     }

        //     makeCode();

        //     $("#text").
        //     on("blur", function () {
        //         makeCode();
        //     }).
        //     on("keydown", function (e) {
        //         if (e.keyCode == 13) {
        //         makeCode();
        //         }
        //     });

    </script>
    <video id="videoBG" autoplay muted loop>
        <source src="{{ asset("assets/video/v.mp4") }}" type="video/mp4">
    </video>
    </body>
</html>
