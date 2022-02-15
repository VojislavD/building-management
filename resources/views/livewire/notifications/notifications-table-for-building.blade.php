<div>
    <div class="flex items-center justify-between mt-4">
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
                        {{ $notification->status }}
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
                        {{ __('There is no apartments yet.') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $notifications->links() }}
</div>