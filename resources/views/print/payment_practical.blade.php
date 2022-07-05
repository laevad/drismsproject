@extends('layouts.header')
@section('content')
    <!-- Admin home page -->
    <!-- sidebar -->


    <style>
        @media print
        {
            #non-printable { display: none; }
            #printable {
                display: block;

            }
            .print-body{
                color:#000;
            }
            .text-right{
                color:#000;
            }
            .table-responsive{
                color:#000;
            }
            #print-payment{
                display: none;
            }
            footer{
                display: none;
            }
        }
        footer{
            margin: 0;
        }
        .text-right {
            display: block;
        }
        h1{
            text-align: center;
        }
        h5{
            text-align: center;
        }

    </style>


    <div class="print-body">



        @forelse($invoice_practicals as $invoice)

            <h1>DriSMS</h1>
            <h5>Cagayan de Oro City</h5>
            <h5>============================</h5>

            <div class="container bootstrap snippets bootdey">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 text-left">
                                <h4><strong>Student</strong> Details</h4>
                                <ul class="list-unstyled">
                                    <li><strong>First Name:</strong>{{ $invoice->fname }}</li>
                                    <li><strong>Last Name:</strong> {{ $invoice->lname }}</li>
                                    <li><strong>Gmail:</strong>  {{ $invoice-> email}} </li>
                                </ul>
                            </div>

{{--                            <div class="col-md-6 col-sm-6 text-right">--}}
{{--                                <h4><strong>Payment</strong> Details</h4>--}}
{{--                                <ul class="list-unstyled">--}}
{{--                                    <li><strong>Account Number:</strong> {{ $invoice->id }}</li>--}}
{{--                                    <li><strong>Account Username:</strong> {{ $invoice->username }}</li>--}}

{{--                                </ul>--}}

{{--                            </div>--}}

                        </div>

                        <div class="table-responsive">
                            <table class="table table-condensed nomargin">
                                <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Student Name</th>
                                    <th>Date</th>
                                    <th>Updated</th>
                                    <th>Total Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div><strong>{{ $invoice->course_name }}</strong></div>
                                    </td>
                                    <td>{{ $invoice->fname }} {{ $invoice->lname }}</td>
                                    <td>{{ $invoice->created_at }}</td>
                                    <td>{{ $invoice->updated_at }}</td>
                                    <td>{{ $invoice->price }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <hr class="nomargin-top">
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <h4><strong>Contact Details </strong> </h4>
                                <p class="nomargin nopadding">
                                    <strong></strong>

                                </p><br><!-- no P margin for printing - use <br> instead -->

                                <address>

                                    Lapasan, Cagayan de Oro City<br>
                                    Phone: +63 9682095315 <br>
                                    Fax: 1-800-565-2390 <br>
                                    Email:admin@gmail.com
                                </address>
                            </div>

                            <div class="col-sm-6 text-right">
                                <h4><strong>Payment</strong> Details</h4>
                                <ul class="list-unstyled">
                                    <li><strong>Full Tuition: </strong> 3000</li>
                                    <li><strong>Partial Payment: </strong> {{ $invoice->amount }}</li>
                                    <li><strong>Total:</strong> {{ $invoice->price }}</li>
                                    <li>Balance:  @php
                                            $balance = 0;
                                            $balance = ($invoice->total_amount) - ($invoice->price);
                                        @endphp
                                        @if($balance < 0)
                                            <span class="">{{ $balance }}</span>
                                        @else
                                            <span class="">{{ $balance }}</span>
                                        @endif</li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li>Assisted by: <strong>{{ $invoice->assisted_by }}</strong></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="text-right">
                <button class="btn btn-primary" id="print-payment"> Print</button>
            </div>
        @empty

        @endforelse

    </div>

    @include('../layouts/includes/footer')
    <script>
        $(document).ready(function() {



            $('#print-payment').on('click touchstart', function(e){
                e.preventDefault();
                window.print();
            });


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
