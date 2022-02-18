<div class="h-full flex flex-col justify-between">
    <h4 class="text-lg font-bold text-gray-700">{{ __('Scheduled Notifications') }}</h4>

    <div class="flex-1 space-y-1">
        @forelse ($notifications as $notification)
            <div class="flex h-16 mt-6 hover:bg-gray-100">
                <div class="w-16 xl:w-24 bg-secondary flex flex-col items-center justify-center text-sm py-3">
                    <span class="font-bold text-gray-200">{{ $notification->send_at->format('d M') }}</span>
                    <span class="text-gray-300">{{ $notification->send_at->format('h:i') }}</span>
                </div>
                <div class="flex-1 flex flex-col justify-center pl-4 truncate">
                    <a href="{{ route('notifications.show', $notification) }}" class="text-lg text-gray-900 font-bold hover:underline" title="{{ $notification->subject }}">{{ str($notification->subject)->limit(80) }}</a>
                    <span class="text-gray-700" title="{{ $notification->body }}">{{ str($notification->body)->limit(80) }}</a>
                </div>
                <div class="flex items-center pr-4 space-y-2">
                    <span class="bg-gray-300 text-xs px-3 py-2 rounded-lg">{{ $notification->created_at->shortRelativeDiffForHumans() }}</span>
                </div>
            </div>
        @empty
            <p class="mt-4 text-gray-700 text-center">{{ __('There is no scheduled notifications.') }}</p>
        @endforelse
    </div>
    <div class="mt-4">
        {{ $notifications->links() }}
    </div>
</div>
