@section('appTitle', 'Create Task')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sub Tasks') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __($method === 'POST' ? 'Create Subtask' : 'Edit Subtask') }}
                </div>
            </div>
        </div>
    </div>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-body">
                    <form
                        action="{{ $method !== 'PATCH' ? route('task.subtask.store') : route('task.subtask.update', ['subtask' => $subtask->id]) }}"
                        method="POST">
                        @csrf
                        @if ($method === 'PATCH')
                            @method('PATCH')
                        @endif
                        <div class="mb-3">
                            <label for="task_id" class="form-label">Task ID:</label>
                            <input class="form-control" value="{{ $task->id ?? $subtask->task_id }}" disabled>
                            @if ($method === 'POST')
                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                            @endif
                        </div>
                        @if ($method === 'PATCH')
                            <div class="mb-3">
                                <label for="task_id" class="form-label">Subtask ID:</label>
                                <input class="form-control" value="{{ $subtask->id }}" disabled>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3"
                                name="description">{{ old('description', isset($subtask) ? $subtask->description : '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @if ($method === 'PATCH')
                            <div class="mb-3">
                                <label for="description" class="form-label">Status</label>
                                @isset($task)
                                    <Select class="form-control @error('status') is-invalid @enderror" name="status">
                                        <option value="todo" {{ $task->status === 'todo' ? 'selected' : '' }}>Todo
                                        </option>
                                        <option value="in progress" {{ $task->status === 'in progress' ? 'selected' : '' }}>
                                            In Progress</option>
                                        <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>
                                            Completed</option>
                                    </Select>
                                @endisset
                                @isset($subtask)
                                    <Select class="form-control @error('status') is-invalid @enderror" name="status">
                                        <option value="todo" {{ $subtask->status === 'todo' ? 'selected' : '' }}>Todo
                                        </option>
                                        <option value="in progress"
                                            {{ $subtask->status === 'in progress' ? 'selected' : '' }}>
                                            In Progress</option>
                                        <option value="completed" {{ $subtask->status === 'completed' ? 'selected' : '' }}>
                                            Completed</option>
                                    </Select>
                                @endisset

                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                        <div class="d-flex justify-end">
                            @if ($method === 'PATCH')
                                {{-- task.subtask.destroy --}}
                                <button type="button" class="btn btn-outline-danger mr-2" data-bs-toggle="modal"
                                    data-bs-target="#destroySubtaskModal">Permanently Delete</button>
                            @endif
                            <button type="submit"
                                class="btn btn-outline-primary">{{ $method === 'POST' ? 'Submit' : 'Update' }}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($method === 'PATCH')
        @include('tasks.subtask.modal-destroy')
    @endif
</x-app-layout>
