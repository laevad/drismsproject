@extends('layouts.header') 
@section('content')     
        <!-- Admin home page --> 
        <!-- sidebar -->  
    @include("layouts/includes/sidebar")     
<!-- main content -->


<div class="main-content">
    <div class="page-header">
 
        <h1>Schedule for {{$user->role }} {{  ucfirst($user->fname) }} {{  ucfirst($user->lname) }}</h1>
   
    </div>
 

    <!-- page content -->
    <div class="row">
        <h3>School Schedule</h3>
 
 
        @if(!empty($school_course_instructors))  

            <table class="table table-borderless form-drisms">
                <thead>
                    <th>#</th>
                    <th>School</th>
                    <th>Branch</th>
                    <th>Course</th>
                    <th>Price</th>
                    <th>Days</th>
                    <th>Time Start & End</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Duration</th>
                    <th>Period</th>
                </thead>
                <tbody> 
                    @foreach($school_course_instructors as $key=>$val)
                        <tr> 
                            <td>{{ $key+1 }}</td>  
                            <td>{{ $val->s_name }}</td>  
                            <td>{{ $val->b_name }}</td>  
                            <td>{{ $val->c_name }}</td>  
                            <td> {{ $val->price }}</td>  
                            <td> {{ $val->days }} </td>  
                            <td> {{ $val->time_start_end }} </td>  
                            <td> {{ $val->start }} </td>  
                            <td> {{ $val->end }} </td>  
                            <td> {{ $val->duration }} </td>  
                            <td> {{ $val->period }} </td>  
                        </tr>   
                    @endforeach 
                </tbody>
            </table>  
        @else 
            @include("admin/empty/empty")   
        @endif 
    </div>





    <!-- page content -->
    <div class="row">
        <h3>Fleet Schedule</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Make</th>
                    <th scope="col">Car Number</th>
                    <th scope="col">Car Plate</th>
                    <th scope="col">Model</th>
                    <th scope="col">Model Year</th>
                    <th scope="col">Time start and Time end</th>
                    <th scope="col">Date Start</th>
                    <th scope="col">Date End</th>
                    <th scope="col">Day</th> 
                    <th scope="col">Duration</th> 
                    <th scope="col">Period</th>  
                    <th scope="col">Action</th>  
                </tr>
            </thead>
            <tbody>

                @forelse($fleets as $key=>$val)

                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $val->make }}</td> 
                        <td>{{ $val->car_no }}</td> 
                        <td>{{ $val->car_plate }}</td> 
                        <td>
                            {{ $val->model }}  
                        </td> 
                        <td>{{ $val->model_year }}</td> 
                        <td>{{ $val->time_start_end }}</td> 
                        <td>{{ $val->start }}</td> 
                        <td>{{ $val->end }}</td> 
                        <td>{{ $val->day }}</td>  
                        <td>{{ $val->duration }}</td>  
                        <td>{{ $val->period }}</td>    
                        <td>  

                            <a   
                                href="{{ route('fleet.form.edit', $val->id) }}"
                                class="btn btn-primary"
                            >  
                                <i class="mdi mdi-pencil"></i>  
                            </a>
  
                            <form id="deleteFleetSchedule{{$val->id}}" action="{{ route('fleet.form.delete', $val->id)}} " method="POST">
                                @csrf
                                @method('DELETE')  
                                <a  
                                    href="#"  
                                    class="btn btn-danger fs_delete " 
                                    rel="deleteFleetSchedule{{$val->id}}"
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
    $('.fs_delete').on('click touchstart', function(e){ 
        e.preventDefault();
        if(confirm("Are you sure to delete this Fleet schedule?")){ 
            $fleet_delete = $(this).attr('rel');
            $('#'+$fleet_delete).submit();
        } 
    })  
</script>


@endsection