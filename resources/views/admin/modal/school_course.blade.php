

<!-- add course -->
<div class="modal right fade" id="addCourse{{$school->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"><i class="mdi mdi-close-circle-outline"></i></span></button>
                <h4 class="modal-title" id="myModalLabel2">Add Course</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('school.courseSchoolStore')}}" method="post">
                    @csrf
                    <p></p>

                    <input type="hidden" value="{{$school->id}}" name="school_id"/>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12"></div>
                        </div>
                        
                        <label>Course</label>

                        <select class="form-control select2" name="course_id" id="select-course" required=""> 
                            <option value="">Select Course</option> 
                            @if(!empty($courses))
                                @foreach($courses as $course)
                                <option value="{{$course->id}}">{{ $course->name }}</option> 
                                @endforeach
                            @endif
                        </select>

                    </div>   


                    <div class="hidden" id="school-course-table" >
                        <table class="table">
                         
                            <tbody>
                                <tr>
                                    <th scope="row" >Course: </th>
                                    <td class="sc-title"></td> 
                                </tr>
                                <tr>
                                    <th scope="row">Duration</th>
                                    <td class="sc-duration">Larry</td> 
                                </tr>
                                <tr>
                                    <th scope="row">Period</th>
                                    <td class="sc-period"></td> 
                                </tr>
                                <tr>
                                    <th scope="row">Practical Classes</th>
                                    <td class="sc-practical">Larry</td> 
                                </tr> 
                                <tr>
                                    <th scope="row">Price</th>
                                    <td class="sc-price">Larry</td> 
                                </tr>  
                                <tr>
                                    <th scope="row">Status</th>
                                    <td class="sc-status">Larry</td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>

 
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12"> 
                                <input type="submit" value="Add Course"  class="btn btn-primary btn-block"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div>

<script> 


</script>