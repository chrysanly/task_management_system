<!-- Modal -->
<div class="modal fade" id="trashModal" tabindex="-1" aria-labelledby="trashModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="trashModalLabel">Permanently Delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to move this task to <b>Trash</b>?
                <form action="{{ route('task.trash', ['task' => $task]) }}" method="POST" id="trashSubmit">
                    @csrf
                    @method('PUT')
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-warning" form="trashSubmit">Save changes</button>
            </div>
        </div>
    </div>
</div>
