@extends('layouts.header') 
@section('content')     
        <!-- Admin home page --> 
        <!-- sidebar --> 

    @include("layouts/includes/sidebar")   

  
    <!-- main content -->
    <div class="main-content">
        <div class="page-header">
            <h3>Invoices</h3>
        </div>


        <!-- page content -->
        <div class="row">
            <div class="col-md-12">
                <div class="card"> 
                        <div class="card-body p-0">
                            <div class="table-responsive longer">
                                <table class="table table-striped mb-0 mw-1000" id="data-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student</th>
                                        <th>Ref</th>
                                        <th>Amount</th>
                                        <th>Paid</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody> 

                                    @forelse($invoices as $invoice)
 
                                        <tr>
                                            <th scope="row"> </th>
                                            <td class="p-8">
                                                @if($invoice->image_name)

                                                <img height="45px" 
                                                    src="{{ url('/images'). '/' .$invoice->image_name }} " 
                                                    class="img-responsive" 
                                                >   
                                                @else
                                                <img height="45px" 
                                                    src="{{ url('/assets/images/avatar.png') }} " 
                                                    class="img-responsive" 
                                                >  
                                                @endif

                                                <a href=""><strong>{{ $invoice->fname}} {{ $invoice->lname}} </strong></a>
                                                <span class="communication-contact">{{ $invoice->email}} </span>
                                            </td>
                                            <td>{{ $invoice->course_name }}</td>
                                            <td>{{ $invoice->total_amount }}</td>
                                            <td>{{ $invoice->price }}</td>
                                            <td>
                                            @php
                                                $balance = 0;
                                                $balance = ($invoice->total_amount) - ($invoice->price);
                                            @endphp 
                                                @if($balance < 0) 
                                                    <span class="badge badge-danger">{{ $balance }}</span>
                                                @else 
                                                    <span class="badge badge-success">{{ $balance }}</span> 
                                                @endif 
                                            </td>
                                            <td>
                                                @if($invoice->total_amount >= $invoice->price)  
                                                    <span class="badge badge-danger">Paid </span>   
                                                @else  
                                                    <span class="badge badge-danger">Not Paid </span>  
                                                @endif
                                            </td>
                                            
                                            <td>{{ $invoice->created_at }}</td>
                                            <td class="text-center">
                                                <!-- <a class="btn btn-primary btn-sm btn-icon" target="_blank" href=""><i class="mdi mdi-eye"></i> Preview</a> -->
                                                <div class="dropdown inline-block">
                                                        <button class="btn btn-default btn-sm btn-icofn dropdown-toggle" data-toggle="dropdown">
                                                            <i class="mdi mdi-dots-vertical"></i></button>
                                                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1"> 
                                                            @if($balance < 0) 
                                                                <li role="presentation">
                                                                    <a role="menuitem" href="" input="invoice" modal="#addpayment{{ $invoice->user_id }}" rel="print-payment-record{{ $invoice->user_id }}" class="pass-data {{ $permission_status }}" value="" > 
                                                                        <i class="mdi mdi-credit-card-plus"></i> 
                                                                        Add Payment
                                                                    </a>
                                                                </li>  
                                                            @endif 
                                                            <li role="presentation"> 
                                                                <a role="menuitem" href="{{ route('invoice.print', $invoice->user_id) }}" target="_blank"> 

                                                                <i class="mdi mdi-eye"></i> 
                                                                    <!-- <i class="mdi mdi-cloud-download"></i>  -->
                                                                    Print Preview
                                                                </a>
                                                            </li>  
                                                        </ul>
                                                </div>
                                                
                                            </td>
 

                                        </tr>  
 
                                            @include("admin/modal/invoice")  
                                    @empty 
                                        <tr>
                                            <th class="text-center" colspan="8">It's empty here!</th>
                                        </tr> 
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
    <script>
        $(document).ready(function() {
 

 


            // $('#data-table').DataTable({
            //     dom: 'Bfrtip',
            //     buttons: [
            //         'copyHtml5',
            //         'excelHtml5',
            //         'csvHtml5'
            //     ]
            // });
        });
        </script>
@endsection