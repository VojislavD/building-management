<?php

namespace App\Http\Livewire\Projects;

use App\Contracts\Actions\UpdatesProject;
use App\Models\Project;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;

class EditProject extends Component
{
    public Project $project;

    public array $state = [];

    public function mount(): void
    {
        $this->fill([
            'state.internal_code' => $this->project->building->internal_code,
            'state.address' => $this->project->building->address,
            'state.status' => $this->project->status->value,
            'state.name' => $this->project->name,
            'state.price' => $this->project->price,
            'state.rates' => $this->project->rates,
            'state.amount_payed' => $this->project->amount_payed,
            'state.amount_left' => $this->project->amount_left,
            'state.start_paying' => $this->project->start_paying->format('Y-m-d'),
            'state.end_paying' => $this->project->end_paying->format('Y-m-d'),
        ]);
    }

    public function submit(UpdatesProject $updator): Redirector|RedirectResponse
    {
        $this->resetErrorBag();

        $updator($this->project, $this->state);

        session()->flash('projectUpdated', __('Project successfully updated.'));

        return to_route('projects.index');
    }

    public function render(): Renderable
    {
        return view('livewire.projects.edit-project');
    }
}
