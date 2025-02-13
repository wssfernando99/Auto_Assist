<div class="modal fade" id="vehicle-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Add Vehicle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('addUser')}}" novalidate method="post" enctype="multipart/form-data">
                {{csrf_field()}}                
                <div class="modal-body">

                    

                    <div class="row">
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Image</label>
                            <input class="form-control @error('profileImage') is-invalid @enderror" type="file" id="profileImage" name="profileImage" accept="image/*" onchange="previewImage()" value="{{ old('profileImage') }}" />
                            <label for="" class="form-label text-danger" id="imgValid" name="imgValid"></label>
                            @error('profileImage')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="name" name="name" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('name') }}" />
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Contact Number<span class="text-danger">*</span></label>
                            <input type="tel" class="form-control @error('contact') is-invalid @enderror"  placeholder="011*******" pattern="[0-9]*" maxlength="10" minlength="10" min="0" id="contact" name="contact" required value="{{ old('contact') }}" />
                            @error('contact')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-email">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="john.doe@loopcare.com" name="email" required value="{{ old('email') }}" />
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-role">Role<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <select class="form-select @error('role') is-invalid @enderror" aria-label="Default select example" name="role" required >
                                    <option value="">--- Select a Role ---</option>
                                    <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : ''}}>Admin</option>
                                    <option value="Service Admin" {{ old('role') == 'Service Admin' ? 'selected' : ''}}>Service Admin</option>
                                </select>
                            @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                                 
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-default-email">Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="***********" name="password" required pattern="^[^\s]+$"/>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vehile-modal">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>