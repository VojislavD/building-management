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
                    model="state.internal_code"
                    id="internal_code" 
                    title="{{ __('Internal Code') }}" 
                    placeholder="{{ __('Internal Code') }}" 
                    disabled="true"
                />
            </div>

            <div>
                <x-form.input 
                    type="text" 
                    model="state.address"
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
                    model="state.status" 
                    id="status" 
                    error="status" 
                    title="{{ __('Status') }}" 
                    :options="[
                        'Pending' => \App\Enums\ProjectStatus::Pending(), 
                        'Processing' => \App\Enums\ProjectStatus::Processing(),
                        'Finished' => \App\Enums\ProjectStatus::Finished(),
                        'Cancelled' => \App\Enums\ProjectStatus::Cancelled()
                    ]"
                />
            </div>

            <div>
                <x-form.input 
                    type="text" 
                    model="state.name" 
                    id="name" 
                    error="name" 
                    title="{{ __('Name') }}" 
                    placeholder="{{ __('Name') }}" 
                />
            </div>

            <div>
                <x-form.input 
                    type="number" 
                    model="state.price" 
                    id="price" 
                    error="price" 
                    title="{{ __('Price') }}" 
                    placeholder="{{ __('Price') }}" 
                />
            </div>

            <div>
                <x-form.input 
                    type="text" 
                    model="state.rates" 
                    id="rates" 
                    error="rates" 
                    title="{{ __('Rates') }}" 
                    placeholder="{{ __('Rates') }}" 
                />
            </div>

            <div>
                <x-form.input 
                    type="text" 
                    model="state.amount_payed" 
                    id="amount_payed" 
                    error="amount_payed" 
                    title="{{ __('Amount Payed') }}" 
                    placeholder="{{ __('Amount Payed') }}" 
                />
            </div>

            <div>
                <x-form.input 
                    type="text" 
                    model="state.amount_left" 
                    id="amount_left" 
                    error="amount_left" 
                    title="{{ __('Amount Left') }}" 
                    placeholder="{{ __('Amount Left') }}" 
                />
            </div>

            <div>
                <x-form.input 
                    type="date" 
                    model="state.start_paying" 
                    id="start_paying" 
                    error="start_paying" 
                    title="{{ __('Start Paying') }}" 
                    placeholder="{{ __('Start Paying') }}" 
                />
            </div> 
            
            <div>
                <x-form.input 
                    type="date" 
                    model="state.end_paying" 
                    id="end_paying" 
                    error="end_paying" 
                    title="{{ __('End Paying') }}" 
                    placeholder="{{ __('End Paying') }}" 
                />
            </div> 
        </div>
    </div>
    
    <div>
        <x-form.submit title="Save" />
    </div>
</form>