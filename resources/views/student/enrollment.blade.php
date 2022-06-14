@extends('layouts.header') 
@section('content')      
    @include("layouts/includes/sidebar")     
<!-- main content -->
<div class="main-content"> 
    @if(Auth::user()->role == 'Admin') 
        @include('admin/dashboard') 
    @else 
        <div>
            <div>
                <img src="" alt="" />
                <div>
                    DATS Driving School
                    Registration Form
                    <small>
                        FAx # (xxx xxxx xxxx)  Driving School
                    </small>
                </div>
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
            @error('student_id')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror 
            <div>
                <form action="{{ route('enrollment.store' )}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
        
                                <label>Select School</label>
                                <select class="form-control" name="school_id" id="enrolmlment-school" required="">  
                                    <option value="">Select School</option>   
                                        @forelse($schools as $school)
                                            <option value="{{ $school->id }}">{{$school->name }}</option>  
                                        @empty
                                        @endforelse
                                </select>  
                            </div>
                        </div> 
                    </div> 

                    <div class="form-group hidden" id="school-branch">
                        <div class="row">
                            <div class="col-md-12">
        
                                <label>Select Branch</label>
                                <select class="form-control" name="branch_id" id="enrolmlment-branch" required="">  
                                    <option value="">Select Branch</option>     
                                </select>  
                            </div>
                        </div> 
                    </div>  

                    <div class="form-group hidden" id="school-course">
                        <div class="row">
                            <div class="col-md-12">
        
                                <label>Select Course</label>
                                <select class="form-control" name="course_id" id="enrolmlment-course" required="">  
                                    <option value="">Select Course</option>     
                                </select>  
                            </div>
                        </div> 
                    </div> 


                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
        
                                <label>Years of Experience</label>
                                <select class="form-control" name="y_e" required="">  
                                    <option value="more than a months" selected>more than a months</option>   
                                    <option value="1 year">1 year</option>   
                                    <option value="2 years">2 years</option>   
                                    <option value="more than 5 years">more than 5 years</option>    
                                </select>  
                            </div>
                        </div> 
                    </div> 
 
 
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12"> 
                                <input type="submit" value="Register"  class="btn btn-primary"  @if(Auth::user()->enrollment_status == 1)  disabled @endif/>

                                 
                            </div>
                        </div>
                    </div>


                </form> 
            </div>
        </div>
    @endif
</div> 
    @include('../layouts/includes/footer')  


    <script>

        
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        } 
    });
    
    var data2;
        $('#enrolmlment-school').on('change', function(e){  

                e.preventDefault(); 
                var data1 = $(this).val();
                var url = '{{ route("get.enrollment.branch", ":id") }}';
                    url = url.replace(':id', data1);

                    data2 = data1;
                $.ajax({
                    url: url,
                    method: 'get', 
                    data: {
                        _token: '{{csrf_token()}}' 
                    },
                    success: function(items){
 
                        if(items){
 
                            $('#school-branch').removeClass('hidden');
                            $('.branch-append').remove();
                            $.each(items, function (i, item) {
                                $('#enrolmlment-branch').append($('<option>', { 
                                    value: item.id,
                                    text : item.name,
                                    class: 'branch-append'
                                }));  
                            });

                        }else{
                            console.log('No branch found!!!')
                        }
        
                    }
                }); 
 
        });

        $('#enrolmlment-branch').on('change', function(e){
                e.preventDefault(); 
                var data1 = $(this).val(); 

                var url = '{{ route("get.course", [":school_id", ":course_id"]) }}';
                    url = url.replace(':course_id', data1);
                    url = url.replace(':school_id', data2);

                    
                $.ajax({
                    url: url,
                    method: 'get', 
                    data: {
                        _token: '{{csrf_token()}}' 
                    },
                    success: function(items){ 

                        console.log(items);
                        if(items){
  
                            $('#school-course').removeClass('hidden');
                            $('.course-append').remove();
                            $.each(items, function (i, item) {
                                $('#enrolmlment-course').append($('<option>', { 
                                    value: item.id,
                                    text : item.name,
                                    class: 'course-append'
                                }));  
                            });

                            }else{
                            console.log('No course found!!!')
                            }
        
                        }
                }); 
        })

    </script>
@endsection