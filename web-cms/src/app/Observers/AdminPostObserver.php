<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Admins\Entities\Posts;

class AdminPostObserver
{
    public function creating(Posts $post)
    {
        $order = $post->order ?? Posts::get_order($post->group_id ?? 0);
        $post->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;
        $post->order = $order;
        $post->status = $post->status ?? Posts::STATUS_SUSPEND;
        $post->slug = Posts::get_slug($post->name, $order);
    }

    public function created(Posts $post)
    {
        //
    }

    public function updating(Posts $post)
    {
        $post->slug = Posts::get_slug($post->name);
    }

    public function updated(Posts $post)
    {
    }

    public function deleted(Posts $post)
    {
        // delete image in s3
        if ($post->image) {
            Storage::delete($post->image);
        }
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
