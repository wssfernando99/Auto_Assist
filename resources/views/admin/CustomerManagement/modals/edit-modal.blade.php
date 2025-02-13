<div class="modal fade" id="edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Customer Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  action="{{url('/editCustomer')}}" method="post" novalidate enctype="multipart/form-data">
                {{csrf_field()}}                
                <div class="modal-body">

                    <input type="number" name="id" id="id" hidden>

                    <div class="row">
                        <div class="col-md-12 mb-3"><h4>Customer Details</h4></div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="basic-default-fullname">Customer Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('ename') is-invalid @enderror" placeholder="name" name="ename" id="name"  value="{{ old('ename') }}" />
                            @error('ename')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="basic-default-company">Contact Number<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('econtact') is-invalid @enderror"  placeholder="011*******"   id="contact" name="econtact"  value="{{ old('econtact') }}" />
                            @error('econtact')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="basic-default-email">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('eemail') is-invalid @enderror" placeholder="john.doe@loopcare.com" name="eemail" id="email" value="{{ old('eemail') }}" />
                            @error('eemail')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="basic-default-address">Address<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('eaddress') is-invalid @enderror" placeholder="address" name="eaddress" id="address"  value="{{ old('eaddress') }}" />
                            @error('eaddress')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>