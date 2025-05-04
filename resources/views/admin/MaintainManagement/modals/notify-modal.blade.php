<div class="modal fade" id="notify-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Notify Customer : <span id="name"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ url('/checkIn') }}" id="checkInForm">
                {{ csrf_field() }}

                <input type="hidden" name="vehicleId" id="vehicleId" />

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select to send the notification.</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="notificationMethod" id="notifyEmail" value="email" required>
                            <label class="form-check-label" for="notifyEmail">Via Email   (<span id="email"></span>)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="notificationMethod" id="notifyMobile" value="mobile">
                            <label class="form-check-label" for="notifyMobile">Via Mobile   (<span id="number"></span>)</label>
                        </div>
                        <div class="invalid-feedback" id="notificationMethodFeedback">Please select a notification method.</div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Notify</button>
                </div>
            </form>
        </div>
    </div>
</div>
