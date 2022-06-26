<?php

namespace App\Http\Controllers;

use App\Contracts\Actions\DeletesProject;
use App\Models\Project;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    public function index(): Renderable
    {
        return view('projects.index');
    }

    public function edit(Project $project): Renderable
    {
        return view('projects.edit', [
            'project' => $project,
        ]);
    }

    public function destroy(Project $project, DeletesProject $deleter): RedirectResponse
    {
        $deleter($project);

        return to_route('projects.index')->with('projectDeleted', 'Project successfully deleted.');
    }
}
