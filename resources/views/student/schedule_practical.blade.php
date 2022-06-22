@extends('layouts.header')
@section('content')
    @include("layouts/includes/sidebar")

    <style>

        ul li{
            list-style: none;
        }
        .form-drisms tbody tr td{
            padding-top: 0px !important;
            padding-bottom: 0px !important
        }
        .form-drisms tbody tr{
            background-color:white !important;
        }
    </style>


<div class="main-content">
    <div class="page-header">
        <h3>Your Schedule for fleet</h3>
    </div>
    <!-- students growth -->

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

    <div class="alert alert-danger">NOTE: REGISTRATION FEE OF P3000 IS NON-REFUNDABLE</div>
    <div class="row">
        <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No. </th>
                            <th scope="col">Instructor</th>
                            <th scope="col">Make and Model</th>
                            <th scope="col">Model Year</th>
                            <th scope="col">Car Number</th>
                            <th scope="col">Car Plate</th>
                            <th scope="col">Time Start & End</th>
{{--                            <th scope="col">Date Start</th>--}}
{{--                            <th scope="col">Date End</th>--}}
{{--                            <th scope="col">Days</th>--}}
{{--                            <th scope="col">Duration & Period</th>--}}
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse($fleet_schedules as $key => $val)

                            <form action="{{route('student.fleet.form.update', $val->id)}}" method="POST">

                                @csrf
                                @method('PUT')
                                <input type="hidden" name="_student_id" value="{{ Auth::user()->id }}" />
                                    <tr>
                                        <td> {{ $key + 1 }} </td>
                                        <td>{{ $val->fname }} {{ $val->lname }}</td>
                                        <td>{{ $val->make }} {{ $val->model }} </td>
                                        <td>{{ $val->model }}</td>
                                        <td>{{ $val->car_no }}</td>
                                        <td>{{ $val->car_plate }}</td>
                                        <td>{{ $val->time_start }} - {{ $val->time_end }}</td>
{{--                                        <td>{{ $val->start }}</td>--}}
{{--                                        <td>{{ $val->end }}</td>--}}
{{--                                        <td>{{ $val->day }}</td>--}}
                                        <td>{{ $val->duration }} {{ $val->period }}</td>
                                        <td>  <input type="submit" value="Register" class="btn btn-primary  " @if( Auth::user()->enrollment_status != null ) disabled @endif  > </td>

                                    </tr>

                            </form>
                        @empty
                        @endforelse
                    <tbody>
                </table>


        </div>
    </div>





</div>


@include('../layouts/includes/footer')

<script>
</script>
@endsection
