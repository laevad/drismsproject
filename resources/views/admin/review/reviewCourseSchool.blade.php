@extends('layouts.header')
@section('content')
        <!-- Admin home page -->
        <!-- sidebar -->

    @include("layouts/includes/sidebar")



<!-- main content -->
<div class="main-content">
    <div class="page-header">

    <a href="{{ route('school.course.add', $id) }}" class="btn btn-primary btn-icon pull-right ml-5 {{ $permission_status }}" >
        
        <i class=" mdi mdi-plus-circle-outline" style="position: relative">

        </i>
        Add Course
    </a>

        <h3>List of School Course</h3>
    </div>


    <!-- page content -->
    <div class="row">

        <table class="table table-striped" style="background-color:white;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Day</th>
{{--                    <th scope="col">Time</th>--}}
{{--                    <th scope="col">Start</th>--}}
{{--                    <th scope="col">End</th>--}}
                    <th scope="col">Duration</th>
                    <th scope="col">Period</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @forelse($school_corses as $key=>$val)

                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $val->name }}</td>
                        <td>{{ $val->price }}</td>
                        <td>{{ $val->status }}</td>
                        <td>
                            {{ $val->day }}
                        </td>
{{--                        <td>{{ $val->time_start_end }}</td>--}}
{{--                        <td>{{ $val->start }}</td>--}}
{{--                        <td>{{ $val->end }}</td>--}}
                        <td>{{ $val->duration }}</td>
                        <td>{{ $val->period }}</td>

                        <td>
                            <a
                                href="{{ route("school.course.edit", $val->id) }}"
                                class="btn btn-primary"
                            >
                                <i class="mdi mdi-pencil"></i>
                            </a>
                            <form id="deleteSC{{$val->id}}" action="{{ route('school.scDelete', $val->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a
                                    href="#"
                                    class="btn btn-danger sc_delete {{ $permission_status }} {{ $permission_delete }} "
                                    rel="deleteSC{{$val->id}}"
                                >
                                    <i class="mdi mdi-delete"></i>
                                </a>
                            </form>
                        </td>
                    </tr>

                @empty
                    @include("admin/empty/empty")
                @endforelse
            </tbody>
        </table>


    </div>

</div>

@include('../layouts/includes/footer')


<script>
    $('.sc_delete').on('click touchstart', function(e){
        e.preventDefault();
        if(confirm("Are you sure to delete this School?")){
            $sc_delete = $(this).attr('rel');
            $('#'+$sc_delete).submit();
        }
    })
</script>


@endsection
