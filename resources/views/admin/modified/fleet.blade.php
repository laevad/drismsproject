<!-- modals -->
<div class="modal right fade" id="update{{ $car->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close-circle-outline"></i></span></button>
                    <h4 class="modal-title" id="myModalLabel2">Add Vehicle</h4>
                </div>

                <div class="modal-body">
                    <form action="{{ route('fleet.update', $car->id) }}" method="POST" >
                        @csrf
                        @method('PUT')
                    <p>A welcome email will be set and recepient will complete setup.</p>
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Car No.</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="Car No." 
                                    name="carno" 
                                    value="{{$car->car_no}}"
                                    required
                                >
           
                            </div>
                            <div class="col-md-6">
                                <label>Number Plate</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="Number Plate" 
                                    name="carplate" 
                                    required
                                    value="{{$car->car_plate}}"
                                >
                            </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Make</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="Make" 
                                    name="make" 
                                    required
                                    value="{{$car->make}}"
                                >
                              </div>
                            <div class="col-md-6">
                                <label>Model</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="Model" 
                                    name="model" 
                                    required
                                    value="{{$car->model}}"
                                >
                              </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Model Year</label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    placeholder="Model Year" 
                                    name="modelyear" 
                                    required
                                    value="{{$car->model_year}}" 
                                >
                            </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="email">Assigned Instructor</label>
                                
                                <select class="form-control select" name="instructor" required> 
                                    @foreach($users as $user)
                                        <option class="item" value="{{ $user->id }}">{{ $user->fname }} {{ $user->lname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                            
                                <input type="submit" value="Update Vehicle" class="btn btn-primary btn-block">
                                <!-- <button class="btn btn-primary btn-block" type="submit">Add Vehicle</button>
                            -->
                            </div>
                        </div>
                      </div>
                      
                    </form>
                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->

    <!-- update -->
    <div class="modal right fade" id="update" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"><i class="mdi mdi-close-circle-outline"></i></span></button>
                    <h4 class="modal-title" id="myModalLabel2">Edit Car</h4>
                </div>
                <div class="update-holder"></div>
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>
    <!-- end update -->