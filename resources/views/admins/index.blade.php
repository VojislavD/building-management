<x-app-layout>
    <h1 class="text-xl font-bold">{{ __('All Admins') }}</h1>

    <div class="flex items-center justify-end">
        <x-link-button route="#" text="{{ __('New Admin') }}" />
    </div>

    @livewire('admins.admins-table')
    
</x-app-layout>