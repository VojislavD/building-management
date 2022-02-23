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
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Owner Info') }}</p>

        <div class="grid grid-cols-3 gap-8 my-4">
            <div>
                <x-form.input 
                    type="text" 
                    model="state.owner_name" 
                    id="owner_name" 
                    error="owner_name"
                    title="{{ __('Name') }}" 
                    placeholder="{{ __('Name') }}" 
                />
            </div>

            <div>
                <x-form.input 
                    type="email" 
                    model="state.owner_email" 
                    id="owner_email" 
                    error="owner_email"
                    title="{{ __('Email Address') }}" 
                    placeholder="{{ __('Email Address') }}" 
                />
            </div>
            
            <div>
                <x-form.input 
                    type="text" 
                    model="state.owner_phone" 
                    id="owner_phone" 
                    error="owner_phone"
                    title="{{ __('Phone Number') }}" 
                    placeholder="{{ __('Phone Number') }}" 
                />
            </div>
        </div>
    </div>

    <div class="my-16">
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Apartment Info') }}</p>

        <div class="grid grid-cols-2 gap-8 my-4">
            <div>
                <x-form.input 
                    type="number" 
                    model="state.number" 
                    id="number" 
                    error="number"
                    title="{{ __('Number') }}" 
                    placeholder="{{ __('Number') }}" 
                />
            </div>

            <div>
                <x-form.input 
                    type="number" 
                    model="state.tenants" 
                    id="tenants" 
                    error="tenants"
                    title="{{ __('Tenants') }}" 
                    placeholder="{{ __('Tenants') }}" 
                />
            </div>
        </div>
    </div>
    
    <div>
        <x-form.submit title="Save" />
    </div>
</form>