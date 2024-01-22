<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateRequest;
use App\Models\SubTask;
use App\Models\Task;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Task $task)
    {
        return view('tasks.subtask.form',[
            'task' => $task,
            'method' => 'POST',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $request->validated();
        $subtask = new SubTask();
        $subtask->task_id = $request->task_id;
        $subtask->description = $request->description;
        $subtask->save();

        return redirect('/tasks/show/' . $request->task_id)->with('success', 'Subtask Created');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubTask $subtask)
    {
        return view('tasks.subtask.form', [
            'subtask' => $subtask,
            'method' => 'PATCH',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRequest $request, SubTask $subtask)
    {
        $request->validated();
        $subtask->description = $request->description;
        $subtask->status = $request->status;
        $subtask->save();
        return redirect('/tasks/show/' . $subtask->task_id)->with('success', 'Subtask Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubTask $subtask)
    {
        $id = $subtask->task_id;
        $subtask->delete();
        return redirect('/tasks/show/' . $id)->with('success', 'Subtask Permanently Deleted');
    }
}
