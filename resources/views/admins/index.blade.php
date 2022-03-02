<x-app-layout>
    <h1 class="text-xl font-bold">{{ __('All Admins') }}</h1>

    <x-flash-message type="success" name="adminCreated" />
    <x-flash-message type="success" name="adminUpdated" />

    <div class="flex items-center justify-end">
        <x-link-button route="{{ route('admins.create') }}" text="{{ __('New Admin') }}" />
    </div>

    @livewire('admins.admins-table')
    
</x-app-layout>