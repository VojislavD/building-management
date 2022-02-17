<?php

namespace App\Http\Controllers;

use App\Enums\NotificationStatus;
use App\Enums\TaskStatus;
use App\Models\Notification;
use App\Models\Task;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(): Renderable
    {
        $tasksThisMonth = Task::whereMonth('created_at',  now())->count();
        $tasksLastMonth = Task::whereMonth('created_at', now()->subMonth())->count();
        $notificationsThisMonth = Notification::whereMonth('created_at', now())->count();
        $notificationsLastMonth = Notification::whereMonth('created_at', now()->subMonth())->count();

        $pendingTasksThisMonth = Task::whereMonth('created_at', now())
            ->whereStatus(TaskStatus::Pending)
            ->count();
        $completedTasksThisMonth = Task::whereMonth('created_at', now())
            ->whereStatus(TaskStatus::Completed)
            ->count();
        $cancelledTasksThisMonth = Task::whereMonth('created_at', now())
            ->whereStatus(TaskStatus::Cancelled)
            ->count();

        $scheduledNotificationsThisMonth = Notification::whereMonth('created_at', now())
            ->whereStatus(NotificationStatus::Scheduled)
            ->count();
        $processingNotificationsThisMonth = Notification::whereMonth('created_at', now())
            ->whereStatus(NotificationStatus::Processing)
            ->count();
        $finishedNotificationsThisMonth = Notification::whereMonth('created_at', now())
            ->whereStatus(NotificationStatus::Finished)
            ->count();
        $cancelledNotificationsThisMonth = Notification::whereMonth('created_at', now())
            ->whereStatus(NotificationStatus::Cancelled)
            ->count();

        return view('dashboard', [
            'ttm' => $tasksThisMonth,
            'tlm' => $tasksLastMonth,
            'ntm' => $notificationsThisMonth,
            'nlm' => $notificationsLastMonth,
            'pttm' => $pendingTasksThisMonth,
            'cottm' => $completedTasksThisMonth,
            'cattm' => $cancelledTasksThisMonth,
            'sntm' => $scheduledNotificationsThisMonth,
            'pntm' => $processingNotificationsThisMonth,
            'fntm' => $finishedNotificationsThisMonth,
            'cntm' => $cancelledNotificationsThisMonth,
        ]);
    }
}
