
    <div class="page-header">
        <!-- <a href="" class="btn btn-success btn-icon pull-right"><i class="mdi mdi-calendar-text"></i> Scheduling </a> -->
        <h3>Dashboard</h3>
    </div>
        <!-- stats -->
        <div class="row">

            <!-- stat 1 -->
            <div class="col-md-3">
                <div class="card widget">
                    <div class="widget-icon widget-primary">
                        <i class="mdi mdi-account-convert"></i>
                    </div>
                    <div class="widget-title">
                        <h2>{{ $cstudent  }}</h2>
                        <p>Total Students</p>
                    </div>
                    <!-- <div class="widget-trend">
                        <p class="text-primary">
                            <i class="mdi mdi-menu-up"></i>
                            growth student
                        </p>
                    </div> -->
                </div>
            </div>

            <!-- stat 1 -->
            <div class="col-md-3">
                <div class="card widget">
                    <div class="widget-icon widget-secondary ">
                        <i class="mdi mdi-account-multiple-outline"></i>
                    </div>
                    <div class="widget-title">
                        <h2> {{ $cinstructor }} </h2>
                        <p >Total Instructors</p>
                    </div>
                    <!-- <div class="widget-trend">
                        <p class="text-warning">
                            <i class="mdi mdi-menu-up"></i>
                            growth income
                        </p>
                    </div> -->
                </div>
            </div>

             <!-- stat 1 -->
             <div class="col-md-3">
                <div class="card widget">
                    <div class="widget-icon widget-success ">
                        <i class="mdi mdi-account-settings-variant"></i>
                    </div>
                    <div class="widget-title">
                        <h2> {{ $cstaff }} </h2>
                        <p >Total Staff</p>
                    </div>
                    <!-- <div class="widget-trend">
                        <p class="text-warning">
                            <i class="mdi mdi-menu-up"></i>
                            growth income
                        </p>
                    </div> -->
                </div>
            </div>

            <!-- stat 1 -->
            <div class="col-md-3">
                <div class="card widget">
                    <div class="widget-icon widget-danger ">
                    <i class="menu-icon mdi mdi-table-large"></i>
                    </div>
                    <div class="widget-title">
                        <h2>{{ $cschool }}</h2>
                        <p>Total School</p>
                    </div>
                    <!-- <div class="widget-trend">
                        <p class="text-success"><i class="mdi mdi-menu-up"></i> growth attendance</p>
                    </div> -->
                </div>
            </div>

            <!-- stat 1 -->
            <div class="col-md-3">
                <div class="card widget">
                    <div class="widget-icon widget-warning ">
                    <i class="menu-icon mdi mdi-source-branch"></i>
                    </div>
                    <div class="widget-title">
                        <h2>{{ $branches->count() }}</h2>
                        <p>Total Branch</p>
                    </div>
                    <!-- <div class="widget-trend">
                        <p class="text-success"><i class="mdi mdi-menu-up"></i> growth attendance</p>
                    </div> -->
                </div>
            </div>

            <!-- stat 1 -->
            <div class="col-md-3">
                <div class="card widget">
                    <div class="widget-icon widget-info ">
                    <i class="menu-icon mdi mdi-book-open"></i>
                    </div>
                    <div class="widget-title">
                        <h2>{{ $courses->count() }}</h2>
                        <p>Total Course</p>
                    </div>
                    <!-- <div class="widget-trend">
                        <p class="text-success"><i class="mdi mdi-menu-up"></i> growth attendance</p>
                    </div> -->
                </div>
            </div>


            <!-- stat 1 -->
            <div class="col-md-3">
                <div class="card widget">
                    <div class="widget-icon widget-danger ">
                    <i class="menu-icon mdi mdi-truck"></i>
                    </div>
                    <div class="widget-title">
                        <h2>{{ $fleets->count() }}</h2>
                        <p>Total Fleet</p>
                    </div>
                    <!-- <div class="widget-trend">
                        <p class="text-success"><i class="mdi mdi-menu-up"></i> growth attendance</p>
                    </div> -->
                </div>
            </div>


        </div>

        <!-- students growth -->
        <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                                <h5>Overall Students for this month</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-md-6 growth-left">
                                    <div class="growth-heading">

                                        <p>{{ $cnew_student }} New Students (Last 30 Days)</p>
                                    </div>
                                    <!-- <div class="growth-pointers">
                                        <div class="growth-icon success">
                                            <i class="mdi mdi-menu-up"></i>
                                        </div>
                                        <div class="growth-message">
                                            <p>You have <strong class="text-success">100% Growth</strong> in comparison to the previous month.</p>
                                        </div>
                                    </div> -->
                                    <!-- <div class="growth-pointers">
                                        <div class="growth-icon warning">
                                            <i class="mdi mdi-menu-right"></i>
                                        </div>
                                        <div class="growth-message">
                                            <p>Payments perfomance has had a <strong class="text-warning">100% perfomance</strong> in comparison to the previous month.</p>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="col-md-6">
                                    <div class="student-growth-chart mt-15"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>




        <div class="row">
            <!-- Certificate -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Certificate For Student</h5>
                    </div>
                    <div class="card-body p-0 comparison-widget">

                        @if(!$student_certification->isEmpty())

                            <table class="border borderless table">
                                <thead>
                                    <th>Name</th>
                                    <th>Theoretical</th>
                                    <th>Practical</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach($student_certification as $scr)
                                        <tr>
                                            <td> {{ $scr->fname }} {{ $scr->lname }}</td>
                                            <td> {{ $scr->sc_status }}  </td>
                                            <td> @if($scr->fs_status == null) not registered @elseif($scr->fs_status == 'inprogress') {{ $scr->fs_status }} @else {{ $scr->fs_status }} @endif</td>
                                            <td><a href="{{ route('student.cert', $scr->id) }}"  class="btn btn-success  @if($scr->fs_status == null)  disabled @elseif($scr->fs_status == 'inprogress') disabled @else  @endif"  >Cert</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="col-md-12">
                                <div class="empty">
                                    <i class="mdi mdi-alert-circle-outline"></i>
                                    <h3>No student record was found!</h3>
                                </div>
                            </div>
                        @endif


                    </div>
                </div>
            </div>



             <!-- Certificate -->
             <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Evaluation for Instructor</h5>
                    </div>
                    <div class="card-body p-0 comparison-widget">
                        <table class="border borderless table">
                            <thead>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @foreach($instructor_evaluation as $ie)
                                    <tr>
                                        <td>{{ $ie->fname }} {{ $ie->lname }}</td>
                                        <td> {{ $ie->role }} </td>
                                        <td><a href="{{ route('show.instructor.evaluation', $ie->id)}}" class="btn btn-primary">Evaluate</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>





        <!-- page content -->
        <div class="row">

            <!-- course sales -->
            <div class="col-md-6">
                <div class="card">
                        <div class="card-header">
                                <h5>Course Available</h5>
                        </div>
                        <div class="card-body p-0 comparison-widget">

                            <table class="border borderless table">
                                <thead>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>

                                    @foreach($courses as $course)
                                        <tr>
                                            <td> {{ $course->name }}</td>
                                            <td> {{ $course->price }}</td>
                                            <td> {{ $course->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>




            <!-- Activity -->
            <div class="col-md-6">
                <div class="card">
                        <div class="card-header">
                                <h5>Recent Activities</h5>
                        </div>
                        <div class="card-body p-0">

                                <div class="notifications-widget">

                                    <!-- single notification -->

                                    @forelse($notifications as $notification)
                                        <div class="single-notification">
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
                                                <div class="notification-icon bg-warning">
                                                    <i class="mdi mdi-account-plus"></i>
                                                </div>
                                            @elseif ( $notification->type == "payment" )
                                                <div class="notification-icon bg-success">
                                                    <i class="mdi mdi-credit-card"></i>
                                                </div>
                                            @endif
                                                <div class="notification-message">
                                                    <div class="notification-date">{{ date('F j, Y h:ia', strtotime($notification->created_at)) }}</div>
                                                    {!! $notification->message !!}
                                                </div>
                                        </div>
                                    @empty
                                        @include("admin/empty/empty")
                                    @endforelse


<!--
                                    <p class="text-center view-all-last"><a href=""><strong>View All</strong></a></p> -->

                                </div>
                        </div>

                </div>
            </div>
        </div>
