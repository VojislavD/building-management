<x-app-layout>
    <h1 class="text-xl font-bold">{{ __('Send New Notification') }}</h1>

    @livewire('notifications.create-notification', ['building' => $building])

</x-app-layout>