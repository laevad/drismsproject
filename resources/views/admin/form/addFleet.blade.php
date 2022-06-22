@extends('layouts.header')
@section('content')
    @include("layouts/includes/sidebar")
<!-- main content -->
<div class="main-content">
    <div class="page-header">
        <h3> Adding {{ $fleet->make }} Schedule</h3>
        <small> {{ $fleet->car_no }} {{ $fleet->car_plate }} {{ $fleet->model }} {{ $fleet->model_year }} </small>
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


    @if (\Session::has('exists'))
        <div class="alert alert-danger">
            {!! \Session::get('exists') !!}
        </div>
    @endif

    <div>
        <form action="{{ route('fleet.form.store') }}" method="post">
            @csrf

            <input type="hidden" value="{{$id}}" name="fleet_id"/>

            <div class="form-group">
                <div class="row">

                    <div class="col-md-3 form-group">
                        <label>Time Start</label>
                        <input required type="time" class="form-control" name="time_start">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Time end</label>
                        <input required type="time" class="form-control" name="time_end" >
                    </div>

                    <div class="col-md-6">
                        <label>Day</label>

                        <select class="form-control select2" name="day[]" multiple="">
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                    </div>

                </div>
            </div>


{{--            <div class="form-group">--}}

{{--                <div class="row">--}}
{{--                    <div class="col-md-6">--}}
{{--                        <label>Start</label>--}}
{{--                        <input type="date" name="start" class="form-control"  required=""/>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6">--}}
{{--                        <label>End</label>--}}
{{--                        <input type="date" name="end" class="form-control"  required=""/>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}


            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label>Duration</label>
                        <input type="number" name="duration" class="form-control" placeholder="Duration" required="">
                    </div>

                    <div class="col-md-6">
                        <label>Period</label>
                        <select name="period" class="form-control" required="">
                            <option value="Hours">Hours</option>
                            <option value="Days">Days</option>
                            <option value="Weeks">Weeks</option>
                            <option value="Months">Months</option>
                        </select>
                    </div>
                </div>
            </div>




            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label>Instructor</label>
                        @if(!empty($instructors))
                            <select class="form-control select2" name="instructor_id" id="select-instructor" required="">
                                <option value="">Select Instructors</option>
                                @foreach($instructors as $instructor)
                                    <option value="{{$instructor->id}}" @if($instructor->status == "Suspended" || $instructor->status == "Inactive") disabled @endif >{{ $instructor->fname }} {{ $instructor->lname }} ({{$instructor->status}})</option>
                                @endforeach
                            </select>
                        @else
                            <span class="alert alert-success">
                                <strong>Empty Instructors</strong>
                            </span>
                        @endif
                    </div>
                </div>

            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" value="Add Course"  class="btn btn-primary "/>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
    @include('../layouts/includes/footer')

<script>

</script>
@endsection


