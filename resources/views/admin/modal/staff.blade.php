
<!-- modals -->
<div class="modal right fade" id="updateStaff{{$user->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close-circle-outline"></i></span></button>
                    <h4 class="modal-title">Permission for {{ $user->fname }} {{$user->lname}} Staff </h4>
                </div>

                <div class="modal-body">
                    <form action="{{ route('staff.update', $user->id)}}" method="POST"  > 
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-12">
                            <label for="email">Scheduling</label>
                            <select class="form-control" name="p_schedule" required>
                                <option value="read_only" {{ $user->scheduling == "read_only" ? 'selected' : '' }}>Read Only</option>
                                <option value="read_write"  {{ $user->scheduling == "read_write" ? 'selected' : '' }}>Read & Write</option> 
                                <option value="read_write_delete" {{ $user->scheduling == "read_write_delete" ? 'selected' : '' }} >Read, Write & Delete</option> 
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-12">
                            <label for="email">Students</label>
                            <select class="form-control" name="p_student" required>
                                <option value="read_only" {{ $user->students == "read_only" ? 'selected' : '' }}>Read Only</option>
                                <option value="read_write" {{ $user->students == "read_write" ? 'selected' : '' }}>Read & Write</option> 
                                <option value="read_write_delete" {{ $user->students == "read_write_delete" ? 'selected' : '' }}>Read, Write & Delete</option> 
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-12">
                            <label for="email">Instructor</label>
                            <select class="form-control" name="p_instructor" required>
                                <option value="read_only" {{ $user->instructor == "read_only" ? 'selected' : '' }} >Read Only</option>
                                <option value="read_write" {{ $user->instructor == "read_write" ? 'selected' : '' }} >Read & Write</option> 
                                <option value="read_write_delete" {{ $user->instructor == "read_write_delete" ? 'selected' : '' }} >Read, Write & Delete</option> 
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-12">
                            <label for="email">Fleet</label>
                            <select class="form-control" name="p_fleet" required>
                                <option value="read_only" {{ $user->fleet == "read_only" ? 'selected' : '' }}>Read Only</option>
                                <option value="read_write" {{ $user->fleet == "read_write" ? 'selected' : '' }} >Read & Write</option> 
                                <option value="read_write_delete" {{ $user->fleet == "read_write_delete" ? 'selected' : '' }}>Read, Write & Delete</option> 
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-12">
                            <label for="email">Branch</label>
                            <select class="form-control" name="p_branch" required>
                                <option value="read_only" {{ $user->branch == "read_only" ? 'selected' : '' }} >Read Only</option>
                                <option value="read_write" {{ $user->branch == "read_write" ? 'selected' : '' }} >Read & Write</option> 
                                <option value="read_write_delete" {{ $user->branch == "read_write_delete" ? 'selected' : '' }}>Read, Write & Delete</option> 
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-12">
                            <label for="email">Invoice</label>
                            <select class="form-control" name="p_invoice" required>
                                <option value="read_only" {{ $user->invoice == "read_only" ? 'selected' : '' }}>Read Only</option>
                                <option value="read_write" {{ $user->invoice == "read_write" ? 'selected' : '' }}>Read & Write</option> 
                                <option value="read_write_delete" {{ $user->invoice == "read_write_delete" ? 'selected' : '' }}>Read, Write & Delete</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-12">
                            <label for="email">Courses</label>
                            <select class="form-control" name="p_course" required>
                                <option value="read_only" {{ $user->course == "read_only" ? 'selected' : '' }}>Read Only</option>
                                <option value="read_write" {{ $user->course == "read_write" ? 'selected' : '' }}>Read & Write</option> 
                                <option value="read_write_delete" {{ $user->course == "read_write_delete" ? 'selected' : '' }}>Read, Write & Delete</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-12">
                            <label for="email">School</label>
                            <select class="form-control" name="p_school" required>
                                <option value="read_only" {{ $user->	school == "read_only" ? 'selected' : '' }}>Read Only</option>
                                <option value="read_write" {{ $user->	school == "read_write" ? 'selected' : '' }}>Read & Write</option>
                                <option value="read_write_delete" {{ $user->	school == "read_write_delete" ? 'selected' : '' }}>Read, Write & Delete</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-12">
                            <button class="btn btn-primary btn-block">Update</button>
                          </div>
                        </div>
                      </div>
                    </form>
                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->

