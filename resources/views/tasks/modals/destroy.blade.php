<!-- Modal -->
<div class="modal fade" id="destroyModal" tabindex="-1" aria-labelledby="destroyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="destroyModalLabel">Move to Trash</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to <b>Permanently Delete</b> this task?
                <form action="{{ route('task.destroy', ['task' => $task]) }}" method="POST" id="destroySubmit">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-danger" form="destroySubmit">Save changes</button>
            </div>
        </div>
    </div>
</div>
