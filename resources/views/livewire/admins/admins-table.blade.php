<div>
    <table class="w-full my-3 whitespace-nowrap">
        <thead class="bg-secondary text-gray-100 font-bold">
            <tr>
                <td class="py-2 pl-2">
                    {{ __('Name') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Email') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Company') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Created At') }}
                </td>
                <td class="py-2 pl-2">
                    {{ __('Updated At') }}
                </td>
                <td class="py-2 pl-2"></td>
            </tr>
        </thead>
        <tbody>
            @forelse($admins as $admin)
                <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
                    <td class="py-3 pl-2 capitalize">
                        {{ $admin->name }}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $admin->email }}
                    </td>
                    <td class="py-3 pl-2 capitalize">
                        {{ $admin->company->name }}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $admin->created_at->toFormattedDateString() }}
                    </td>
                    <td class="py-3 pl-2">
                        {{ $admin->updated_at->toFormattedDateString() }}
                    </td>
                    <td class="flex items-center space-x-2 py-3 pl-2">
                        <a 
                            href="{{ route('admins.edit', $admin) }}" 
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
    {{ $admins->links() }}
</div>
