<div class="h-full flex flex-col justify-between">
    <h4 class="text-lg font-bold text-gray-700">{{ __('Active Projects') }}</h4>

    <div class="flex-1 space-y-1">
        @forelse ($projects as $project)
            <div class="h-16 flex mt-6 hover:bg-gray-100 px-4">
                <div class="flex-1 flex flex-col justify-center truncate">
                    <div class="flex items-center space-x-2">
                        <a href="#" class="font-bold hover:underline text-gray-900">{{ str($project->name)->limit(50) }}</a>
                        <span>{!! $project->status->label() !!}</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-1 text-sm">
                            <span>{{ __('Total:') }}</span>
                            <span class="font-bold">${{ $project->price }}</span>
                        </div>
                        <div class="flex items-center space-x-1 text-sm">
                            <span>{{ __('Paid:') }}</span>
                            <span class="font-bold">${{ $project->amount_payed }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-y-2">
                    <span class="bg-gray-300 text-xs px-3 py-2 rounded-lg">{{ $project->created_at->shortRelativeDiffForHumans() }}</span>
                </div>
            </div>
        @empty
            <p class="mt-4 text-gray-700 text-center">{{ __('There is no pending tasks.') }}</p>
        @endforelse
    </div>
    <div class="mt-4">
        {{ $projects->links() }}
    </div>
</div>
