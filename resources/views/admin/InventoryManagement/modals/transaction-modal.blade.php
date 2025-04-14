@foreach ($data as $inventory)

<div class="modal fade transaction-modal" id="transaction-modal{{ $inventory->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Make Transaction for <b>{{ $inventory->name }}</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{url('makeTransaction')}}" novalidate method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">

                    <div class="row">
                        <input type="hidden" name="id" value="{{ $inventory->id }}">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Allocated Quantity<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('tquantity') is-invalid @enderror" id="qauntity" placeholder="Available quantity is {{ $inventory->quantity }}" name="tquantity" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('tquantity') }}" />
                            @error('tquantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-role">Select a Transaction Type<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <select class="form-select @error('ttransaction') is-invalid @enderror" aria-label="Default select example" name="ttransaction" required >
                                    <option value="">--- Select a Transaction ---</option>
                                    <option value="faults & returns" {{ old('ttransaction') == "faults & returns" ? 'selected' : ''}}>faults & returns</option>
                                    <option value="for Spare Parts" {{ old('ttransaction') == "for Spare Parts" ? 'selected' : ''}}>for Spare Parts</option>
                                    <option value="for Sale" {{ old('ttransaction') == "for Sale" ? 'selected' : ''}}>for Sale</option>

                                </select>
                            @error('ttransaction')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Note<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('tnote') is-invalid @enderror" id="note" placeholder="note" name="tnote" pattern="^[^\d\s](?:[^\d\s]+(?: [^\d\s]+)*)?$" required value="{{ old('tnote') }}" />
                            @error('tnote')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Make Transaction</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endforeach
