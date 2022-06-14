@extends('layouts.header') 
@section('content')     
        <!-- Admin home page --> 
        <!-- sidebar --> 

    @include("layouts/includes/sidebar")  
  <!-- main content -->
    <div class="main-content">
        <div class="page-header">
            
            <a href="#" class="btn btn-success btn-icon pull-right">
                <i class="mdi mdi-calendar-text"></i> 
                View All 
            </a>
        
            <h3>Scheduling</h3>
        </div>


        <!-- page content -->
        <div class="row">
            <!-- Scheduling -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <p class="pull-right schedule-map">
                            <span> <i class=" mdi mdi-circle text-danger"></i> Missed </span>
                            <span> <i class=" mdi mdi-circle text-success"></i> Practical </span>
                            <span> <i class=" mdi mdi-circle text-primary"></i> Theory </span>
                            <span> <i class=" mdi mdi-circle text-muted"></i> Complete </span>
                        </p>
                            <h5>Schedule</h5>
                    </div>
                    
                    <div class="card-body p-0">
                        <div id='calendar'>
                            <div class="loader-demo-box">
                                <div class="circle-loader"></div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
 
    @include("admin/modal/scheduling")   
 
    @include('../layouts/includes/footer')  
    <script src="{{ asset('libs/datetimepicker/js/bootstrap-datetimepicker.js') }}"></script> 
    <script src="{{ asset('libs/fullcalendar/moment.min.js') }}"></script> 
    <script src="{{ asset('libs/fullcalendar/fullcalendar.min.js') }}"></script> 
    <script src="{{ asset('libs/jquery-ui/jquery-ui.min.js') }}"></script> 
    <script src="{{ asset('js/components/schedule.js') }}"></script> 

        <script type="text/javascript">
            var filter='';
            var filterid='';
            var schedulesUrl='{{route("schedule.index")}}';
            var schedulesUpdateView='';
       </script>


@endsection