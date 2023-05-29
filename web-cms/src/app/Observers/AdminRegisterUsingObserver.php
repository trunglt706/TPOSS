<?php

namespace App\Observers;

use Modules\Admins\Entities\RegisterUsing;

class AdminRegisterUsingObserver
{
    public function creating(RegisterUsing $client)
    {
    }

    public function created(RegisterUsing $client)
    {
        //
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
