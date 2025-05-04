<div class="modal fade" id="maintenance-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Update Maintenance Records</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  action="{{url('/updateMaintenance')}}" method="post" novalidate enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">

                    <input type="text" name="vehicleId" id="vehicleId" hidden>

                    <div class="row">
                        <div class="col-md-12 mb-3"><h4>Customer Details</h4></div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="basic-default-fullname">Total Milage<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('milage') is-invalid @enderror" placeholder="" name="milage" id="milage"  value="{{ old('milage') }}" />
                            @error('milage')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="basic-default-company">last Service Milage<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('lservice') is-invalid @enderror"  placeholder=""   id="lService" name="lService"  value="{{ old('lservice') }}" />
                            @error('lService')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="basic-default-email">Last Brake Checked Milage<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('lBrake') is-invalid @enderror" placeholder="" name="lBrake" id="lBrake" value="{{ old('lBrake') }}" />
                            @error('lBrake')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="basic-default-address">Last Oil Filter Changed Milage<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('lOil') is-invalid @enderror" placeholder="" name="lOil" id="lOil"  value="{{ old('lOil') }}" />
                            @error('lOil')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="basic-default-address">Last Oil Engine Checked Milage<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('lEngine') is-invalid @enderror" placeholder="" name="lEngine" id="lEngine"  value="{{ old('lEngine') }}" />
                            @error('lEngine')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="basic-default-address">Last Tire Rotation Milage<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('lTire') is-invalid @enderror" placeholder="" name="lTire" id="lTire"  value="{{ old('lTire') }}" />
                            @error('lTire')
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
