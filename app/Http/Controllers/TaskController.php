<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateRequest;
use App\Models\SubTask;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $tasks = Task::query();
        $tasks->where('user_id', auth()->user()->id);
        if ($request->search) {
            $tasks->where('description', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->sortField) {
            $tasks->orderBy('deleted_at', 'asc');
            $tasks->orderBy($request->sortField, isset($request->sortType) ? $request->sortType : 'asc');
        } else {
            $tasks->orderBy('deleted_at', 'asc');
            $tasks->orderBy('id', 'desc');
        }
        return view('tasks.table', [
            'tasks' => $tasks->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.form', [
            'method' => 'POST',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $userId = auth()->user()->id;
        $request->validated();
        $task = new Task();
        $task->user_id = $userId;
        $task->description = $request->description;
        $task->save();

        return redirect('/tasks')->with('success', 'Task Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $subtasks = SubTask::where('task_id', $task->id)->orderByDesc('id')->paginate(5);
        return view('tasks.view', [
            'task' => $task,
            'subtasks' => $subtasks,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.form', [
            'task' => $task,
            'method' => 'PATCH',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRequest $request, Task $task)
    {
        $request->validated();
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();
        return redirect('/tasks')->with('success', 'Task Updated');
    }

    /**
     * Trash the specified resource from storage.
     */
    public function trash(Task $task)
    {
        $task->deleted_at = now();
        $task->save();
        return redirect('/tasks')->with('success', 'Task Moved to Trash');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/tasks')->with('success', 'Task Permanently Deleted');
    }
}
