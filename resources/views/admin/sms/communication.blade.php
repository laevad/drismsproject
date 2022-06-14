<!-- Send SMS-->
<div class="modal right fade" id="sendsms" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close-circle-outline"></i></span></button>
                <h4 class="modal-title" id="myModalLabel2">Send SMS</h4>
            </div>

            <div class="modal-body">
                <form id="comm_form_sms" action="{{ route('communication.store') }}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" name="subject"   value="unknown">
                            
                    <input type="hidden" name="type" value="sms">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="email">Recipient</label>
                                <select class="form-control select2" name="recipient">
                                    <option value="student">All Students</option>
                                    <option value="staff">All Staff</option>
                                    <option value="instructor">All Instructors</option>
                                    <option value="branches">All Branches</option>
                                    <option value="schools">All Schools</option>
                                    <option value="everyone">Everyone</option>
                                      @if($users)
                                        @foreach($users as $user) 
                                            <option value="{{ $user->id }}">{{ $user->fname}} {{ $user->lname }}( {{ $user->role }} )</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Message</label>
                            <textarea class="form-control" placeholder="Message" rows="6" name="message" required=""></textarea>
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-block" id="comm_send_sms" type="submit">Send SMS</button>
                        </div>
                    </div>
                    </div>
                </form>
            </div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div>
<!-- end SMS-->
