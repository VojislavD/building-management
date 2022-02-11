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
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Owner Info') }}</p>

        <div class="grid grid-cols-3 gap-8 my-4">
            <div>
                <x-form.input 
                    type="text" 
                    model="owner_name" 
                    id="owner_name" 
                    title="{{ __('Name') }}" 
                    placeholder="{{ __('Name') }}" 
                />
                <x-form.error-message name="owner_name" />
            </div>

            <div>
                <x-form.input 
                    type="email" 
                    model="owner_email" 
                    id="owner_email" 
                    title="{{ __('Email Address') }}" 
                    placeholder="{{ __('Email Address') }}" 
                />
                <x-form.error-message name="owner_email" />
            </div>
            
            <div>
                <x-form.input 
                    type="text" 
                    model="owner_phone" 
                    id="owner_phone" 
                    title="{{ __('Phone Number') }}" 
                    placeholder="{{ __('Phone Number') }}" 
                />
                <x-form.error-message name="owner_phone" />
            </div>
        </div>
    </div>

    <div class="my-16">
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Apartment Info') }}</p>

        <div class="grid grid-cols-2 gap-8 my-4">
            <div>
                <x-form.input 
                    type="number" 
                    model="number" 
                    id="number" 
                    title="{{ __('Number') }}" 
                    placeholder="{{ __('Number') }}" 
                />
                <x-form.error-message name="number" />
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
    </div>
    
    <div>
        <x-form.submit title="Save" />
    </div>
</form>