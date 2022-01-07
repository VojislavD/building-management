<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class UpdateClientForm extends Component
{
    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [
        'name' => '',
    ];

    public function rules()
    {
        return [
            'state.name' => ['required', 'string', 'min:2', 'max:255']
        ];
    }

    public function updateClient()
    {
        $this->validate();

        $updateClient = auth()->user()->client->update([
            'name' => $this->state['name']
        ]);

        if ($updateClient) {
            $this->state = [
                'name' => '',
            ];
    
            $this->emit('saved');
        }
    }

    public function render()
    {
        return view('livewire.profile.update-client-form');
    }
}
