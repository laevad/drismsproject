@extends('layouts.header') 
@section('content')      
    @include("layouts/includes/sidebar")     
<!-- main content -->
<div class="main-content"> 
    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Staff') 
        @include('admin/dashboard') 
    @else
       @include('student/dashboard') 
    @endif
</div> 
    @include('../layouts/includes/footer')  
    <script> 
        $('#student-enrollment-record').on('click touchstart', function(){
            window.print();
        })
    </script>
@endsection