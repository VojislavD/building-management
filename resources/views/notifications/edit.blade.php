<x-app-layout>
    <h1 class="text-xl font-bold">{{ __('Edit Notification') }}</h1>

    @livewire('notifications.edit-notification', ['notification' => $notification])

</x-app-layout>