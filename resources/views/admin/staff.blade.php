@extends('layouts.header') 
@section('content')     
        <!-- Admin home page --> 
        <!-- sidebar -->  
    @include("layouts/includes/sidebar")   
   
    <!-- main content -->
    <div class="main-content">
        <div class="page-header">
            <button 
                type="button" 
                class="btn btn-success btn-icon pull-right toggle-search"
            >
                <i class=" mdi mdi-filter-outline"></i> 
                Filter & Search 
            </button>
            <h3>Staff</h3>
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
            <!-- search & Filter -->
            <div class="col-md-12 search-filter" style="display: none;">
            <div class="card">
                <form class="form" action="{{ route('staff-search') }}" method="GET">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Search Name</label>
                                <input type="text" class="form-control" placeholder="Search Name, Email or Phone" name="search">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="email">Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="">Select Gender*</option>
                                    <option value="">All</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-icon btn-block">
                                <i class=" mdi mdi-filter-outline"></i> 
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            </div>  
        </div> 

        <div class="row">    
            @if($users)
                @forelse($users as $user)
                <!-- user grid -->
                <div class="col-md-3">
                    <div class="user-grid card">
                        <div class="user-grid-pic"> 
                            @if($user->image_name)   
                                <img 
                                    src="{{url('/images'). '/' .$user->image_name }} " 
                                    class="img-responsive"
                                >  
                            @else
                                <img 
                                    src="{{url('/assets/images/avatar.png') }} " 
                                    class="img-responsive"
                                > 
                            @endif
                            
                        </div>
                        <div class="user-grid-info">
                            <h5> {{ ucfirst($user->fname) }} {{ucfirst($user->lname)}} </h5>
                            <p>branch name </p>
                            <p>{{$user->phone}} </p>
                        </div>
                        <div class="row user-grid-buttons">
                            <div class="col-md-12">
                                <a 
                                    class="btn btn-primary btn-block" 
                                    href="{{ route('profiles.show',$user->username)}}"
                                >
                                    Profile
                                </a>
                            </div>
                        </div>
                        <div class="user-grid-class-left">
                            <p class="text-success"> 
                                <a role="menuitem" 
                                    class="pass-data" 
                                    modal="#updateStaff{{$user->id}}"  
                                    href="#"
                                > 
                                    <i class="mdi mdi-pencil"></i> 
                                    Edit
                                </a> 
                            </p>
                        </div>
                    </div>
                </div>   
                    @include("admin/modal/staff")    
                @empty  
                    @include("admin/empty/empty")   
                @endforelse  
            @endif

        </div> 
    </div>
 
    @include('../layouts/includes/footer') 

@endsection