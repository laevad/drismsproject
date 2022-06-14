@extends('layouts.header') 
@section('content')      
    @include("layouts/includes/sidebar")     
<!-- main content -->
<div class="main-content">  
    <div class="page-header"> 
       
        <h3>{{ $school->name }}</h3>
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

    <form action="{{ route('school.courseSchoolStore')}}" method="post">
        @csrf 
        <input type="hidden" value="{{$id}}" name="school_id"/> 

        <div class="form-group"> 
            <div class="row"> 

                <div class="col-md-6"> 
                     <label>Time Start and Time End</label>
                    <select name="start_end" class="form-control" required="">
                        <option value="7:30 AM to 9:00 AM">7:30 AM to 9:00 AM</option>
                        <option value="10:00 AM to 11:30 AM">10:00 AM to 11:30 AM</option>
                        <option value="1:30 PM to 3:00 PM">1:30 PM to 3:00 PM</option>
                        <option value="3:00 PM to 4:30 PM">3:00 AM to 4:30 PM</option>
                    </select>
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

        
        <div class="form-group">
            
            <div class="row"> 
                <div class="col-md-6"> 
                    <label>Start</label>
                    <input type="date" name="start" class="form-control"  required=""/>
                </div> 
                <div class="col-md-6"> 
                    <label>End</label>
                    <input type="date" name="end" class="form-control"  required=""/>
                </div> 

            </div> 
        </div>


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
                @if(!empty($courses))
                    <div class="col-md-3">
    
                        <label>Course</label>
                        <select class="form-control select2" name="course_id" id="select-course" required=""> 
                            <option value="">Select Course</option>  
                            @foreach($courses as $course)   
                                <option value="{{$course->id}}">{{ $course->name }}</option>    
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
                        <select class="form-control select2" name="instructor_id" id="select-instructor" required=""> 
                            <option value="">Select Instructors</option>  
                            @foreach($instructors as $instructor)   
                                <option value="{{$instructor->id}}" @if($instructor->status == "Suspended" || $instructor->status == "Inactive") disabled @endif >{{ $instructor->fname }} {{ $instructor->lname }} ({{$instructor->status}})</option>    
                            @endforeach 
                        </select>  
                    </div>
                @else
                    <span class="alert alert-success">
                        <strong>Empty Instructors</strong>
                    </span> 
                @endif  
 
                @if(!empty($branches))
                <div class="col-md-3"> 
                    <label>Branch</label>
                    <select class="form-control select2" name="branch_id" id="select-branch" required=""> 
                        <option value="">Select Branch</option>  
                        @foreach($branches as $branch)   
                            <option value="{{$branch->id}}"> {{$branch->name}} {{  $branch->email }} {{  $branch->address }}</option>    
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


        <div class="hidden" id="school-course-table" >
            <table class="table"> 
                <tbody>
                    <tr>
                        <th scope="row" >Course: </th>
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
                    <input type="submit" value="Add Course"  class="btn btn-primary btn-block"/>
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


    $('#select-course').on('change', function(e){
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
            success: function(result){
                $('#school-course-table').removeClass('hidden');
                $('.sc-title').text(result.name); 
                $('.sc-price').text(result.price);
                $('.sc-status').text(result.status); 
            }
        }); 

    })


        
       
</script>
@endsection


