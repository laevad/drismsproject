@extends('layouts.header') 
@section('content')      
    @include("layouts/includes/sidebar")     
    <style> 
        ul li{
            list-style: none;
        }
        .form-drisms tbody tr td{
            padding-top: 0px !important; 
            padding-bottom: 0px !important
        }
        .form-drisms tbody tr{
            background-color:white !important;
        }
    </style>
<div class="main-content"> 
    <div class="page-header"> 
        <h3>School</h3>
    </div> 
    <!-- students growth -->
    <div class="row">  
        @forelse($schools as $school) 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{$school->name}} ( School )</h5> 
                        <small>{{$school->address}}</small>
                    </div>  
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-12 growth-left"> 
                                @forelse($branches as $branch) 
                                    @if($branch->school_id == $school->id) 
                                        <h5>{{$branch->name}} ( Branch )</h5> 
                                        <small>{{$branch->address}}</small>  
                                        @php 
                                            $branches_id = $branch->id;
                                        @endphp
                                        @include("student/view/theoretical_form") 
                                    @endif 
                                @empty  
                                    @php 
                                        $branches_id = NULL;
                                    @endphp 
                                        @include("student/view/theoretical_form")
                                @endforelse 
                                        
                            </div>
                            <div class="col-md-6">
                                <div class="student-growth-chart mt-15"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        @empty
            @include("admin/empty/empty")   
        @endforelse 
    </div> 
</div>


@include('../layouts/includes/footer')  

<script>
    $('.ec_forn_c').on('change', function(){ 
        $('.ec_forn_c').not(this).prop('checked',false);  
        $data = $(this).attr('rel'); 

        $('.dc-cls').addClass('hidden'); 
        $('#'+$data).removeClass('hidden');  
    });

    $('.others_mc').on('change', function(){ 

        if($(this).is(":checked")){ 
            $('.other-transmission').removeClass('hidden');
        }else{ 
            $('.other-transmission').addClass('hidden');
        }

    })

    $('.others_').on('change', function(){

        if($(this).is(":checked")){ 
            $('.other_inform').removeClass('hidden');
        }else{

            $('.other_inform').addClass('hidden');
        }
        
    })
</script>
@endsection