
@foreach($students as $student)
      <!-- modals -->
      <div class="modal right fade" id="create{{ $student->id }}" role="dialog">


        <div class="modal-dialog" role="document">
            <div class="modal-content"> 
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close-circle-outline"></i></span></button>
                    <h4 class="modal-title" id="myModalLabel2">Update {{$student->fname }}</h4> 
                </div> 

                <div class="modal-body">
                    <form action="{{ route('invoice.store')}}" method="POST" > 
                    @csrf
                    
                    <input type="hidden" class="form-control" placeholder="Amount Paid" value="{{$student->id}}" name="student_id">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-12">
    
                            <label>Course</label>
                            <select class="form-control select2" name="course_id" required=""> 
                               
                                  @forelse($studentCourses as $sc) 
                                    @if($student->id  == $sc->student_id)
                                      <option value="{{$sc->course_id}}">{{ $sc->name }}</option>  
                                    @else
                                      <option value="">No record was found</option> 
                                    @endif
                                  @empty
                                    <option value="">No record was found</option> 
                                  @endforelse 
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group newamount" require>
                        <div class="row">
                          <div class="col-md-12"> 
                            <input type="number" class="form-control" placeholder="00.00 (&#8369)" min="0" max="100000" step="1" value="" name="amount">
                          </div>
                        </div>
                      </div>
                      <div class="form-group newmethod" require>
                        <div class="row">
                          <div class="col-md-12">
                            <label for="email">Method of payment</label>
                            <select class="form-control method" name="method">
                                <option value="Cash">Cash</option>
                                <!-- <option value="Mpesa">Mpesa</option>
                                <option value="Paypal">Paypal</option>
                                <option value="Card">Card</option>
                                <option value="Other">Other</option> -->
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
    @endforeach