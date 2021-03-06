<!-- modals -->
<div class="modal right fade" id="update-profile{{ $user->id }}" role="dialog">


    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
                            class="mdi mdi-close-circle-outline"></i></span></button>
                <h4 class="modal-title" id="myModalLabel2">Update {{$user->fname }}</h4>
            </div>

            <div class="modal-body">
                <form action="{{ route("profiles.update") }}" method="POST">
                    @csrf

                    <input type="hidden" class="form-control" placeholder="Amount Paid" value="{{$user->id}}"
                           name="user_id">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>First Name</label>
                            <input required type="text" class="form-control" placeholder="Name" value="{{$user->fname}}" name="fname">
                            <br>
                            <label>Last Name</label>
                            <input required type="text" class="form-control" placeholder="Name" value="{{$user->lname}}" name="lname">
                            <br>
                            <label>Email</label>
                            <input required type="email" class="form-control" placeholder="Name" value="{{$user->email}}" name="email">
                            <br>
                            <label>Phone</label>
                            <input required type="text" class="form-control" placeholder="Name" value="{{$user->phone}}" name="phone">
                            <br>
                            <label>Date of Birth</label>
                            <input required type="date" class="form-control" placeholder="Name" value="{{$user->dob}}" name="dob">
                            <br>
                            <label>Gender</label>
                            <div class="form-check">
                                <div class="d-flex justify-content-start">
                                    <div class="d-inline">
                                        <input required id="male" type="radio"
                                               class=" "
                                               name="gender" value="Male" {{ ($user->gender=='Male')?'checked':'' }}
                                               autocomplete="gender" autofocus>
                                        <label class="form-check-label" for="male">
                                            {{ __('Male') }}
                                        </label>
                                    </div>
                                    <div class="d-inline ml-4">
                                        <input id="female" type="radio"
                                               class=""
                                               name="gender" value="Female" {{ ($user->gender=='Female')?'checked':''  }}
                                               autocomplete="gender" autofocus>
                                        <label class="form-check-label"
                                               for="female">
                                            {{ __('Female') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <label>Address</label>
                            <input type="text" class="form-control" placeholder="Name" value="{{$user->address}}" name="address">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">

                                <input type="submit" name="" value="Update Profile" class="btn btn-primary btn-block"/>
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

