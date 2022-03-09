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
                    <td class="flex items-center justify-center space-x-2 py-3 pl-2">
                        <a 
                            href="{{ route('impersonate', $admin->id) }}" 
                            class="hover:text-primary" 
                            title="{{ __('Impersonate') }}"
                        >

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 511 512.35"><path d="M162.62 21.9c-5.49 5.43-10.63 12.02-15.42 19.71-17.37 27.82-30.33 69.99-39.92 123.16-56.3 10.64-91.06 34.14-89.9 58.14 1.04 21.74 28.46 38.41 69.67 49.92-2.71 8.38-2.07 9.82 1.6 20.13-30.78 12.98-62.94 52.4-88.65 86.93l100.03 67.61-35.32 64.85h384.41l-37.26-64.85L511 378.63c-29.08-40.85-64.19-75.56-86.12-84.98 4.63-12.02 5.44-14.12 1.56-20.79 41.21-11.72 68.23-28.84 68.17-51.47-.06-24.68-35.5-48.38-88.31-56.62-12.64-53.5-25.22-95.62-41.23-123.27-2.91-5.02-5.93-9.57-9.09-13.62-47.66-61.12-64.36-2.69-98.14-2.76-39.17-.08-44.15-53.69-95.22-3.22zm67.12 398.37c-3.57 0-6.47-2.9-6.47-6.47s2.9-6.47 6.47-6.47h10.52c1.38 0 2.66.44 3.7 1.17 3.77 2.1 7.46 3.33 11.01 3.42 3.54.09 7.14-.96 10.8-3.45a6.515 6.515 0 0 1 3.61-1.11l12.78-.03c3.57 0 6.46 2.9 6.46 6.47s-2.89 6.47-6.46 6.47h-10.95c-5.46 3.27-10.98 4.67-16.54 4.53-5.44-.14-10.78-1.77-16.01-4.53h-8.92zm-69.12-140.78c60.43 21.74 120.87 21.38 181.3 1.83-58.45 4.75-122.79 3.62-181.3-1.83zm208.37-.86c20.89 70.63-68.53 106.5-101.95 27.98h-22.11c-34.12 78.28-122.14 44.17-102.16-28.94-7.31-.8-14.51-1.68-21.56-2.62l-.32 1.88-.59 3.56-3.48 20.87c-30.39-6.72-13.36 71.77 14.26 64.87 4.22 12.18 7.69 22.62 11.26 32.19 36.81 98.83 190.88 104.81 226.95 6.36 3.78-10.32 6.85-21.64 11.24-35.39 25.44 4.06 46.35-73.31 15.34-67.63l-3.19-21.05-.55-3.65-.23-1.54c-7.47 1.16-15.12 2.2-22.91 3.11zM123.7 176.34l7.43-25.43c48.16 40.42 214.59 34.09 250.87 0l6.26 25.43c-42.31 44.75-219.33 38.67-264.56 0z"/></svg>
                        </a>
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
