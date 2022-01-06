<x-app-layout>
    <h1 class="text-xl font-bold">{{ __('View Task Details') }}</h1>

    <div class="w-full xl:w-2/3 mx-auto">
        <div class="my-16">
            <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Task Details') }}</p>

            <div class="my-4 flex items-center">
                <span class="w-36 font-bold">{{ __('Status:') }}</span>
                <span>{!! $task->getStatusLabel() !!}</span>
            </div>

            <div class="my-4 flex items-center">
                <span class="w-36 font-bold">{{ __('Created By:') }}</span>
                <span>{{ $task->tenant->name }}</span>
            </div>

            <div class="my-4 flex items-center">
                <span class="w-36 font-bold">{{ __('Building:') }}</span>
                <span>{!! $task->building->address !!}</span>
            </div>

            <div class="my-4 flex items-start">
                <span class="font-bold">{{ __('Description:') }}</span>
                <span class="ml-14">{{ $task->description }}</span>
            </div>

            <div class="my-4 flex items-center">
                <span class="w-36 font-bold">{{ __('Comment:') }}</span>
                <span>{{ $task->comment }}</span>
            </div>

            <div class="my-4 flex items-center">
                <span class="w-36 font-bold">{{ __('Created At:') }}</span>
                <span>{{ $task->created_at->format('d.m.Y') }}</span>
            </div>

            <div class="my-4 flex items-center">
                <span class="w-36 font-bold">{{ __('Last Updated At:') }}</span>
                <span>{{ $task->updated_at->format('d.m.Y') }}</span>
            </div>
        </div>

        <div class="my-16">
            <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Add Comment') }}</p>

            <form class="my-4">
                <x-form.input
                    type="text"
                    id="comment"
                    title="Comment"
                    placeholder="Add Comment..."
                    name="comment"
                />

                <div class="mt-4">
                    <x-form.submit title="Save" />
                </div>
            </form>
        </div>

        <div class="my-16">
            <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Change Status') }}</p>

            <div class="flex items-center space-x-4 my-4">
                <div
                    x-data="{ confirmTaskStatus: false }" 
                    class="flex items-center justify-center"
                >
                    <button
                        @click="confirmTaskStatus = true"
                        class="flex items-center justify-center bg-green-600 hover:bg-green-800 text-gray-100 py-1 px-3 rounded space-x-2" 
                        title="{{ __('Mark As Completed') }}"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        <span>{{ __('Mark As Completed')}}</span>
                    </button>

                    <x-modals.confirm-task-status route="{{ route('tasks.completed', $task) }}" />
                </div>
                
                <div
                    x-data="{ confirmTaskStatus: false }" 
                    class="flex items-center justify-center"
                >
                    <button
                        @click="confirmTaskStatus = true"
                        class="flex items-center justify-center bg-red-600 hover:bg-red-800 text-gray-100 py-1 px-3 rounded space-x-2" 
                        title="{{ __('Mark As Cancelled') }}"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        <span>{{ __('Mark As Cancelled') }}</span>
                    </button>

                    <x-modals.confirm-task-status route="{{ route('tasks.cancelled', $task) }}" />
                </div>
            </div>
        </div>
    </div>

</x-app-layout>