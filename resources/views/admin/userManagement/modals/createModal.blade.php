<div class="modal fade" id="create-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('addUser')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}                
                <div class="modal-body">

                    <div class="row">
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" id="profileImage" name="profileImage" accept="image/*" onchange="previewImage()">
                            <label for="" class="form-label text-danger" id="imgValid" name="imgValid"></label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="name" name="name" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required />
                            <div class="invalid-feedback">Please enter a name.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Contact Number<span class="text-danger">*</span></label>
                            <input type="tel" class="form-control"  placeholder="011*******" pattern="[0-9]*" maxlength="10" minlength="10" min="0" id="contact" name="contact" required>
                            <div class="invalid-feedback">Please enter a contact number.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-email">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" placeholder="john.doe@loopcare.com" name="email" required />
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-email">Designation <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Designation" name="designation" required />
                            <div class="invalid-feedback">Please enter a valid designation  address.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-role">Role<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <select class="form-select" aria-label="Default select example" name="role" required>
                                    <option value="Admin" selected>Admin</option>
                                    <option value="Admin (View Only)" selected>Admin (View Only)</option>
                                    <option value="Data Entry Operator">Data Entry Operator </option>
                                    <option value="Material Controller">Material Controller </option>
                                </select>                                   

                                <div class="invalid-feedback">Please select a role.</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-default-email">Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" placeholder="***********" name="password" required pattern="^[^\s]+$"/>
                            <div class="invalid-feedback">Please enter a valid password.</div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>