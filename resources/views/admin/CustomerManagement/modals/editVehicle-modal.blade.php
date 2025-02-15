<div class="modal fade" id="editVehicle-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Vehicle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  action="{{url('/editVehicle')}}" method="post" novalidate enctype="multipart/form-data">
                {{csrf_field()}}                
                <div class="modal-body">

                    <input type="text" name="vehicleId" id="vehicleId" hidden>
                    <div class="row">

                        <div class="col-md-12 mb-3"><h4>Vehicle Details</h4></div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Vehicle Brand<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('abrand') is-invalid @enderror" placeholder="brand" name="abrand" id="brand" value="{{ old('abrand') }}" />
                            @error('abrand')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Model Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('amodelName') is-invalid @enderror" placeholder="model name" id="modelName" name="amodelName"  value="{{ old('amodelName') }}" />
                            @error('amodelName')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Manufactured Year<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('ayear') is-invalid @enderror" placeholder="20XX" id="year" name="ayear"  value="{{ old('ayear') }}" />
                            @error('ayear')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-role">Vehicle Type<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <select class="form-select @error('atype') is-invalid @enderror" aria-label="Default select example" id="type" name="atype" required >
                                    <option value="">--- Select a Vehicle Type ---</option>
                                    <option value="Truck" {{ old('atype') == 'Truck' ? 'selected' : ''}}>Truck</option>
                                    <option value="Sedan" {{ old('atype') == 'Sedan' ? 'selected' : ''}}>Sedan</option>
                                    <option value="Cab" {{ old('atype') == 'Cab' ? 'selected' : ''}}>Cab</option>
                                    <option value="Van" {{ old('atype') == 'Van' ? 'selected' : ''}}>Van</option>
                                    <option value="Motorcycle" {{ old('atype') == 'Motorcycle' ? 'selected' : ''}}>Motorcycle</option>
                                    <option value="SUV" {{ old('atype') == 'SUV' ? 'selected' : ''}}>SUV</option>
                                </select>
                            @error('atype')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                                 
                            </div>
                        </div>
                       
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-role">Engine Type<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <select class="form-select @error('aengine') is-invalid @enderror" aria-label="Default select example" id="engine" name="aengine" required >
                                    <option value="">--- Select a Engine engine ---</option>
                                    <option value="Diesel" {{ old('aengine') == 'Diesel' ? 'selected' : ''}}>Diesel</option>
                                    <option value="Petrol" {{ old('aengine') == 'Petrol' ? 'selected' : ''}}>Petrol</option>
                                    <option value="Hybrid" {{ old('aengine') == 'Hybrid' ? 'selected' : ''}}>Hybrid</option>
                                    <option value="Electric" {{ old('aengine') == 'Electric' ? 'selected' : ''}}>Electric</option>
                                </select>
                            @error('aengine')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                                 
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Number Plate No.<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('anumberPlate') is-invalid @enderror" placeholder="CAR-XXXX" id="numberPlate" name="anumberPlate"  value="{{ old('anumberPlate') }}" />
                            @error('anumberPlate')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-company">Total Milage(Km)<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('amilage') is-invalid @enderror"  placeholder="milage"   id="milage" name="amilage"  value="{{ old('amilage') }}" />
                            @error('amilage')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-company">Milage Per month(Km)<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('aperMilage') is-invalid @enderror"  placeholder="milage"   id="perMilage" name="aperMilage"  value="{{ old('aperMilage') }}" />
                            @error('aperMilage')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 d-flex justify-content-between">
                            <label class="form-label" for="basic-default-company">Enable Notification feature</label>
                            <input type="checkbox" class="form-check-input" id="check" name="check" value="1" @checked(old('check') == '1') />
                            
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