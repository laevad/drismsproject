
<!-- modals -->
<div class="modal right fade" id="create" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close-circle-outline"></i></span></button>
                    <h4 class="modal-title" id="myModalLabel2">Add Course</h4>
                </div>

                <div class="modal-body">
                    <form method="POST" action="{{ route('course') }}" enctype="multipart/form-data">
                            @csrf
                            <p>Create a new course.</p>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Cover Image</label> 
                                    <input type="file" name="image_course" class="croppie" placeholder="Course Cover Image" crop-width="400" crop-height="190" accept="image/*" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-12">
                                <label>Course Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Course Name" required="">
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-12">
                                <label>Price ( currency )</label>
                                <input type="number" name="price" class="form-control" placeholder="Price" required="">
                            </div>
                            </div>
                        </div>


<!--                         

                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-6">
                                <label>Duration</label>
                                <input type="number" name="duration" class="form-control" placeholder="Duration" required="">
                            </div>
                            <div class="col-md-6">
                                <label>Period</label>
                                <select name="period" class="form-control" required="">
                                    <option value="Days">Days</option>
                                    <option value="Weeks">Weeks</option>
                                    <option value="Months">Months</option>
                                </select>
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-12">
                                <label>No. of Practical Classes</label>
                                <input type="number" name="practical_classes" class="form-control" placeholder="No. of Practical Classes" value="0">
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-12">
                                <label>No. of Theory Classes</label>
                                <input type="number" name="theory_classes" class="form-control" placeholder="No. of Theory Classes" value="0">
                            </div>
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <div class="row">
                            <div class="col-md-12">
                                <label for="email">Instructors</label>
                                <select class="form-control select2" name="instructors[]" multiple="">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                        </div> -->


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="email">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="Available">Available</option>
                                        <option value="Unavailable">Unavailable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-12">
                                <input class="btn btn-primary btn-block" type="submit" value="Create Course"> 
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
                    <h4 class="modal-title" id="myModalLabel2">Edit Course</h4>
                </div>
                <div class="update-holder"></div>
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>
    <!-- end update -->

