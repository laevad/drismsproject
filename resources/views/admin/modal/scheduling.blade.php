
        <!-- Add class -->
        <div class="modal right fade" id="scheduleclass" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close-circle-outline"></i></span></button>
                            <h4 class="modal-title" id="myModalLabel2">Schedule Class</h4>
                        </div>
                        <div class="modal-body">
                            <form class="simcy-form" action="" method="POST" loader="true">
                              <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Class Starts</label>
                                        <input type="text" class="form-control" placeholder="Class Starts" name="start" data-date-format="dd MM yyyy - HH:ii p">
                                        <input type="hidden" name="csrf-token" value="">
                                    </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Class Ends</label>
                                        <input type="text" class="form-control" placeholder="Class Ends" name="end" data-date-format="dd MM yyyy - HH:ii p">                                    
                                    </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Student</label>
                                        <select class="form-control select2" name="student" required="">
                                         
                                            <option value="">First name and last name</option>
                                          
                                        </select>
                                    </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Course</label>
                                        <select class="form-control select2" name="course" required="">
                                        <option value="0">Select Courses*</option>
                                        
                                            <option value="">Course Name</option>
                                         
                                        </select>
                                    </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Instructor</label>
                                        <select class="form-control select2" name="instructor" required="">
                                            <option value="0">Select Instructor*</option>          
                                            <option value="" id="">First name and last name</option>
                                        
                                        </select>
                                    </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Class</label>
                                        <select class="form-control select2" name="class_type" required="">
                                            <option value="Theory">Theory Class</option>
                                            <option value="Practical">Practical Practical</option>
                                        </select>
                                    </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Car</label>
                                        <select class="form-control select2" name="car">
                                            <option value="0">Select Car*</option>
                                          
                                            <option value="">make and model( carplate ) </option>
          
                                        </select>
                                    </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Status</label>
                                        <select class="form-control select2" name="status" required="">
                                            <option value="New">New Booking</option>
                                            <option value="Complete">Complete</option>
                                            <option value="Missed">Missed</option>
                                        </select>
                                    </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary btn-block" type="submit">Save Class</button>
                                    </div>
                                </div>
                              </div>
                            </form>
                        </div>

                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div>
        <!-- end Add class -->

    <!-- scheduleupdate -->
    <div class="modal right fade" id="scheduleupdate" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"><i class="mdi mdi-close-circle-outline"></i></span></button>
                    <h4 class="modal-title" id="myModalLabel2">Scheduling</h4>
                </div>
                <div class="scheduleupdate-holder"></div>
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>
    <!-- end scheduleupdate -->
