
<div class="modal fade" id="edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Edit Supplier</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{url('editSupplier')}}" novalidate method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-body">

                <input type="hidden" name="id" id="id">

                <div class="row">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Edit Company Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('ename') is-invalid @enderror" placeholder="name" id="ename" name="ename" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('ename') }}" />
                        @error('ename')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Edit Contact Person Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('econtact_person') is-invalid @enderror" placeholder="econtact_person" id="econtact_person" name="econtact_person" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('econtact_person') }}" />
                        @error('econtact_person')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Edit Phone Number<span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('ephone') is-invalid @enderror" placeholder="077#######" id="ephone" name="ephone" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('ephone') }}" />
                        @error('ephone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Edit Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('eemail') is-invalid @enderror" placeholder="eemail" id="eemail" name="eemail" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('eemail') }}" />
                        @error('eemail')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Edit Address<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('eaddress') is-invalid @enderror" placeholder="eaddress" id="eaddress" name="eaddress" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('eaddress') }}" />
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
                <button type="submit" class="btn btn-primary">Edit Supplier</button>
            </div>
        </form>
    </div>
</div>
</div>

