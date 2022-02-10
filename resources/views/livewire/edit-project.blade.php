<form 
    class="w-full xl:w-2/3 mx-auto"
    wire:submit.prevent="submit"
>
    <div class="my-16">
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Building Info') }}</p>

        <div class="grid grid-cols-2 gap-8 my-4">
            <div>
                <x-form.input 
                    type="text" 
                    model="internal_code"
                    id="internal_code" 
                    title="{{ __('Internal Code') }}" 
                    placeholder="{{ __('Internal Code') }}" 
                    disabled="true"
                />
            </div>

            <div>
                <x-form.input 
                    type="text" 
                    model="address"
                    id="address" 
                    title="{{ __('Address') }}" 
                    placeholder="{{ __('Address') }}" 
                    disabled="true"
                />
            </div>
        </div>
    </div>

    <div class="my-16">
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Project Info') }}</p>

        <div class="grid grid-cols-2 gap-8 my-4">
            <div>
                <x-form.select 
                    model="status" 
                    id="status" 
                    title="{{ __('Status') }}" 
                    :options="[
                        'Pending' => \App\Enums\ProjectStatus::Pending->value, 
                        'Processing' => \App\Enums\ProjectStatus::Processing->value,
                        'Finished' => \App\Enums\ProjectStatus::Finished->value,
                        'Cancelled' => \App\Enums\ProjectStatus::Cancelled->value
                    ]"
                />
                <x-form.error-message name="status" />
            </div>

            <div>
                <x-form.input 
                    type="text" 
                    model="name" 
                    id="name" 
                    title="{{ __('Name') }}" 
                    placeholder="{{ __('Name') }}" 
                />
                <x-form.error-message name="name" />
            </div>

            <div>
                <x-form.input 
                    type="number" 
                    model="price" 
                    id="price" 
                    title="{{ __('Price') }}" 
                    placeholder="{{ __('Price') }}" 
                />
                <x-form.error-message name="price" />
            </div>

            <div>
                <x-form.input 
                    type="text" 
                    model="rates" 
                    id="rates" 
                    title="{{ __('Rates') }}" 
                    placeholder="{{ __('Rates') }}" 
                />
                <x-form.error-message name="rates" />
            </div>

            <div>
                <x-form.input 
                    type="text" 
                    model="amount_payed" 
                    id="amount_payed" 
                    title="{{ __('Amount Payed') }}" 
                    placeholder="{{ __('Amount Payed') }}" 
                />
                <x-form.error-message name="amount_payed" />
            </div>

            <div>
                <x-form.input 
                    type="text" 
                    model="amount_left" 
                    id="amount_left" 
                    title="{{ __('Amount Left') }}" 
                    placeholder="{{ __('Amount Left') }}" 
                />
                <x-form.error-message name="amount_left" />
            </div>

            <div>
                <x-form.input 
                    type="date" 
                    model="start_paying" 
                    id="start_paying" 
                    title="{{ __('Start Paying') }}" 
                    placeholder="{{ __('Start Paying') }}" 
                />
                <x-form.error-message name="start_paying" />
            </div> 
            
            <div>
                <x-form.input 
                    type="date" 
                    model="end_paying" 
                    id="end_paying" 
                    title="{{ __('End Paying') }}" 
                    placeholder="{{ __('End Paying') }}" 
                />
                <x-form.error-message name="end_paying" />
            </div> 
        </div>
    </div>
    
    <div>
        <x-form.submit title="Save" />
    </div>
</form>