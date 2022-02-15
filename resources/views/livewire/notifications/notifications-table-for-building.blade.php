<div>
    <div class="flex items-center justify-end">
        <div class="flex items-center">
            <label>Status:</label>
            <select wire:model="status" class="w-32 text-sm py-0.5 ml-2 focus:outline-none focus:ring-0 focus:border-gray-900">
                <option value="0">{{ __('All') }}</option>
                <option value="{{ \App\Enums\NotificationStatus::Scheduled->value }}">{{ __('Scheduled') }}</option>
                <option value="{{ \App\Enums\NotificationStatus::Processing->value }}">{{ __('Processing') }}</option>
                <option value="{{ \App\Enums\NotificationStatus::Finished->value }}">{{ __('Finished') }}</option>
                <option value="{{ \App\Enums\NotificationStatus::Cancelled->value }}">{{ __('Cancelled') }}</option>
            </select>
        </div>
    </div>

    <table class="w-full my-3 whitespace-nowrap">
        <thead class="bg-secondary text-gray-100 font-bold">
            <tr>
                <td class="py-2 pl-2">
                    {{ __('Subject') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Body') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Via Email') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Status') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Send At') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Created At') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Manage') }}
                </td>
            </tr>
        </thead>
        <tbody>
            @forelse($notifications as $notification)
                <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
                    <td class="py-3 pl-2" title="{{ $notification->subject }}">
                        {{ str($notification->subject)->limit(50) }}
                    </td>
                    <td class="py-3 pl-2" title="{{ $notification->body }}">
                        {{ str($notification->body)->limit(50) }}
                    </td>
                    <td class="py-3 pl-2">
                        {!! $notification->viaEmailLabel() !!}
                    </td>
                    <td class="py-3 pl-2">
                        {!! $notification->status->label() !!}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $notification->send_at }}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $notification->created_at }}
                    </td>
                    <td
                        x-data="{ confirmDelete: false }" 
                        class="flex items-center space-x-2 py-3 pl-2"
                    >
                        <button title="{{ __('View Details')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700 hover:text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>
                        </button>
                        <button title="Cancel Notification">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700 hover:text-primary" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                        </button>
                        <button 
                            @click="confirmDelete = true" 
                            title="Delete Notificaton"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700 hover:text-primary" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                        </button>
                        <x-modals.confirm-delete route="{{ route('notifications.delete', $notification) }}" />
                    </td>
                </tr>
            @empty
                <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
                    <td class="py-3 pl-2 text-center" colspan="8">
                        {{ __('There is no notifications.') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $notifications->links() }}
</div>