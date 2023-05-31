<?php

namespace App\Observers;

use Modules\Stores\Entities\Stores;

class StoreObserver
{

    public function creating(Stores $store)
    {
    }

    public function created(Stores $store)
    {
        // add to store_permission
    }

    public function updating(Stores $store)
    {
    }

    public function updated(Stores $store)
    {
    }

    public function deleted(Stores $store)
    {
    }

    public function restored(Stores $store)
    {
        // check and delete logo in s3
    }

    public function forceDeleted(Stores $store)
    {
        //
    }
}
