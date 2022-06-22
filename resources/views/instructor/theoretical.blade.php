<div class="row">
    <div class="col-md-12">
        <table class="border borderless table">
            <thead>

                <th>#</th>
                <th>Name</th>
                <th>Day</th>
                <th>time start and end</th>
{{--                <th>Start Date</th> --}}
{{--                <th>End Date</th> --}}
                <th>Duration</th>
                <th>Period</th>
                <th>Course Name</th>
                <th>School Name</th>
                <th>Action</th>
            </thead>
            <tbody>
                @forelse($instructor_school_course as $key=>$val)

                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $val->c_name}}  </td>
                    <td>{{ $val->day}}  </td>
                    <td>{{ date('h:i:s a', strtotime($val->time_start)) }} - {{ date('h:i:s a', strtotime($val->time_end)) }} </td>
{{--                    <td>{{ $val->start}}  </td>--}}
{{--                    <td>{{ $val->start}}  </td>--}}
{{--                    <td>{{ $val->end}}  </td>--}}
                    <td>{{ $val->duration}}  </td>
                    <td>{{ $val->period}}  </td>
                    <td>{{ $val->c_name}}  </td>
                    <td>{{ $val->s_name}}  </td>
                    <td> <a href ="{{ route('theoretical.instructor.view.student', $val->id)}}" class="btn btn-primary">View Student</a> </td>
                </tr>
                @empty
                    @include("admin/empty/empty")
                @endforelse
            </tbody>
        </table>
    <div>
</dov>
