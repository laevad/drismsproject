  
@if($studentcourses) 
<div class="page-header evaluate-instructor">  
    <a href="{{ route('instructor.evaluation', ['theoretical', $studentcourses->student_course_id, $studentcourses->instructor_id]) }} " class="btn btn-success btn-icon pull-right">
        <i class="mdi mdi-calendar-text"></i> 
        Evaluate Instructor
    </a> 
</div>


<div class="row"> 
    <!-- students theoretical page -->
    <div class="row"> 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{Auth::user()->fname}} {{Auth::user()->lname}}</h3>
                    </div> 
                    <div class="card-body p-0">
                        <div class="row">
                            
                            <div class="col-md-12 growth-left">

                                <div cladd="item-center">
                                    <label>
                                        <h2>  
                                            {{ $studentcourses->s_name}}  
                                        </h2>
                                        <small> {{ $studentcourses->s_address}}  </small>
                                    </label>
                                    <p>{{ $studentcourses->b_name}}   <small> {{ $studentcourses->b_address}}  </small> </p>
                                </div>
                                <div class="row">  
                                    <div class="col-md-12">
                                        <table class="table table-borderless form-drisms">
                                            <thead>
                                                <th>Course</th>
                                                <th>Price</th>
                                                <th>Days</th>
                                                <th>Time Start & End</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Duration</th>
                                                <th>Period</th>
                                            </thead>
                                            <tbody> 
                                                <tr> 
                                                    <td> {{ $studentcourses->c_name}} </td> 
                                                    <td> {{ $studentcourses->c_price}} </td> 
                                                    <td> {{ $studentcourses->day}} </td> 
                                                    <td> {{ $studentcourses->time_start_end}} </td> 
                                                    <td> {{ $studentcourses->start}} </td> 
                                                    <td> {{ $studentcourses->end}} </td> 
                                                    <td> {{ $studentcourses->duration }} </td> 
                                                    <td> {{ $studentcourses->period }} </td>
                                                </tr>  
                                            </tbody>
                                        </table>  
                                    </div> 
                                    <hr />
                                    <div class="col-md-4"> 
                                        <table class="table table-borderless form-drisms">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        {{ $studentcourses->driving_lto_requirement }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $studentcourses->theoretical_driving_course }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $studentcourses->practical_driving_course_mv }} </td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $studentcourses->manual_transmission_mv }} </td>
                                                </tr> 
                                                <tr>
                                                    <td>{{ $studentcourses->automatic_transmission_mv }}</td>
                                                </tr> 
                                            </tbody>
                                        </table>  
                                    </div>
                                    <div class="col-md-4"> 
                                        <table class="table table-borderless form-drisms">
                                            <tbody>
                                                <tr>
                                                    <td>{{ $studentcourses->practical_driving_course_mc }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $studentcourses->manual_transmission_mc }}</td>
                                                </tr>
                                                <tr>
                                                    <td> {{ $studentcourses->automatic_transmission_mc }}</td>
                                                </tr>
                                                <tr>
                                                    <td>OTHERS: {{ $studentcourses->others_mc }}</td>
                                                </tr> 
                                            </tbody>
                                        </table> 
                                    </div>
                                    <div class="col-md-4"> 
                                        <div cladd="item-center">
                                            <p> Where did you know {{ $studentcourses->s_name}} : </p> 
                                        </div> 
                                        <table class="table table-borderless form-drisms">
                                            <tbody>
                                                <tr>
                                                    <td> {{ $studentcourses->where_did_you_know_school_ }} </td>
                                                </tr> 
                                            </tbody>
                                        </table>  
                                    </div> 
                                </div>  
                                <!--<div class="row"> -->
                                <!--    <div class="col-md-8">-->
                                <!--        <h5>Additional information about you</h5> -->
                                <!--        <div class="row">-->
                                <!--            <div class="col-md-6"> -->
                                <!--                <table class="table form-drisms">-->
                                <!--                    <tbody>-->
                                <!--                        <tr>-->
                                <!--                            <th>Civil Status: </th>-->
                                <!--                            <td>{{ $studentcourses->civil_status }}  </td>-->
                                <!--                        </tr>  -->
                                <!--                        <tr>-->
                                <!--                            <th>Place of Birth: </th>-->
                                <!--                            <td>{{ $studentcourses->pob }}</td>-->
                                <!--                        </tr> -->
                                <!--                        <tr>-->
                                <!--                            <th>Height: </th>-->
                                <!--                            <td> {{ $studentcourses->height }} </td>-->
                                <!--                        </tr> -->
                                <!--                        <tr>-->
                                <!--                            <th>Weigth: </th>-->
                                <!--                            <td> {{ $studentcourses->weigth }}  </td>-->
                                <!--                        </tr> -->
                                <!--                        <tr>-->
                                <!--                            <th>Blood Type: </th>-->
                                <!--                            <td>{{ $studentcourses->blood_type }}  </td>-->
                                <!--                        </tr> -->
                                <!--                    </tbody>-->
                                <!--                </table>  -->
                                <!--            </div> -->
                                <!--            <div class="col-md-6"> -->
                                <!--                <table class="table form-drisms">-->
                                <!--                    <tbody>-->
                                <!--                        <tr>-->
                                <!--                            <th>Name of Mother: </th>-->
                                <!--                            <td> {{ $studentcourses->name_of_mother }}  </td>-->
                                <!--                        </tr>  -->
                                <!--                        <tr>-->
                                <!--                            <th>Name of Father: </th>-->
                                <!--                            <td> {{ $studentcourses->name_of_father }} </td>-->
                                <!--                        </tr> -->
                                <!--                        <tr>-->
                                <!--                            <th>Person to Notify in Case of Emergency:  </th>-->
                                <!--                            <td> {{ $studentcourses->person_notify_in_case_of_emergency }} </td>-->
                                <!--                        </tr> -->
                                <!--                        <tr>-->
                                <!--                            <th>Address: </th>-->
                                <!--                            <td> {{ $studentcourses->guardian_address }} </td>-->
                                <!--                        </tr> -->
                                <!--                        <tr>-->
                                <!--                            <th>Contact Number: </th>-->
                                <!--                            <td> {{ $studentcourses->guardian_number }}  </td>-->
                                <!--                        </tr>  -->
                                <!--                        <tr>-->
                                <!--                            <th> Place of Birth: </th>-->
                                <!--                            <td>{{ $studentcourses->guardian_pob }}</td>-->
                                <!--                        </tr> -->
                                <!--                        <tr>-->
                                <!--                            <th> Relation: </th>-->
                                <!--                            <td> {{ $studentcourses->guardian_relation }} </td>-->
                                <!--                        </tr>  -->
                                <!--                    </tbody>-->
                                <!--                </table>  -->
                                <!--            </div>  -->
                                <!--        </div>-->
                                <!--    </div> -->

                                <!--    <div class="col-md-4 text-right">-->
                                <!--        <h5>TO BE ACCOMPLISHED BY PERSONEL</h5> -->
                                <!--        <div class="row">  -->
                                <!--            <table class="table  form-drisms">-->
                                <!--                <tbody>-->
                                <!--                    <tr>      -->
                                <!--                        <td><label>O.R.No.</label></td> -->
                                <!--                        <td class="">{{ $studentcourses->orno }} </td>-->
                                <!--                    </tr> -->
                                <!--                    <tr>-->
                                <!--                        <td><label>Amount Paid</label> </td>-->
                                <!--                        <td>{{ $studentcourses->amount_paid }}</td>-->
                                <!--                    </tr>   -->
                                <!--                </tbody>-->
                                <!--            </table>    -->
                                <!--        </div>-->
                                <!--    </div> -->
                                <!--</div> -->

                                <!--<div class="row">  -->
                                <!--    <div class="col-md-4" >-->
                                <!--        <table class="table table-borderless form-drisms">-->
                                <!--            <thead> -->
                                <!--            </thead>-->
                                <!--            <tbody>-->
                                <!--                <tr>      -->
                                <!--                    <th scope="row">Years of Experience: </th> -->
                                <!--                    <td>  {{ $studentcourses->y_e }}  </td>-->
                                <!--                </tr>  -->
                                <!--            </tbody>-->
                                <!--        </table>   -->
                                <!--    </div>-->
                                <!--</div>-->
                                
                                
                                <div class="row">  
                                    <div class="col-md-12">  
                                        <table class="table table-borderless form-drisms">
                                            <tbody>
                                                <tr>      
                                                    <td> <label>Signature: </label></td> 
                                                    <td><label>Assisted by: </label> </td>
                                                </tr> 
                                                <tr>
                                                    <td class=""><hr></td> 
                                                    <td class=""><hr></td>
                                                </tr>   
                                            </tbody>
                                        </table>   
                                        <div class="alert alert-danger">NOTE: REGISTRATION FEE OF P2000 IS NON-REFUNDABLE</div>
                                    </div>  
                                </div>     
                       
                </div> 
                <div class="col-md-6">
                    <div class="student-growth-chart mt-15">
                        <button class="btn btn-primary" id="student-enrollment-record">Print</button>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    </div>
    </div> 

@else
    @include("admin/empty/empty")         
@endif 