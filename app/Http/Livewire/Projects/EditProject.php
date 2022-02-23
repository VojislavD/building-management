<?php

namespace App\Http\Livewire\Projects;

use App\Contracts\Actions\EditsProject;
use App\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditProject extends Component
{
    public Project $project;

    public $state = [];

    public function mount()
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
            'state.end_paying' => $this->project->end_paying->format('Y-m-d')
        ]);
    }

    public function submit(EditsProject $editor): Redirector|RedirectResponse
    {
        $this->resetErrorBag();

        $editor($this->project, $this->state);

        session()->flash('projectUpdated', __('Project successfully updated.'));

        return to_route('projects.index');
    }

    public function render(): Renderable
    {
        return view('livewire.projects.edit-project');
    }
}
