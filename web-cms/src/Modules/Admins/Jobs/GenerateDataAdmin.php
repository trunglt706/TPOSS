<?php

namespace Modules\Admins\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Admins\Entities\Admins;

class GenerateDataAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $admin_group_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($admin_group_id)
    {
        $this->admin_group_id = $admin_group_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        for ($i = 0; $i < 1000; $i++) {
            $phone = 909000999 + $i;
            Admins::create([
                'name' => "Admin $i",
                'email' => "admin$i@gmail.com",
                'phone' => "0$phone",
                'group_id' => $this->admin_group_id,
                'status' => Admins::STATUS_ACTIVE,
            ]);
        }
    }
}
