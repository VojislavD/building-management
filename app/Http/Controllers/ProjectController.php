<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.index');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', [
            'project' => $project
        ]);
    }

    public function destroy(Project $project)
    {
        if ($project->delete()) {
            return redirect()->to(route('projects.index'))->with('projectDeleted', 'Project successfully deleted.');
        } else {
            return redirect()->to(route('projects.index'))->with('projectNotDeleted', 'Oops! Something went wrong, please try again.');
        }

    }
}
