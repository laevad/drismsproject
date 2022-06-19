@extends('layouts.header')
@section('content')
        <!-- Admin home page -->
        <!-- sidebar -->
    @include("layouts/includes/sidebar")
        @include("admin/modal/update-profile")


    <style>

        footer{
            margin: 0 !important;
        }
    </style>
<div class="main-content">
    <div class="page-header">
        <h3>{{ $user->fname }} {{ $user->lname }}</h3>
    </div>
    <!-- page content -->
    <div class="row">
        <div class="p-0">

                        <div class="slimscroll-profile-menu">

                            <div class="user-profile-pic">
                                @if(!file_exists($user->image_name))
                                    <img
                                        src="{{ url('/images'). '/' .$user->image_name }} "
                                        class="img-responsive"
                                    >
                                @else
                                    <img
                                        src="{{ url('/assets/images/default.png') }} "
                                        class="img-responsive"
                                    >
                                @endif


                            </div>
                            <div class="user-profile-info">
                                <h5>{{ $user->fname }} {{ $user->lname }}</h5>
                            </div>
                            <div class="profile-more-section">
                                <ul class="nav nav-tabs">
                                <li><a data-toggle="tab" href="#account" class="active">Account Info</a></li>
                                <!-- <li><a data-toggle="tab" href="#activity">Activity</a></li> -->
                                </ul>

                                <div class="tab-content">
                                    <div id="account" class="tab-pane fade in show active">
                                        <table>
                                            <tr>
                                                <td class="profile-item-title">Email</td>
                                                <td class="profile-item-value">{{$user->email}}</td>
                                            </tr>
                                            <tr>
                                                <td class="profile-item-title">Phone</td>
                                                <td class="profile-item-value">{{$user->phone}}</td>
                                            </tr>
                                            <tr>
                                                <td class="profile-item-title">Date of Birth</td>
                                                <td class="profile-item-value">
                                                @if( $user->dob != '0000-00-00' )
                                                <span>{{ date('F j, Y', strtotime($user->dob)) }}</span>
                                                @else
                                                <span class="text-muted">Not set</span>
                                                @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="profile-item-title">Gender</td>
                                                <td class="profile-item-value">{{$user->gender}}</td>
                                            </tr>
                                            <tr>
                                                <td class="profile-item-title">Address</td>
                                                <td class="profile-item-value">{{$user->address}}</td>
                                            </tr>
                                        </table>
                                        <div class="mt-2">

                                            <button class="btn btn-success btn-block"   data-toggle="modal" data-target="#update-profile{{ $user->id }}" >
                                                Update Profile
                                            </button>

                                        </div>
                                    </div>

                                        <!-- <div id="activity" class="tab-pane fade">
                                            <ol class="activity-feed">
                                            @if(!empty($timeline))
                                                @foreach($timeline as $activity)
                                                <li class="feed-item">
                                                    <time class="date" datetime="9-25">{{date('d F, Y',strtotime($activity->created_at))}}</time>
                                                    {{ $activity->activity }}
                                                </li>
                                                @endforeach
                                            @else
                                                <li class="feed-item">
                                                    <span class="text">No activities found.</span>
                                                </li>
                                            @endif
                                            </ol>
                                        </div> -->
                                </div>
                            </div>
        </div>
    </div>
</div>


    @include('../layouts/includes/footer')

@endsection
