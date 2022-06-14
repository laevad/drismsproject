@extends('layouts.header') 
@section('content')      
    @include("layouts/includes/sidebar")   

    <style>
        ul li{
            list-style: none;
        }
        .form-drisms tbody tr td{
            /* padding-top: 0px !important; 
            padding-bottom: 0px !important */
        }
        .form-drisms tbody tr{
            background-color:white !important;
        } 

        @media print
        {
            .page-header, .evaluate-instructor { display: none; }
            #student-enrollment-record { display: none; }
            footer{ display: none;}
        } 
       
    </style> 
    
<!-- main content -->
<div class="main-content"> 
        <div class="page-header"> 
            <h3></h3>
        </div> 
 
        @if(Auth::user()->role == "Instructor") 
            @include('instructor/theoretical') 
        @endif
        @if(Auth::user()->role == "Student")
            @if(Auth::user()->enrollment_status == 1)   
                @include('student/theoretical')    
            @else 
                @include("admin/empty/empty")   
            @endif
        @endif
 
</div> 


@include('layouts/includes/footer')

<script>
    $('#student-enrollment-record').on('click touchstart', function(e){
        e.preventDefault(); 
        window.print();
    });

</script>
@endsection