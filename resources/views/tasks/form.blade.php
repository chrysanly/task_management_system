@section('appTitle', 'Create Task')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __($method === 'POST' ? 'Create Task' : 'Edit Task') }}
                </div>
            </div>
        </div>
    </div>
    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-body">
                    <form
                        action="{{ isset($task) ? route('task.update', ['task' => $task->id]) : route('task.store') }}"
                        method="POST">
                        @csrf
                        @if ($method === 'PATCH')
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="task_id" class="form-label">Task ID:</label>
                                <input class="form-control" value="{{ $task->id }}" disabled>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3"
                                name="description">{{ old('description', isset($task) ? $task->description : '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @if ($method === 'PATCH')
                            <div class="mb-3">
                                <label for="description" class="form-label">Status</label>
                                <Select class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option value="todo" {{ $task->status === 'todo' ? 'selected' : '' }}>Todo
                                    </option>
                                    <option value="in progress" {{ $task->status === 'in progress' ? 'selected' : '' }}>
                                        In Progress</option>
                                    <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>
                                        Completed</option>
                                </Select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                        <button type="submit"
                            class="btn btn-outline-primary float-end">{{ $method === 'POST' ? 'Submit' : 'Update' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
