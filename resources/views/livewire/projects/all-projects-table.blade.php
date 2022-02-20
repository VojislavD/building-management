<div>
    <div class="flex items-center justify-between mt-4">
        <div class="flex items-center space-x-4">
            <div class="flex items-center">
                <label>Status:</label>
                <select wire:model="status" class="w-32 text-sm py-0.5 ml-2 focus:outline-none focus:ring-0 focus:border-gray-900">
                    <option value="0">{{ __('All') }}</option>
                    <option value="{{ \App\Enums\ProjectStatus::Pending() }}">
                        {{\App\Enums\ProjectStatus::Pending->name() }}
                    </option>
                    <option value="{{ \App\Enums\ProjectStatus::Processing() }}">
                        {{ \App\Enums\ProjectStatus::Processing->name() }}
                    </option>
                    <option value="{{ \App\Enums\ProjectStatus::Finished() }}">
                        {{ \App\Enums\ProjectStatus::Finished->name() }}
                    </option>
                    <option value="{{ \App\Enums\ProjectStatus::Cancelled() }}">
                        {{ \App\Enums\ProjectStatus::Cancelled->name() }}
                    </option>
                </select>
            </div>
            <div class="flex items-center">
                <label>Building:</label>
                <select wire:model="building_id" class="w-48 text-sm py-0.5 ml-2 focus:outline-none focus:ring-0 focus:border-gray-900">
                    <option value="0">{{ __('All') }}</option>
                    @foreach($buildings as $building)
                    <option value="{{ $building->id }}">{{ $building->address }}</option>
                    @endforeach
                </select>
            </div>
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
    </div>
    

    <table class="w-full my-3 whitespace-nowrap">
        <thead class="bg-secondary text-gray-100 font-bold">
            <tr>
                <td class="py-2 pl-2">
                    {{ __('Name') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Price') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Rates') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Payed') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Left') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Status') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Start Paying') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('End Paying') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Manage') }}
                </td>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
                <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
                    <td class="py-3 pl-2">
                        {{ $project->name }}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $project->price }} RSD
                    </td>
                    <td class="py-3 pl-2">
                        {{ $project->rates }}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $project->amount_payed }} RSD
                    </td>
                    <td class="py-3 pl-2">
                        {{ $project->amount_left }} RSD
                    </td>
                    <td class="py-3 pl-2">
                        {!! $project->status->label() !!}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $project->start_paying->format('d.m.Y') }}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $project->end_paying->format('d.m.Y') }}
                    </td>
                    <td class="flex items-center space-x-2 py-3 pl-2">
                        <a href="{{ route('projects.edit', $project) }}" class="hover:text-primary" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                    </td>
                </tr>
            @empty
                <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
                    <td class="py-3 pl-2 text-center" colspan="9">
                        {{ __('There is no projects yet.') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $projects->links() }}
</div>