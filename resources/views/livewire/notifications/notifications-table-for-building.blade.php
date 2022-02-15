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
                    <td class="py-3 pl-2">
                        {{ $notification->subject }}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $notification->body }}
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
                    <td class="flex items-center space-x-2 py-3 pl-2">
                        {{-- <a href="{{ route('apartments.edit', $apartment) }}" class="hover:text-primary" title="Edit"> --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
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