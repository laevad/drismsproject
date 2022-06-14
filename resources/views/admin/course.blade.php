@extends('layouts.header') 
@section('content')     
        <!-- Admin home page --> 
        <!-- sidebar --> 

@include("layouts/includes/sidebar")   

@include("admin/modal/course")    

<!-- main content --> 
<div class="main-content"> 
    <div class="page-header">
        <button 
            type="button" 
            class="btn btn-primary btn-icon pull-right ml-5" 
            data-toggle="modal" 
            data-target="#create"

            {{ $permission_status }}
            {{ $permission_delete }}

            >
            <i class=" mdi mdi-plus-circle-outline"></i> 
            Add Course 
        </button>
        <h3>Courses</h3>
        <p>Manage courses offered on your school. </p>
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
    <!-- page content -->
    <div class="row"> 
        <!-- course -->

        @forelse($courses as $course)
                
            <div class="col-md-4">
                <div class="card">
                    <div class="course">
                        <div class="course-image">
 
                            @if($course->image_name)   
                                <img 
                                    src="{{url('/images'). '/' .$course->image_name }} " 
                                    class="img-responsive"
                                >  
                            @else
                                <img 
                                    src="{{url('/assets/images/avatar.png') }} " 
                                    class="img-responsive"
                                > 
                            @endif
                       
                        </div>

                    
                            <div class="course-info">
                                <div class="course-info-basic">
                                    <span class="badge badge-dark pull-right" data-toggle="tooltip" data-placement="top" title=""><i class="menu-icon mdi mdi-account-multiple-outline"></i></span>
                                    <a href=""><h5> {{ $course->name}} </h5></a>
                                    <p>{{$course->theory_classes}} theory classes  | {{$course->practical_classes}} practical Classes</p>
                                </div>
                                <div class="course-info-other">
                                    <h5 class="pull-right">money {{ $course->price }} </h5>
                                    <span class="badge badge-primary">
                                        <i class="menu-icon mdi mdi-clock-fast"></i> 
                                        {{ $course->duration}} || {{ $course->period }}  
                                    </span>
                                </div>
                                <div class="course-info-more">
                                    <div class="dropdown pull-right">
                                        <span class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="mdi mdi-dots-horizontal"></i> </span>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                            <li role="presentation"><a role="menuitem" href=""> <i class="mdi mdi-eye"></i> View More</a></li>
                                            <!-- <li role="presentation"><a role="menuitem" href=""> <i class="mdi mdi-calendar-text"></i> Schedule</a></li> -->
                                            <li role="presentation">
                                                <a 
                                                    role="menuitem" 
                                                    href="#" 
                                                    data-toggle="modal" 
                                                    data-target="#update{{$course->id}}"
                                                    class="{{ $permission_status }}"    
                                                    >
                                                
                                                    <i class="mdi mdi-pencil"></i> 
                                                    Edit
                                                </a>
                                            </li>
                                            
                                            <li role="presentation"> 
                                                <form id="deleteCourse{{$course->id}}" action="{{ route('course.destroy', $course->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')  
                                                    <a  
                                                        href=""
                                                        class="couse_delete {{ $permission_status }} {{ $permission_delete }}"  
                                                        rel="deleteCourse{{$course->id}}"    
                                                    >
                                                        <i class="mdi mdi-delete"></i> 
                                                        Delete
                                                    </a> 
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="course-instructors">
                                
                                        <div class="more-instructors" data-toggle="tooltip" data-placement="top" title=""> </div>
                                    </div>
                                </div>
                            </div> 
                    </div>
                </div>
            </div> 

            @include("admin/modified/course")   

        @empty
            @include("admin/empty/empty")   
        @endforelse
    </div>
</div>  
 
        @include('../layouts/includes/footer') 
     <script>
         $('.couse_delete').on('click touchstart', function(e){ 
            e.preventDefault();
            if(confirm("Are you sure to delete this? This course and all it's data will be deleted")){

                $course_data = $(this).attr('rel');
                $('#'+$course_data).submit();
            } 
         })
       

     </script>
@endsection


