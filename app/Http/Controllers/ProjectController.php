<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function store()
    {
        Project::create(request()->validate([
            'name' => 'sometimes|required|min:3|max:255|string',
            'description' => 'nullable|string',
        ]));

        return redirect()->route('projects.index');
    }

    public function show(){
        $project = Project::findOrFail(request('project'));

        return view('projects.show', compact('project'));
    }

    public function update(Project $project)
    {
        $project->update(request()->validate([
            'name' => 'sometimes|required|min:3|max:255|string',
            'description' => 'nullable|string',
        ]));

        return redirect()->route('projects.index');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index');
    }
}
