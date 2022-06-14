@extends('layouts.header')
@section('content')
        <!-- Admin home page -->
        <!-- sidebar -->


    <!-- main content -->
    <div class="main-content">
        <div class="page-header">
            <h3>Communication</h3>
        </div>

        <!-- page content -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-0 " id="communication-content">



                         <form id="comm_form_sms" action="{{ route('communication_test.sms') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary btn-block" id="comm_send_sms" type="submit">Send SMS</button>
                                    </div>
                                </div>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>





    <div  class="right card-body p-0 hidden" id="loading">
        <div class="sub-loading" role="document">
            <div class="loader-demo-box">
                <div class="circle-loader"></div>
            </div>
        </div>
    </div>



    @include('../layouts/includes/footer')
    <script>
        $(document).ready(function() {
            // $('#communication > li > a').on('click touchstart', function(e){
            //     e.preventDefault();

            //     var data = $(this).attr('rel');
            //     $('.active').removeClass('active');
            //     $(this).addClass('active');

            //     $('#communication-content > div.d-block').removeClass('d-block');
            //     $('#'+data).addClass('d-block');

            // });
            // $('#comm_send_mail').on('click touchstart', function(e){
            //     $('#comm_form').submit();
            //     $('div#loading').removeClass('hidden');
            // });
            // $('#comm_send_sms').on('click touchstart', function(e){
            //     $('#comm_form_sms').submit();
            //     // $('div#loading').removeClass('hidden');
            // });

        });
    </script>
@endsection
