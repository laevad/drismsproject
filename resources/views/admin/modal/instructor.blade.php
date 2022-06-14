
<!-- modals -->
<div class="modal right fade" id="create{{$user->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close-circle-outline"></i></span></button>
                    <h4 class="modal-title">Update Instructor {{ $user->fname}}</h4>
                </div>

                <div class="modal-body">
                    <form action="{{ route('instructor.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-12">
                            <label for="email">Status</label>
 
                            <select class="form-control" name="status" required>
                                
                                <option value="Active" @if($user->status == "Active") selected @endif >Active</option>
                                <option value="Suspended" @if($user->status == "Suspended") selected @endif >Suspended</option>
                                <option value="Inactive" @if($user->status == "Inactive") selected @endif >Inactive</option>
                                
                            </select>


                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-12">
                            <button class="btn btn-primary btn-block">Update Instructor</button>
                          </div>
                        </div>
                      </div> 
                    </form>
                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->

