@extends('layouts.header')
@section('content')
    @include("layouts/includes/sidebar")
    <!-- main content -->
    <div class="main-content">
        <div class="page-header">

            @foreach($schools as $school)
                @if($school->id == $school_courses->school_id)
                    <h3>{{ $school->name }}</h3>
                @endif
            @endforeach
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

        @if (\Session::has('exist'))
            <div class="alert alert-danger">
                {!! \Session::get('exist') !!}
            </div>
        @endif

        <form action="{{ route('school.course.update', $id)}}" method="post">
            @csrf
            <input type="hidden" value="{{$id}}" name="school_id"/>

            <div class="form-group">
                <div class="row">

                    <div class="col-md-3 form-group">
                        <label>Time Start</label>
                        <input required type="time" class="form-control" name="time_start" value="{{ $school_courses->time_start }}">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Time end</label>
                        <input required type="time" class="form-control" name="time_end" value="{{ $school_courses->time_end }}">
                    </div>

                    <div class="col-md-6">
                        <label>Day</label>

                        <select required class="form-control select2" name="day[]" multiple="">
                            <option value="Monday"
                            @if (!empty($days->day))
                                @foreach(explode(', ', $days->day) as $day)
                                    {{ $day == "Monday" ? 'selected' : '' }}
                                    @endforeach
                                @endif
                            >
                                Monday</option>
                            <option value="Tuesday"
                            @if (!empty($days->day))
                                @foreach(explode(', ', $days->day) as $day)

                                    {{ $day == "Tuesday" ? 'selected' : '' }}

                                    @endforeach
                                @endif
                            >Tuesday</option>
                            <option value="Wednesday"
                            @if (!empty($days->day))
                                @foreach(explode(', ', $days->day) as $day)
                                    {{ $day == "Wednesday" ? 'selected' : '' }}
                                    @endforeach
                                @endif
                            >Wednesday</option>
                            <option value="Thursday"
                            @if (!empty($days->day))
                                @foreach(explode(', ', $days->day) as $day)
                                    {{ $day == "Thursday" ? 'selected' : '' }}
                                    @endforeach
                                @endif
                            >Thursday</option>
                            <option value="Friday"
                            @if (!empty($days->day))
                                @foreach(explode(', ', $days->day) as $day)
                                    {{ $day == "Friday" ? 'selected' : '' }}
                                    @endforeach
                                @endif
                            >Friday</option>
                            <option value="Saturday"
                            @if (!empty($days->day))
                                @foreach(explode(', ', $days->day) as $day)
                                    {{ $day == "Saturday" ? 'selected' : '' }}
                                    @endforeach
                                @endif
                            >Saturday</option>
                            <option value="Sunday"
                            @if (!empty($days->day))
                                @foreach(explode(', ', $days->day) as $day)
                                    {{ $day == "Sunday" ? 'selected' : '' }}
                                    @endforeach
                                @endif
                            >Sunday</option>
                        </select>
                    </div>

                </div>
            </div>


            <div class="form-group">

                <div class="row">
                    <div class="col-md-6">
                        <label>Start</label>
                        <input type="date" name="start" class="form-control" required="" value="{{ $school_courses->start }}"/>
                    </div>
                    <div class="col-md-6">
                        <label>End</label>
                        <input type="date" name="end" class="form-control" required="" value="{{ $school_courses->end }}"/>
                    </div>

                </div>
            </div>


            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label>Duration</label>
                        <input type="number" name="duration" class="form-control" placeholder="Duration" required="" value="{{ $school_courses->duration }}">
                    </div>

                    <div class="col-md-6">
                        <label>Period</label>
                        <select name="period" class="form-control" required="" >
                            <option value="Hours" {{ $school_courses->period == "Days" ? 'selected' : '' }}>Hours</option>
                            <option value="Days" {{ $school_courses->period == "Days" ? 'selected' : '' }}>Days</option>
                            <option value="Weeks" {{ $school_courses->period == "Weeks" ? 'selected' : '' }}>Weeks</option>
                            <option value="Months" {{ $school_courses->period == "Months" ? 'selected' : '' }}>Months</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    @if(!empty($courses))
                        <div class="col-md-3">

                            <label>Course</label>
                            <select class="form-control select2" name="course_id" id="select-course" required="">
                                <option value="">Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{$course->id}}" {{ $school_courses->course_id == $course->id ? 'selected' : '' }}>{{ $course->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <span class="alert alert-success">
                        <strong>Empty Course</strong>
                    </span>
                    @endif

                    @if(!empty($instructors))
                        <div class="col-md-3">
                            <label>Instructor</label>
                            <select class="form-control select2" name="instructor_id" id="select-instructor"
                                    required="">
                                <option value="">Select Instructors</option>
                                @foreach($instructors as $instructor)
                                    <option value="{{$instructor->id}}" {{ $school_courses->instructor_id == $instructor->id ? 'selected' : '' }}
                                            @if($instructor->status == "Suspended" || $instructor->status == "Inactive") disabled @endif >{{ $instructor->fname }} {{ $instructor->lname }}
                                        ({{$instructor->status}})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <span class="alert alert-success">
                        <strong>Empty Instructors</strong>
                    </span>
                    @endif

                    @if(!empty($branches))
                        <div class="col-md-6">
                            <label>Branch</label>
                            <select class="form-control select2" name="branch_id" id="select-branch" required="">
                                <option value="">Select Branch</option>
                                @foreach($branches as $branch)
                                    <option
                                        value="{{$branch->id}}" {{ $school_courses->branch_id == $branch->id ? 'selected' : '' }}> {{$branch->name}} ( {{  $branch->address }} )</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <span class="alert alert-success">
                        <strong>Empty Branch</strong>
                    </span>
                    @endif
                </div>
            </div>


            <div class="hidden" id="school-course-table">
                <table class="table">
                    <tbody>
                    <tr>
                        <th scope="row">Course:</th>
                        <td class="sc-title"></td>
                    </tr>
                    <tr>
                        <th scope="row">Price</th>
                        <td class="sc-price"></td>
                    </tr>
                    <tr>
                        <th scope="row">Status</th>
                        <td class="sc-status"></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" value="Update Course" class="btn btn-primary btn-block"/>
                    </div>
                </div>
            </div>
        </form>

    </div>
    @include('../layouts/includes/footer')

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });


        $('#select-course').on('change', function (e) {
            e.preventDefault();


            var data1 = $(this).val();

            var url = '{{ route("course.show", ":id") }}';
            url = url.replace(':id', data1);

            $.ajax({
                url: url,
                method: 'get',
                data: {
                    _token: '{{csrf_token()}}'
                },
                success: function (result) {
                    $('#school-course-table').removeClass('hidden');
                    $('.sc-title').text(result.name);
                    $('.sc-price').text(result.price);
                    $('.sc-status').text(result.status);
                }
            });

        })


    </script>
@endsection


