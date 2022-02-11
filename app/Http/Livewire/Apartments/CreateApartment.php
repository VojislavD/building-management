<?php

namespace App\Http\Livewire\Apartments;

use App\Models\Apartment;
use App\Models\Building;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Laravel\Fortify\Rules\Password;

class CreateApartment extends Component
{
    public Building $building;

    public $internal_code;
    public $address;
    public $owner_name;
    public $owner_email;
    public $owner_phone;
    public $owner_password;
    public $owner_password_confirmation;
    public $number;
    public $tenants;

    public function mount()
    {
        $this->internal_code = $this->building->internal_code;
        $this->address = $this->building->address;
    }

    protected function rules(): array
    {
        return [
            'owner_name' => ['required', 'string', 'max:255'],
            'owner_email' => ['required', 'string', 'email', 'max:255'],
            'owner_phone' => ['required', 'string', 'max:255'],
            'owner_password' => ['required', 'string', new Password, 'confirmed'],
            'number' => ['required', 'integer', 'min:0', 'max:9999', Rule::unique('apartments')->where('building_id', $this->building->id)],
            'tenants' => ['required', 'integer', 'min:0', 'max:9999']
        ];
    }

    public function submit(): Redirector|RedirectResponse
    {
        $this->validate();

        DB::transaction(function () {
            $owner = User::create([
                'company_id' => $this->building->company->id,
                'name' => $this->owner_name,
                'email' => $this->owner_email,
                'phone' => $this->owner_phone,
                'password' => bcrypt($this->owner_password)
            ]);

            Apartment::create([
                'building_id' => $this->building->id,
                'user_id' => $owner->id,
                'number' => $this->number,
                'tenants' => $this->tenants
            ]);
        });

        session()->flash('apratmentCreated', __('Apartment successfully created.'));

        return to_route('buildings.show', $this->building);
    }
    
    public function render(): Renderable
    {
        return view('livewire.apartments.create-apartment');
    }
}
