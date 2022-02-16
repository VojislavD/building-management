<div>
    <h4 class="text-lg font-bold text-gray-700">{{ __('Pending Tasks') }}</h4>

    <div class="space-y-1">
        @forelse ($tasks as $task)
            <div class="h-16 flex mt-6 hover:bg-gray-100 px-4">
                <div class="flex-1 flex flex-col justify-center truncate">
                    <a href="{{ route('tasks.show', $task) }}" class="font-bold hover:underline text-gray-900" >{{ str($task->description)->limit(40) }}</a>
                    <span class="text-gray-700">{{ $task->user->name }}</span>
                </div>
                <div class="flex items-center space-y-2">
                    <span class="bg-gray-300 text-xs px-3 py-2 rounded-lg">{{ $task->created_at->shortRelativeDiffForHumans() }}</span>
                </div>
            </div>
        @empty
            <p class="mt-4 text-gray-700 text-center">{{ __('There is no pending tasks.') }}</p>
        @endforelse
    </div>
    <div class="mt-4">
        {{ $tasks->links() }}
    </div>
</div>
