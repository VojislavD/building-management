<form 
    class="w-full xl:w-2/3 mx-auto"
    wire:submit.prevent="submit"
>
    <div class="my-16">
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Basic Info') }}</p>

        <div class="grid grid-cols-2 gap-8 my-4">
            <div>
                <x-form.input 
                    type="text" 
                    model="state.internal_code"
                    id="internal_code" 
                    error="internal_code" 
                    title="{{ __('Internal Code') }}" 
                    placeholder="{{ __('Internal Code') }}" 
                />
            </div>

            <div>
                <x-form.select 
                    model="state.status" 
                    id="status" 
                    error="status" 
                    title="{{ __('Status') }}" 
                    :options="[
                        'Active' => \App\Enums\BuildingStatus::Active(), 
                        'Inactive' => \App\Enums\BuildingStatus::Inactive()
                    ]"
                />
            </div>
        </div>

        <div class="grid grid-cols-3 gap-8 my-4">
            <div>
                <x-form.select 
                    model="state.construction_year" 
                    id="construction_year" 
                    title="{{ __('Construction Year') }}" 
                    :options="\App\Models\Building::availableConstructionYears()"
                />
                <x-form.error-message name="construction_year" />
            </div>

            <div>
                <x-form.input 
                    type="number" 
                    step=".01"
                    model="state.square" 
                    id="square" 
                    error="square" 
                    title="{{ __('Square') }}" 
                    placeholder="{{ __('Square') }}" 
                />
            </div>

            <div>
                <x-form.input 
                    type="number" 
                    model="state.floors" 
                    id="floors" 
                    error="floors" 
                    title="{{ __('Floors') }}" 
                    placeholder="{{ __('Floors') }}" 
                />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-8 my-4">
            <div>
                <x-form.select 
                    model="state.elevator" 
                    id="elevator" 
                    error="elevator" 
                    title="{{ __('Elevator') }}" 
                    :options="[
                        'Yes' => 1,
                        'No' => 0
                    ]"
                />
            </div>

            <div>
                <x-form.select 
                    model="state.yard" 
                    id="yard" 
                    error="yard" 
                    title="{{ __('Yard') }}" 
                    :options="[
                        'Yes' => 1,
                        'No' => 0
                    ]"
                />
            </div>
        </div>

        <div class="my-4">
            <div>
                <x-form.input 
                    type="number" 
                    step=".01"
                    model="state.balance" 
                    id="balance" 
                    error="balance" 
                    title="{{ __('Balance') }}" 
                    placeholder="{{ __('Balance') }}" 
                />
            </div>
        </div>
    </div>

    <div class="my-16">
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Administrative Info') }}</p>

        <div class="grid grid-cols-3 gap-8 my-4">
            <div>
                <x-form.input 
                    type="text" 
                    model="state.pib" 
                    id="pib" 
                    error="pib" 
                    title="{{ __('PIB') }}" 
                    placeholder="{{ __('PIB') }}" 
                />
            </div>

            <div>
                <x-form.input 
                    type="text" 
                    model="state.identification_number" 
                    id="identification_number" 
                    error="identification_number" 
                    title="{{ __('Identification Number') }}" 
                    placeholder="{{ __('Identification Number') }}" 
                />
            </div>
            
            <div>
                <x-form.input 
                    type="text" 
                    model="state.account_number" 
                    id="account_number" 
                    error="account_number" 
                    title="{{ __('Account Number') }}" 
                    placeholder="{{ __('Account Number') }}" 
                />
            </div>
        </div>
    </div>
    
    <div class="my-16">
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Location Info') }}</p>
    
        <div class="my-4">
            <div>
                <x-form.input 
                    type="text" 
                    model="state.address" 
                    id="address" 
                    error="address" 
                    title="{{ __('Address') }}" 
                    placeholder="{{ __('Address') }}" 
                />
            </div>
        </div>
    
        <div class="grid grid-cols-3 gap-8 my-4">
            <div>
                <x-form.input 
                    type="text" 
                    model="state.city" 
                    id="city" 
                    error="city" 
                    title="{{ __('City') }}" 
                    placeholder="{{ __('City') }}" 
                />
            </div>

            <div>
                <x-form.input 
                    type="text" 
                    model="state.county" 
                    id="county" 
                    error="county" 
                    title="{{ __('County') }}" 
                    placeholder="{{ __('County') }}" 
                />
            </div>

            <div>
                <x-form.input 
                    type="text" 
                    model="state.postal_code" 
                    id="postal_code" 
                    error="postal_code" 
                    title="{{ __('Postal Code') }}" 
                    placeholder="{{ __('Postal Code') }}" 
                />
            </div>
        </div>
    </div>
    
    <div class="my-16">
        <div class="my-4">
            <div>
                <x-form.textarea
                    model="state.comment"
                    id="comment"
                    error="comment"
                    title="Comment"
                    placeholder="{{ __('Comment...') }}"
                />
            </div>
        </div>
    </div>

    <div>
        <x-form.submit title="Save" />
    </div>
</form>