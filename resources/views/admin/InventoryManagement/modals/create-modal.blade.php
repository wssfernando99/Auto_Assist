<div class="modal fade" id="create-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true" aria-labelledby="createModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add Inventory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('addInventory')}}" novalidate method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Inventory Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Gear Box" id="name" name="name" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('name') }}" />
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Stock Keeping Quantity<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('sku') is-invalid @enderror" id="sku" placeholder="20" name="sku" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('sku') }}" />
                            @error('sku')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Available Quantity<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="qauntity" placeholder="20" name="quantity" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('quantity') }}" />
                            @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Price per one quantity (Rs.)<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" id="descripton" placeholder="2000.00" name="price" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('price') }}" />
                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-role">Select a Category<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <select class="form-select @error('category') is-invalid @enderror" aria-label="Default select example" name="category" required >
                                    <option value="">--- Select a category ---</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{ old('category') == $category->id ? 'selected' : ''}}>{{$category->category}}</option>

                                    @endforeach
                                </select>
                            @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" id="descripton" placeholder="description" name="description" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('description') }}" />
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-default-role">Select a Supplier<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <select class="form-select @error('supplier') is-invalid @enderror" aria-label="Default select example" name="supplier" required >
                                    <option value="">--- Select a supplier ---</option>
                                    @foreach ($suppliers as $supplier)
                                    <option value="{{$supplier->id}}" {{ old('supplier') == $supplier->id ? 'selected' : ''}}>{{$supplier->name}}</option>

                                    @endforeach
                                </select>
                            @error('supplier')
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
                    <button type="submit" class="btn btn-primary">Add Inventory</button>
                </div>
            </form>
        </div>
    </div>
</div>
