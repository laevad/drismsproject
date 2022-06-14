@extends('layouts.header') 
@section('content')     
        <!-- Admin home page --> 
        <!-- sidebar --> 

    @include("layouts/includes/sidebar")   
<!-- main content -->
<div class="main-content">
        <div class="page-header">
            <!-- <button type="button" class="btn btn-primary btn-icon pull-right ml-5" data-toggle="modal" data-target="#create"><i class=" mdi mdi-account-plus-outline"></i> Add Instructor </button> -->
            <button type="button" class="btn btn-success btn-icon pull-right toggle-search"><i class=" mdi mdi-filter-outline"></i> Filter & Search </button>
            <h3>Instructors</h3>
        </div> 
        <!-- page content --> 
        <div class="row">
            <!-- search & Filter -->
            <div class="col-md-12 search-filter" style="display: none;">
               <div class="card">
                <form class="form" action="{{route('instructor-search')}}" method="GET">
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
                              <button class="btn btn-primary btn-icon btn-block"><i class=" mdi mdi-filter-outline"></i> Search</button>
                        </div>
                    </div>
                </form>
              </div>
            </div> 
        </div>
        <div class="row"> 
            @forelse($users as $user)
                <!-- user grid -->
                <div class="col-md-4">
                    <div class="user-grid card">
                        <div class="user-grid-pic">
                            <img src="{{url('/images'). '/' .$user->image_name }} " class="img-responsive">  
                        
                        </div>
                        <div class="user-grid-info">
                            <h5>{{ ucfirst($user->fname) }} {{ucfirst($user->lname)}}</h5>
                            <p>{{ $user->status }}</p>
                            <p>{{$user->phone}}</p>
                        </div>
                        <div class="row user-grid-buttons">
                            <div class="col-md-6">
                                <a 
                                    class="btn btn-primary btn-block @if($user->status == 'Inactive' || $user->status == 'Suspended') disabled @endif" 
                                    href="{{ route('profiles.show', $user->username)}}"
                                >Profile</a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-default btn-block @if($user->status == 'Inactive' || $user->status == 'Suspended') disabled @endif" href="{{route('schedule.show', $user->id)}}">Schedule</a>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button class="btn btn-success btn-block" {{$permission_status}} data-toggle="modal" data-target="#create{{$user->id}}"  >Update</button>
                            </div>
                        </div>
                        <!-- <div class="user-grid-class-left">
                            <p class="text-success"><i class=" mdi mdi-counter"></i> instructor completed Class(es) Completed</p>
                        </div> -->
                    </div>
                </div>

                @include("admin/modal/instructor")  
            @empty
                @include("admin/empty/empty")   
            @endforelse 
        </div>
    </div>

    @include('../layouts/includes/footer') 

@endsection