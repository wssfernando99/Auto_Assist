@foreach ($data as $inventory)

<div class="modal fade" id="delete-modal{{ $inventory->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Are you sure want to delete <b>{{ $inventory->category }}</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="{{ url('/deleteCategory') }}">
            {{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" name="id" value="{{ $inventory->id }}">

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
            </form>

        </div>
    </div>
</div>
@endforeach
