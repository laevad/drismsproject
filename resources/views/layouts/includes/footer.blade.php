
<footer>
    <p class="text-center">&copy; {{ date("Y") }}  {{ env("APP_NAME") }}. All Rights Reserved.</p>
</footer>

<script src="{{ asset('js/components/popper.min.js') }}"></script>
<script src="{{ asset('js/components/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('libs/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{  asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/components/simcify.min.js') }}"></script>
<script src="{{ asset('js/components/app.js') }}"></script>
<script>
        $(document).ready(function(){


        if(window.location.href.indexOf("register") > -1) {
            // console.log("Registration");



            // $('#rg-select-opt > button.student-rg').on('click', function(){

            //     // $('.rg-form').removeClass('hidden');
            //     // $('#rg-select-opt').removeClass('d-flex');
            //     // $('#rg-select-opt').addClass('hidden');
            //     // $('#role').append($('<option>', {
            //     //     value: 'Student',
            //     //     text: 'Student'
            //     // }));
            //     window.location.href="register";
            // });


            // $('#rg-select-opt > button.staff-rg').on('click', function(){

            //     // $('.rg-form').removeClass('hidden');
            //     // $('.student-rg').addClass('hidden');

            //     // $('#rg-select-opt').removeClass('d-flex');
            //     // $('#rg-select-opt').addClass('hidden');
            //     // $('#role').append($('<option>', {
            //     //         value: 'Staff',
            //     //         text: 'Staff'
            //     //     },
            //     //     {
            //     //         value: 'Instructor',
            //     //         text: 'Instructor'
            //     //     }

            //     // ));

            //     window.location.href="student/registrer";
            // });


            // alert("your url contains the name franky");
        }else{

            function loadlink(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/admin/notify/') }}",
                    method: 'post',
                    timeout:3000,
                    data: {
                        _token: '{{csrf_token()}}'
                    },
                    success: function(result){

                        if(result.notifify == ""){
                            $('#notification').addClass('d-none');
                        }else{
                            $('#notification').removeClass('d-none');
                            $('#notification').html(result.notifify);
                        }
                    }
                });
            }
            loadlink(); // This will run on page load
            setInterval(function(){
                loadlink() // this will run after every 5 seconds
            }, 3000);

        }

    });
            // $( ".student-rg" ).click(function() {
            // alert("Hello World");
            // });


</script>
