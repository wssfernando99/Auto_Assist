
        <div class="modal fade" id="edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('/editEmployee')}}" novalidate method="post" enctype="multipart/form-data">
                {{csrf_field()}}                
                <div class="modal-body">

                    <input name="id" id="id" hidden>


                    <div class="row">

                        {{-- @foreach ($data as $employee )
                        <div class="col-md-6 mb-3" >
                        <img src="{{ asset('userProfileImage/' . $employee->emImage) }}" alt="user-avatar" class="d-block rounded" height="150" id="uploadedAvatar" />
                        </div>
                        @endforeach --}}
                            <div class="col-md-6 mb-3" >
                                <img id="employeeImage" src="default-profile.jpg" 
                                    alt="Profile Image" class="rounded-circle" name="eemployeeImage" 
                                style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                        
                            <!-- File Input -->
                            <div class="col-md-6 mb-3" >
                                <label for="profileImage" class="form-label">Upload New Image</label>
                                <input class="form-control @error('eemImage') is-invalid @enderror" type="file" 
                                        name="eemImage" id="eemImage" accept="image/*" 
                                       onchange="previewImage()" value="{{ old('eemImage') }}" />
                                <label class="form-label text-danger" id="imgValid" name="imgValid"></label>
                                @error('eemImage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                    
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('ename') is-invalid @enderror" placeholder="name" name="ename" id="name"   value="{{ old('ename') }}" />
                            @error('ename')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-company">Contact Number<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('econtact') is-invalid @enderror"  placeholder="011*******"  id="contact" name="econtact"  value="{{ old('econtact') }}" />
                            @error('econtact')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-email">Email</label>
                            <input type="email" class="form-control @error('eemail') is-invalid @enderror" placeholder="john.doe@loopcare.com" name="eemail" id="email" value="{{ old('eemail') }}" />
                            @error('eemail')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-nic">NIC<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('enic') is-invalid @enderror" placeholder="nic" name="enic" id="nic" value="{{ old('enic') }}" />
                            @error('enic')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-position">Address<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('eaddress') is-invalid @enderror" placeholder="address" name="eaddress" id="address"  value="{{ old('eaddress') }}" />
                            @error('eaddress')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-gender">Gender<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <select class="form-select @error('egender') is-invalid @enderror" aria-label="Default select example" name="egender" id="gender" >
                                    <option value="">--- Select a gender ---</option>
                                    <option value="Male" {{ old('egender') == 'Male' ? 'selected' : ''}}>Male</option>
                                    <option value="Female" {{ old('egender') == 'Female' ? 'selected' : ''}}>Female</option>
                                </select>
                            @error('egender')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                                 
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-position">Date of birth<span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('edob') is-invalid @enderror" placeholder="dob" name="edob" id="dob"  value="{{ old('edob') }}" />
                            @error('edob')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-position">Position<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('eposition') is-invalid @enderror" placeholder="Position" name="eposition" id="position"  value="{{ old('eposition') }}" />
                            @error('eposition')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($role == 'Admin')
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-position">Salary<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('salary') is-invalid @enderror" placeholder="salary" name="esalary" id="salary" e value="{{ old('esalary') }}" />
                            @error('esalary')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-position">Join Date<span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('ejoiningDate') is-invalid @enderror" placeholder="joiningDate" name="ejoiningDate" id="joiningDate"  value="{{ old('ejoiningDate') }}"  />
                            @error('ejoiningDate')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                            
                        @else
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-position">Salary<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('esalary') is-invalid @enderror" placeholder="salary" name="esalary" id="salary"  value="{{ old('esalary') }}" readonly/>
                            <span class="text-danger">Only Admin can change this.</span>
                            @error('esalary')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-position">Join Date<span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('ejoiningDate') is-invalid @enderror" placeholder="joiningDate" name="ejoiningDate" id="joiningDate"  value="{{ old('ejoiningDate') }}" readonly />
                            <span class="text-danger">Only Admin can change this.</span>
                            @error('ejoiningDate')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                            
                        @endif
                        
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
