@extends('layouts.header')
@section('content')
        <!-- Admin home page -->
        <!-- sidebar -->

    @include("layouts/includes/sidebar")

    <!-- main content -->
    <div class="main-content">
        <div class="page-header">
            <button type="button" class="btn btn-success btn-icon pull-right ml-5"  data-toggle="modal" data-target="#sendemail"><i class=" mdi mdi-email-outline"></i> Send Email </button>
            <button type="button" class="btn btn-primary btn-icon pull-right"  data-toggle="modal" data-target="#sendsms"><i class=" mdi mdi-message-text-outline"></i> Send SMS </button>
            <h3>Communication</h3>
        </div>

        @if( \Session::has('success'))
            <div class="alert alert-success">
                {!! \Session::get('success') !!}
            </div>
        @endif

        @if( \Session::has('error'))
            <div class="alert alert-danger">
                {!! \Session::get('error') !!}
            </div>
        @endif
        <!-- page content -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-0 " id="communication-content">

                        <ul class="nav nav-tabs" id="communication">
                            <li>
                                <a href="" class="active" rel="to-users">
                                    To Users
                                </a>
                            </li>
                            <li>
                                <a href="#" rel="to-branches">
                                    To Branches
                                </a>
                            </li>
                            <li>
                                <a href="#" rel="to-schools">
                                    To Schools
                                </a>
                            </li>
                        </ul>

                        <div class="table-responsive hidden d-block" id="to-users" style="height: 100vh">
                            <table class="table table-striped mb-0 mw-1000" id="data-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Receiver Users</th>
                                    <th>Status + Date</th>
                                    <th>Message</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @forelse($receiver_users as $key=>$value)

                                    @include("admin/read/communication")
                                    <tr>
                                        <th scope="row">{{ $key + 1}}</th>
                                        <td>
                                            @if($value->image_name)
                                                <img
                                                    src="{{ url('/images'). '/' .$value->image_name }} "
                                                    class="table-avatar communication-avatar img-responsive"
                                                >
                                            @else
                                                <img
                                                    src="{{ url('/assets/images/avatar.png') }} "
                                                    class="table-avatar communication-avatar img-responsive"
                                                >
                                            @endif
                                            <a href=""><strong>{{ $value->fname }} {{ $value->lname }}</strong></a>
                                            <span class="communication-contact">{{ $value->phone }}</span>
                                            <span class="badge badge-primary">{{ $value->type }}</span>
                                        </td>
                                        <td>
                                        {{  Str::limit($value->messages, 30) }}
                                        </td>
                                        <td class="text-center">
                                            <button
                                                class="btn btn-primary btn-sm btn-icon"
                                                data-toggle="modal"
                                                data-target="#read_message{{$value->id}}"
                                            >
                                                <i class=" mdi mdi-email-outline"></i>
                                                Read Message
                                            </button>

                                            <form class="d-inline" action="{{ route('communication.destroy', $value->cusb_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger btn-sm d-inline" type="submit">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>

                                            </form>

                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <th colspan="7">
                                                <p class="text-muted text-center">
                                                    It's empty here.
                                                </p>
                                            </th>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>


                        <div class="table-responsive hidden" id="to-branches"  style="height: 100vh">
                            <table class="table table-striped mb-0 mw-1000" id="data-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Receiver branches</th>
                                    <th>Status + Date</th>
                                    <th>Message</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse($branch_users as $key=>$value)

                                        @include("admin/read/communication")
                                        <tr>
                                            <th scope="row">{{ $key + 1}}</th>
                                            <td>
                                                <a href=""><strong>{{ $value->name }} </strong></a>
                                                <span class="communication-contact">{{ $value->phone }}</span>
                                                <span class="badge badge-primary">{{ $value->type }}</span>
                                            </td>
                                            <td>
                                            {{  Str::limit($value->messages, 30) }}
                                            </td>
                                            <td class="text-center">
                                                <button
                                                    class="btn btn-primary btn-sm btn-icon"
                                                    data-toggle="modal"
                                                    data-target="#read_message_{{$value->id}}"
                                                >
                                                    <i class=" mdi mdi-email-outline"></i>
                                                    Read Message
                                                </button>



                                            <form class="d-inline" action="{{ route('communication.destroy', $value->cusb_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger btn-sm d-inline" type="submit">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>

                                            </form>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <th colspan="7">
                                                    <p class="text-muted text-center">
                                                        It's empty here.
                                                    </p>
                                                </th>
                                            </tr>
                                        @endforelse

                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive hidden" id="to-schools" style="height: 100vh">
                            <table class="table table-striped mb-0 mw-1000" id="data-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Receiver schools</th>
                                    <th>Status + Date</th>
                                    <th>Message</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse($school_users as $key=>$value)

                                        @include("admin/read/communication")
                                        <tr>
                                            <th scope="row">{{ $key + 1}}</th>
                                            <td>
                                                <a href=""><strong>{{ $value->name }} </strong></a>
                                                <span class="communication-contact">{{ $value->phone }}</span>
                                                <span class="badge badge-primary">{{ $value->type }}</span>
                                            </td>
                                            <td>
                                            {{  Str::limit($value->messages, 30) }}
                                            </td>
                                            <td class="text-center">
                                                <button
                                                    class="btn btn-primary btn-sm btn-icon"
                                                    data-toggle="modal"
                                                    data-target="#read_message_{{$value->id}}"
                                                >
                                                    <i class=" mdi mdi-email-outline"></i>
                                                    Read Message
                                                </button>

                                                <form class="d-inline" action="{{ route('communication.destroy', $value->cusb_id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm d-inline" type="submit">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <th colspan="7">
                                                    <p class="text-muted text-center">
                                                        It's empty here.
                                                    </p>
                                                </th>
                                            </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>





    @include("admin/email/communication")
    @include("admin/sms/communication")

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
            $('#communication > li > a').on('click touchstart', function(e){
                e.preventDefault();

                var data = $(this).attr('rel');
                $('.active').removeClass('active');
                $(this).addClass('active');

                $('#communication-content > div.d-block').removeClass('d-block');
                $('#'+data).addClass('d-block');

            });
            $('#comm_send_mail').on('click touchstart', function(e){
                $('#comm_form').submit();
                $('div#loading').removeClass('hidden');
            });
            $('#comm_send_sms').on('click touchstart', function(e){
                $('#comm_form_sms').submit();
                $('div#loading').removeClass('hidden');
            });

        });
    </script>
@endsection
