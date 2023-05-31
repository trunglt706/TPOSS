<?php

namespace App\Observers;

use Modules\Admins\Entities\PostGroup;

class AdminPostGroupObserver
{
    public function creating(PostGroup $group)
    {
    }

    public function created(PostGroup $group)
    {
        //
    }

    public function updating(PostGroup $group)
    {
    }

    public function updated(PostGroup $group)
    {
    }

    public function deleted(PostGroup $group)
    {
        // delete all post of group

        // check and delete image in s3
    }

    public function restored(PostGroup $group)
    {
        //
    }

    public function forceDeleted(PostGroup $group)
    {
        //
    }
}
