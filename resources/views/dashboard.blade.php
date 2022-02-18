<x-app-layout>
@push('headScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
@endpush

    <div class="py-6">
        <div class="mx-auto sm:px-6 lg:px-8">
            @role('super_admin')
                Super Admin
            @endrole

            @role('admin')
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    <div class="md:col-span-2 xl:col-span-1 bg-white rounded-lg space-y-4">
                        <div class="flex items-center justify-between py-2 px-8 border-b">
                            <div class="flex flex-col">
                                <span class="xl:text-lg font-bold text-gray-700">{{ __('Tasks This Month') }}</span>
                                <span class="text-sm text-gray-500">{{ __('Number of tasks this month') }}</span>
                            </div>
                            <span class="text-xl md:text-2xl 2xl:text-3xl font-bold text-sky-600">{{ $ttm }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-8 border-b">
                            <div class="flex flex-col">
                                <span class="xl:text-lg font-bold text-gray-700">{{ __('Tasks Last Month') }}</span>
                                <span class="text-sm text-gray-500">{{ __('Number of tasks last month') }}</span>
                            </div>
                            <span class="text-xl md:text-2xl 2xl:text-3xl font-bold text-indigo-600">{{ $tlm }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-8 border-b">
                            <div class="flex flex-col">
                                <span class="xl:text-lg font-bold text-gray-700">{{ __('Notifications This Month') }}</span>
                                <span class="text-sm text-gray-500">{{ __('Number of notifications this month') }}</span>
                            </div>
                            <span class="text-xl md:text-2xl 2xl:text-3xl font-bold text-sky-600">{{ $ntm }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-8">
                            <div class="flex flex-col">
                                <span class="xl:text-lg font-bold text-gray-700">{{ __('Notifications Last Month') }}</span>
                                <span class="text-sm text-gray-500">{{ __('Number of notifications last month') }}</span>
                            </div>
                            <span class="text-xl md:text-2xl 2xl:text-3xl font-bold text-indigo-600">{{ $nlm }}</span>
                        </div>
                    </div>
                    <div class="bg-white flex flex-col items-center rounded-lg py-2 px-8 space-y-2">
                        <span class="font-bold text-gray-700 capitalize">{{ __('Tasks This Month') }}</span>
                        <div class="w-3/4 2xl:w-2/3">
                            <canvas id="tasks"></canvas>
                        </div>
                    </div>
                    <div class="bg-white flex flex-col items-center rounded-lg py-2 px-8 space-y-2">
                        <span class="font-bold text-gray-700 capitalize">{{ __('Notifications This Month')}}</span>
                        <div class="w-3/4 2xl:w-2/3">
                            <canvas id="notifications"></canvas>
                        </div>
                    </div>
                </div>


                <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mt-8">
                    <div class="xl:col-span-2 bg-white rounded-lg p-4">
                        @livewire('notifications.scheduled-notifications')
                    </div>
                    <div class="bg-white rounded-lg p-4">
                        @livewire('tasks.pending-tasks')
                    </div>
                </div>
            @endrole

            @role('user')
                <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-4 gap-6 2xl:gap-12">
                    <div class="px-6 py-6 bg-white rounded-lg shadow-xl">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-lg text-teal-600">{{ __('Current Budget') }}</span>
                        </div>
                        <div class="flex items-center justify-between mt-6">
                            <div>
                                <svg class="w-12 2xl:w-16 h-12 2xl:h-16 p-1 2xl:p-3 bg-teal-400 bg-opacity-20 rounded-full text-teal-600 border border-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex items-end">
                                    <span class="text-2xl 2xl:text-3xl font-bold">$ {{ $cb }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-6 bg-white rounded-lg shadow-xl">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-lg text-sky-600">{{ __('Spent This Year') }}</span>
                        </div>
                        <div class="flex items-center justify-between mt-6">
                            <div>
                                <svg class="w-12 2xl:w-16 h-12 2xl:h-16 p-1 2xl:p-3 bg-sky-400 bg-opacity-20 rounded-full text-sky-600 border border-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex items-end">
                                    <span class="text-2xl 2xl:text-3xl font-bold">$ 0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-6 bg-white rounded-lg shadow-xl">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-lg text-indigo-600">{{ __('Pending Tasks') }}</span>
                        </div>
                        <div class="flex items-center justify-between mt-6">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 2xl:w-16 h-12 2xl:h-16 p-1 2xl:p-3 bg-indigo-400 bg-opacity-20 rounded-full text-indigo-600 border border-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex items-end">
                                    <span class="text-2xl 2xl:text-3xl font-bold">{{ $pt }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-6 bg-white rounded-lg shadow-xl">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-lg text-purple-600">{{ __('Active Projects') }}</span>
                        </div>
                        <div class="flex items-center justify-between mt-6">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 2xl:w-16 h-12 2xl:h-16 p-1 2xl:p-3 bg-purple-400 bg-opacity-20 rounded-full text-purple-600 border border-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex items-end">
                                    <span class="text-2xl 2xl:text-3xl font-bold">{{ $ap }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-12 mt-12">
                    <div class="bg-white rounded-lg p-4">
                        @livewire('tasks.pending-tasks')
                    </div>
                    <div class="bg-white rounded-lg p-4">
                        @livewire('projects.active-projects')
                    </div>
                </div>
                
            @endrole
        </div>
    </div>

@push('scripts')
    <script>
        // start:: Tasks
        const DATA_SET_TASKS = [{{ $pttm }}, {{ $cottm }}, {{ $cattm }}];

        const dataTasks = {
            labels: ['Pending', 'Completed', 'Cancelled'],
            datasets: [
                {
                    data: DATA_SET_TASKS,
                    backgroundColor: [
                        '#eab308',
                        '#22c55e',
                        '#ef4444',
                    ],
                },
            ]
        };

        const configTasks = {
            type: 'doughnut',
            data: dataTasks,
            options: {
                responsive: true,
            },
        };

        var tasks = new Chart(
            document.getElementById('tasks'),
            configTasks
        );
        // end:: Tasks

        // start:: Notifications
        const DATA_SET_NOTIFICATIONS = [{{ $sntm }}, {{ $pntm }}, {{ $fntm }}, {{ $cntm }}];

        const dataNotifications = {
            labels: ['Scheduled', 'Processing', 'Finished', 'Cancelled'],
            datasets: [
                {
                    data: DATA_SET_NOTIFICATIONS,
                    backgroundColor: [
                        '#eab308',
                        '#60a5fa',
                        '#22c55e',
                        '#ef4444',
                    ],
                },
            ]
        };

        const configNotifications = {
            type: 'doughnut',
            data: dataNotifications,
            options: {
                responsive: true,
            },
        };

        var tasks = new Chart(
            document.getElementById('notifications'),
            configNotifications
        );
        // end:: Notifications
    </script>
@endpush
</x-app-layout>
