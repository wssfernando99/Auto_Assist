
        <div class="modal fade" id="edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('editUser')}}" method="post" novalidate enctype="multipart/form-data">
                {{csrf_field()}}                
                <div class="modal-body">

                    <input name="id" id="id" hidden />

                    <div class="row">
                        
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <!-- Current Image Preview -->
                            <div class="me-3">
                                <img id="profilePreview" src="default-profile.jpg" 
                                    alt="Profile Image" class="rounded-circle" 
                                style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                        
                            <!-- File Input -->
                            <div>
                                <label for="profileImage" class="form-label">Upload New Image</label>
                                <input class="form-control @error('eprofileImage') is-invalid @enderror" type="file" 
                                       id="profileImage" name="eprofileImage" accept="image/*" 
                                       onchange="previewImage()" value="{{ old('eprofileImage') }}" />
                                <label class="form-label text-danger" id="imgValid" name="imgValid"></label>
                                @error('eprofileImage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('ename') is-invalid @enderror" placeholder="name" name="ename" id="name" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('ename') }}" />
                            @error('ename')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Contact Number<span class="text-danger">*</span></label>
                            <input type="tel" class="form-control @error('econtact') is-invalid @enderror"  placeholder="011*******" pattern="[0-9]*" maxlength="10" minlength="10" min="0" id="contact" name="econtact" required value="{{ old('econtact') }}" />
                            @error('econtact')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-email">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('eemail') is-invalid @enderror" placeholder="john.doe@loopcare.com" name="eemail" id="email" required value="{{ old('eemail') }}" />
                            @error('eemail')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-role">Role<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <select class="form-select @error('erole') is-invalid @enderror" aria-label="Default select example" id="role" name="erole" required >
                                    <option value="">--- Select a Role ---</option>
                                    <option value="Admin" {{ old('erole') == 'Admin' ? 'selected' : ''}}>Admin</option>
                                    <option value="Service Admin" {{ old('erole') == 'Service Admin' ? 'selected' : ''}}>Service Admin</option>
                                </select>
                            @error('erole')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                                 
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
