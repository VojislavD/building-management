<?php

namespace App\Http\Livewire\Admins;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class AdminsTable extends Component
{
    public function render(): Renderable
    {
        return view('livewire.admins.admins-table', [
            'admins' => User::admin()->paginate(10)
        ]);
    }
}
