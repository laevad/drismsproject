@extends('layouts.header')
@section('content')
    <!-- Admin home page -->
    <!-- sidebar -->

    @include("layouts/includes/sidebar")

    @include("admin/modal/student")

    <!-- main content -->
    <div class="main-content">
        <div class="page-header">
            <button type="button" class="btn btn-success btn-icon pull-right toggle-search">
                <i class=" mdi mdi-filter-outline"></i>
                Filter & Search
            </button>
            <h3>Students</h3>
        </div>
        <!-- page content -->
        <div class="row">
            <!-- search & Filter -->
            <div class="col-md-12 search-filter" style="display: none;">
                <div class="card">
                    <form class="row" action="{{ route('student-search') }}" method="GET" role="search">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Search Name, Email or Phone</label>
                                <input type="text" class="form-control" placeholder="Search Name, Email or Phone"
                                       name="search">
                            </div>
                        </div>
{{--                        <div class="col-md-2">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="email">Gender</label>--}}
{{--                                <select class="form-control" name="gender">--}}
{{--                                    <option value="">Select Gender*</option>--}}
{{--                                    <option value="">All</option>--}}
{{--                                    <option value="Male">Male</option>--}}
{{--                                    <option value="Female">Female</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-icon btn-block btn-sm" type="submit">
                                <i class=" mdi mdi-filter-outline"></i>
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if (\Session::has('success'))
            <div class="alert alert-success">
                {!! \Session::get('success') !!}
            </div>
        @endif
        @if (\Session::has('error'))
            <div class="alert alert-danger">
                {!! \Session::get('error') !!}
            </div>
        @endif
        <div class="row">

            @forelse($students as $student)
                <!-- user grid -->
                <div class="col-md-4">
                    <div class="user-grid card">
                        <div class="user-grid-pic">
                            @if( !empty($student->image_name) )
                                <img src="
                    @if(file_exists(url('/images'). '/' .$student->image_name))
                        {{ url('/images'). '/' .$student->image_name }}
                    @else
                       {{ url('/images'). '/' .$student->image_name }}
                       @endif
                    " class="img-responsive">
                            @else
                                <img src="{{ url('/images/default.png') }} ">
                            @endif
                        </div>
                        <div class="user-grid-info">
                            <h5>{{ ucfirst($student->fname) }} {{ ucfirst($student->lname) }}</h5>
                            <p>{{ $student->courses }} </p>
                            <p>{{ $student->phone }}</p>
                        </div>
                        <div class="row user-grid-buttons">

                            <div class="col-md-6">
                                <a
                                    class="btn btn-primary btn-block"
                                    href="{{ route('profiles.show',$student->username)}}">

                                    Profile
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-default btn-block"
                                   href="{{ route('dashboard.show', $student->username) }}">
                                    Schedule
                                </a>
                            </div>

                            <div class="col-md-12 mt-2">

                                <button class="btn btn-success btn-block" {{$permission_status}} data-toggle="modal"
                                        data-target="#create{{ $student->id }}">
                                    Update Payment
                                </button>

                            </div>
                        </div>
                        <!-- <div class="user-grid-class-left">
                            <p class="text-success"><i class=" mdi mdi-counter"></i> student completed Class(es) Completed</p>
                        </div> -->
                    </div>
                </div>
            @empty
                @include("admin/empty/empty")
            @endforelse
        </div>
    </div>



    @include('../layouts/includes/footer')
    <script>
        //Hide Payment Method
        $('.paymentmethod').hide();
        //Conditionally show payment method
        $('.amountpaid').on('keyup', function () {
            if ($(this).val() > 0) {
                $('.paymentmethod').show();
                $('.method').attr('required', true);
            } else {
                $('.paymentmethod').hide();
                $('.method').attr('required', false);
            }
        });
    </script>

@endsection
