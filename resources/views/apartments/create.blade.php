<x-app-layout>
    <h1 class="text-xl font-bold">{{ __('Add New Apartment') }}</h1>

    @livewire('apartments.create-apartment', ['building' => $building])
    
</x-app-layout>