
<div class="modal fade" id="edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Edit User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{url('editCategory')}}" novalidate method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-body">

                <div class="row">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Edit Category Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('ecategory') is-invalid @enderror" placeholder="category" id="ecategory" name="ecategory" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('ecategory') }}" />
                        @error('ecategory')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Edit Description<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('edescription') is-invalid @enderror" placeholder="description" id="edescription" name="edescription" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('edescription') }}" />
                        @error('edescription')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Edit Category</button>
            </div>
            </div>
        </form>
    </div>
</div>
</div>

