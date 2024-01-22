@section('appTitle', 'View Task')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="d-flex justify-content-between p-6 text-gray-900">
                    {{ __('View Task') }}
                    <a href="{{ route('task.subtask.create', ['task' => $task->id]) }}" class="btn btn-outline-primary float-right">
                        Add Subtask
                    </a>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success |</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
                </div>
            </div>
        </div>
    @endif
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3"
                            name="description" disabled>{{ $task->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Status</label>
                        <Select class="form-control" disabled>
                            <option value="{{ $task->status }}">{{ ucfirst($task->status) }}</option>
                        </Select>
                    </div>
                    <div class="d-flex justify-content-end">
                        @if ($task->is_deleted)
                            <form action="{{ route('task.destroy', ['task' => $task]) }}" method="POST"
                                id="destroySubmit">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="submit" form="destroySubmit" class="btn btn-outline-danger">Permanenlty
                                Delete</button>
                            &nbsp;&nbsp;
                        @else
                            <form action="{{ route('task.trash', ['task' => $task]) }}" method="POST" id="trashSubmit">
                                @csrf
                                @method('PUT')
                            </form>
                            <button type="submit" form="trashSubmit" class="btn btn-warning">Move to
                                Trash</button>
                            &nbsp;&nbsp;
                        @endif
                        <a href="{{ route('task.edit', ['task' => $task->id]) }}" class="btn btn-primary">Edit Task</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
