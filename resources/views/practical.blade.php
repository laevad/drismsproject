@extends('layouts.header')
@section('content')
    @include("layouts/includes/sidebar")

    <style>
       footer{
            margin: 0 !important;
            margin-top: 20px !important;
        }
        @media print{
            #print-fleet, #print-fleet-schedule, footer{
                display: none;
            }

        }
    </style>

<!-- main content -->
<div class="main-content">
        <div class="page-header">
            <h3></h3>
        </div>
        @if(Auth::user()->role == "Instructor")
            @include('instructor/practical')
        @endif
        @if(Auth::user()->role == "Student")
            @if(Auth::user()->enrollment_status == 1)
                @include('student/practical')
            @else
                @include("admin/empty/empty")
            @endif
        @endif
</div>

@include('layouts/includes/footer')

<script>
    $('#print-fleet, #print-fleet-schedule').on('click touchstart', function(e){
        e.preventDefault();
        window.print();
    });
    $('.fs_pass').on('click touchstart', function (e) {
        e.preventDefault();
        if (confirm("Are you sure to pass this Student?")) {
            $fs_pass = $(this).attr('rel');
            $('#' + $fs_pass).submit();
        }
    })
    $('.fs_fail').on('click touchstart', function (e) {
        e.preventDefault();
        if (confirm("Are you sure to fail this Student?")) {
            $fail = $(this).attr('rel');
            $('#' + $fail).submit();
        }
    })


</script>

@endsection
