
<div class="modal fade" id="edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Edit Inventory</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{url('editInventory')}}" novalidate method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-body">

                <div class="row">
                    <input type="hidden" name="id" id="id">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="basic-default-fullname">Inventory Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('ename') is-invalid @enderror" placeholder="Gear Box" id="name" name="ename" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('ename') }}" />
                        @error('ename')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="basic-default-fullname">Stock Keeping Quantity<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('esku') is-invalid @enderror" id="sku" placeholder="20" name="esku" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('esku') }}" />
                        @error('esku')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="basic-default-fullname">Available Quantity<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('equantity') is-invalid @enderror" id="quantity" placeholder="20" name="equantity" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('equantity') }}" />
                        @error('equantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="basic-default-fullname">Price per one quantity (Rs.)<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('eprice') is-invalid @enderror" id="price" placeholder="2000.00" name="eprice" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('eprice') }}" />
                        @error('eprice')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-role">Select a Category<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <select class="form-select @error('ecategory') is-invalid @enderror" aria-label="Default select example" id="category" name="ecategory" required >
                                <option value="">--- Select a category ---</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{ old('ecategory') == $category->id ? 'selected' : ''}}>{{$category->category}}</option>

                                @endforeach
                            </select>
                        @error('ecategory')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Description</label>
                        <input type="text" class="form-control @error('edescription') is-invalid @enderror" id="description" placeholder="description" name="edescription" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('description') }}" />
                        @error('edescription')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-role">Select a Supplier<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <select class="form-select @error('esupplier') is-invalid @enderror" aria-label="Default select example" id="supplier" name="esupplier" required >
                                <option value="">--- Select a supplier ---</option>
                                @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->id}}" {{ old('esupplier') == $supplier->id ? 'selected' : ''}}>{{$supplier->name}}</option>

                                @endforeach
                            </select>
                        @error('esupplier')
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
                <button type="submit" class="btn btn-primary">Edit Inventory</button>
            </div>
        </form>
    </div>
</div>
</div>

