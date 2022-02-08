<?php

namespace App\Http\Livewire;

use App\Models\Project;
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

    protected function rules()
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

    public function submit()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.edit-project');
    }
}
