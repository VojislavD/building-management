<x-app-layout>
    <h1 class="text-xl font-bold">{{ __('Edit Admin') }}</h1>

    @livewire('admins.edit-admin', ['admin' => $admin])
    
    {{-- <div
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

        <x-modals.confirm-delete route="{{ route('buildings.delete', $building) }}" />
    </div> --}}

</x-app-layout>