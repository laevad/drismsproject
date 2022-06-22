@extends('layouts.header')
@section('content')
    @include("layouts/includes/sidebar")
<!-- main content -->
<div class="main-content">
    <div class="page-header">
        <h3> Update Instructor {{ $fleet->make }} Schedule</h3>
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


    @if (\Session::has('not_exists'))
        <div class="alert alert-danger">
            {!! \Session::get('not_exists') !!}
        </div>
    @endif

    <div>
        <form action="{{ route('fleet.form.update', $fleet->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <div class="row">

                    <div class="col-md-3 form-group">
                        <label>Time Start</label>
                        <input required type="time" class="form-control" name="time_start" value="{{ $fleet->time_start }}">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Time end</label>
                        <input required type="time" class="form-control" name="time_end" value="{{ $fleet->time_end }}">
                    </div>
                    <div class="col-md-6">
                        <label>Day</label>

                        @if (!empty($fleet->day))
                            @foreach(explode(',', $fleet->day) as $day)
                                {{ $day  }}
                            @endforeach
                        @endif

                            <select class="form-control select2" name="day[]" multiple="">
                                <option value="Monday"
                                @if (!empty($fleet->day))
                                    @foreach(explode(', ', $fleet->day) as $day)
                                        {{ $day == "Monday" ? 'selected' : '' }}
                                    @endforeach
                                @endif
                                >
                                Monday</option>
                                <option value="Tuesday"
                                @if (!empty($fleet->day))
                                    @foreach(explode(', ', $fleet->day) as $day)

                                        {{ $day == "Tuesday" ? 'selected' : '' }}

                                    @endforeach
                                @endif
                                >Tuesday</option>
                                <option value="Wednesday"
                                @if (!empty($fleet->day))
                                    @foreach(explode(', ', $fleet->day) as $day)
                                        {{ $day == "Wednesday" ? 'selected' : '' }}
                                    @endforeach
                                @endif
                                >Wednesday</option>
                                <option value="Thursday"
                                @if (!empty($fleet->day))
                                    @foreach(explode(', ', $fleet->day) as $day)
                                        {{ $day == "Thursday" ? 'selected' : '' }}
                                    @endforeach
                                @endif
                                >Thursday</option>
                                <option value="Friday"
                                @if (!empty($fleet->day))
                                    @foreach(explode(', ', $fleet->day) as $day)
                                        {{ $day == "Friday" ? 'selected' : '' }}
                                    @endforeach
                                @endif
                                >Friday</option>
                                <option value="Saturday"
                                @if (!empty($fleet->day))
                                    @foreach(explode(', ', $fleet->day) as $day)
                                        {{ $day == "Saturday" ? 'selected' : '' }}
                                    @endforeach
                                @endif
                                >Saturday</option>
                                <option value="Sunday"
                                @if (!empty($fleet->day))
                                    @foreach(explode(', ', $fleet->day) as $day)
                                        {{ $day == "Sunday" ? 'selected' : '' }}
                                    @endforeach
                                @endif
                                >Sunday</option>
                            </select>
                    </div>

                </div>
            </div>

{{--            <div class="form-group">--}}

{{--                <div class="row">--}}
{{--                    <div class="col-md-6">--}}
{{--                        <label>Start</label>--}}
{{--                        <input type="date" name="start" class="form-control"  required="" value="{{$fleet->start}}"/>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6">--}}
{{--                        <label>End</label>--}}
{{--                        <input type="date" name="end" class="form-control"  required="" value="{{$fleet->end}}"/>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label>Duration</label>
                        <input type="number" name="duration" class="form-control" placeholder="Duration" required="" value="{{$fleet->duration}}">
                    </div>

                    <div class="col-md-6">
                        <label>Period</label>
                        <select name="period" class="form-control" required="">
                            <option value="Days" {{ $fleet->period == "Days" ? 'selected' : '' }}>Days</option>
                            <option value="Weeks" {{ $fleet->period == "Weeks" ? 'selected' : '' }}>Weeks</option>
                            <option value="Months" {{ $fleet->period == "Months" ? 'selected' : '' }}>Months</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" value="Update Instructor Schedule"  class="btn btn-primary "/>
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


