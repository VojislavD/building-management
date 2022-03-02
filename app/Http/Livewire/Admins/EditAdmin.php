<?php

namespace App\Http\Livewire\Admins;

use App\Contracts\Actions\UpdatesAdmin;
use App\Models\Company;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class EditAdmin extends Component
{
    public User $admin;

    public array $state = [];

    public function mount(): void
    {
        $this->fill([
            'state.company_id' => $this->admin->company_id,
            'state.name' => $this->admin->name,
            'state.email' => $this->admin->email,
            'state.password' => ''
        ]);
    }

    public function submit(UpdatesAdmin $updator): Redirector|RedirectResponse
    {
        $this->resetErrorBag();

        $updator($this->admin, $this->state);

        session()->flash('adminUpdated', __('Admin is successfully updated.'));

        return to_route('admins.index');
    }

    public function render(): Renderable
    {
        return view('livewire.admins.edit-admin', [
            'companies' => Company::get(['id', 'name'])
        ]);
    }
}
