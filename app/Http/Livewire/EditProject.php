<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditProject extends Component
{
    public Project $project;
    public $internal_code;
    public $address;
    public $status;
    public $name;
    public $price;
    public $rates;
    public $amount_payed;
    public $amount_left;
    public $start_paying;
    public $end_paying;

    public function mount()
    {
        $this->internal_code = $this->project->building->internal_code;    
        $this->address = $this->project->building->address;
        $this->status = $this->project->status;
        $this->name = $this->project->name;
        $this->price = $this->project->price;
        $this->rates = $this->project->rates;
        $this->amount_payed = $this->project->amount_payed;
        $this->amount_left = $this->project->amount_left;
        $this->start_paying = $this->project->start_paying->format('Y-m-d');
        $this->end_paying = $this->project->end_paying->format('Y-m-d');
    }

    protected function rules(): array
    {
        return [
            'status' => ['required', 'integer', Rule::in([
                Project::STATUS_PENDING, 
                Project::STATUS_PROCESSING, 
                Project::STATUS_FINISHED, 
                Project::STATUS_CANCELLED
            ])],
            'name' => ['required', 'string', 'min:6', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'rates' => ['required', 'integer', 'min:0'],
            'amount_payed' => ['required', 'integer', 'min:0'],
            'amount_left' => ['required', 'integer', 'min:0',],
            'start_paying' => ['required', 'date'],
            'end_paying' => ['required', 'date']
        ];
    }

    public function submit(): Redirector|RedirectResponse
    {
        $this->validate();

        $updateProject = $this->project->update([
            'status' => $this->status,
            'name' => $this->name,
            'price' => $this->price,
            'rates' => $this->rates,
            'amount_payed' => $this->amount_payed,
            'amount_left' => $this->amount_left,
            'start_paying' => $this->start_paying,
            'end_paying' => $this->end_paying
        ]);

        if ($updateProject) {
            session()->flash('projectUpdated', __('Project successfully updated.'));
        } else {
            session()->flash('projectNotUpdated', __('Oops! Something went wrong, please try again.'));
        }

        return redirect()->to(route('projects.index'));
    }

    public function render(): Renderable
    {
        return view('livewire.edit-project');
    }
}
