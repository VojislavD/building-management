<div>
    <div class="flex items-center justify-between mt-4">
        <div>
            <label for="">Status: </label>
            <select 
                wire:model="status"
                class="py-1 text-sm border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300"
                >
                <option value="">{{ __('All') }}</option>
                <option value="{{ \App\Enums\BuildingStatus::Active() }}">
                    {{ \App\Enums\BuildingStatus::Active->name() }}
                </option>
                <option value="{{ \App\Enums\BuildingStatus::Inactive() }}">
                    {{ \App\Enums\BuildingStatus::Inactive->name() }}
                </option>
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
    </div>
    <table class="w-full my-3 whitespace-nowrap">
        <thead class="bg-secondary text-gray-100 font-bold">
            <tr>
                <td class="py-2 pl-2">
                    {{ __('Internal Code') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Address') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Status') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Floors') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Apartments') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Tenants') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Manage') }}
                </td>
            </tr>
        </thead>
        <tbody>
            @forelse($buildings as $building)
                <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
                    <td class="py-3 pl-2">
                        # {{ $building->internal_code }}
                    </td>
                    <td class="py-3 pl-2 capitalize">
                        {{ $building->address }}, {{ $building->city }}
                    </td>
                    <td class="py-3 pl-2">
                        {!! $building->status->label() !!}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $building->floors }}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $building->apartments_count }}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $building->tenantsSum() }}
                    </td>
                    <td class="flex items-center space-x-2 py-3 pl-2">
                        <a 
                            href="{{ route('buildings.show', $building) }}" 
                            class="hover:text-primary" 
                            title="{{ __('View Details') }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </a>
                        <a 
                            href="{{ route('buildings.edit', $building) }}" 
                            class="hover:text-primary" 
                            title="{{ __('Edit') }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        </a>
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
    {{ $buildings->links() }}
</div>
