
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
<div class="page-header mb-3">
    @if(Auth::user()->role == 'Student')
        <a href="{{ route('student.scheduling') }}" class="btn btn-success btn-icon pull-right">
            <i class="mdi mdi-calendar-text"></i>
            Scheduling
        </a>
{{--        <a href="" class="btn btn-primary btn-icon pull-right">--}}
{{--            <i class="mdi mdi-printer"></i>--}}
{{--            Print receipt--}}
{{--        </a>--}}

    @endif
    <h3 class="mt-2">Dashboard</h3>
</div>

<div class="container">
    <div class="col-md-10 m-auto">
        <div class="row ">
            <!-- stat 1 -->
            <div class="col-md-5">
                <div class="card widget" id="theoretical">
                    <a href="{{ route('schedule.theoretical')}}" class="
            @if(Auth::user()->role == 'Instructor' )
                @else @if($student_access_theoretical->isEmpty())
                @else disabled  @endif  @endif
            ">
                        <div class="widget-icon @if(Auth::user()->role == 'Instructor' ) widget-success  @else @if($student_access_theoretical->isEmpty())  widget-success @else bg-gray @endif @endif">
                            <i class="mdi mdi-blur-radial"></i>
                        </div>
                        <div class="@if(Auth::user()->role == 'Instructor' ) widget-title  @else @if($student_access_theoretical->isEmpty() )  widget-title  @else bg-gray @endif  @endif">
                            <h2>Theoretical</h2>
                            <p>School Schedule</p>
                        </div>
                    </a>
                </div>
            </div>
            <!-- stat 2 -->


            <div class="col-md-5">
                <div class="card widget" id="practical">
                    <a href="{{ route('schedule.practical')}}" class="
                @if(Auth::user()->role == 'Instructor' )
                @else @if($student_access_practical->isEmpty() && !$student_access_theoretical->isEmpty() )
                @else disabled  @endif  @endif
                "    >
                        <div class="widget-icon @if(Auth::user()->role == 'Instructor' ) widget-danger  @else @if($student_access_practical->isEmpty()  && !$student_access_theoretical->isEmpty() )   widget-danger @else bg-gray @endif @endif">
                            <i class="mdi mdi-car-connected"></i>
                        </div>
                        <div class=" @if(Auth::user()->role == 'Instructor' ) widget-title  @else @if($student_access_practical->isEmpty() && !$student_access_theoretical->isEmpty())  widget-title  @else bg-gray @endif  @endif ">

                            <h2>Practical</h2>
                            <p>Fleet Schedule</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>
   @if(Auth::user()->role=='Student')
       <div class="pull-right">
           <h4>Print Receipt</h4>
           <form action="{{ route('invoice.print', \Auth::user()->id) }}"  class="pull-right ml-3" target="_blank">
               <input type="submit" class="btn btn-primary " value=" theoretical" {{ $print_theo->isEmpty()? "disabled": "" }} />
           </form>

           <form action="{{ route('invoice.print_practical', \Auth::user()->id) }}" class="pull-right" target="_blank">
               <input type="submit" class="btn btn-primary " value=" practical" {{ $print_prac->isEmpty()? "disabled": "" }} />
           </form>
       </div>
   @endif
    <br>
    <br>
    <br>
    <br>
