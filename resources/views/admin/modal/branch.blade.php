
<!-- modals -->
<div class="modal right fade" id="create" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close-circle-outline"></i></span></button>
                    <h4 class="modal-title" id="myModalLabel2">Add Branch</h4>
                </div>

                <div class="modal-body">
                    <form action="{{ route('branch.store') }}" method="POST" >
                        @csrf
                        <p>Enter information of your new branch.</p>
         
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Branch Name</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        placeholder="Branch Name" 
                                        name="name" 
                                        required=""
                                    >

                                    @error('name')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror 
                                </div>
                            </div>
                        </div>




                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Email Address</label>
                                <input 
                                    type="email" 
                                    class="form-control" 
                                    placeholder="Email Address" 
                                    name="email" 
                                    required=""
                                >

                                
                                @error('email')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror 
                            </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Phone Number</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="Phone Number" 
                                    name="phone" 
                                    required=""
                                >
                                
                                @error('phone')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror 
                            </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Address</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="Address" 
                                    name="address" 
                                    required=""
                                >
                                @error('address')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror 
                            </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-12"> 

                             
                            <label>Main School</label>
                            <select class="form-control select2" name="school_id" required=""> 
                                <option value="">Select Course</option>  
                                @if(!empty($schools))
                                @foreach($schools as $school)
                                <option value="{{$school->id}}">{{ $school->name }}</option> 
                                @endforeach
                                @endif 
                            </select>


                            </div>
                        </div>
                      </div>






                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <input 
                                    type="submit" 
                                    class="btn btn-primary btn-block" 
                                    value="Add Branch"
                                />
                            </div>
                        </div>
                      </div>
                    </form>
                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
