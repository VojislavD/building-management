<x-app-layout>
    <h1 class="text-xl font-bold">{{ __('All Projects') }}</h1>

    <x-flash-message type="success" name="projectDeleted" />
    <x-flash-message type="error" name="projectNotDeleted" />
    
    @livewire('all-projects-table')

</x-app-layout>