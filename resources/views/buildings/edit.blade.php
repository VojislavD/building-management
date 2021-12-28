<x-app-layout>
    <h1 class="text-xl font-bold">{{ __('Edit Building') }}</h1>

    @livewire('edit-building', ['building' => $building])
    
        
    <div
        x-data="{ confirmDelete: false }" 
        class="flex items-center justify-end mt-12"
    >
        <button
            @click="confirmDelete = true" 
            class="text-red-500 hover:text-red-700 font-semibold" 
            title="{{ __('Delete Building')}}"
        >
            {{ ('Delete Building') }}
        </button>

        <x-confirm-delete route="{{ route('buildings.delete', $building) }}" />
    </div>

</x-app-layout>