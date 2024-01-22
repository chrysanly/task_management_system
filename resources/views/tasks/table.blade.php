@section('appTitle', 'Table')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Table') }}
        </h2>
    </x-slot>

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

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="d-flex justify-content-between p-6 text-gray-900">
                    <div class="col-md-3 ">
                        <form action="{{ route('task.index') }}" method="GET">
                            @csrf
                            <div class="input-group">
                                <input type="search" class="form-control" value="{{ old('search') }}"
                                    placeholder="{{ __('Search') }}" name="search">
                                <button class="btn btn-outline-secondary" type="submit"
                                    id="button-addon2">Search</button>
                            </div>
                        </form>
                    </div>
                    <a href="{{ route('task.create') }}" class="btn btn-primary">{{ __('Create Task') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="py8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
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
                                <a href="{{ url('tasks?sortField=created_at&sortType=asc') }}"><i class="fa fa-sort-asc"
                                        aria-hidden="true"></i></a></th>
                                @endif
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $task)
                                <tr>
                                    <td>{{ $task->id }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>
                                        @if ($task->status === 'todo')
                                            <div class="badge bg-secondary">{{ ucfirst($task->status) }}</div>
                                        @elseif ($task->status === 'in progress')
                                            <div class="badge bg-primary">{{ ucfirst($task->status) }}</div>
                                        @else
                                            <div class="badge bg-success">{{ ucfirst($task->status) }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $task->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info"
                                            href="{{ route('task.show', ['task' => $task->id]) }}">
                                            View Task
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
                    {{ $tasks->links() }}
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
