<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UpdateCompanyForm extends Component
{
    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [
        'name' => '',
    ];

    public function mount()
    {
        $this->state['name'] = auth()->user()->company->name;
    }

    public function rules(): array
    {
        return [
            'state.name' => ['required', 'string', 'max:255', Rule::unique('companies', 'name')->ignore(auth()->user()->company)]
        ];
    }

    public function updateCompany()
    {
        $this->validate();

        $updateCompany = auth()->user()->company->update([
            'name' => $this->state['name']
        ]);

        if ($updateCompany) {
            $this->state = [
                'name' => '',
            ];
    
            $this->emit('saved');
        }
    }

    public function render(): Renderable
    {
        return view('livewire.profile.update-company-form');
    }
}
