<x-app-layout>
    <h1 class="text-xl font-bold">{{ __('All Buildings') }}</h1>
    <div class="flex items-center justify-end">
        <x-link-button route="{{ route('buildings.create') }}" text="{{ __('New Building') }}" />
    </div>
    
    @livewire('buildings-table')
    
</x-app-layout>