@extends('layouts.header') 
@section('content')     
        <!-- Admin home page --> 
        <!-- sidebar --> 

    @include("layouts/includes/sidebar")   


        
    <!-- main content -->
    <div class="main-content">
        <div class="page-header">
            <button type="button" class="btn btn-primary btn-icon pull-right ml-5 addbranch" {{  $permission_status }} data-toggle="modal" data-target="#create"><i class=" mdi mdi-plus-circle-outline"></i> Add Branch </button>
            <h3>Branches</h3>
            <p>These are branches of your school. </p>
        </div>


        <!-- page content -->   
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
        <div class="row">  
             @forelse($branches as $branch)
                <!-- branch -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="school">
                            <div class="school-heading">
                                <div class="school-icon"><i class="mdi mdi-map-marker-multiple"></i></div>
                                <div class="school-details">
                                    <h5>{{$branch->name}}</h5>
                                    <span>{{$branch->email}}</span>
                                    <span>
                                        @if ( !empty($branch->phone) ) {{ $branch->phone }} @else Phone not set @endif
                                    </span>
                                </div>
                            </div>
                            <div class="school-info">
                                <p>
                                    <span><i class="mdi mdi-account-convert"></i></span>
                                    {{$branch->students}} Active Students
                                </p>
                                <p>
                                    <span><i class="mdi mdi-account-multiple-outline"></i></span>
                                    {{$branch->instructors}} Instructors
                                </p>
                                <p>
                                    <span><i class="mdi mdi-car"></i></span>
                                    {{$branch->vehicles}} Vehicles
                                </p>
                                <p>
                                    <span><i class="mdi mdi-map"></i></span>
                                    @if ( !empty($branch->address) ) {{ $branch->address }} @else Address not set @endif
                                </p>
                            </div>
                            <div class="school-footer">
                                <div class="dropdown pull-right">
                                        <span class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="mdi mdi-dots-horizontal"></i> </span>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                            <li role="presentation">
                                                <a 
                                                    data-toggle="modal" 
                                                    data-target="#update{{ $branch->id }}"
                                                    href="#"
                                                    class="{{ $permission_status }}"
                                                > 
                                                    <i class="mdi mdi-pencil"></i> 
                                                    Edit
                                                </a>
                                            </li>
                                          <li role="presentation">
                                                <a role="menuitem" 
                                                    href="" 
                                                    data-toggle="modal" 
                                                    data-target="#sendemail{{$branch->id}}"
                                                    class="{{ $permission_status }} {{ $permission_delete }}"
                                                >
                                            <i class="mdi mdi-email-outline"></i> Send Email</a></li>
                                            <li role="presentation">
                                                <a role="menuitem" 
                                                    href=""   
                                                    data-toggle="modal" 
                                                    data-target="#sendsms{{$branch->id}}"
                                                    class="{{ $permission_status }} {{ $permission_delete }}"
                                                > 
                                                <i class="mdi mdi-message-text-outline"></i> 
                                                Send SMS
                                                </a>
                                            </li>
                                            <li 
                                                role="presentation"
                                            >  
                                                <form id="deleteBranch{{$branch->id}}" action="{{ route('branch.destroy', $branch->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')  
                                                    <a  
                                                        href="#"  
                                                        class="branch_delete   {{ $permission_status }} {{ $permission_delete }}"  
                                                        rel="deleteBranch{{$branch->id}}"

                                                    >
                                                        <i class="mdi mdi-delete"></i> 
                                                        Delete
                                                    </a> 
                                                </form>

                                            </li>
                                          
                                        </ul>
                                </div> 
                                    <span class="badge badge-success">Current branch</span> 
                                    <a 
                                    href="" 
                                    class="send-to-server-click" 
                                    data="branchid:{{ $branch->id }}|csrf-token:{{ csrf_token() }}" 
                                    url="{{ url('Branch@switch') }}" 
                                    loader="true"><span class="badge badge-primary pointer">Switch to branch</span></a> 
                            </div>
                        </div>
                    </div>
                </div> 
                
                @include("admin/sms/branch")   
                @include("admin/modified/branch") 
                @include("admin/email/branch")  
            @empty  
              @include("admin/empty/empty")  
            @endforelse
        </div>
    </div>
 


 
    @include("admin/modal/branch")  
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
         $('.branch_delete').on('click touchstart', function(e){ 
            e.preventDefault();
            if(confirm("Are you sure to delete this? This Branch and all it's data will be deleted")){

                $branch_data = $(this).attr('rel');
                $('#'+$branch_data).submit();

            } 
        })

    //Send Email
    // $('.sendemail').on('click',function(){
    //   var email = $(this).attr('data-value');
    //   $('.schoolemail').val(email);
    // });
    // //Send SMS
    // $('.sendsms').on('click',function(){
    //   var phone = $(this).attr('data-value');
    //   $('.schoolphone').val(phone);
    // });
    // //Edit Branch
    // $('.editbranch').on('click',function(){
    //     var data = JSON.parse($(this).attr('data-scope'));
    //     $('#create .modal-title').text('Edit Branch');
    //     $('.submitbtn').text('Save changes');
    //     $('.branchform').attr('action', `{{url('Branch@edit')}}${data.id}/`);
    //     $('.branchname').val(data.bname);
    //     $('.branchemail').val(data.bemail);
    //     $('.branchphone').val(data.bphone);
    //     $('.branchaddress').val(data.baddress);
    //     $('.branchcode').val(data.bcode);
    // });
    // //Add Branch
    // $('.addbranch').on('click',function(){
    //     $('#create .modal-title').text('Add Branch');
    //     $('.submitbtn').text('Add Branch');
    //     $('.branchform').attr('action',"{{url('Branch@store')}}");
    //     $('.branchname').val('');
    //     $('.branchemail').val('');
    //     $('.branchphone').val('');
    //     $('.branchaddress').val('');
    //     $('.branchcode').val('');
    // });
   </script>
 
@endsection

 
