<div>
    <div class="mt-8 mb-3 flex items-center justify-end">
        <label>Building:</label>
        <select wire:model="building_id" class="w-48 text-sm py-0.5 ml-2">
            <option value="0">{{ __('All') }}</option>
            @foreach($buildings as $building)
                <option value="{{ $building->id }}">{{ $building->address }}</option>
            @endforeach
        </select>
    </div>

    <table class="w-full my-3 whitespace-nowrap">
        <thead class="bg-secondary text-gray-100 font-bold">
            <tr>
                <td></td>
                <td class="py-2 pl-2">
                    {{ __('Number') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Tenants') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Owner Name') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Owner Email') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Owner Phone') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Building Address') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Manage') }}
                </td>
            </tr>
        </thead>
        <tbody>
            @forelse($apartments as $apartment)
                <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
                    <td class="py-3 pl-2">
                        <input type="checkbox" class="rounded focus:ring-0 checked:bg-red-500 ml-2">
                    </td>
                    <td class="py-3 pl-2">
                        {{ $apartment->number }}
                    </td>
                    <td class="py-3 pl-2 capitalize">
                        {{ $apartment->tenants }}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $apartment->owner->name }}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $apartment->owner->email }}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $apartment->owner->phone }}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $apartment->building->address }}
                    </td>
                    <td class="flex items-center space-x-2 py-3 pl-2">
                        <a href="{{ route('apartments.edit', $apartment) }}" class="hover:text-primary" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                    </td>
                </tr>
            @empty
                <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
                    <td class="py-3 pl-2 text-center" colspan="8">
                        {{ __('There is no apartments yet.') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $apartments->links() }}
</div>