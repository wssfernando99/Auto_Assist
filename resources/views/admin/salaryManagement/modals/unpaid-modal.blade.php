@foreach ($data as $salary)

<div class="modal fade" id="unpaid-modal{{ $salary->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Are you sure want mark as unpaid for <b>{{ $salary->name }}</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ url('/unPaid/' .$salary->id) }}">
                @csrf

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-warning">Unpaid</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
