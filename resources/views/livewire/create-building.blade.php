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
                    model="internal_code"
                    id="internal_code" 
                    title="{{ __('Internal Code') }}" 
                    placeholder="{{ __('Internal Code') }}" 
                />
                <x-form.error-message name="internal_code" />
            </div>

            <div>
                <x-form.select 
                    model="status" 
                    id="status" 
                    title="{{ __('Status') }}" 
                    :options="[
                        'Active' => \App\Models\Building::STATUS_ACTIVE, 
                        'Inactive' => \App\Models\Building::STATUS_INACTIVE
                    ]"
                />
                <x-form.error-message name="status" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-8 my-4">
            <div>
                <x-form.select 
                    model="construction_year" 
                    id="construction_year" 
                    title="{{ __('Construction Year') }}" 
                    :options="\App\Models\Building::availableConstructionYears()"
                />
                <x-form.error-message name="construction_year" />
            </div>

            <div>
                <x-form.input 
                    type="number" 
                    model="square" 
                    id="square" 
                    title="{{ __('Square') }}" 
                    placeholder="{{ __('Square') }}" 
                />
                <x-form.error-message name="square" />
            </div>
        </div>

        <div class="grid grid-cols-3 gap-8 my-4">
            <div>
                <x-form.input 
                    type="number" 
                    model="floors" 
                    id="floors" 
                    title="{{ __('Floors') }}" 
                    placeholder="{{ __('Floors') }}" 
                />
                <x-form.error-message name="floors" />
            </div>

            <div>
                <x-form.input 
                    type="number" 
                    model="apartments" 
                    id="apartments" 
                    title="{{ __('Apartments') }}" 
                    placeholder="{{ __('Apartments') }}" 
                />
                <x-form.error-message name="apartments" />
            </div>

            <div>
                <x-form.input 
                    type="number" 
                    model="tenants" 
                    id="tenants" 
                    title="{{ __('Tenants') }}" 
                    placeholder="{{ __('Tenants') }}" 
                />
                <x-form.error-message name="tenants" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-8 my-4">
            <div>
                <x-form.select 
                    model="elevator" 
                    id="elevator" 
                    title="{{ __('Elevator') }}" 
                    :options="[
                        'Yes' => 1,
                        'No' => 0
                    ]"
                />
                <x-form.error-message name="elevator" />
            </div>

            <div>
                <x-form.select 
                    model="yard" 
                    id="yard" 
                    title="{{ __('Yard') }}" 
                    :options="[
                        'Yes' => 1,
                        'No' => 0
                    ]"
                />
                <x-form.error-message name="yard" />
            </div>
        </div>

        <div class="my-4">
            <div>
                <x-form.input 
                    type="number" 
                    model="balance_begining" 
                    id="balance_begining" 
                    title="{{ __('Balance Begining') }}" 
                    placeholder="{{ __('Balance Begining') }}" 
                />
                <x-form.error-message name="balance_begining" />
            </div>
        </div>
    </div>

    <div class="my-16">
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Administrative Info') }}</p>

        <div class="grid grid-cols-3 gap-8 my-4">
            <div>
                <x-form.input 
                    type="text" 
                    model="pib" 
                    id="pib" 
                    title="{{ __('PIB') }}" 
                    placeholder="{{ __('PIB') }}" 
                />
                <x-form.error-message name="pib" />
            </div>

            <div>
                <x-form.input 
                    type="text" 
                    model="identification_number" 
                    id="identification_number" 
                    title="{{ __('Identification Number') }}" 
                    placeholder="{{ __('Identification Number') }}" 
                />
                <x-form.error-message name="identification_number" />
            </div>
            
            <div>
                <x-form.input 
                    type="text" 
                    model="account_number" 
                    id="account_number" 
                    title="{{ __('Account Number') }}" 
                    placeholder="{{ __('Account Number') }}" 
                />
                <x-form.error-message name="account_number" />
            </div>
        </div>
    </div>
    
    <div class="my-16">
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Location Info') }}</p>
    
        <div class="my-4">
            <div>
                <x-form.input 
                    type="text" 
                    model="address" 
                    id="address" 
                    title="{{ __('Address') }}" 
                    placeholder="{{ __('Address') }}" 
                />
                <x-form.error-message name="address" />
            </div>
        </div>
    
        <div class="grid grid-cols-3 gap-8 my-4">
            <div>
                <x-form.input 
                    type="text" 
                    model="city" 
                    id="city" 
                    title="{{ __('City') }}" 
                    placeholder="{{ __('City') }}" 
                />
                <x-form.error-message name="city" />
            </div>

            <div>
                <x-form.input 
                    type="text" 
                    model="county" 
                    id="county" 
                    title="{{ __('County') }}" 
                    placeholder="{{ __('County') }}" 
                />
                <x-form.error-message name="county" />
            </div>

            <div>
                <x-form.input 
                    type="text" 
                    model="postal_code" 
                    id="postal_code" 
                    title="{{ __('Postal Code') }}" 
                    placeholder="{{ __('Postal Code') }}" 
                />
                <x-form.error-message name="postal_code" />
            </div>
        </div>
    </div>
    
    <div class="my-16">
        <div class="my-4">
            <div>
                <x-form.textarea
                    model="comment"
                    id="comment"
                    title="Comment"
                    placeholder="{{ __('Comment...') }}"
                />
                <x-form.error-message name="comment" />
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end">
        <x-form.submit title="Save" />
    </div>
</form>