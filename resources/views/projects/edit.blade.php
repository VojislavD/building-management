<x-app-layout>
    <h1 class="text-xl font-bold">{{ __('Edit Project') }}</h1>

    @livewire('projects.edit-project', ['project' => $project])
    
    <div
        x-data="{ confirmDelete: false }" 
        class="flex items-center justify-end mt-12"
    >
        <button
            @click="confirmDelete = true" 
            class="text-red-500 hover:text-red-700 font-semibold" 
            title="{{ __('Delete Project')}}"
        >
            {{ ('Delete Project') }}
        </button>

        <x-modals.confirm-delete route="{{ route('projects.delete', $project) }}" />
    </div>
</x-app-layout>