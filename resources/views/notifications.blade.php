@extends('layouts.header') 
@section('content')      
    @include("layouts/includes/sidebar")   
    <!-- main content --> 
    <style>
        .notification-active{
            background-color: #e4fbf9 !important;
        }
    </style>
    <div class="main-content">
        <div class="page-header">
            <h3>Notifications</h3>
        </div> 
        <!-- page content -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="notifications"> 
                        <!-- single notification --> 
                        @forelse($notifications as $notification) 

                            @include("admin/modal/notification")  

                            <div class="single-notification notification-identifier{{$notification->id}} @if($notification->nstatus == 'active') notification-active @endif">

                                <div style="display:flex">
                                    @if ( $notification->type == "message" )
                                        <div class="notification-icon bg-purple">
                                            <i class=" mdi mdi-message-text-outline"></i>
                                        </div>
                                    @elseif ( $notification->type == "delete" )
                                        <div class="notification-icon bg-danger"> 
                                            <i class=" mdi mdi-delete"></i> 
                                        </div>
                                    @elseif ( $notification->type == "calendar" )
                                        <div class="notification-icon bg-secondary"> 
                                            <i class=" mdi mdi-calendar"></i> 
                                        </div>
                                    @elseif ( $notification->type == "newaccount" )
                                            @if($notification->image_name) 
                                                <img src="{{ url('/images').'/'.$notification->image_name }}" class="img-responsive" style="height: 50px; width: auto;" >    
                                            @else 
                                                <div class="notification-icon bg-warning"> 
                                                    <i class="mdi mdi-account-plus"></i>   
                                                </div>
                                            @endif
                                    @elseif ( $notification->type == "payment" )
                                        <div class="notification-icon bg-success"> 
                                            <i class="mdi mdi-credit-card"></i> 
                                        </div>
                                    @endif 
                                        <div class="notification-message  " >
                                            <div class="notification-date">{{ date('F j, Y h:ia', strtotime($notification->created_at)) }}</div>
                                            {!! $notification->message !!} 
                                        </div> 
                                </div>
                                <div class="" style="display: flex;"> 
                                    <a href="#" class="delete_notification" rel="{{$notification->id}}" 
                                                    data-toggle="modal" 
                                                    data-target="#notificationModal{{ $notification->id }}">
                                        <i class="mdi mdi-eye"></i> 
                                    </a> 
                                    <form id="deleteNot{{$notification->id}}" action="{{ route('notification.destroy', $notification->id) }}" method="POST" >
                                        @csrf
                                        @method('DELETE')  
                                        <a href="#" class="trash-notification" rel="deleteNot{{$notification->id}}">
                                            <i class="mdi mdi-delete " style="color: red;"></i> 
                                        </a> 
                                    </form>
                                </div>
                            </div> 
                        @empty 
                            @include("admin/empty/empty") 
                        @endforelse 
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>  
@include('../layouts/includes/footer') 
<script>  
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        } 
    });

    $('.delete_notification').on('click touchstart', function(e){
        e.preventDefault(); 
        var data = $(this).attr('rel');  
            var url = '{{ route("notification.update", ":id") }}';
                url = url.replace(':id', data); 
        $.ajax({
            url: url,
            method: 'PUT', 
            data: {
                _token: '{{csrf_token()}}' 
            },
            success: function(status){ 
                if(status == true){
                    $('.notification-identifier'+data).removeClass('notification-active');
                } 
            }
        }); 
    });

    $('.trash-notification').on('click touchstart', function(e){
        e.preventDefault();
        var data = $(this).attr('rel');
        $('#'+data).submit();
    });

</script> 
@endsection