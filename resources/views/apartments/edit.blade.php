<x-app-layout>
    <h1 class="text-xl font-bold">{{ __('Edit Apartment') }}</h1>

    @livewire('edit-apartment', ['apartment' => $apartment])
    
</x-app-layout>