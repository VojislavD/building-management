<?php

namespace App\Console\Commands;

use App\Notifications\BuildingNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Models\Notification as NotificationModel;

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
        $notifications = NotificationModel::where('status', NotificationModel::STATUS_SCHEDULED)->get(); 

        foreach ($notifications as $notification) {
            $tenants = $notification->building->tenants;

            Notification::send($tenants, new BuildingNotification(
                $notification->via_email,
                $notification->subject,
                $notification->body
            ));
        }
    }
}