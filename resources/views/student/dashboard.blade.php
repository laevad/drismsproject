
    <style>
        #theoretical>a:hover, #theoretical>a{
            color:#38c172;
            text-decoration: none;
        }

        #practical>a:hover, #practical>a{
            color: #e3342f;
            text-decoration: none;
        }
        .bg-gray{
            color: gray !important;
            opacity: .3;
        }
  </style>
<div class="page-header">
    @if(Auth::user()->role == 'Student')
        <a href="{{ route('student.scheduling') }}" class="btn btn-success btn-icon pull-right">
            <i class="mdi mdi-calendar-text"></i>
            Scheduling
        </a>
    @endif
    <h3>Dashboard</h3>
</div>

<div class="row">
    <!-- stat 1 -->
    <div class="col-md-3">
        <div class="card widget" id="theoretical">
            <a href="{{ route('schedule.theoretical')}}" class="
            @if(Auth::user()->role == 'Instructor' )
                @else @if(!$student_access_practical->isEmpty() || $student_info->type=="Theory")
                @else disabled  @endif  @endif
            ">
                <div class="widget-icon @if(Auth::user()->role == 'Instructor' ) widget-success  @else @if(!$student_access_practical->isEmpty() || $student_info->type=="Theory")  widget-success @else bg-gray @endif @endif">
                    <i class="mdi mdi-blur-radial"></i>
                </div>
                <div class="@if(Auth::user()->role == 'Instructor' ) widget-title  @else @if(!$student_access_practical->isEmpty() || $student_info->type=="Theory")  widget-title  @else bg-gray @endif  @endif">
                    <h2>Theoretical</h2>
                    <p>School Schedule</p>
                </div>
            </a>
        </div>
    </div>
    <!-- stat 2 -->


        <div class="col-md-3">
            <div class="card widget" id="practical">
                <a href="{{ route('schedule.practical')}}" class="
                @if(Auth::user()->role == 'Instructor' )
                @else @if(!$student_access_practical->isEmpty() || $student_info->type=="Practical")
                @else disabled  @endif  @endif
                "    >
                    <div class="widget-icon @if(Auth::user()->role == 'Instructor' ) widget-danger  @else @if(!$student_access_practical->isEmpty() || $student_info->type=="Practical")  widget-danger @else bg-gray @endif @endif">
                        <i class="mdi mdi-car-connected"></i>
                    </div>
                    <div class=" @if(Auth::user()->role == 'Instructor' ) widget-title  @else @if(!$student_access_practical->isEmpty() || $student_info->type=="Practical")  widget-title  @else bg-gray @endif  @endif ">

                        <h2>Practical</h2>
                        <p>Fleet Schedule</p>
                    </div>
                </a>
            </div>
        </div>

</div>

