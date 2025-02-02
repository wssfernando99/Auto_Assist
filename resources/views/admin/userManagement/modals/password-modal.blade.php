{{--  Create Modal  --}}
        <div class="modal fade" id="password-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('resetPassword') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="text" class="form-control" id="id" name="id" hidden >

                    <div class="row">
                        <div class="mb-3">
                            <br>
                            <h4>Do you really want to Change the Password? </h4>
                            <h6>Enter The new Password</h6>
                            <div class="col-md-12">
                                <label class="form-label">Password<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="password" name="pwd"
                                    id="pwd" required>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save Change</button>
                </div>
            </form>
        </div>
    </div>
</div>
