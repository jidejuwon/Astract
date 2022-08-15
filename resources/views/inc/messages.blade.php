@if(count($errors) > 0)
    @foreach($errors as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endforeach
@endif


<!-- success modal  -->
@if( session('success'))
    <div  id="confirm" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">check</i>
                    </div>
                </div>
                <div class="modal-body">
                    <p class="text-center"> {{ Auth::user()->name  }} You have succesfully <strong class="text-secondary">{{ session('success') }}</strong></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
@endif


@if(session('error'))
    <!-- failed modal  -->
    <div id="failed" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box" style="background:darkred;">
                        <i class="material-icons" style="color:tomato;">close</i>
                    </div>
                </div>
                <div class="modal-body">
                    <p class="text-center"><strong class="text-secondary"> {{ session('error') }} </strong></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-block" style="background:darkred;" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
@endif



