<div class="modal fade" id="create-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('/addEmployee')}}" novalidate method="post" enctype="multipart/form-data">
                {{csrf_field()}}                
                <div class="modal-body">


                    <div class="row">
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="name" name="name" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('name') }}" />
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-company">Contact Number<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('contact') is-invalid @enderror"  placeholder="011*******" pattern="[0-9]*" maxlength="10" minlength="10" min="0" id="contact" name="contact" required value="{{ old('contact') }}" />
                            @error('contact')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="john.doe@loopcare.com" name="email" required value="{{ old('email') }}" />
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-nic">NIC<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nic') is-invalid @enderror" placeholder="nic" name="nic" required value="{{ old('nic') }}" />
                            @error('nic')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-position">Address<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" placeholder="address" name="address" required value="{{ old('address') }}" />
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-gender">Gender<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <select class="form-select @error('gender') is-invalid @enderror" aria-label="Default select example" name="gender" required >
                                    <option value="">--- Select a gender ---</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : ''}}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : ''}}>Female</option>
                                </select>
                            @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                                 
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-position">Date of birth<span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('dob') is-invalid @enderror" placeholder="dob" name="dob" required value="{{ old('dob') }}" />
                            @error('dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-position">Position<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror" placeholder="Position" name="position" required value="{{ old('position') }}" />
                            @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-position">Salary<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('salary') is-invalid @enderror" placeholder="salary" name="salary" required value="{{ old('salary') }}" />
                            @error('salary')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-position">Join Date<span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('joiningDate') is-invalid @enderror" placeholder="joiningDate" name="joiningDate" required value="{{ old('joiningDate') }}" />
                            @error('joiningDate')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label for="image" class="form-label">Upload Image</label>
                            <input class="form-control @error('emImage') is-invalid @enderror" type="file" id="emImage" name="emImage" accept="image/*" onchange="previewImage()" value="{{ old('emImage') }}" />
                            <label for="" class="form-label text-danger" id="imgValid" name="imgValid"></label>
                            @error('emImage')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Add Employee</button>
                </div>
            </form>
        </div>
    </div>
</div>