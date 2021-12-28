<x-app-layout>
    <h1 class="text-xl font-bold">{{ __('Edit Building') }}</h1>

    @livewire('edit-building', ['building' => $building])
    
</x-app-layout>