<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    public function store()
    {
        Task::create(request()->validate([
            'title' => 'required|min:3|max:255|string',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,done',
            'project_id' => 'required|exists:projects,id',
        ]));

        return redirect()->route('tasks.index');
    }

    public function show(){
        $task = Task::findOrFail(request('task'));

        return view('tasks.show', compact('task'));
    }

    public function update(Task $task)
    {
        $task->update(request()->validate([
            'title' => 'sometimes|required|min:3|max:255|string',
            'description' => 'nullable|string',
            'status' => 'sometimes|required|in:todo,in_progress,done',
            'project_id' => 'sometimes|required|exists:projects,id',
        ]));

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
