@extends('layouts.header') 
@section('content')     
        <!-- Admin home page --> 
        <!-- sidebar -->  
    @include("layouts/includes/sidebar")     
<!-- main content -->
<div class="main-content">
    <div class="page-header">

    <a href="{{ route('fleet.form.show', $fleet_single->id)}}" class="btn btn-primary btn-icon pull-right ml-5 " >
        <i class=" mdi mdi-plus-circle-outline"> 
        </i> 
        Add Schedule
    </a>
       
        <h3>Schedule for {{ $fleet_single->make }} </h3> 
    </div>
 

    <!-- page content -->
    <div class="row">


        @if(!empty($fleets))
     
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
                    <th scope="col">Instructor</th>  
                    <th scope="col">Actions</th>  
                </tr>
            </thead>
            <tbody>

                @foreach($fleets as $key=>$val) 
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
                        <td>{{ $val->fname }} {{ $val->lname }} </td>   
                        <td>   
                            <a   
                                href="{{ route('fleet.form.edit', $val->id) }}"
                                class="btn btn-primary"
                            >  
                                <i class="mdi mdi-pencil"></i>  
                            </a> 
                            <form id="deleteFleetSchedule{{$val->id}}" action="{{ route('fleet.form.delete', $val->id)}}" method="POST">
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
                @endforeach
            </tbody>
        </table>
        @else 
            @include("admin/empty/empty")   
        @endif

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