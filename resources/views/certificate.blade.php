@extends('layouts.header') 
@section('content')      
        <!-- sidebar -->  
    @include("layouts/includes/sidebar")   
    <style> 
        @media print{
          footer{
              display: none;
          }  
          #cert-print{
              display:none;
          }
        }
        footer{
            margin: 0 !important;
        }
        table{
            width: 100% !important;
        }
    </style>
<div class="main-content"> 
<!-- (!$student_cert->isEmpty()) -->
    @if(!empty($student_cert)) 
        <div class="page-header flex flex-row items-center justify-center"> 
            <div class="user-profile-pic  mr-2">  
                <img 
                    src="{{ asset('/assets/images/icon.ico') }}" 
                    class="img-responsive" 
                >   
            </div>  
            <div class="user-profile-pic  ml-2">   
                @if(!empty($student_cert)) 
                    <img 
                        src="{{ url('/images'). '/' .$student_cert->image_name }} " 
                        class="img-responsive" 
                    >   
                @else
                    <img 
                        src="{{ url('/assets/images/avatar.png') }} " 
                        class="img-responsive" 
                    >  
                @endif  
            </div>   
        </div> 
        <div class="page-header flex flex-column justify-center items-center">   
            <h4>Republic of the Philippines</h4>
            <h4>Department of Transportation</h4>
            <h4>Land Transportation Office</h4>
        </div>  
        <!-- page content -->
        <div class="row">   
            <dic class="col-md-12 text-center">
                <h3>CERTIFICATE OF DRIVING COURSE COMPLETION</h3>
            </div> 
            <div class="col-md-12"  style="margin-bottom: 10px">
                <div class="" style="background-color:gray; padding: 10px;"  style="margin-bottom: 10px">
                    <p class="m-0" ><b>Student Driver Information</b></p>
                </div> 
                <table>
                    <tbody class="">
                        <tr>
                            <td><b>First Name: </b>{{ ucfirst($student_cert->fname) }}  </td>
                            <td colspan="2" ></td>
                            <!-- <td>Middle Name</td> -->
                            
                            <td><b>Last Name: </b> {{ ucfirst($student_cert->lname) }} </td>
                            <td colspan="2" ></td>
                        </tr>
                        <tr>
                            <td><b>Address: </b> {{ $student_cert->address }}</td>
                            <td colspan="6"></td> 
                        </tr> 
                        <tr>
                            <td><b>Driver's License Number: </b> {{ $student_cert->driver_license_no }} </td>
                            <td  colspan="2"></td> 
                            <td><b>Date of Birth: </b> {{ date('F j, Y', strtotime($student_cert->dob)) }}</td>
                            <td  colspan="2">  </td> 
                        </tr> 
                        <tr>
                            <!-- <th>Nationality: </th>
                            <td> Filipino</td>  -->
                            <td><b> Age: </b> {{ $age }} </td>
                            <td> </td> 
                            <td><b>Gender: </b> {{ $student_cert->gender }} </td>
                            <td>  </td> 
                            <td> <b>Marital Status: </b> {{ $student_cert->civil_status }}</td>
                            <td>  </td> 
                        </tr>
                    </tbody>
                </table>
            </div>  
    
            <div class="col-md-12"  style="margin-bottom: 10px"> 
                <hr> 

                <div class="" style="background-color:gray; padding: 10px; margin-bottom: 10px;">
                    <p class="m-0" ><b>Driving Course Training Information</b></p>
                </div> 


                <table>
                    <tbody>
                        <tr>
                            <td><b>Classes:</b> Theoretical</td>
                            <td></td>
                            <td><b>Date Started:</b> {{ date('F j, Y', strtotime($student_cert->shc_start)) }} </td>
                            <td></td>
                            <td><b>Date Completed:</b> {{ date('F j, Y', strtotime($student_cert->shc_end)) }} </td>
                            <td></td> 
                            
                            <td><b>Total Number of Days:</b> {{ date('F j, Y', strtotime($student_cert->shc_duration)) }} </td>
                            <td></td> 
                        </tr> 
                        <tr>
                            <td> <b>Classes:</b> Practical</td>
                            <td></td> 
                            <td><b>Date Started:</b> {{ date('F j, Y', strtotime($student_cert->fs_start)) }} </td>
                            <td></td> 
                            <td><b>Date Completed:</b> {{ date('F j, Y', strtotime($student_cert->fs_end)) }} </td>
                            <td></td> 
                            <td><b>Total Number of Days:</b> {{ date('F j, Y', strtotime($student_cert->fs_duration)) }} </td>
                            <td></td> 
                        </tr> 
                    </tbody>
                </table>
            </div> 

            <div class="col-md-12"  >
                <div class="" style="background-color:gray; padding: 10px; margin-bottom: 10px;">
                    <p class="m-0" ><b>Driving Course Training Evaluation</b></p>
                </div> 
                <div class="" style="margin-bottom: 10px">
                    <p class="m-0" ><b>Driving Course Name:</b> {{ $student_cert->c_name }}</p>
                </div>  
                <table>
                    <thead>
                        <th>Assessment </th>
                        <th>PASSED</th>
                        <th>FAILED</th>
                        <th></th>
                        <th></th>

                    </thead>
                    <tbody>
                        <tr>
                            <td>Theoretical Classes: </td>
                            <td> @if($student_cert->sc_evaluation == "pass") <div class="alert alert-success" >Pass </div>  @endif</td>
                            <td> @if($student_cert->sc_evaluation == "failed") <div class="alert alert-danger" >Failed </div> @endif </td>
                            <!-- <td>Additional Remarks: </td>
                            <td></td>  -->
                        </tr>
                        <tr> 
                            <td>Practical Classes: </td>   
                            <td> @if($student_cert->fs_evaluation == "pass") <div class="alert alert-success" >Pass </div> @endif</td>
                            <td> @if($student_cert->fs_evaluation == "failed") <div class="alert alert-danger" >Failed </div> @endif </td>
                        </tr> 
                        
                        <tr> 
                            <td>Overall Rating: </td>   
                            <td  > @if($student_cert->sc_evaluation == "pass" && $student_cert->fs_evaluation == "pass" ) <div class="alert alert-success" >Pass </div> @endif</td>
                            <td  > @if($student_cert->sc_evaluation == "failed" || $student_cert->fs_evaluation == "failed") <div class="alert alert-danger" >Failed </div> @endif </td> 
                        </tr> 
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="page-header  text-center">   
                <P class="m-0">This Driving Course Completion Certificate with </P>
                <P class="m-0">Control Number {{ $student_cert->control_no }} has been issued</P>
                <P class="m-0">on {{ date('F j, Y', strtotime($date_now)) }}  </P>
            </div> 


            <div class="page-header  text-center">   
                <P class="m-0">Prepared and issued by:</P>
                <h3 class="m-0">DRISMS SCHOOL</h3> 
            </div> 

            <div class="page-header  text-center">   
                <hr>
                <div class="flex flex-row justify-evenly align-center">
                    <div> 
                        <h4 class="m-0">{{ $ti->fname }} {{ $ti->lname }}</h4>
                        <p class="m-0">Authorized Thoeretical Instructor</p>  
                    </div>
                    <div> 
                        <h4 class="m-0">{{ $pi->fname }} {{ $pi->lname }}</h4>
                        <p class="m-0">Authorized Practical Instructor</p>  
                    </div>
                </div>
            </div> 
 

            <div class="page-header  text-center " style="margin: 0px 20px;">    
                <p class="m-0">This Certificate was uploaded on {{  $student_cert->date_issue }}</p> 
            </div> 


            <button class="btn btn-primary" id="cert-print">Print</button>
        </div> 
        @else
            @include("admin/empty/empty") 
        @endif
    </div>


    @include('../layouts/includes/footer') 
        <script>
            $('#cert-print').on('click touchstart', function(){
                window.print();
            })

    </script>
@endsection