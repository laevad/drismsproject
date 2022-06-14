@extends('layouts.header') 
@section('content')     
        <!-- Admin home page --> 
        <!-- sidebar --> 

    @include("layouts/includes/sidebar")   
    @include("admin/modal/fleet")  
 
    <!-- main content -->
    <div class="main-content">
        <div class="page-header">
       
            <h3>Evaluation</h3>
            <p> </p>
        </div> 
        <!-- page content -->
        <div class="row">
            <div class="col-md-12">
                <div class="card"> 
                    <div class="card-body p-0">
                        <div class="table-responsive " style="height: 80vh"> 
                            
                            <table class="table table-striped mb-0 mw-1000">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Demonstrates </th>
                                        <th>Accurate<th>Plate</th>
                                        <th>demonstrates_mastery</th> 
                                        <th>teaching strategy</th> 
                                        <th>enhance student self-esteem</th> 
                                        <th>Encourage Student</th> 
                                        <th>Implements Learning Condition</th> 
                                        <th>Comments</th> 
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    
                                    @forelse($instructor_evaluation as $key=>$val )
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $val.demonstrates_sensivity_to_students }}</td>
                                        <td>{{ $val.keeps_accurate_records_of_students }}</td>
                                        <td>{{ $val.demonstrates_mastery_subject_matter }}</td>
                                        <td>{{ $val.creates_teaching_strategies }}</td>
                                        <td>{{ $val.enhances_student_self_esteem }}</td>
                                        <td>{{ $val.encourage_students }}</td>
                                        <td>{{ $val.designs_and_implements_learning_conditions }}</td>
                                        <td>{{ $val.comments }}</td> 
                                    </tr>                           
                                    @empty
                                        <td colspan="10" class="text-center">Empty Instructor Evaluation Record</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    @include('../layouts/includes/footer') 
    
@endsection