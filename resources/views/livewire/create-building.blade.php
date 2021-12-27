<form class="w-full xl:w-2/3 mx-auto">
    <div class="my-16">
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Basic Info') }}</p>

        <div class="grid grid-cols-2 gap-8 my-4">
            <x-form.input 
                type="text" 
                name="internal_code" 
                id="internal_code" 
                title="{{ __('Internal Code') }}" 
                placeholder="{{ __('Internal Code') }}" 
            />

            <x-form.select 
                name="status" 
                id="status" 
                title="{{ __('Status') }}" 
                :options="[
                    'Active' => \App\Models\Building::STATUS_ACTIVE, 
                    'Inactive' => \App\Models\Building::STATUS_INACTIVE
                ]"
            />
        </div>

        <div class="grid grid-cols-2 gap-8 my-4">
            <x-form.select 
                name="construction_year" 
                id="construction_year" 
                title="{{ __('Construction Year') }}" 
                :options="\App\Models\Building::availableConstructionYears()"
            />
    
            <x-form.input 
                type="number" 
                name="square" 
                id="square" 
                title="{{ __('Square') }}" 
                placeholder="{{ __('Square') }}" 
            />
        </div>

        <div class="grid grid-cols-3 gap-8 my-4">
            <x-form.input 
                type="number" 
                name="floors" 
                id="floors" 
                title="{{ __('Floors') }}" 
                placeholder="{{ __('Floors') }}" 
            />
    
            <x-form.input 
                type="number" 
                name="apartments" 
                id="apartments" 
                title="{{ __('Apartments') }}" 
                placeholder="{{ __('Apartments') }}" 
            />
    
            <x-form.input 
                type="number" 
                name="tenants" 
                id="tenants" 
                title="{{ __('Tenants') }}" 
                placeholder="{{ __('Tenants') }}" 
            />
        </div>

        <div class="grid grid-cols-2 gap-8 my-4">
            <x-form.select 
                name="elevator" 
                id="elevator" 
                title="{{ __('Elevator') }}" 
                :options="[
                    'Yes' => 1,
                    'No' => 0
                ]"
            />
    
            <x-form.select 
                name="yard" 
                id="yard" 
                title="{{ __('Yard') }}" 
                :options="[
                    'Yes' => 1,
                    'No' => 0
                ]"
            />
        </div>

        <div class="my-4">
            <x-form.input 
                type="number" 
                name="balance_begining" 
                id="balance_begining" 
                title="{{ __('Balance Begining') }}" 
                placeholder="{{ __('Balance Begining') }}" 
            />
        </div>
    </div>

    <div class="my-16">
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Administrative Info') }}</p>

        <div class="grid grid-cols-3 gap-8 my-4">
            <x-form.input 
                type="text" 
                name="pib" 
                id="pib" 
                title="{{ __('PIB') }}" 
                placeholder="{{ __('PIB') }}" 
            />
    
            <x-form.input 
                type="text" 
                name="identification_number" 
                id="identification_number" 
                title="{{ __('Identification Number') }}" 
                placeholder="{{ __('Identification Number') }}" 
            />
    
            <x-form.input 
                type="text" 
                name="account_number" 
                id="account_number" 
                title="{{ __('Account Number') }}" 
                placeholder="{{ __('Account Number') }}" 
            />
        </div>
    </div>
    
    <div class="my-16">
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Location Info') }}</p>
    
        <div class="my-4">
            <x-form.input 
                type="text" 
                name="address" 
                id="address" 
                title="{{ __('Address') }}" 
                placeholder="{{ __('Address') }}" 
            />
        </div>
    
        <div class="grid grid-cols-3 gap-8 my-4">
            <x-form.input 
                type="text" 
                name="city" 
                id="city" 
                title="{{ __('City') }}" 
                placeholder="{{ __('City') }}" 
            />
    
            <x-form.input 
                type="text" 
                name="county" 
                id="county" 
                title="{{ __('County') }}" 
                placeholder="{{ __('County') }}" 
            />
    
            <x-form.input 
                type="text" 
                name="postal_code" 
                id="postal_code" 
                title="{{ __('Postal Code') }}" 
                placeholder="{{ __('Postal Code') }}" 
            />
        </div>
    </div>
    
    <div class="my-16">
        <div class="my-4">
            <x-form.input 
                type="text" 
                name="comment" 
                id="comment" 
                title="{{ __('Comment') }}" 
                placeholder="{{ __('Comment') }}" 
            />
        </div>
    </div>
</form>