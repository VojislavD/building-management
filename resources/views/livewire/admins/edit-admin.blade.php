<form 
    class="w-full xl:w-2/3 mx-auto"
    wire:submit.prevent="submit"
>
    <div class="my-16">
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Admin Info') }}</p>

        <div class="flex flex-col my-4">
            <label for="company_id">Company</label>
            <select 
                name="company_id" 
                id="company_id" 
                class="mt-2 py-1 border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 capitalize @error('company_id') border-red-500 @enderror"
                wire:model.defer="state.company_id"
            >
                <option></option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>   
                @endforeach
            </select>
            @if('company_id')
                <x-form.error-message name="company_id" />
            @endif
        </div>

        
        <div class="my-4">
            <x-form.input 
                type="text" 
                model="state.name"
                id="name" 
                error="name" 
                title="{{ __('Name') }}" 
                placeholder="{{ __('Name') }}" 
            />
        </div>

        <div class="my-4">
            <x-form.input 
                type="email" 
                model="state.email"
                id="email" 
                error="email" 
                title="{{ __('Email') }}" 
                placeholder="{{ __('Email') }}" 
            />
        </div>

        <div class="my-4">
            <x-form.input 
                type="password" 
                model="state.password"
                id="password" 
                error="password" 
                title="{{ __('New Password') }}" 
                placeholder="{{ __('Leave Empty To Keep Old Password') }}" 
            />
        </div>
    </div>

    <div>
        <x-form.submit title="Save" />
    </div>
</form>