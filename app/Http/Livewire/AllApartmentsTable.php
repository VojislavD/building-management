<?php

namespace App\Http\Livewire;

use App\Models\Apartment;
use Livewire\Component;
use Livewire\WithPagination;

class AllApartmentsTable extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.all-apartments-table', [
            'apartments' => Apartment::with('building')->latest()->paginate(10)
        ]);
    }
}
