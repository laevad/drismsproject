@extends('layouts.header') 
@section('content')      
    @include("layouts/includes/sidebar")     
    <style> 
            #theoretical>a:hover, #theoretical>a{
                color:#38c172;
                text-decoration: none;
            }
            
            #practical>a:hover, #practical>a{
                color: #e3342f;
                text-decoration: none;
            }
            
    </style>
<!-- main content -->
<div class="main-content">  

    
        <div class="page-header"> 
            <h3></h3>
        </div>  

        <div class="row" style="text-align: center; justify-content: center;"> 
            <!-- stat 1 -->
            <!--<div class="col-md-3">-->
            <!--    <div class="card widget" id="theoretical">-->


            <!--        <a href="{{ route('student.scheduling.theoretical') }}" class="btn btn-success btn-icon pull-right" style="color: white">-->
            <!--            <i class="mdi mdi-blur-radial"></i>-->
            <!--             Theoretical -->
            <!--        </a> -->



            <!--    </div>-->
            <!--</div>-->
            <!-- stat 2 -->
            <div class="col-md-3">
                <div class="card widget" id="practical">  
                    <a href="{{ route('student.scheduling.practical') }}" class="btn btn-danger btn-icon pull-right @if(!$student_access_practical->isEmpty())  @else disabled  @endif" style="color: white">
                        <i class="mdi mdi-blur-radial"></i>
                            Practical 
                    </a>  
                </div>
            </div> 
        </div>
        
</div> 
    @include('../layouts/includes/footer')   
@endsection