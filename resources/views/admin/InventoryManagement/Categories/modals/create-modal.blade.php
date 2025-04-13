<div class="modal fade" id="create-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true" aria-labelledby="createModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('addCategory')}}" novalidate method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">

                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Category Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror" placeholder="category" id="category" name="category" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('category') }}" />
                            @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Description<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" id="descripton" placeholder="description" name="description" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('description') }}" />
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
