<div>
    {{-- <div class="flex items-center justify-between mt-4">
        <div>
            <label for="">Status: </label>
            <select 
                wire:model="status"
                class="py-1 text-sm border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300"
                >
                <option value="">{{ __('All') }}</option>
                <option value="{{ \App\Models\Building::STATUS_ACTIVE }}">{{ __('Active') }}</option>
                <option value="{{ \App\Models\Building::STATUS_INACTIVE }}">{{ __('Inactive') }}</option>
            </select>
        </div>
        <div>
            <select 
                wire:model="perPage"
                class="py-1 text-sm border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300"
                >
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>
        </div>
    </div> --}}
    <table class="w-full my-3 whitespace-nowrap">
        <thead class="bg-secondary text-gray-100 font-bold">
            <tr>
                <td class="py-2 pl-2">
                    {{ __('Created By') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Status') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Description') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Building') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Created At') }}
                </td>
                <td class="py-2 pl-2"></td>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
                <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
                    <td class="py-3 pl-2">
                        {{ $task->tenant->name }}
                    </td>
                    <td class="py-3 pl-2 capitalize">
                        {!! $task->getStatusLabel() !!}
                    </td>
                    <td class="py-3 pl-2 truncate" title="{{ Str::limit($task->description, 500, '...') }}">
                        {{ Str::limit($task->description, 40, '...') }}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $task->building->address }}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $task->created_at->format('d.m.Y') }}
                    </td>
                    <td class="flex items-center space-x-2 py-3 pl-2">
                        <button
                            class="text-primary hover:text-primary-dark" 
                            title="{{ __('View Details') }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </button>
                        <button
                            class="text-green-600 hover:text-green-800" 
                            title="{{ __('Mark As Finished') }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        </button>
                        <button
                            class="text-red-600 hover:text-red-800" 
                            title="{{ __('Mark As Cancelled') }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </td>
                </tr>
            @empty
                <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
                    <td class="py-3 pl-2 text-center" colspan="8">
                        {{ __('There is no any buildings yet') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $tasks->links() }}
</div>
