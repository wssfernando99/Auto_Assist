
<div class="modal fade" id="edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Update Salary Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{url('updateSalary')}}" method="post" novalidate enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-body">

                <input name="id" id="id" hidden />

                <div class="row">


                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Bonus<span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('bonus') is-invalid @enderror" placeholder="bonus" name="bonus" id="bonus" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('bonus') }}" />
                        @error('bonus')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-company">Deduction<span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('deduction') is-invalid @enderror"  placeholder="011*******" pattern="[0-9]*" maxlength="10" minlength="10" min="0" id="deduction" name="deduction" required value="{{ old('deduction') }}" />
                        @error('deduction')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-company">Leaves Taken<span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('leave') is-invalid @enderror"  placeholder="011*******" pattern="[0-9]*" maxlength="10" minlength="10" min="0" id="leave" name="leave" required value="{{ old('leave') }}" />
                        @error('leave')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


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
