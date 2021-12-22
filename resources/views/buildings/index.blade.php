<x-app-layout>
    <div class="flex items-center justify-end">
        <a 
            href="#"
            class="bg-primary hover:bg-primary-dark text-gray-100 px-3 py-1 rounded cursor-pointer transition duration-150" 
            title="{{ __('Add New Building') }}"
        >
            {{ __('Add Building') }}
        </a>
    </div>
    <table class="w-full my-8 whitespace-nowrap">
        <thead class="bg-secondary text-gray-100 font-bold">
            <tr><td>
            </td>
            <td class="py-2 pl-2">
                {{ __('ID') }}
            </td>
            <td class="py-2 pl-2">
                {{ __('Address') }}
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
        </tr></thead>
        <tbody>
            <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
                <td class="py-3 pl-2">
                    <input type="checkbox" class="rounded focus:ring-0 checked:bg-red-500 ml-2">
                </td>
                <td class="py-3 pl-2">
                    #1143
                </td>
                <td class="py-3 pl-2 capitalize">
                    309 Fairfield Road, Saint Louis, MO 63109
                </td>
                <td class="py-3 pl-2">
                    4
                </td>
                <td class="py-3 pl-2">
                    16
                </td>
                <td class="py-3 pl-2">
                    42
                </td>
                <td class="flex items-center space-x-2 py-3 pl-2">
                    <a href="#" class="hover:text-primary" title="{{ __('View Details') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    </a>
                    <a href="#" class="hover:text-primary" title="{{ __('Edit') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</x-app-layout>