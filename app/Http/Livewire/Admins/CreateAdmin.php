<?php

namespace App\Http\Livewire\Admins;

use App\Contracts\Actions\CreatesAdmin;
use App\Models\Company;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class CreateAdmin extends Component
{
    public array $state = [];

    public function submit(CreatesAdmin $creator): Redirector|RedirectResponse
    {
        $this->resetErrorBag();

        $creator($this->state);
        
        session()->flash('adminCreated', __('New admin successfully created.'));

        return to_route('admins.index');
    }

    public function render(): Renderable
    {
        return view('livewire.admins.create-admin', [
            'companies' => Company::get(['id', 'name'])
        ]);
    }
}
