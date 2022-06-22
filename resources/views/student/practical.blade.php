


<div class="page-header">

@if(!empty($fleet_schedule))
    @if($fleet_schedule->status == "completed")
        <a href="{{ route('instructor.evaluation', ['practical', $fleet_schedule->id, $fleet_schedule->instructor_id]) }} " class="btn btn-success btn-icon pull-right">
            <i class="mdi mdi-calendar-text"></i>
            Evaluate Instructor
        </a>
    @endif

 @endif
</div>

<div class="row">
    <div class="col-md-12">
        @if(!empty($fleet_schedule))
        <table class="table table-bordered ">

            <thead>
                <th>Instructor</th>
                <th>Make Model</th>
                <th>Model Year</th>
                <th>Car No</th>
                <th>Time start & end</th>
{{--                <th>Start</th>--}}
{{--                <th>End</th>--}}
                <th>Days</th>
                <th>Duration & Period</th>
            </thead>
            <tbody>

                <tr>
                    <td>{{ $fleet_schedule->fname }} {{ $fleet_schedule->lname }}</td>
                    <td>{{ $fleet_schedule->make }} {{ $fleet_schedule->model }}</td>
                    <td>{{ $fleet_schedule->model_year }} </td>
                    <td>{{ $fleet_schedule->car_no }} </td>
                    <td>  {{ date('h:i:s a', strtotime($fleet_schedule->time_start)) }} : {{ date('h:i:s a', strtotime($fleet_schedule->time_end)) }}</td>
{{--                    <td>{{ $fleet_schedule->start }} </td>--}}
{{--                    <td>{{ $fleet_schedule->end }} </td>--}}
                    <td>{{ $fleet_schedule->day }} </td>
                    <td>{{ $fleet_schedule->duration }}  {{ $fleet_schedule->period }} </td>
                </tr>

            </tbody>
        <table>



        <button class="btn btn-primary" id="print-fleet">Print</button>
                @else
                    @include("admin/empty/empty")
                @endif
    </div>
</div>
