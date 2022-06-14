
<!-- read -->
<div class="modal right fade" id="read_message{{$value->id}}"  role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close-circle-outline"></i></span></button>
                    <h4 class="modal-title" id="myModalLabel2">Read Message</h4>
                </div>
                <div class="message-holder">  
                    <div class="card">
                        <div class="card-header">
                        {{  $value->subject }}
                        </div>
                        <div class="card-body"> 
                            <p class="card-text">
                            {{  $value->messages }}
                            </p>
                        </div>
                    </div>
                    
                </div>


            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>
<!-- end read -->

<!-- read -->
<div class="modal right fade" id="read_message_{{$value->id}}"  role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close-circle-outline"></i></span></button>
                    <h4 class="modal-title" id="myModalLabel2">Read Message</h4>
                </div>
                <div class="message-holder">  
                    <div class="card">
                        <div class="card-header">
                        {{  $value->subject }}
                        </div>
                        <div class="card-body"> 
                            <p class="card-text">
                            {{  $value->messages }}
                            </p>
                        </div>
                    </div>
                    
                </div>


            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>
<!-- end read -->