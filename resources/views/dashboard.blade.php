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
                <div class="grid grid-cols-3 gap-8">
                    <div class="bg-white rounded-lg space-y-4">
                        <div class="flex items-center justify-between py-2 px-8 border-b">
                            <div class="flex flex-col">
                                <span class="text-lg font-bold text-gray-700">{{ __('Tasks This Month') }}</span>
                                <span class="text-sm text-gray-500">{{ __('Number of tasks this month') }}</span>
                            </div>
                            <span class="text-3xl font-bold text-sky-600">{{ $ttm }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-8 border-b">
                            <div class="flex flex-col">
                                <span class="text-lg font-bold text-gray-700">{{ __('Tasks Last Month') }}</span>
                                <span class="text-sm text-gray-500">{{ __('Number of tasks last month') }}</span>
                            </div>
                            <span class="text-3xl font-bold text-indigo-600">{{ $tlm }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-8 border-b">
                            <div class="flex flex-col">
                                <span class="text-lg font-bold text-gray-700">{{ __('Notifications This Month') }}</span>
                                <span class="text-sm text-gray-500">{{ __('Number of notifications this month') }}</span>
                            </div>
                            <span class="text-3xl font-bold text-sky-600">{{ $ntm }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-8">
                            <div class="flex flex-col">
                                <span class="text-lg font-bold text-gray-700">{{ __('Notifications Last Month') }}</span>
                                <span class="text-sm text-gray-500">{{ __('Number of notifications last month') }}</span>
                            </div>
                            <span class="text-3xl font-bold text-indigo-600">{{ $nlm }}</span>
                        </div>
                    </div>
                    <div class="bg-white flex flex-col items-center rounded-lg py-2 px-8 space-y-2">
                        <span class="font-bold text-gray-700 capitalize">{{ __('Tasks This Month') }}</span>
                        <div class="w-2/3">
                            <canvas id="tasks"></canvas>
                        </div>
                    </div>
                    <div class="bg-white flex flex-col items-center rounded-lg py-2 px-8 space-y-2">
                        <span class="font-bold text-gray-700 capitalize">{{ __('Notifications This Month')}}</span>
                        <div class="w-2/3">
                            <canvas id="notifications"></canvas>
                        </div>
                    </div>
                </div>


                <div class="grid grid-cols-3 gap-8 mt-8">
                    <div class="h-full col-span-2 bg-white rounded-lg p-4">
                        @livewire('notifications.scheduled-notifications')
                    </div>
                    <div class="h-full bg-white rounded-lg p-4">
                        @livewire('tasks.pending-tasks')
                    </div>
                </div>
            @endrole

            @role('user')
                User
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
