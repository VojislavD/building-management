<?php

namespace App\Console\Commands;

use App\Enums\NotificationStatus;
use App\Jobs\SendNotification;
use App\Models\Notification as NotificationModel;
use Illuminate\Console\Command;

class SendBuildingNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:building-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications to apartment owners from some building';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $notifications = NotificationModel::where('status', NotificationStatus::Scheduled())
            ->where('send_at', '<', now())
            ->get();

        foreach ($notifications as $notification) {
            SendNotification::dispatch($notification);

            $notification->update([
                'status' => NotificationStatus::Processing(),
            ]);
        }

        return 0;
    }
}
