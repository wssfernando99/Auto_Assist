<div class="modal fade" id="create-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Add Customer & Vehicle details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  action="{{url('/addCustomer')}}" method="post" novalidate enctype="multipart/form-data">
                {{csrf_field()}}                
                <div class="modal-body">

                    

                    <div class="row">
                        <div class="col-md-12 mb-3"><h4>Customer Details</h4></div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Customer Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="name" name="name"  value="{{ old('name') }}" />
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-company">Contact Number<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('contact') is-invalid @enderror"  placeholder="011*******"   id="contact" name="contact"  value="{{ old('contact') }}" />
                            @error('contact')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-email">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="john.doe@loopcare.com" name="email" required value="{{ old('email') }}" />
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-address">Address<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" placeholder="address" name="address" required value="{{ old('address') }}" />
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-md-12 mb-3"><h4>Vehicle Details</h4></div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Vehicle Brand<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('brand') is-invalid @enderror" placeholder="brand" name="brand"  value="{{ old('brand') }}" />
                            @error('brand')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Model Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('modelName') is-invalid @enderror" placeholder="model name" name="modelName"  value="{{ old('modelName') }}" />
                            @error('modelName')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Manufactured Year<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('year') is-invalid @enderror" placeholder="20XX" name="year"  value="{{ old('year') }}" />
                            @error('year')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-role">Vehicle Type<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <select class="form-select @error('type') is-invalid @enderror" aria-label="Default select example" name="type" required >
                                    <option value="">--- Select a Vehicle Type ---</option>
                                    <option value="Truck" {{ old('type') == 'Truck' ? 'selected' : ''}}>Truck</option>
                                    <option value="Sedan" {{ old('type') == 'Sedan' ? 'selected' : ''}}>Sedan</option>
                                    <option value="Cab" {{ old('type') == 'Cab' ? 'selected' : ''}}>Cab</option>
                                    <option value="Van" {{ old('type') == 'Van' ? 'selected' : ''}}>Van</option>
                                    <option value="Motorcycle" {{ old('type') == 'Motorcycle' ? 'selected' : ''}}>Motorcycle</option>
                                    <option value="SUV" {{ old('type') == 'SUV' ? 'selected' : ''}}>SUV</option>
                                </select>
                            @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                                 
                            </div>
                        </div>
                       
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-role">Engine Type<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <select class="form-select @error('engine') is-invalid @enderror" aria-label="Default select example" name="engine" required >
                                    <option value="">--- Select a Engine engine ---</option>
                                    <option value="Diesel" {{ old('engine') == 'Diesel' ? 'selected' : ''}}>Diesel</option>
                                    <option value="Petrol" {{ old('engine') == 'Petrol' ? 'selected' : ''}}>Petrol</option>
                                    <option value="Hybrid" {{ old('engine') == 'Hybrid' ? 'selected' : ''}}>Hybrid</option>
                                    <option value="Electric" {{ old('engine') == 'Electric' ? 'selected' : ''}}>Electric</option>
                                </select>
                            @error('engine')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                                 
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Number Plate No.<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('numberPlate') is-invalid @enderror" placeholder="CAR-XXXX" name="numberPlate"  value="{{ old('numberPlate') }}" />
                            @error('numberPlate')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-company">Total Milage(Km)<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('milage') is-invalid @enderror"  placeholder="milage"   id="milage" name="milage"  value="{{ old('milage') }}" />
                            @error('milage')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-company">Milage Per month(Km)<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('perMilage') is-invalid @enderror"  placeholder="milage"   id="perMilage" name="perMilage"  value="{{ old('perMilage') }}" />
                            @error('perMilage')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 d-flex justify-content-between">
                            <label class="form-label" for="basic-default-company">Enable Notification feature</label>
                            <input type="checkbox" class="form-check-input" id="check" name="check" value="1" />
                            
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button class="btn btn-primary" type="submit">Add Customer</button>
                </div>
            </form>
        </div>
    </div>
</div>