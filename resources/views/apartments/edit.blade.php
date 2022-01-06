<x-app-layout>
    <h1 class="text-xl font-bold">{{ __('Edit Apartment') }}</h1>

    @livewire('edit-apartment', ['apartment' => $apartment])
    
    <div
        x-data="{ confirmDelete: false }" 
        class="flex items-center justify-end mt-12"
    >
        <button
            @click="confirmDelete = true" 
            class="text-red-500 hover:text-red-700 font-semibold" 
            title="{{ __('Delete Apartment')}}"
        >
            {{ ('Delete Apartment') }}
        </button>

        <x-modals.confirm-delete route="{{ route('apartments.delete', $apartment) }}" />
    </div>
</x-app-layout>