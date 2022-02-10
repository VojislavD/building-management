<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(): Renderable
    {
        return view('projects.index');
    }

    public function edit(Project $project): Renderable
    {
        return view('projects.edit', [
            'project' => $project
        ]);
    }

    public function destroy(Project $project): RedirectResponse
    {
        if ($project->delete()) {
            return to_route('projects.index')->with('projectDeleted', 'Project successfully deleted.');
        } else {
            return to_route('projects.index')->with('projectNotDeleted', 'Oops! Something went wrong, please try again.');
        }

    }
}
