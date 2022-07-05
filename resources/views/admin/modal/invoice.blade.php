<div class="modal right fade" id="addpayment{{ $invoice->user_id }}" role="dialog">


        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close-circle-outline"></i></span></button>
                    <h4 class="modal-title" id="myModalLabel2">Update {{$invoice->fname }}</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('invoice.addPayment')}}" method="POST" >
                    @csrf
                    <input type="hidden" class="form-control" placeholder="Amount Paid" value="{{$invoice->user_id}}" name="student_id">
                    <!-- <input type="hidden" class="form-control" placeholder="Amount Paid" value="{{$invoice->id}}" name="student_id"> -->
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-12">
                            <label>Course</label>
                            <select class="form-control select2" name="course_id" required="">
                                <option selected value="{{$invoice->course_id}}">{{ $invoice->course_name }}</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group newamount" require>
                        <div class="row">
                          <div class="col-md-12">
                            <input type="number" class="form-control" placeholder="00.00 (&#8369)" min="0" max="100000" step="1" value="{{ $balance }}" name="amount">
                          </div>
                        </div>
                      </div>
                      <div class="form-group newmethod" require>
                        <div class="row">
                          <div class="col-md-12">
                            <label for="email">Method of payment</label>
                            <select class="form-control method" name="method">
                                <option value="Cash">Cash</option>
                            </select>
                          </div>
                        </div>
                        </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-12">

                            <input type="submit" name="" value="Add" class="btn btn-primary btn-block" />
                            <!-- <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                           -->
                          </div>
                        </div>
                      </div>
                    </form>
                </div>
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
      </div><!-- modal -->
