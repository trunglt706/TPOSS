<?php

namespace App\Observers;

use Carbon\Carbon;
use Modules\Admins\Entities\RegisterUsing;

class AdminRegisterUsingObserver
{
    public function creating(RegisterUsing $client)
    {
        $status = $client->status ?? RegisterUsing::STATUS_WAIT;
        $client->ip = $client->ip ?? get_ip();
        $client->device = $client->device ?? get_device();
        $client->status = $status;

        if ($status == RegisterUsing::STATUS_WAIT) {
            $client->verify_code = generateRandomString(10);
            $client->expired_code = Carbon::now()->addMinutes(15);
        }
    }

    public function created(RegisterUsing $client)
    {
        // send email to validate code
    }

    public function updating(RegisterUsing $client)
    {
    }

    public function updated(RegisterUsing $client)
    {
    }

    public function deleted(RegisterUsing $client)
    {
    }

    public function restored(RegisterUsing $client)
    {
        //
    }

    public function forceDeleted(RegisterUsing $client)
    {
        //
    }
}
