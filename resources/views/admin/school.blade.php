@extends('layouts.header') 
@section('content')     
        <!-- Admin home page --> 
        <!-- sidebar --> 

    @include("layouts/includes/sidebar")   
    @include("admin/modal/school")  

 
  
<!-- main content -->
<div class="main-content">
    <div class="page-header">
        <button type="button" class="btn btn-primary btn-icon pull-right ml-5 " {{ $permission_status }} data-toggle="modal" data-target="#create"><i class=" mdi mdi-plus-circle-outline"></i> Add School </button>
        <h3>Schools</h3>
        <p>These are independent schools that signed up. </p>
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

        @forelse($schools as $school)
         
        @if($school->status == "Active")

        <!-- school -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="school">
                            <div class="school-heading">
                                <div class="school-icon">{{ mb_substr($school->name, 0, 1, 'utf-8') }}</div>
                                <div class="school-details">
                                    <h5>{{$school->name}}</h5>
                                    <span>{{$school->email}}</span>
                                    <span>
                                @if ( !empty($school->phone) ) {{ $school->phone }} @else Phone not set @endif
                                </span>
                                </div>
                            </div>
                            <div class="school-info">
                                <p>
                                    <span><i class="mdi mdi-account-convert"></i></span>
                                    {{ $school->students }} Active Students
                                </p>
                                <p>
                                    <span><i class="mdi mdi-account-multiple-outline"></i></span>
                                    {{ $school->instructors }} Instructors
                                </p>
                                <p>
                                    <span><i class="mdi mdi-map-marker-multiple"></i></span>
                                    {{ $school->branches }} Branches
                                </p>
                                <p>
                                    <span><i class="mdi mdi-map"></i></span>
                                @if ( !empty($school->address) ) {{ $school->address }} @else Address not set @endif
                                </p>
                            </div>
                            <div class="school-footer">
                                <div class="dropdown pull-right">
                                    <span class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="mdi mdi-dots-horizontal"></i> </span>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                        
                                        <li role="presentation">
                                            <a role="menuitem"  
                                                href="{{ route('school.course.review', $school->id)}}" 
                                                 
                                                >   
                                                <i class="mdi mdi-eye"></i>
                                                Review Course
                                            </a>
                                        </li>
                                        
                                        <li role="presentation">
                                            <a role="menuitem"  
                                                href="{{ route('school.course.add', $school->id)}}" 
                                                class="{{ $permission_status }}"
                                                > 
                                                <i class="mdi mdi-plus-circle-outline"></i>
                                                Add Course
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem"
                                                href="#" 
                                                input="schoolid" 
                                                modal="#sendemail{{$school->id}}" 
                                                class="pass-data {{ $permission_status }}" 
                                                value="{{ $school->id }}"
                                                > 
                                                <i class="mdi mdi-email-outline"></i> 
                                                Send Email
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" 
                                                href="" 
                                                input="schoolid" 
                                                modal="#sendsms{{ $school->id }}" 
                                                class="pass-data {{ $permission_status }}" 
                                                value="{{ $school->id }}"> 
                                                <i class="mdi mdi-message-text-outline"></i> 
                                                Send SMS
                                            </a>
                                        </li>
                                        
                                        <li role="presentation">
                                            <a role="menuitem" 
                                                class="pass-data {{ $permission_status }}" 
                                                modal="#update{{$school->id}}"  
                                                href="#" 
                                                > 
                                                <i class="mdi mdi-pencil"></i> 
                                                Edit
                                            </a>
                                        </li>

                                        <li role="presentation">
                                            
                                            <form id="deleteSchool{{$school->id}}" action="{{ route('school.destroy', $school->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')  
                                                <a  
                                                    href="#"  
                                                    class="school_delete {{ $permission_status }} {{ $permission_delete }}"
                                                    rel="deleteSchool{{$school->id}}"
                                                >
                                                    <i class="mdi mdi-server-remove"></i> 
                                                    Suspended
                                                </a> 
                                            </form> 
                                        </li>
                                    </ul>
                                </div>
                                @if(($school->status) == 'Active')
                                <span class="badge badge-success">Active School</span>
                                @else
                                <span class="badge badge-danger">Suspended School</span>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>



                @include("admin/modified/school")   
                @include("admin/email/school")   
                @include("admin/sms/school")  

            
            @endif
        @empty 
            @include("admin/empty/empty")   
        @endforelse
    </div>

</div> 

<!-- end add school -->
<!-- update -->
<div class="modal right fade" id="update" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"><i class="mdi mdi-close-circle-outline"></i></span></button>
                <h4 class="modal-title" id="myModalLabel2">Edit School</h4>
            </div>
            <div class="update-holder"></div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div>
<!-- end update -->

 
@include('../layouts/includes/footer')

<script> 
 

    $('.school_delete').on('click touchstart', function(e){ 
        e.preventDefault();
        if(confirm("Are you sure you want to do this?")){ 
            $school_data = $(this).attr('rel');
            $('#'+$school_data).submit();
        } 
    })  
</script>
@endsection