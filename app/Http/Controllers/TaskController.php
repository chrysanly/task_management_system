<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateRequest;
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
        if ($request->search) {
            $tasks->where('description', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->sortField ) {
                $tasks->orderBy($request->sortField, isset($request->sortType) ? $request->sortType : 'asc');
        }else{
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
        return view('tasks.form');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
