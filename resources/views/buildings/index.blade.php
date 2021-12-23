<x-app-layout>
    <div class="flex items-center justify-end">
        <a 
            href="#"
            class="bg-primary hover:bg-primary-dark text-gray-100 px-3 py-1 rounded cursor-pointer transition duration-150" 
            title="{{ __('Add New Building') }}"
        >
            {{ __('Add Building') }}
        </a>
    </div>
    
    @livewire('buildings-table')
    
</x-app-layout>