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
                /*background: linear-gradient(rgba(4,9,30,0.7), rgba(4,9,30,0.7)), url("/images/driving.jpg");*/
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
                color: black;
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




            /*contact us*/

            .location{
            	width: 80%;
            	margin: auto;
            	padding: 80px 0;
            }

            .location iframe{
            	width: 100%;
            }
            .contact-us{
            	width: 80%;
            	margin: auto;
            }
            .contact-col{

            	flex-basis: 48%;
            	margin-bottom: 30px;
            }

            .contact-col div{
            	display: flex;
            	align-items: center;
            	margin-bottom: 40px;
            }

            .contact-col div .fa{
            	font-size: 28px;
            	color: #f44336;
            	margin-left: 60px;
            	margin-right: 30px;
            }

            .contact-col div p {
            	padding: 0;
            }

            .contact-col div h5{
            	margin-bottom: 5px;
            	color: #555;
            }

            .contact-col input, .contact-col textarea{
            	width: 80%;
            	padding: 15px;
            	margin-bottom: 17px;
            	outline: none;
            	border: 1px solid #ccc;
            }

            .red-btn{
            	border: 1px solid #f44336;
            	background: transparent;
            	color: #f44336;
            	display:block;
            }

            .red-btn:hover{
            	color: #fff;
            }
            #videoBG {
                position: absolute;
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

       <div class="flex-center position-ref full-height">

            @if (Route::has('login'))
                <div class="top-right links " style="color: white">
                    @auth
                        <a href="{{ url('/dashboard') }}">{{ __('Dashboard') }}</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        @if (Route::has('student.register'))
                            <a href="{{ route('student.register') }}">Register</a>
                        @endif

                            <a href="{{ route('contact-us') }}">Contact Us</a>
                    @endauth
                </div>
            @endif
            <div class="content">
                <div class="title m-b-md">
                        <h1>Contact us</h1>
                    <video id="videoBG" autoplay muted loop>
                        <source src="{{ asset("assets/video/v.mp4") }}" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>




<!-- Contact us -->



<section class="location">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3946.148636760592!2d124.65454881427385!3d8.484925099610052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32fff2c3ca5ae8c7%3A0x880805868ab84491!2sUniversity%20of%20Science%20and%20Technology%20of%20Southern%20Philippines!5e0!3m2!1sen!2sph!4v1635686584624!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</section>

<section class="contact-us">
	<div class="row">
		<div class="contact-col">
			<div>
				<i class="fa fa-home"></i>
				<span>
					<h5>CM Recto Avenue, Lapasan</h5>
					<p>9000 Cagayan De Oro City</p>
				</span>
			</div>

			<div>
				<i class="fa fa-phone"></i>
				<span>
					<h5>+639066624939</h5>
					<p>Monday to Saturday, 8:00am-5:00pm</p>
				</span>
			</div>
			<div>
				<i class="fa fa-envelope-o"></i>
				<span>
					<h5>info@drisms.com</h5>
					<p>email us your query</p>
				</span>
			</div>
		</div>

    	<div class="contact-col">
            @if(\Session::has('sendEmailMs'))
                <div class="alert alert-success">
                    {!! \Session::get('sendEmailMs') !!}
                </div>
            @endif




				<form action="{{ route('sendEmail') }}" method="post">
				         @csrf

					<input type="text" placeholder="Enter your name" name="name" required>
					<input type="email" placeholder="Enter Email Address" name="email" required>
					<input type="text" placeholder="Enter Subject" name="subject" required>
					<textarea rows="8" placeholder="Message" name="message" required> </textarea>

					<button type="submit" class="hero-btn red-btn"> Submit</button>


				</form>

		</div>

	</div>
</section>





<!-- Javacript toggle menu-->
	<script>

		function showMenu(){
			document.getElementbyId("navLinks").style.right = "200px";

		}
		function hideMenu(){
			document.getElementbyId("navLinks").style.right = "0px";

		}

	</script>

</body>
</html>
