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
                    <a href="{{ route('task.subtask.create', ['task' => $task->id]) }}"
                        class="btn btn-outline-primary float-right">
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
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="task_id" class="form-label">Task ID:</label>
                        <input class="form-control" value="{{ $task->id }}" disabled>
                    </div>
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
                        @if ($task->deleted_at)
                            <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#destroyModal">Permanenlty
                                Delete</button>
                            &nbsp;&nbsp;
                        @else
                            <button type="submit" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#trashModal">Move to Trash</button>
                            &nbsp;&nbsp;
                        @endif
                        <a href="{{ route('task.edit', ['task' => $task->id]) }}" class="btn btn-primary">Edit Task</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-header">
                    File Uploads
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-evenly overflow-auto">
                        @forelse ($task->files as $file)
                            <div class="row">
                                <img src="{{ asset($file->path) }}" alt="uploaded images" style="width: 150px; height: 150px">
                            {{-- <a href="#" class="text-sm card-link">Remove</a> --}}
                            </div>
                            {{-- <button class="btn btn-sm btn-secondary" style="width: 110px">remove</button> --}}
                        @empty
                            No Uploaded Images
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-header">
                    Subtasks
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Created At
                                    @if (request('sortField') !== 'created_at')
                                        <a href="{{ url('tasks?sortField=created_at&sortType=asc') }}"><i
                                                class="fa fa-sort" aria-hidden="true"></i></a>
                                </th>
                            @elseif (request('sortField') === 'created_at' && request('sortType') === 'asc')
                                <a href="{{ url('tasks?sortField=created_at&sortType=desc') }}"><i
                                        class="fa fa-sort-desc" aria-hidden="true"></i></a></th>
                            @else
                                <a href="{{ url('tasks?sortField=created_at&sortType=asc') }}"><i
                                        class="fa fa-sort-asc" aria-hidden="true"></i></a></th>
                                @endif
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subtasks as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        @if ($item->status === 'todo')
                                            <div class="badge bg-secondary">{{ ucfirst($item->status) }}</div>
                                        @elseif ($item->status === 'in progress')
                                            <div class="badge bg-primary">{{ ucfirst($item->status) }}</div>
                                        @else
                                            <div class="badge bg-success">{{ ucfirst($item->status) }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info"
                                            href="{{ route('task.subtask.edit', ['subtask' => $item->id]) }}">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        @if (request('search'))
                                            Task not found.
                                        @else
                                            No data
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $subtasks->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('tasks.modals.trash')
    @include('tasks.modals.destroy')
</x-app-layout>
