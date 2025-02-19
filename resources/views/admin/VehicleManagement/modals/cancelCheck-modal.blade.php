<div class="modal fade" id="cancelCheck-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Are you sure want to cancel check in for this vehicle?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ url('/cancelCheckIn') }}">
                {{csrf_field()}} 

                <input type="text" name="vehicleId" id="vehicleId" hidden/>
        
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger">Cancel Check In</button>
                </div>
            </form>
        </div>
    </div>
</div>