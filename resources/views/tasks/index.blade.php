<x-app-layout>
    <h1 class="text-xl font-bold">{{ __('All Tasks') }}</h1>

    <x-flash-message type="success" name="taskUpdated" />
    <x-flash-message type="success" name="taskCompleted" />
    <x-flash-message type="success" name="taskCancelled" />

    @livewire('tasks.tasks-table')

</x-app-layout>