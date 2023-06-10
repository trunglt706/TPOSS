<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Admins\Entities\PostGroup;

class AdminPostGroupObserver
{
    public function creating(PostGroup $group)
    {
        $order = $group->order ?? PostGroup::get_order();
        $group->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;
        $group->order = $order;
        $group->status = $group->status ?? PostGroup::STATUS_SUSPEND;
        $group->slug = PostGroup::get_slug($group->name, $order);
    }

    public function created(PostGroup $group)
    {
        //
    }

    public function updating(PostGroup $group)
    {
        $group->slug = PostGroup::get_slug($group->name);
    }

    public function updated(PostGroup $group)
    {
    }

    public function deleted(PostGroup $group)
    {
        // delete all post of group
        if ($group->posts) {
            $group->posts->delete();
        }
        // check and delete image in s3
        if ($group->image) {
            Storage::delete($group->image);
        }
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
