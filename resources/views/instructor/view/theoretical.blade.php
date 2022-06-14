@extends('layouts.header') 
@section('content')      
    @include("layouts/includes/sidebar")  


    <style>

        @media print{
            footer,
            #print-schedule
            {
                display: none !important;
            }
        }
        footer{
            margin: 0 !important;
        }
    </style>
<!-- main content -->
<div class="main-content"> 

    <div class="page-header"> 
        <h3>Theoretical Classes</h3>
    </div> 


    <div class="row"> 
        <div class="col-md-12">
            @if(!$view_student_enroll->isEmpty())
            <table class="border borderless table">
                <thead> 
                    <th>#</th>
                    <th>Name</th>   
                    <th colspan="2" class="text-center">Action</th> 
                </thead>
                <tbody> 
                    @foreach($view_student_enroll as $key=>$val)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ ucfirst($val->fname) }} {{ ucfirst($val->lname) }} </td>

                            
                            @if($val->evaluation == 'pass' || $val->evaluation == 'failed')
                            <td colspan="2"  class="text-center alert @if($val->evaluation == 'pass') alert-success @else alert-danger @endif" > <b> {{ ucfirst($val->evaluation) }} </b> </td>
                             @else
                                <td> 
                                <form action="{{ route('theoretical.instructor.update.student',  $val->id) }}" method="POST" >
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="evaluation" value="pass">
                                        <input type="submit" class="btn btn-success @if($val->status == 'completed') disabled @endif" value="Pass" />
                                </form>
                                </td>
                                <td>  
                                    <form action="{{ route('theoretical.instructor.update.student',  $val->id) }}" method="POST" >
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="evaluation" value="failed">
                                        <input type="submit" class="btn btn-danger @if($val->status == 'completed') disabled @endif" value="Failed" />
                                    </form>
                                    
                                  </td> 
                            @endif 
                        </tr> 
                    @endforeach 
                </tbody>
            </table> 

            <button class="btn btn-primary mb-2" id="print-schedule" >Print</button>
            @else 
                @include("admin/empty/empty") 
            @endif  
        <div>
    </dov>

</div> 

@include('../layouts/includes/footer')  

<script>
    $('#print-schedule').on('click touchstart', function(){
        window.print();
    });
</script>
@endsection