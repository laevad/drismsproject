<style>
    .modal.right.fade.show .modal-dialog{
        right: 50% !important; 
        width: 100%;
        height: 80%;
        top: 50%;
        transform: translate(50%, -50%) !important;
    }
</style>
<div class="modal right fade" id="notificationModal{{ $notification->id }}" role="dialog">


        <div class="modal-dialog" role="document">
            <div class="modal-content"> 
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close-circle-outline"></i></span></button>
                    <h4 class="modal-title" id="myModalLabel2">Notification Preview </h4> 
                </div> 
                <div class="modal-body">
                     

                    <div class="card" style="height: 100%;"> 
                        @if($notification->image_name) 
                            <img 
                                src="{{ url('/images'). '/' .$notification->image_name }} " 
                                class="img-responsive" 
                                style=""
                            >    
                        @else 
                            <div class="notification-icon bg-warning"> 
                                <i class="mdi mdi-account-plus"></i>  
                            </div>
                        @endif

                        <div class="card-body">

                            <p class="card-text">{!! $notification->message !!} </p>
                           

                        </div>

                        <div class="card-footer">
                            <small>{{ date('F j, Y h:ia', strtotime($notification->created_at)) }}</small>
                        </div>
                    </div>

                </div> 
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
      </div><!-- modal --> 