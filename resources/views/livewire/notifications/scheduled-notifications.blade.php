<div>
    <h4 class="text-lg font-bold text-gray-700">{{ __('Scheduled Notifications') }}</h4>

    <div class="space-y-1">
        @forelse ($scheduledNotifications as $notification)
            <div class="flex mt-6 hover:bg-gray-100">
                <div class="w-24 bg-secondary flex flex-col items-center justify-center text-sm py-3">
                    <span class="font-bold text-gray-200">{{ $notification->send_at->format('d M') }}</span>
                    <span class="text-gray-300">{{ $notification->send_at->format('h:i') }}</span>
                </div>
                <div class="flex-1 flex flex-col justify-center pl-4">
                    <a href="{{ route('notifications.show', $notification) }}" class="text-lg font-bold hover:underline" title="{{ $notification->subject }}">{{ str($notification->subject)->limit(80) }}</a>
                    <span title="{{ $notification->body }}">{{ str($notification->body)->limit(80) }}</a>
                </div>
                <div class="flex items-center pr-4 space-y-2">
                    <span class="bg-gray-300 text-sm px-3 py-2 rounded-lg">{{ $notification->created_at->shortRelativeDiffForHumans() }}</span>
                </div>
            </div>
        @empty
            <p class="mt-4 text-gray-700 text-center">{{ __('There is no pending tasks.') }}</p>
        @endforelse
    </div>
    <div class="mt-4">
        {{ $scheduledNotifications->links() }}
    </div>
</div>
