<div class="modal fade" id="ignore-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Ignore</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ url('/ignoreNotification') }}" id="checkInForm">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id" />

                <div class="modal-body">
                    <p>Are you sure you want to ignore this notification?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Ignore</button>
                </div>
            </form>
        </div>
    </div>
</div>
