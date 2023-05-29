<?php

namespace App\Observers;

use Modules\Admins\Entities\Posts;

class AdminPostObserver
{
    public function creating(Posts $post)
    {
    }

    public function created(Posts $post)
    {
        //
    }

    public function updating(Posts $post)
    {
    }

    public function updated(Posts $post)
    {
    }

    public function deleted(Posts $post)
    {
    }

    public function restored(Posts $post)
    {
        //
    }

    public function forceDeleted(Posts $post)
    {
        //
    }
}
