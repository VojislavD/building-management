<?php

namespace App\Jobs;

use App\Enums\NotificationStatus;
use App\Models\Notification as NotificationModel;
use App\Notifications\BuildingNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public NotificationModel $notification)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tenants = $this->notification->building->allTenants();
        
        Notification::send($tenants, new BuildingNotification(
            $this->notification->via_email,
            $this->notification->subject,
            $this->notification->body
        ));

        $this->notification->update([
            'status' => NotificationStatus::Finished()
        ]);
    }
}
