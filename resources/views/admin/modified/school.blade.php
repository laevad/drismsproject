

<!-- add school -->
<div class="modal right fade" id="update{{$school->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"><i class="mdi mdi-close-circle-outline"></i></span></button>
                <h4 class="modal-title" id="myModalLabel2">Add School</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('school.update', $school->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <p>A welcome email will be set and recepient will complete setup of their school account.</p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12"></div>
                        </div>
                        <label>School Name</label> 
                        <input 
                            class="form-control @error('name') is-invalid @enderror" 
                            name="name" 
                            placeholder="School Name"  
                            type="text"
                            value="{{ $school->name }}"
                        >
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Email Address</label> 
                                <input 
                                    type="email" 
                                    class="form-control" 
                                    data-parsley-trigger="change" 
                                    name="email" 
                                    placeholder="Email Address"  
                                    value="{{ $school->email }}"
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
                                    class="form-control" 
                                    name="phone" 
                                    placeholder="Phone Number"  
                                    type="text" 
                                    value="{{ $school->phone }}"
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
                                    class="form-control" 
                                    name="address" 
                                    placeholder="Address"  
                                    type="text"
                                    value="{{ $school->address }}"
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
                                <input type="submit" value="Update School"  class="btn btn-primary btn-block"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div>