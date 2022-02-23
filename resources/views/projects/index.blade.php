<x-app-layout>
    <h1 class="text-xl font-bold">{{ __('All Projects') }}</h1>

    <x-flash-message type="success" name="projectUpdated" />

    <x-flash-message type="success" name="projectDeleted" />

    @livewire('projects.all-projects-table')

</x-app-layout>