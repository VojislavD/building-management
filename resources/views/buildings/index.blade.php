<x-app-layout>
    <h1 class="text-xl font-bold">{{ __('All Buildings') }}</h1>

    <x-flash-message type="success" name="buildingCreated" />

    <x-flash-message type="success" name="buildingUpdated" />
    <x-flash-message type="error" name="buildingNotUpdated" />
    
    <x-flash-message type="success" name="buildingDeleted" />
    <x-flash-message type="error" name="buildingNotDeleted" />

    <div class="flex items-center justify-end">
        <x-link-button route="{{ route('buildings.create') }}" text="{{ __('New Building') }}" />
    </div>
    
    @livewire('buildings.buildings-table')
    
</x-app-layout>