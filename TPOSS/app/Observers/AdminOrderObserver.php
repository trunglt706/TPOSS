<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Modules\Admins\Entities\AdminOrder;

class AdminOrderObserver
{
    public function creating(AdminOrder $order)
    {
        $discount_total = $order->discount_value;
        if ($order->discount_type == AdminOrder::DISCOUNT_TYPE_PERCENT) {
            $discount_total = $order->discount_value * $order->sub_total / 100;
        }
        $vat_total = $order->vat_value * ($order->sub_total - $discount_total) / 100;

        $order->discount_total = $discount_total;
        $order->vat_total = $vat_total;
        $order->total = $order->sub_total - $discount_total + $vat_total;
    }

    public function created(AdminOrder $order)
    {
        //
    }

    public function updating(AdminOrder $order)
    {
        $discount_total = $order->discount_value;
        if ($order->discount_type == AdminOrder::DISCOUNT_TYPE_PERCENT) {
            $discount_total = $order->discount_value * $order->sub_total / 100;
        }
        $vat_total = $order->vat_value * ($order->sub_total - $discount_total) / 100;

        $order->discount_total = $discount_total;
        $order->vat_total = $vat_total;
        $order->total = $order->sub_total - $discount_total + $vat_total;
        $order->created_by = Auth::guard('admin')->user()->id;
    }

    public function updated(AdminOrder $order)
    {
    }

    public function deleted(AdminOrder $order)
    {
        $order->status = AdminOrder::STATUS_DELETED;
        $order->deleted_by = Auth::guard('admin')->user()->id;
    }

    public function restored(AdminOrder $order)
    {
        //
    }

    public function forceDeleted(AdminOrder $order)
    {
        //
    }
}
